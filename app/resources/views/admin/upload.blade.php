@extends('layouts.app')

@section('title', 'Upload')

{{-- Como esta vista requiere de un plugin, archivo especifico que el resto de vista no requieren, lo incluimos solamente 
en esta de esta manera --}}
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"
        integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        #boton{
            background-color:#838383
        }

        #boton:hover{
            background-color: #444444;
        }
    </style>


@endsection


@section('content')

<div class="block mx-auto my-12 p-8 bg-white w-5/6 md:w-1/2 lg:w-1/3 border border-gray-200 rounded-lg shadow-lg">
    <h1 class="text-3xl text-center font-bold">Upload Product</h1>

    <form class="mt-4" method="POST" action="{{ route('admin.uploadData') }}" enctype="multipart/form-data"
        accept="image/*">

        {{-- cuidado con esto por dios --}}
        @csrf

        <div class="mb-4">
            <input type="text"
                class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                placeholder="Name" id="name" name="name">
        </div>

        @error('name')
            <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
        @enderror

        <div class="mb-4">
            <textarea
                class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                placeholder="Description" id="description" name="description"></textarea>
        </div>

        @error('description')
            <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
        @enderror

        <div class="mb-4">
            <div class="flex flex-wrap items-center">
                <div class="mb-4 mr-auto">
                    <input type="hidden" name="highest_bid" id="highest_bid" value="">
                    <input type="number" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="Starting Price" id="starting_price" name="starting_price">
                </div>
        
                @error('starting_price')
                    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
                @enderror
        
                {{-- <div class="flex-shrink-0">
                    <label for="category" class="mr-2">Category:</label>
                </div> --}}

                <div class="flex-md-grow-1 mb-4 ml-2">
                    <select name="category" id="category" class="border border-gray-200 rounded-md bg-gray-200 text-lg p-2 focus:bg-white">
                      <option disabled selected hidden>Selecciona categoría</option>
                      <option value="d">Deportiva</option>
                      <option value="n">Naked</option>
                      <option value="c">Custom</option>
                      <option value="s">Scooter</option>
                      <option value="q">Quad</option>
                      <option value="t">Triciclo</option>
                      <!-- Add more options as needed -->
                    </select>
                  </div>
            </div>
        </div>

        <div class="mb-4">
            <label for="fecha-termino">Finalización puja:</label>
            <input type="datetime-local" class="ml-1" id="ending_date" name="ending_date">
        </div>

        {{-- mirar --}}
        @error('ending_date')
            <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
        @enderror
        <div class="flex items-center justify-center w-full">
            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
              <div class="flex flex-col items-center justify-center pt-2 pb-3">
                <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span></p>
                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF</p>
                <p id="file-count" class="text-xl text-gray-500 dark:text-gray-400">0 files selected</p>
              </div>
              <input id="dropzone-file" type="file" class="hidden" name="imagen[]" accept="image/*" multiple onchange="updateFileCount()" />
            </label>
          </div>
          
    
        @error('imagen[]')
            <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
        @enderror
    
        <button type="submit" id="boton"
            class="rounded-md w-full text-lg text-white font-semibold p-2 my-3">Enviar</button>
    </form>
    






@endsection


@section('js')


    <script>
        function updateFileCount() {
            const fileCount = document.getElementById('dropzone-file').files.length;
            document.getElementById('file-count').innerHTML = fileCount + ' file(s) selected';
        }



    </script>

    {{-- <script>
        $(document).ready(function() {
            Dropzone.options.myAwesomeDropzone = {
                header: {
                    'X-CSRF-TOKEN': "6TaMJLomTGThrezocuC6EuuL5KReAgWaalapMlHU"
                },
                paramName: "imagen[]",
                init: function() {
                    this.on("error", function(file, response) {
                        console.log(response);
                    });
                }
            }
        });
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script> --}}


@endsection