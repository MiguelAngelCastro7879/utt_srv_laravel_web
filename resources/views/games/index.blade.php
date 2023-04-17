<x-app-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class= "row">
    <a href="{{ url('Nuevo') }}" class="btn btn-primary button">Nuevo</a>
    </div>
    <div>
      @foreach ($games as $game)
      <div class="card-container">
        <a href="{{ route('dashboard') }}"><div class="card">
          <img src="images/logo.png" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">{{ $game->name }} </p>
            <p class="card-text">{{ $game->category->name }} </p>
            <p class="card-text">${{ $game->price }} </p>
          </div>
        </div></a>
      </div>
      @endforeach
    </div>
</x-app-layout>

<style>
.card-container {
display: inline-flex;
justify-content: space-between; /* align cards with equal spacing */

}

.button {
      transition-duration: 0.4s;
      border-radius: 12px;
      font-size: 15px;
      text-align:center;
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

.card-img-top{
  justify-self: center;
  text-align: center;
  margin-left: 0.8em;
}

.card {
text-align: center;
margin: 3em 1em 1em 1em;
width: 250px;
height: 250px;
border: 1px solid #000000;
justify-content: center;
border-radius: 1em;
color: white;
font-size: 1.3em;
box-shadow: 0 0 16px #0d0061, 0 0 16px #0d0061, 0 0 16px #0d0061, 0 0 16px #0d0061; /* set the box shadow with multiple layers of increasing distance and brightness */
}


</style>