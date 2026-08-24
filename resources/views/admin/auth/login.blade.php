<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal Login | NNAJI O.A & COMPANY</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: {
                            950: '#061b13',
                            900: '#0a2a1e',
                            800: '#0f3d2e',
                        },
                        gold: {
                            500: '#c5a059',
                            400: '#d4af37',
                            300: '#e7cf84',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        cinzel: ['Cinzel', 'serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-forest-950 min-h-screen flex items-center justify-center p-4 font-sans relative overflow-hidden">
    
    <!-- Subtle luxury background pattern -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#c5a059_1px,transparent_1px)] [background-size:24px_24px]"></div>

    <div class="w-full max-w-md relative z-10">
        
        <!-- Logo Badge -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-gold-400 to-gold-600 text-forest-950 font-bold flex items-center justify-center font-cinzel text-2xl mx-auto shadow-xl mb-3">
                NOA
            </div>
            <h1 class="text-white font-cinzel font-bold text-xl tracking-wider">NNAJI O.A & COMPANY</h1>
            <p class="text-gold-400 text-xs tracking-widest uppercase font-semibold mt-1">Estate Surveyors & Valuers &bull; CMS</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-3xl p-8 shadow-2xl border border-gold-500/30 space-y-6">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Surveyor Portal Authentication</h2>
                <p class="text-xs text-slate-500 mt-1">Sign in with authorized corporate credentials</p>
            </div>

            @if($errors->any())
                <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Email Address</label>
                    <div class="relative">
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="name@company.com" class="w-full px-4 py-2.5 pl-10 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
                        <i class="fa-solid fa-envelope absolute left-3.5 top-3.5 text-slate-400 text-xs"></i>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Password</label>
                    <div class="relative">
                        <input type="password" name="password" required placeholder="••••••••••••" class="w-full px-4 py-2.5 pl-10 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
                        <i class="fa-solid fa-lock absolute left-3.5 top-3.5 text-slate-400 text-xs"></i>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center space-x-2 text-slate-600">
                        <input type="checkbox" name="remember" class="rounded text-forest-900 focus:ring-forest-800">
                        <span>Keep me logged in</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-3 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-xs uppercase tracking-wider transition duration-200 shadow-md flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-key text-gold-400"></i>
                    <span>Access CMS Dashboard</span>
                </button>
            </form>

            <div class="pt-4 border-t border-slate-100 text-center text-xs text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-forest-900 transition">&larr; Return to Public Website</a>
            </div>
        </div>

    </div>
</body>
</html>
