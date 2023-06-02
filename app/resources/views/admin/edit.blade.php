@extends('layouts.app')

@section('title', 'Edit Moto')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"
        integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="block mx-auto my-12 p-8 bg-white w-1/3 border border-gray-200 rounded-lg shadow-lg">
        <h1 class="text-3xl text-center font-bold">Edit Moto</h1>

        <form class="mt-4" method="POST" action="{{ route('motoAdmin.update', $moto) }}" enctype="multipart/form-data"
            accept="image/*"> 

            {{-- cuidado con esto por dios --}}
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-lg font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" placeholder="Name" value="{{ $moto->name }}"
                    class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white">
                @error('name')
                    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" placeholder="Description"
                    class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white">{{ $moto->description }}</textarea>
                @error('description')
                    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="starting_price" class="block text-lg font-medium text-gray-700">Starting Price</label>
                <input type="number" id="starting_price" name="starting_price" placeholder="Starting Price"
                    value="{{ $moto->starting_price }}"
                    class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white">
                @error('starting_price')
                    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
                @enderror
            </div>

            <label for="items-center" class="block text-lg font-medium text-gray-700">Tenga en cuenta que las fotos se añadirán a las ya existentes</label>
            <div class="flex items-center justify-center w-full">                   
                <label for="dropzone-file"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"> 
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                                upload</span></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF</p>
                        <p id="file-count" class="text-xl text-gray-500 dark:text-gray-400">0 files selected</p>
                    </div>
                    <input id="dropzone-file" type="file" class="hidden" name="imagen[]" accept="image/*" multiple
                        onchange="updateFileCount()" />
                </label>
            </div>

            @error('imagen[]')
                <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
            @enderror

            <button type="submit"
                class="rounded-md bg-green-500 w-full text-lg text-white font-semibold p-2 my-3 hover:bg-green-600">Enviar</button>


        </form>



    </div>





@endsection


@section('js')


    <script>
        function updateFileCount() {
            const fileCount = document.getElementById('dropzone-file').files.length;
            document.getElementById('file-count').innerHTML = fileCount + ' file(s) selected';
        }
    </script>


@endsection

