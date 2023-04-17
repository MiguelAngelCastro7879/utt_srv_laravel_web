<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>

    <footer>
        <div class="container">
           <div class="row">
              <div class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <div style="float: left; margin-left:3em;">
                    <img src="images/COYOTE.png" width="119" height="119">
                </div>
                <div style="float: right; margin-right: 3em; margin-top: 2.5em;">
                    <img src="images/utt.png" width="325" height="350">
                </div>
                <div>

                    <h2 class="color">Derechos de Autor: </h2>
                    <h2 class="color">Miguel Castro </h2>
                    <h2 class="color">Fernanda Murillo </h2>
                    <h2 class="color">Pedro De Santiago </h2>

                </div>
              </div>
           </div>
        </div>
     </footer>
     
</html>

<style>
    .text{
        text-align: :center;
    }
    .color{
        color: #fff;
        font-size: 1.96em;
        margin-left: 23%;
        text-align: center;
    }
</style>