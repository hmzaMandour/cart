<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Users List</title>
</head>

<body class="bg-gray-100 font-sans">
    @include('layouts.navigation')

    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <div class="flex-1 p-8">
            <h1 class="text-3xl text-center font-bold text-gray-800 mb-6">Clients</h1>

            {{-- @if (session('success'))
                <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif --}}

            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold uppercase tracking-wider">ID</th>
                        <th class="py-3 px-4 text-left font-semibold uppercase tracking-wider">Name</th>
                        <th class="py-3 px-4 text-left font-semibold uppercase tracking-wider">Email</th>
                        <th class="py-3 px-4 text-left font-semibold uppercase tracking-wider">Status</th>
                        <th class="py-3 px-4 text-left font-semibold uppercase tracking-wider">Change Role</th>
                        <th class="py-3 px-4 text-left font-semibold uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-100 transition-colors duration-200">
                            <td class="py-3 px-4 text-gray-700">{{ $user->id }}</td>
                            <td class="py-3 px-4 text-gray-700">{{ $user->name }}</td>
                            <td class="py-3 px-4 text-gray-700">{{ $user->email }}</td>
                            <td class="py-3 px-4 text-gray-700">
                                @if ($user->trashed())
                                    <span class="text-red-500">Deleted</span>
                                @else
                                    <span class="text-green-500">Active</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <form method="post" action="{{ route('userpage.update', $user->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="checkbox" name="role" value="{{ $role->id }}"
                                        id="checkbox-{{ $user->id }}" @checked($user->roles->contains($role->id))>
                                    <label class="text-gray-700" for="checkbox-{{ $user->id }}">{{ $role->name }}</label>
                                    <button
                                        class="px-2 py-1 bg-blue-700 text-white rounded hover:bg-blue-900">Save</button>
                                </form>
                            </td>
                            <td class="py-3 px-4">
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                <div class="mt-8 flex justify-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</body>

</html>
