<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['site_name'] ?? 'PROPHAMART' }} | {{ $settings['tagline'] ?? 'Trusted Wellness & Pharmacy Care' }}</title>
    <meta name="description" content="{{ $settings['hero_subtitle'] ?? 'Wellness products and pharmacy essentials.' }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .soft-card { background: rgba(15,23,42,0.02); border: 1px solid rgba(15,23,42,0.06); }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased">
    @php($cartCount = collect(session('cart', []))->sum('quantity'))
    <style>
        body { background: #f5f7fb; }
        .brand-mark {
            width: 70px; height: 70px; border-radius: 22px;
            background: linear-gradient(135deg, #0b2d4d 0%, #184f7e 55%, #0b3551 100%);
            display: inline-flex; align-items: center; justify-content: center;
            position: relative; box-shadow: inset 0 0 0 2px rgba(255,255,255,0.08);
        }
        .brand-mark::before {
            content: ""; position: absolute; inset: 12px 10px 12px 10px;
            border-radius: 18px; background: linear-gradient(135deg, #21c7b4 0%, #11a4b3 100%);
            box-shadow: inset 0 0 0 4px rgba(255,255,255,0.2);
        }
        .brand-mark::after {
            content: "+"; position: relative; z-index: 1;
            font-size: 2rem; color: white; font-weight: 800; line-height: 1;
        }
        .glass-strip { background: linear-gradient(135deg, #0e1f33 0%, #102e46 100%); }
        .product-card { transition: transform .2s ease, box-shadow .2s ease; }
        .product-card:hover { transform: translateY(-3px); box-shadow: 0 16px 32px rgba(15,23,42,0.12); }
    </style>
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/90 backdrop-blur">
        <div class="glass-strip text-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-2 text-[11px] font-medium sm:px-6 lg:px-8">
                <div class="flex items-center gap-6">
                    <span>Free delivery over £60</span>
                    <span>Worldwide shipping</span>
                    <span>Secure checkout</span>
                </div>
                <div class="hidden items-center gap-5 md:flex">
                    <span>info@propharmat.com</span>
                    <span>+44 20 5555 0142</span>
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 items-center justify-between gap-6">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="brand-mark" aria-label="PROPHAMART logo"></div>
                    <div>
                        <div class="text-2xl font-black tracking-tight text-slate-900">{{ $settings['site_name'] ?? 'PROPHAMART' }}</div>
                        <div class="text-[10px] uppercase tracking-[0.24em] text-slate-500">{{ $settings['tagline'] ?? 'Health • Care • Delivered' }}</div>
                    </div>
                </a>

                <nav class="hidden items-center gap-7 text-sm font-medium text-slate-600 md:flex">
                    <a href="{{ route('home') }}" class="hover:text-emerald-700">Home</a>
                    <a href="{{ route('shop') }}" class="hover:text-emerald-700">Shop</a>
                    <a href="#categories" class="hover:text-emerald-700">Categories</a>
                    <a href="#popular" class="hover:text-emerald-700">Popular</a>
                    <a href="{{ route('contact') }}" class="hover:text-emerald-700">Contact</a>
                </nav>

                <div class="flex items-center gap-3">
                    <a href="{{ route('cart.index') }}" class="relative rounded-full border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:border-emerald-600 hover:text-emerald-700">
                        Basket
                        @if($cartCount > 0)
                            <span class="absolute -right-2 -top-2 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-emerald-600 px-1 text-[10px] font-bold text-white">{{ $cartCount }}</span>
                        @endif
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-full border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:border-emerald-600 hover:text-emerald-700">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:border-emerald-600 hover:text-emerald-700">Login</a>
                    @endauth
                    <a href="{{ route('shop') }}" class="rounded-full bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-700">Shop now</a>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <footer id="contact" class="mt-16 border-t border-slate-200 bg-slate-900 text-slate-200">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid-cols-4 lg:px-8">
            <div>
                <div class="mb-4 text-xl font-extrabold text-white">{{ $settings['site_name'] ?? 'PROPHAMART' }}</div>
                <p class="text-sm text-slate-300">{{ $settings['footer_text'] ?? 'Trusted pharmacy and wellness essentials.' }}</p>
            </div>
            <div>
                <h3 class="mb-4 text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Quick links</h3>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li><a href="{{ route('shop') }}" class="hover:text-white">Shop</a></li>
                    <li><a href="#categories" class="hover:text-white">Categories</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white">Contact us</a></li>
                </ul>
            </div>
            <div>
                <h3 class="mb-4 text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Support</h3>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li>{{ $settings['phone'] ?? '+44 20 5555 0142' }}</li>
                    <li>{{ $settings['email'] ?? 'hello@propharmat.com' }}</li>
                    <li>{{ $settings['address'] ?? '45 Regent Street, London, UK' }}</li>
                </ul>
            </div>
            <div>
                <h3 class="mb-4 text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Newsletter</h3>
                <div class="flex rounded-full border border-slate-700 bg-slate-800 p-1">
                    <input class="w-full bg-transparent px-3 py-2 text-sm text-white placeholder:text-slate-500 focus:outline-none" placeholder="Your email" />
                    <button class="rounded-full bg-emerald-500 px-4 py-2 text-sm font-semibold text-white">Join</button>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
