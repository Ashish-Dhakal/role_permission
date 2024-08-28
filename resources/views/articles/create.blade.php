<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Article / Create
            </h2>
            <a href="" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">
                Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    @if (Session::has('error'))
                        <div class="bg-red-200 broder-green-600 p-4 mb-3 rounded-sm shadow-sm">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    <form action="{{ route('articles.store') }}" method="POST">
                        @csrf
                        <div class="">
                            <label for="" class="text-lg fint-medium"> Title</label>
                            <div class="my-3">
                                <input placeholder="Enter Title" type="text"
                                    class="broder-grey-300 shadow-sm w-1/2 rounded-lg" value="{{ old('title') }}"
                                    name="title" id="">
                            </div>
                            @error('title')
                                <p class="text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="">
                            <label for="" class="text-lg fint-medium"> Text</label>
                            <div class="my-3">
                                <textarea name="text" class="broder-grey-300 shadow-sm w-1/2 rounded-lg" placeholder="Content text area"
                                    id="" cols="30" rows="10">{{ old('text') }} </textarea>
                            </div>
                            @error('text')
                                <p class="text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="">
                            <label for="" class="text-lg fint-medium"> Auther</label>
                            <div class="my-3">
                                <input placeholder="Enter Auther" type="text"
                                    class="broder-grey-300 shadow-sm w-1/2 rounded-lg" value="{{ old('auther') }}"
                                    name="auther" id=""> 
                            </div>
                            @error('auther')
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
