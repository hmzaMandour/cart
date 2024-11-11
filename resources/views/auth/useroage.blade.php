<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <title>Products</title>
</head>

<body class="bg-gray-100">
    @include('layouts.navigation')

    <div class="flex">
        @include('layouts.sidebar2')

        <div class="container mx-auto px-4 py-8">
            {{-- <div id="imageCarousel" class="carousel slide mb-8" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('/storage/images/product6.webp') }}" class="d-block w-full h-52 object-cover" alt="Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('/storage/images/banner8.webp') }}" class="d-block w-full h-52 object-cover" alt="Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('/storage/images/product2.webp') }}" class="d-block w-full h-52 object-cover" alt="Image 3">
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div> --}}

            <!-- Product Grid -->
            <h2 class="text-2xl font-bold mb-6 text-center">Our Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <img class="w-full h-48 object-cover" src="{{ asset('/storage/images/' . $product->image) }}"
                            alt="{{ $product->name }}">
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>
                            <p class="text-gray-600 mt-1">{{ $product->desc }}</p>
                            <div class="mt-3 flex items-center justify-between">
                                <span class="text-xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>

                                <form action="{{ route('cards.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="productId">
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="userId">

                                    <button
                                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">Add
                                        to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Section -->
            <div class="mt-8 flex justify-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
