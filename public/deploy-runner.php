<?php
/**
 * NNAJI O.A & COMPANY — Hostinger Pure PHP Deployment Runner
 * 
 * Works 100% in pure PHP memory without shell_exec, exec, or symlink dependencies.
 */

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');
set_time_limit(300);

// Root path detection
$isPublicFolder = file_exists(__DIR__ . '/../bootstrap/app.php');
$baseDir = $isPublicFolder ? realpath(__DIR__ . '/..') : __DIR__;
$publicDir = $isPublicFolder ? __DIR__ : $baseDir . '/public';

// Self-destruct handler
if (isset($_POST['action']) && $_POST['action'] === 'self_destruct') {
    @unlink(__FILE__);
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'deploy-runner.php has been deleted from the server.']);
    exit;
}

$outputLog = [];
$statusSuccess = true;
$executed = false;
$autoDelete = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['run_deployment'])) {
    $executed = true;
    $autoDelete = isset($_POST['auto_delete']);

    // 1. Environment & .env file preparation
    $envPath = $baseDir . '/.env';
    $envProdExample = $baseDir . '/.env.production.example';
    $envExample = $baseDir . '/.env.example';

    if (!file_exists($envPath)) {
        if (file_exists($envProdExample)) {
            @copy($envProdExample, $envPath);
            $outputLog[] = ['step' => '.env File Creation', 'cmd' => 'copy(.env.production.example -> .env)', 'status' => 'success', 'output' => 'Created .env from .env.production.example'];
        } elseif (file_exists($envExample)) {
            @copy($envExample, $envPath);
            $outputLog[] = ['step' => '.env File Creation', 'cmd' => 'copy(.env.example -> .env)', 'status' => 'success', 'output' => 'Created .env from .env.example'];
        }
    }

    // Ensure APP_KEY line exists in .env
    if (file_exists($envPath)) {
        $envContent = file_get_contents($envPath);
        if (!str_contains($envContent, 'APP_KEY=') || trim($envContent) === '') {
            $randomKey = 'base64:' . base64_encode(random_bytes(32));
            if (!str_contains($envContent, 'APP_KEY=')) {
                $envContent = "APP_KEY={$randomKey}\n" . $envContent;
            } else {
                $envContent = preg_replace('/APP_KEY=.*$/m', "APP_KEY={$randomKey}", $envContent);
            }
            @file_put_contents($envPath, $envContent);
            $outputLog[] = ['step' => 'APP_KEY Injection', 'cmd' => 'Set APP_KEY in .env', 'status' => 'success', 'output' => "Injected valid application encryption key into .env"];
        }
    }

    $autoloadPath = $baseDir . '/vendor/autoload.php';
    $appPath = $baseDir . '/bootstrap/app.php';

    if (!file_exists($autoloadPath)) {
        $outputLog[] = [
            'step' => 'Vendor Autoload Check',
            'cmd' => 'vendor/autoload.php',
            'status' => 'error',
            'output' => "Error: vendor/autoload.php not found. Run 'composer install --no-dev' first."
        ];
        $statusSuccess = false;
    } elseif (!file_exists($appPath)) {
        $outputLog[] = [
            'step' => 'Laravel Bootstrap Check',
            'cmd' => 'bootstrap/app.php',
            'status' => 'error',
            'output' => "Error: bootstrap/app.php was not found."
        ];
        $statusSuccess = false;
    } else {
        try {
            // Bootstrap Laravel Application in pure PHP memory
            require_once $autoloadPath;
            $app = require_once $appPath;

            $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
            $kernel->bootstrap();

            function callArtisanCommand(string $command, array $parameters = []): array {
                try {
                    $exitCode = \Illuminate\Support\Facades\Artisan::call($command, $parameters);
                    $output = trim(\Illuminate\Support\Facades\Artisan::output());
                    return [
                        'status' => $exitCode === 0 ? 'success' : 'warning',
                        'output' => $output ?: 'Command executed successfully.'
                    ];
                } catch (\Throwable $e) {
                    return [
                        'status' => 'error',
                        'output' => 'Error: ' . $e->getMessage()
                    ];
                }
            }

            // 2. Key Generate
            $res = callArtisanCommand('key:generate', ['--force' => true]);
            $outputLog[] = ['step' => 'Application Key', 'cmd' => 'Artisan::call("key:generate")', 'status' => 'success', 'output' => $res['output']];

            // 3. Database Migration
            $res = callArtisanCommand('migrate', ['--force' => true]);
            if ($res['status'] === 'error') $statusSuccess = false;
            $outputLog[] = ['step' => 'Database Migration', 'cmd' => 'Artisan::call("migrate")', 'status' => $res['status'], 'output' => $res['output']];

            // 4. Database Seeding
            $res = callArtisanCommand('db:seed', ['--force' => true]);
            $outputLog[] = ['step' => 'Database Seeding (Team, Services, Properties, Admin)', 'cmd' => 'Artisan::call("db:seed")', 'status' => $res['status'], 'output' => $res['output']];

            // 5. Storage Link (Safe with disabled symlink support)
            $target = $baseDir . '/storage/app/public';
            $link = $publicDir . '/storage';
            $storageOutput = '';

            if (file_exists($link)) {
                $storageOutput = "The [public/storage] symlink already exists.";
            } elseif (function_exists('symlink')) {
                if (@symlink($target, $link)) {
                    $storageOutput = "The [public/storage] link has been connected to [storage/app/public].";
                } else {
                    $res = callArtisanCommand('storage:link');
                    $storageOutput = $res['output'];
                }
            } else {
                // If symlink function is disabled by host, create storage folder or notice
                if (!is_dir($link)) {
                    @mkdir($link, 0755, true);
                }
                $storageOutput = "symlink() function is disabled on this server. Created directory [public/storage].";
            }
            $outputLog[] = ['step' => 'Storage Directory / Link', 'cmd' => 'Storage setup', 'status' => 'success', 'output' => $storageOutput];

            // 6. Cache Config
            $res = callArtisanCommand('config:cache');
            $outputLog[] = ['step' => 'Configuration Cache', 'cmd' => 'Artisan::call("config:cache")', 'status' => $res['status'], 'output' => $res['output']];

            // 7. Cache Routes
            $res = callArtisanCommand('route:cache');
            $outputLog[] = ['step' => 'Route Cache', 'cmd' => 'Artisan::call("route:cache")', 'status' => $res['status'], 'output' => $res['output']];

            // 8. Cache Views
            $res = callArtisanCommand('view:cache');
            $outputLog[] = ['step' => 'Blade View Cache', 'cmd' => 'Artisan::call("view:cache")', 'status' => $res['status'], 'output' => $res['output']];

        } catch (\Throwable $e) {
            $outputLog[] = [
                'step' => 'Execution Exception',
                'cmd' => 'Runtime Catch',
                'status' => 'error',
                'output' => 'Notice: ' . $e->getMessage()
            ];
        }
    }

    // Auto-delete if enabled and successful
    if ($autoDelete && $statusSuccess) {
        @unlink(__FILE__);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NNAJI O.A & CO — Deployment Runner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background-color: #061b13; font-family: system-ui, -apple-system, sans-serif; }
    </style>
</head>
<body class="min-h-screen text-slate-100 flex flex-col justify-between p-4 sm:p-8">

    <div class="max-w-3xl mx-auto w-full space-y-6">
        
        <!-- Header -->
        <div class="bg-forest-900/90 border border-emerald-500/30 rounded-2xl p-6 shadow-2xl backdrop-blur-md flex items-center justify-between" style="background-color: #0a2a1e;">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-slate-950 font-black text-sm shadow-md">
                    NOA
                </div>
                <div>
                    <h1 class="text-lg font-bold text-white tracking-wide">NNAJI O.A & COMPANY</h1>
                    <p class="text-xs text-amber-300/90">Hostinger In-Memory Deployment Engine</p>
                </div>
            </div>
            <span class="px-3 py-1 text-[11px] font-mono rounded-full bg-emerald-950/80 border border-emerald-500/40 text-emerald-400">
                PHP <?= phpversion() ?>
            </span>
        </div>

        <?php if (!$executed): ?>
            <!-- Ready to Execute Form -->
            <div class="bg-slate-900/90 border border-slate-800 rounded-2xl p-6 sm:p-8 space-y-6 shadow-xl">
                <div>
                    <h2 class="text-base font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-bolt text-amber-400"></i> Operations to Execute in Memory:
                    </h2>
                    <ul class="mt-3 space-y-2 text-xs font-mono text-slate-300 bg-slate-950 p-4 rounded-xl border border-slate-800">
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> .env & Key Generation</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> Database Migrations (`Artisan::call('migrate')`)</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> Database Seeds (`Artisan::call('db:seed')`)</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> Storage Setup</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> Configuration Cache (`Artisan::call('config:cache')`)</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> Route Cache (`Artisan::call('route:cache')`)</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> View Cache (`Artisan::call('view:cache')`)</li>
                    </ul>
                </div>

                <form method="POST" class="space-y-4">
                    <div class="flex items-center space-x-2 bg-slate-950/60 p-3.5 rounded-xl border border-slate-800">
                        <input type="checkbox" name="auto_delete" id="auto_delete" value="1" checked class="rounded text-emerald-600 focus:ring-emerald-500 w-4 h-4">
                        <label for="auto_delete" class="text-xs text-slate-300 cursor-pointer">
                            <strong class="text-white">Auto-Delete this script</strong> automatically after success (Recommended)
                        </label>
                    </div>

                    <button type="submit" name="run_deployment" value="1" class="w-full py-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-bold text-xs uppercase tracking-widest transition shadow-xl flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-rocket"></i> Run Deployment Setup Now
                    </button>
                </form>
            </div>

        <?php else: ?>

            <!-- Results Console -->
            <div class="bg-slate-900/90 border border-slate-800 rounded-2xl p-6 sm:p-8 space-y-5 shadow-xl">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-terminal text-emerald-400"></i> Execution Results
                    </h2>
                    <span class="px-3 py-1 text-xs font-bold rounded-full <?= $statusSuccess ? 'bg-emerald-950 text-emerald-300 border border-emerald-600/40' : 'bg-red-950 text-red-300 border border-red-600/40' ?>">
                        <?= $statusSuccess ? '✓ Deployment Completed Successfully' : '⚠ Completed with Issues' ?>
                    </span>
                </div>

                <div class="space-y-3 font-mono text-xs">
                    <?php foreach ($outputLog as $log): ?>
                        <div class="p-3.5 rounded-xl border <?= $log['status'] === 'success' ? 'bg-slate-950/80 border-emerald-900/50' : ($log['status'] === 'warning' ? 'bg-amber-950/30 border-amber-800/40' : 'bg-red-950/40 border-red-800/50') ?>">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-bold text-white"><?= htmlspecialchars($log['step']) ?></span>
                                <span class="text-[10px] uppercase font-bold <?= $log['status'] === 'success' ? 'text-emerald-400' : ($log['status'] === 'warning' ? 'text-amber-400' : 'text-red-400') ?>">
                                    <?= $log['status'] ?>
                                </span>
                            </div>
                            <div class="text-[11px] text-slate-500 mb-1">$ <?= htmlspecialchars($log['cmd']) ?></div>
                            <pre class="text-slate-300 text-[11px] whitespace-pre-wrap leading-relaxed overflow-x-auto"><?= htmlspecialchars($log['output']) ?></pre>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Action Links -->
                <div class="pt-4 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <a href="./" class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs uppercase tracking-wider text-center transition">
                        Open Website Home &rarr;
                    </a>

                    <button id="delete-btn" onclick="deleteSelf()" type="button" class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-red-900/80 hover:bg-red-800 text-red-100 font-bold text-xs uppercase tracking-wider transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-trash-can"></i> Delete This Script Now
                    </button>
                </div>
            </div>

        <?php endif; ?>

    </div>

    <!-- Footer -->
    <div class="text-center text-xs text-slate-500 mt-8">
        &copy; <?= date('Y') ?> NNAJI O.A & COMPANY &bull; Estate Surveyors & Valuers
    </div>

    <script>
        function deleteSelf() {
            if (!confirm('Are you sure you want to permanently delete this runner script?')) return;
            const btn = document.getElementById('delete-btn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Deleting...';

            fetch(window.location.href, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=self_destruct'
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message || 'File deleted successfully.');
                window.location.href = './';
            })
            .catch(() => {
                alert('File deleted or already removed.');
                window.location.href = './';
            });
        }
    </script>
</body>
</html>
