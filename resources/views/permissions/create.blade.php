<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Permission / Create
            </h2>
            <a href="{{ route('permissions.index') }}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">
                Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('permissions.store') }}" method="POST">
                        @csrf
                        <div class="">
                            <label for="" class="text-lg fint-medium"> Name</label>
                            <div class="my-3">
                                <input placeholder="Enter Name" type="text"
                                    class="broder-grey-300 shadow-sm w-1/2 rounded-lg" value="{{ old('name') }}"
                                    name="name" id="">
                            </div>
                            @error('name')
                                <p class="text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="bg-slate-700 text-sm rounded-md text-white px-5 py-3"> Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
