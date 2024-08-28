<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <a href="{{ route('users.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">
                Create Users</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (Session::has('success'))
                <div class="bg-green-200 border-green-600 p-4 mb-3 rounded-sm shadow-sm">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if (Session::has('error'))
                <div class="bg-red-200 broder-green-600 p-4 mb-3 rounded-sm shadow-sm">
                    {{ Session::get('error') }}
                </div>
            @endif




            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="broder-b">
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Roles</th>
                        <th class="px-6 py-3 text-left">Created</th>
                        <th class="px-6 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($users->isNotEmpty())
                        @foreach ($users as $user)
                            <tr class="border-b">
                                <td class="px-6 py-4 text-left">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-left">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-left">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @foreach ($user->roles as $role)
                                        <span class="bg-blue-700 text-lg rounded-md text-white px-2 py-1">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                {{-- <td class="px-6 py-4 text-left">
                                    {{$user->roles->pluck('name')->implode(', ')}}
                                </td> --}}

                                <td class="px-6 py-4 text-left">{{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}
                                </td>
                                <td class="px-6 py-4 text-left">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="bg-yellow-500 text-sm rounded-md text-white px-5 py-3">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-700 text-sm rounded-md text-white px-5 py-3">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class=" my-3">
                {{ $users->links() }}

            </div>


        </div>
    </div>
</x-app-layout>
