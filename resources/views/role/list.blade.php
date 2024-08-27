<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('roles') }}
            </h2>
            <a href="{{ route('roles.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">
                Create Roles</a>
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
                        <th class="px-6 py-3 text-left">Permission</th>
                        <th class="px-6 py-3 text-left">Created</th>
                        <th class="px-6 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if($roles -> isNotEmpty())
                    @foreach ($roles as $role)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $role->name }}</td>
                            <td class="px-6 py-4">{{ $role->permissions->pluck('name')->implode(' , ') }}</td>
                            <td class="px-6 py-4">{{\Carbon\Carbon::parse($role->created_at)->format('d M, Y')}}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('roles.edit', $role->id) }}"
                                    class="bg-yellow-500 text-sm rounded-md text-white px-5 py-3">Edit</a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
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
                {{$roles->links()}}

            </div>

            
        </div>
    </div>
</x-app-layout>
