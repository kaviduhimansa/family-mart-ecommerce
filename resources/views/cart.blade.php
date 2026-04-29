<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Basket - FamilyMart</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .item-card:hover { transform: translateY(-2px); transition: all 0.3s ease; }
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
            <a href="/" class="text-sm font-bold text-slate-500 hover:text-green-600 transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Continue Shopping
            </a>
        </div>
    </nav>

    <main class="container mx-auto mt-12 px-4 mb-20">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-4xl font-black text-slate-800 mb-2 leading-tight">My Basket</h1>
            <p class="text-slate-400 font-medium mb-10">Review your items before we harvest them for you.</p>

            @if(session('cart') && count(session('cart')) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    
                    <div class="lg:col-span-2 space-y-4">
                        @php $total = 0 @endphp
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            
                            <div class="bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-6 item-card">
                                <div class="w-24 h-24 flex-shrink-0">
                                    <img src="{{ asset($details['image']) }}" class="w-full h-full object-cover rounded-2xl shadow-inner border border-slate-50">
                                </div>

                                <div class="flex-1">
                                    <h3 class="font-bold text-slate-800 text-lg">{{ $details['name'] }}</h3>
                                    <p class="text-green-600 font-black">Rs. {{ number_format($details['price'], 0) }}</p>
                                    
                                    <div class="mt-3 flex items-center gap-4">
                                        <div class="flex items-center bg-slate-50 rounded-xl border border-slate-100 p-1">
                                            <form action="{{ route('cart.removeOne', $id) }}" method="POST">
                                                @csrf
                                                <button class="w-8 h-8 flex items-center justify-center text-slate-400 hover:text-red-500 font-bold transition">-</button>
                                            </form>
                                            <span class="w-8 text-center font-bold text-slate-700 text-sm">{{ $details['quantity'] }}</span>
                                            <a href="{{ route('cart.add', $id) }}" class="w-8 h-8 flex items-center justify-center text-slate-400 hover:text-green-600 font-bold transition">+</a>
                                        </div>
                                        
                                        <form action="{{ route('cart.remove') }}" method="POST" onsubmit="return confirm('Remove this item from basket?')">
                                            @csrf @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="text-[10px] font-black uppercase tracking-widest text-slate-300 hover:text-red-400 transition">Remove</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="text-right pr-4">
                                    <p class="text-[10px] text-slate-300 font-bold uppercase tracking-widest mb-1">Subtotal</p>
                                    <p class="text-slate-800 font-black">Rs.{{ number_format($details['price'] * $details['quantity'], 0) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="lg:col-span-1">
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-green-100/50 border border-slate-100 sticky top-28">
                            <h2 class="text-xl font-black text-slate-800 mb-6">Order Summary</h2>
                            
                            <div class="space-y-4 mb-8">
                                <div class="flex justify-between text-slate-400 font-medium">
                                    <span>Items Total</span>
                                    <span>Rs. {{ number_format($total, 0) }}</span>
                                </div>
                                <div class="flex justify-between text-slate-400 font-medium">
                                    <span>Delivery Fee</span>
                                    <span class="text-green-600 font-bold">FREE</span>
                                </div>
                                <div class="border-t border-slate-100 pt-4 flex justify-between items-end">
                                    <span class="text-slate-800 font-bold">Total Amount</span>
                                    <div class="text-right">
                                        <span class="text-3xl font-black text-green-700">Rs. {{ number_format($total, 0) }}</span>
                                    </div>
                                </div>
                            </div>

                            <button class="w-full bg-green-600 text-white py-5 rounded-2xl font-bold text-lg hover:bg-green-700 shadow-lg shadow-green-100 transition-all active:scale-95 flex items-center justify-center gap-3 group">
                                <span>Proceed to Checkout</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                            
                            <p class="text-[10px] text-slate-400 text-center mt-6 font-bold uppercase tracking-widest">Secure Checkout via FamilyMart API</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-[3rem] p-20 text-center shadow-sm border border-slate-100">
                    <div class="bg-slate-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-black text-slate-800 mb-2">Your basket is empty</h2>
                    <p class="text-slate-400 font-medium mb-10">Looks like you haven't added any fresh produce yet.</p>
                    <a href="/" class="inline-block bg-green-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-green-700 transition shadow-lg shadow-green-100">Start Shopping</a>
                </div>
            @endif
        </div>
    </main>

    <footer class="text-center py-10 opacity-30">
        <p class="text-[10px] font-black uppercase tracking-[0.3em]">FamilyMart © 2026 / SRS Compliant Module</p>
    </footer>

    <script>
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