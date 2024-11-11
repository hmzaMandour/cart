<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Shopping Cart</title>
</head>

<body class="bg-gray-100">
    @include('layouts.navigation')

    <div class="flex">
        @include('layouts.sidebar2')
        <div class="w-full p-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-6 text-center">Shopping Cart</h1>

            <div class="dark:bg-gray-800 shadow-lg rounded-lg p-6 space-y-4 max-w-3xl mx-auto">
                @php
                    $cartItems = Auth::user()->products;
                @endphp

                @foreach ($cartItems as $product)
                    <div class="flex items-center justify-between border-b border-gray-600 pb-4">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('/storage/images/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-20 h-20 object-cover rounded-md shadow-md">

                            <div>
                                <h3 class="text-lg font-semibold text-gray-200">{{ $product->name }}</h3>
                                <p class="text-gray-400 text-sm">Price: <span
                                        class="text-yellow-400">${{ number_format($product->price, 2) }}</span></p>
                                <p class="text-blue-500 font-semibold mt-1">Quantity: {{ $product->pivot->quantity }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-6">
                            <h4 class="text-xl font-bold text-yellow-400">
                                ${{ number_format($product->price * $product->pivot->quantity, 2) }}
                            </h4>

                            <form action="{{ route('cart.decrement', $product->id) }}" method="post">
                                @csrf
                                <button type="submit"
                                    class="text-red-500 hover:text-red-700 transition duration-150 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path
                                            d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z" />
                                        <path
                                            d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="flex justify-between items-center pt-6">
                    <h2 class="text-2xl font-semibold text-gray-300">Total:</h2>
                    @php
                        $total = $cartItems->sum(function ($product) {
                            return $product->price * $product->pivot->quantity;
                        });
                    @endphp
                    <h2 class="text-2xl font-bold text-yellow-300">${{ number_format($total, 2) }}</h2>
                </div>

                <div class="flex justify-end mt-4">
                    <a href="#"
                        class="px-6 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition duration-150 ease-in-out">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
