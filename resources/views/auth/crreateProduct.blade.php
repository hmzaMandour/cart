<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Create Product</title>
    <script>
        function hideMessages() {
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 4000); 
            }
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.style.display = 'none';
                }, 4000); 
            }
        }

        
        document.addEventListener('DOMContentLoaded', hideMessages);
    </script>
</head>

<body class="bg-gray-100">
    @include('layouts.navigation')

    <div class="flex min-h-screen">
        @include('layouts.sidebar') 

        <div class="container mx-auto px-4 py-8 flex-1"> 
            <h1 class="text-2xl font-bold mb-4">Create Product</h1>

            @if (session('success'))
                <div id="success-message" class="bg-green-500 text-white p-4 rounded-lg mb-4 shadow-lg transition duration-300 ease-in-out">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div id="error-message" class="bg-red-500 text-white p-4 rounded-lg mb-4 shadow-lg transition duration-300 ease-in-out">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('userpage.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" name="price" id="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="desc" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="desc" id="desc" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Create Product</button>
            </form>
        </div>
    </div>
</body>

</html>
