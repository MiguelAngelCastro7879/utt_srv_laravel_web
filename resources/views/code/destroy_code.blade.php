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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            @csrf
            {{-- <div class="block mt-4"> --}}
                <label for="remember_me" class="inline-flex items-center">
                    <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Validacion de eliminaciones') }}</span>
                </label>
                <br><br>
                <p class="font-semibold text-x2 text-gray-800 dark:text-gray-200 leading-tight">Puedes enviar un email con un token unico a los usuarios para eliminar un registro</p>
                <br>
            {{-- </div> --}}
                <div style="width: 100%; height 100%; display:flex; flex-wrap:wrap; zoom: 55%; align-content: center;">
                    
                    @foreach ($data as $peticion)
                    <div class="card">
                        <div class="card-text">
                            <h2>{{  $peticion->user->email }}</h2>
                        </div>
                        <div class="card-stats" >
                            <button class="stat" style="border-bottom-left-radius: 15px; background: rgb(6, 163, 40);" onclick="window.location='/api/enviar/codigo/eliminar/{{ $peticion->id }}'">
                                <div class="value">Enviar Token</div>
                            </button>
                            {{-- <button class="stat" style="background: {{ ($game->status) ?  'rgb(6, 163, 40)' :  'rgb(163, 6, 6)'}}; border-bottom-right-radius: 15px;" onclick="window.location='/Videojuegos';" > --}}
                            <button class="stat" style="background: rgb(163, 6, 6); border-bottom-right-radius: 15px;">
                                <div class="value">Rechazar</div>
                            </button>
                        </div>
                    </div>       
                    @endforeach
                </div>
        
        </div>
    </body>
</html>

<style>
    .button {
        transition-duration: 0.4s;
        border-radius: 12px;
        font-size: 15px;
        text-align: center;
        background-color: transparent;
        color: white;
        border: black;
        padding: 14px 40px;
        margin: 1em 1em 0em 1em;
        float: right;
    }

    .button:hover {
        background-color: transparent;
        border: 2px solid white;
        color: white;
    }

    .card {
        display: grid;
        grid-template-columns: 500px;
        grid-template-rows: 100px 80px;
        grid-template-areas: "text""stats";
        border-radius: 18px;
        background: white;
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9);
        font-family: roboto;
        text-align: center;
        width: 500px;
        transition: 0.5s ease;
        cursor: pointer;
        margin: 30px;
    }

    .card-text {
        grid-area: text;
        margin: 25px;
    }

    .card-text p {
        color: grey;
        font-size: 15px;
        font-weight: 300;
    }

    .card-text h2 {
        margin-top: 0px;
        font-size: 28px;
    }

    .card-stats {
        grid-area: stats;
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 1fr;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }

    .card-stats .stat {
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: white;
        border: 1px;
        border-color: black;
    }

    .stat:hover {
        background-color: transparent;
        border: 2px solid white;
        color: white;
    }

    .card-stats .border {
        border-left: 1px solid rgb(172, 26, 87);
        border-right: 1px solid rgb(172, 26, 87);
    }

    .card-stats .value {
        font-size: 22px;
        font-weight: 500;
    }

    .card-stats .value sup {
        font-size: 12px;
    }

    .card-stats .type {
        font-size: 11px;
        font-weight: 300;
        text-transform: uppercase;
    }

    .card:hover {
        transform: scale(1.15);
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.6);
    }
</style>