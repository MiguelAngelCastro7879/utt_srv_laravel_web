<x-app-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="row">
        <a href="{{ url('Nuevo') }}" class="btn btn-primary button">Nuevo</a>
    </div>
    <div style="display:flex; flex-wrap:wrap;">
        @foreach ($games as $game)
            {{-- <div class="card-container">
        <a href="{{ route('dashboard') }}"><div class="card">
          <img src="data:image/jpeg;base64,{{ base64_encode(Storage::disk('digitalocean')->get($game->image)) }}" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">{{ $game->name }} </p>
            <p class="card-text">{{ $game->category->name }} </p>
            <p class="card-text">${{ $game->price }} </p>
          </div>
        </div></a>
      </div> --}}

            <div class="card">
                <div class="card-image"
                    style="background: url('data:image/jpeg;base64,{{ base64_encode(Storage::disk('digitalocean')->get($game->image)) }}');">
                </div>
                <div class="card-text">
                    <h2>{{ $game->name }}</h2>
                    <p>{{ $game->category->name }}</p>

                    <p>{{ $game->price }}</p>
                </div>
                <div class="card-stats" >
                    <button class="stat" style="border-bottom-left-radius: 15px; background: rgb(7, 32, 255);" onclick="window.location='/Actualizar/{{ $game->id }}';">
                        <div class="value">Editar</div>
                    </button>
                    {{-- <button class="stat" style="background: {{ ($game->status) ?  'rgb(6, 163, 40)' :  'rgb(163, 6, 6)'}}; border-bottom-right-radius: 15px;" onclick="window.location='/Videojuegos';" > --}}
                    <button class="stat" style="background: {{ ($game->status) ?  'rgb(6, 163, 40)' :  'rgb(163, 6, 6)'}}; border-bottom-right-radius: 15px;" onclick="window.location='/api/delete/games/{{ $game->id }}';" >
                        <div class="value">{{ ($game->status) ?  'Activar' :  'Desactivar'; }}</div>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>

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
        grid-template-columns: 300px;
        grid-template-rows: 210px 120px 70px;
        grid-template-areas: "image""text""stats";
        border-radius: 18px;
        background: white;
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9);
        font-family: roboto;
        text-align: center;
        width: 300px;
        transition: 0.5s ease;
        cursor: pointer;
        margin: 30px;
    }

    .card-image {
        grid-area: image;
        /* background: url("img1.jpg"); */
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        background-size: cover;
    }

    .card-text {
        grid-area: text;
        margin: 25px;
    }

    .card-text .date {
        color: rgb(255, 7, 110);
        font-size: 13px;
    }

    .card-text p {
        color: grey;
        font-size: 15px;
        font-weight: 300;
    }

    .card-text h2 {
        margin-top: 0px;
        font-size: 20px;
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
