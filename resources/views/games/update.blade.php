<x-app-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <x-guest-layout>
    <form method="POST" action="{{ route('new.game') }}"  enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label><br>
            <input type="text" name="name" class="form-control" value="{{ $game->name }}" >
        </div>
        <div class="form-group">
            <label for="category_id">Categoria:</label>
            <br>
            <select name="category_id" >
            @foreach($categories as $category)
            <option {{ ($category->id == $game->category_id) ? 'selected' : 'no' ; }} value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
            <label for="price">Precio</label>
            <span class="input-group-addon" style="color:white; font-size:1em;">$</span>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $game->price }}">
        </div>
        
        <div class="form-group">
            <label for="price">Imagen</label>
            <input type="file" class="form-control" name="image">
        </div>

        <button type="submit" class="button">Guardar</button>
    </form>
    </x-guest-layout>
</x-app-layout>

<style>
    .button {
      transition-duration: 0.4s;
      border-radius: 12px;
      font-size: 1.2em;
      text-align:center;
      background-color: transparent;
      color: white;
      width: 100%;
      height: 2em;
      border: black; 
    }
    .button:hover {
      background-color: transparent;
      border: 2px solid white; 
      color: white;
    }
    label{
        text-align: center;
        font-size: 1em;
        color: white;
    }
    input{
        width: 100%;
        height: 50px;
        margin-top: 1em;
        color:white;
        margin-bottom: 1em;
    }
    input:hover{
      border: 2px solid white; 
    }
    input[type="text"] {
    background-color: transparent;
    }
    input[type="number"] {
    background-color: transparent;
    }
    select{
        width: 100%;
        height: 50px;
        background: transparent;
        margin-top: 1em;
        margin-bottom: 1em;
        color:white;
    }
    select:hover{
      border: 2px solid white; 
    }

</style>