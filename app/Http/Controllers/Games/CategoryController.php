<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    public function index (Request $request)
    {
        $categories = CategoryModel::all();

        if ($categories != null){
            return response()->json(['categories'=>$categories],200);
        }
        else{
            return response()->json(['message'=>'Error No Existen Categorias'],401);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'description' => ['required', 'string','max:25'],
        ]);

        $category = CategoryModel::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => true
        ]);

        try {
            return response()->json(['message' => 'Categoria ' . $category->name . ' Creada con Exito', 'category' => $category], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Fallo Al Crear Categoria: ' . $category->name], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $category = CategoryModel::findOrFail($id); // recuperamos el modelo correspondiente al registro que queremos actualizar

        // Actualizar los campos del registro con los nuevos valores
        $category->name = $request->input('name');
        $category->description = $request->input('description');

        $category->update();

        if($category->update()){
            return response()->json(['message' => 'Categoria ' . $category->name . ' Actualizada con Exito', 'category' => $category], 201);
        }
        return response()->json(['error' => 'Fallo Al Actualizar Categoria: ' . $category->name], 404);
       
    }

    public function destroy(Request $request, $id)
    {
        $category = CategoryModel::findOrFail($id);

        // Verificar el estado actual y cambiarlo utilizando un operador ternario
        $category->status = $category->status ? false : true;

        if ($category->status == true){
            $mensaje = 'Activado';
        }else{
            $mensaje = 'Desactivado';
        }

        // Guardar los cambios
        $category->save();

        if($category->save()){
            return response()->json(['message' => 'Categoria ' . $category->name .' Se ha ' . $mensaje . ' con Exito', 'category' => $category], 201);
        }
        return response()->json(['error' => 'No Se Ha ' . $mensaje . ' La Categoria: ' . $category->name], 404);


    }
}
