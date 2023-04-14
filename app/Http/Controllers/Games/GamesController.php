<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GameModel;

class GamesController extends Controller
{
    public function index (Request $request)
    {
        $games = GameModel::all();

        if ($games != null){
            return response()->json(['VideoJuegos'=>$games],200);
        }
        else{
            return response()->json(['message'=>'Error No Existen Juegos De Momento'],401);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'category_id' => 'required',
            'price' => 'required',
        ]);

        $games = GameModel::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'status' => true
        ]);

        try {
            return response()->json(['message' => 'VideoJuego ' . $games->name . ' Creado con Exito', 'games' => $games], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Fallo Al Crear VideoJuego: ' . $games->name], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $game = GameModel::findOrFail($id); // recuperamos el modelo correspondiente al registro que queremos actualizar

        // Actualizar los campos del registro con los nuevos valores
        $game->name = $request->input('name');
        $game->category_id = $request->input('category_id');
        $game->price = $request->input('price');

        $game->update();

        if($game->update()){
            return response()->json(['message' => 'Videojuego ' . $game->name . ' Actualizada con Exito', 'game' => $game], 201);
        }
        return response()->json(['error' => 'Fallo Al Actualizar VideoJuego: ' . $game->name], 404);
       
    }

    public function destroy(Request $request, $id)
    {
        $game = GameModel::findOrFail($id);

        // Verificar el estado actual y cambiarlo utilizando un operador ternario
        $game->status = $game->status ? false : true;

        if ($game->status == true){
            $mensaje = 'Activado';
        }else{
            $mensaje = 'Desactivado';
        }

        // Guardar los cambios
        $game->save();

        if($game->save()){
            return response()->json(['message' => 'VideoJuego ' . $game->name .' Se ha ' . $mensaje . ' con Exito', 'game' => $game], 201);
        }
        return response()->json(['error' => 'No Se Ha ' . $mensaje . ' La VideoJuego: ' . $game->name], 404);


    }
}
