<?php
/**
 * NNAJI O.A & COMPANY — Automated Web Deployment Runner
 * 
 * Secure one-click runner for running Laravel migrations, seeds, storage link, and caching on Hostinger.
 * Auto-deletes itself after execution or via the manual Self-Destruct button.
 */

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');
set_time_limit(300);

// Root path detection (either in public/ or root)
$isPublicFolder = file_exists(__DIR__ . '/../artisan');
$baseDir = $isPublicFolder ? realpath(__DIR__ . '/..') : __DIR__;
$artisanPath = $baseDir . '/artisan';

// Self-destruct handler
if (isset($_POST['action']) && $_POST['action'] === 'self_destruct') {
    @unlink(__FILE__);
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'deploy-runner.php has been deleted from the server.']);
    exit;
}

$outputLog = [];
$statusSuccess = true;

function runArtisan(string $command, string $baseDir): string {
    $cmd = "cd " . escapeshellarg($baseDir) . " && php artisan " . $command . " 2>&1";
    $output = @shell_exec($cmd);
    return trim($output ?? 'No output returned');
}

$executed = false;
$autoDelete = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['run_deployment'])) {
    $executed = true;
    $autoDelete = isset($_POST['auto_delete']);

    // 1. PHP Version & Environment Check
    $phpVersion = phpversion();
    $outputLog[] = [
        'step' => 'Environment Check',
        'cmd' => 'php -v',
        'status' => version_compare($phpVersion, '8.2.0', '>=') ? 'success' : 'warning',
        'output' => "PHP Version: {$phpVersion} (Base Dir: {$baseDir})"
    ];

    // Check artisan exists
    if (!file_exists($artisanPath)) {
        $outputLog[] = [
            'step' => 'Artisan Verification',
            'cmd' => 'file_exists(artisan)',
            'status' => 'error',
            'output' => "Error: artisan file not found at {$artisanPath}. Ensure files are uploaded correctly."
        ];
        $statusSuccess = false;
    } else {
        // 2. Key Generate
        $out = runArtisan('key:generate --force', $baseDir);
        $outputLog[] = ['step' => 'Application Key', 'cmd' => 'php artisan key:generate --force', 'status' => 'success', 'output' => $out];

        // 3. Migrate Database
        $out = runArtisan('migrate --force', $baseDir);
        $status = (str_contains(strtolower($out), 'sqlstate') || str_contains(strtolower($out), 'error')) ? 'error' : 'success';
        if ($status === 'error') $statusSuccess = false;
        $outputLog[] = ['step' => 'Database Migration', 'cmd' => 'php artisan migrate --force', 'status' => $status, 'output' => $out];

        // 4. Seed Database
        $out = runArtisan('db:seed --force', $baseDir);
        $status = (str_contains(strtolower($out), 'sqlstate') || str_contains(strtolower($out), 'error')) ? 'error' : 'success';
        $outputLog[] = ['step' => 'Database Seeding', 'cmd' => 'php artisan db:seed --force', 'status' => $status, 'output' => $out];

        // 5. Storage Link
        $out = runArtisan('storage:link', $baseDir);
        $outputLog[] = ['step' => 'Storage Symlink', 'cmd' => 'php artisan storage:link', 'status' => 'success', 'output' => $out];

        // 6. Cache Configurations
        $out = runArtisan('config:cache', $baseDir);
        $outputLog[] = ['step' => 'Config Cache', 'cmd' => 'php artisan config:cache', 'status' => 'success', 'output' => $out];

        // 7. Cache Routes
        $out = runArtisan('route:cache', $baseDir);
        $outputLog[] = ['step' => 'Route Cache', 'cmd' => 'php artisan route:cache', 'status' => 'success', 'output' => $out];

        // 8. Cache Views
        $out = runArtisan('view:cache', $baseDir);
        $outputLog[] = ['step' => 'View Cache', 'cmd' => 'php artisan view:cache', 'status' => 'success', 'output' => $out];
    }

    // Auto-delete if checked and successful
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
                    <p class="text-xs text-amber-300/90">Automated Hostinger Production Setup Runner</p>
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
                        <i class="fa-solid fa-bolt text-amber-400"></i> Commands to be Executed:
                    </h2>
                    <ul class="mt-3 space-y-2 text-xs font-mono text-slate-300 bg-slate-950 p-4 rounded-xl border border-slate-800">
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> php artisan key:generate --force</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> php artisan migrate --force</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> php artisan db:seed --force</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> php artisan storage:link</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> php artisan config:cache</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> php artisan route:cache</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-400"></i> php artisan view:cache</li>
                    </ul>
                </div>

                <form method="POST" class="space-y-4">
                    <div class="flex items-center space-x-2 bg-slate-950/60 p-3.5 rounded-xl border border-slate-800">
                        <input type="checkbox" name="auto_delete" id="auto_delete" value="1" checked class="rounded text-emerald-600 focus:ring-emerald-500 w-4 h-4">
                        <label for="auto_delete" class="text-xs text-slate-300 cursor-pointer">
                            <strong class="text-white">Auto-Delete this script</strong> automatically when finished (Recommended for security)
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
                        <?= $statusSuccess ? '✓ All Commands Completed' : '⚠ Completed with Warnings' ?>
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
