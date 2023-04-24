<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Mail\UpdateCodeMailer;
use Illuminate\Http\Request;
use App\Models\GameModel;
use App\Models\CategoryModel;
use App\Models\GamesCodes;
use App\Models\Roles;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Psr7\MimeType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class GamesController extends Controller
{
    public function index ()
    {
        $games = GameModel::with('category')->get();
        return view('games.index', compact('games'));

        // $games = GameModel::all();
        // return response()->json(['games' => $games], 200);
        // return view('games.index', compact('games'));
    }

    public function meter_codigo_actualizar(Request $request)
    {
        $users = User::where('role_id', 2)->get();
        $signed_url = URL::signedRoute(
            'show_update_code',
            Auth::user()->id
        );
        // return $users;
        GamesCodes::create([
            'codigo'=>'',
            'status'=>0,
            'user_id'=>$request->user()->id,
            'url'=>$signed_url,
        ]);
        $mail = new UpdateCodeMailer($signed_url);
        foreach ($users as $user) {
            Mail::to($user->email)
                ->send($mail);
        }

        return view('games.verify_code', ['type'=>'update']);
    }
    
    public function meter_codigo_eliminar(Request $request)
    {
        $users = User::where('role_id', 3)->get();
        $signed_url = URL::signedRoute(
            'show_destroy_code',
            Auth::user()->id
        );
        $url = str_replace('miguelacv.online', '10.20.0.4', $signed_url);
        // $url = str_replace('localhost', '192.168.118.165', $signed_url);
        // return $users;
        GamesCodes::create([
            'codigo'=>'',
            'status'=>2,
            'user_id'=>$request->user()->id,
            'url'=>$url,
        ]);
        $mail = new UpdateCodeMailer($url);
        foreach ($users as $user) {
            Mail::to($user->email)
                ->send($mail);
        }

        return view('games.verify_code', ['type'=>'delete']);
    }
    
    public function new ()
    {
        $categories = CategoryModel::all();
        return view('games.form', compact('categories'));
    }
    

    public function actualizar (Request $request)
    {
        $game = GameModel::find($request->id);
        $categories = CategoryModel::all();
        return view('games.update', ['categories'=>$categories, 'game'=>$game]);
    }
    

    public function store(Request $request)
    {
        try {
            // $request->validate([
            //     'name' => ['required', 'string', 'max:25'],
            //     'category_id' => 'required',
            //     'price' => 'required',
            //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            // ]);
            
            // return $request->all();
            $file = $request->file('image')->store('image', 'digitalocean');
            $games = GameModel::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'status' => true,
                'image' => $file
            ]);
            $games->save();
            return redirect(RouteServiceProvider::INDEX);

        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
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
            return redirect(RouteServiceProvider::INDEX);
            return response()->json(['message' => 'Videojuego ' . $game->name . ' Actualizada con Exito', 'game' => $game], 201);
        }
        return response()->json(['error' => 'Fallo Al Actualizar VideoJuego: ' . $game->name], 404);
       
    }

    public function destroy(Request $request)
    {
        $game = GameModel::findOrFail($request->id);

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
            return redirect('Videojuegos');
            // return response()->json(['message' => 'VideoJuego ' . $game->name .' Se ha ' . $mensaje . ' con Exito', 'game' => $game], 201);
        }
        return response()->json(['error' => 'No Se Ha ' . $mensaje . ' La VideoJuego: ' . $game->name], 404);
    }
    public function showimage()
    {
        // $file = Storage::disk('digitalocean')->url('imageV3xDIYdRzS41bZuvANsydNf5z35FovysnNWfcmEm.png');
        $file = Storage::disk('digitalocean')->get('image/mvTc8vWfUC2pq33aKvG3CtdLSplc6iZHM4IqP34e.webp');
        // mime_content_type('image/mvTc8vWfUC2pq33aKvG3CtdLSplc6iZHM4IqP34e.webp');
        $mimetype = MimeType::fromFilename('image/mvTc8vWfUC2pq33aKvG3CtdLSplc6iZHM4IqP34e.webp');
        $headers = [
            // 'Content-Type' => $mimetype,
        ];
        return response($file, 200, $headers);
    }
}
