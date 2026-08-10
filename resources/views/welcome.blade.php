<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FamilyMart - Freshness Delivered and Quality Assured</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-gradient { background: linear-gradient(135deg, #166534 0%, #15803d 100%); }
        .glass-effect { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .slider-transition { transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1); }
        .toast { animation: slideIn 0.3s ease-out, slideOut 0.3s ease-out 3.7s forwards; }
        @keyframes slideIn {
            from { transform: translateY(100px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateY(0); opacity: 1; }
            to { transform: translateY(100px); opacity: 0; }
        }
    </style>
</head>
<body class="bg-slate-50 antialiased">

    <!-- Toast Container -->
    @if(session('success'))
        <div id="toast" class="toast fixed bottom-6 right-6 bg-green-600 text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 z-50 max-w-sm">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div id="toast" class="toast fixed bottom-6 right-6 bg-red-600 text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 z-50 max-w-sm">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-black text-green-700 tracking-tighter">FamilyMart.</a>
            
            <div class="flex items-center space-x-5">
                @auth
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="bg-red-50 text-red-600 px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-red-100 transition border border-red-100">
                            Admin Dashboard
                        </a>
                    @endif
                    <div class="hidden md:block text-right">
                        <p class="text-[10px] text-slate-400 font-bold uppercase">Customer</p>
                        <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-slate-400 hover:text-red-500 font-bold text-xs transition">LOGOUT</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-green-700 font-bold text-sm transition">Sign In</a>
                @endauth

                <a href="{{ route('cart.index') }}" class="relative p-3 bg-slate-100 rounded-2xl hover:bg-green-100 transition-all group">
                    <svg class="w-5 h-5 text-slate-600 group-hover:text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    @if(isset($cartCount) && $cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-green-600 text-white text-[10px] font-black px-1.5 py-0.5 rounded-full ring-2 ring-white">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-6 px-4">
        
        <div class="relative hero-gradient rounded-[2rem] overflow-hidden mb-12 shadow-xl max-w-6xl mx-auto">
            <div class="absolute inset-0 opacity-10">
                <img src="{{ asset('images/vegetables.jpg') }}" class="w-full h-full object-cover">
            </div>
            
            <div class="relative px-6 py-10 md:py-16 flex flex-col md:flex-row items-center gap-10">
                <div class="md:w-3/5 text-white z-10 text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-black mb-4 leading-tight tracking-tight">
                        Freshness Delivered <br> <span class="text-yellow-400">To Your Door.</span>
                    </h1>
                    <p class="text-base opacity-90 max-w-lg mb-8 font-medium leading-relaxed">
                        Experience the ultimate convenience with FamilyMart. We bring farm-fresh produce directly to your family. 
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <a href="#products" class="bg-white text-green-800 px-8 py-3 rounded-xl font-bold hover:bg-yellow-400 transition-all shadow-lg active:scale-95 text-center">Shop Now</a>
                        <a href="#" class="glass-effect text-white px-8 py-3 rounded-xl font-bold hover:bg-white/20 transition-all text-center">Learn More</a>
                    </div>
                </div>
                
                <div class="md:w-2/5 w-full aspect-[4/3] overflow-hidden rounded-[2rem] glass-effect shadow-inner relative group">
                    <div id="hero-slider" class="slider-transition flex h-full">
                        <div class="min-w-full h-full relative">
                            <img src="{{ asset('images/vegetables.jpg') }}" class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 flex items-center justify-center bg-black/10"><span class="text-xl font-black italic text-white uppercase tracking-wider">Fresh Veggies</span></div>
                        </div>
                        <div class="min-w-full h-full relative">
                            <img src="{{ asset('images/fruits.jpg') }}" class="w-full h-full object-cover opacity-80">
                            <div class="absolute inset-0 flex items-center justify-center bg-black/10"><span class="text-xl font-black italic text-white uppercase tracking-wider">Premium Fruits</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="products" class="flex flex-col md:flex-row items-center justify-between mb-8">
            <h2 class="text-2xl font-black text-slate-800">Our Collection</h2>
            <div class="h-1 flex-1 mx-8 bg-slate-100 rounded-full hidden md:block"></div>
            <div class="flex gap-2">
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest">Organic</span>
                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest">Local</span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-20">
            @foreach($products as $product)
            <div class="bg-white rounded-[1.5rem] border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500 group">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset($product->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute top-3 right-3 glass-effect px-2 py-0.5 rounded-full"><span class="text-white font-bold text-[8px] uppercase">Available</span></div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-lg font-bold text-slate-800 mb-1">{{ $product->name }}</h3>
                    <p class="text-slate-400 text-xs mb-4 line-clamp-1 leading-relaxed">Sourced from local farms ensuring quality. [cite: 8, 9]</p>
                    
                    <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                        <div class="flex flex-col">
                            <span class="text-[8px] text-slate-400 font-bold uppercase tracking-widest">Price</span>
                            <span class="text-green-700 font-black text-lg">Rs.{{ number_format($product->price, 0) }}</span>
                        </div>
                        <a href="{{ route('cart.add', $product->id) }}" class="bg-green-600 text-white p-2.5 rounded-lg hover:bg-green-700 transition shadow-md active:scale-90">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <footer class="bg-white border-t border-slate-100 pt-16 pb-8">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl font-black text-slate-800 mb-2 tracking-tighter">FamilyMart.</h3>
            <p class="text-slate-400 max-w-sm mx-auto mb-8 text-sm leading-relaxed">Connecting local farmers with your kitchen for a healthier lifestyle.</p>
            <p class="text-[10px] text-slate-300 font-bold uppercase tracking-[0.3em]">
                &copy; 2026 FamilyMart / Built with Laravel 11
            </p>
        </div>
    </footer>

    <script>
        // Hero slider functionality
        const slider = document.getElementById('hero-slider');
        let index = 0;
        setInterval(() => {
            index = (index + 1) % 2;
            if(slider) slider.style.transform = `translateX(-${index * 100}%)`;
        }, 4000);

        // Toast notification auto-dismiss
        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('toast');
            if(toast) {
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 4000);
            }
        });
    </script>
</body>
</html>