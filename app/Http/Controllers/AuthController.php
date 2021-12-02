<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    //crear usuario
    public function store(Request $request)
    {
       
        $user = User::create([
            'name' => $request['name'],
            'password' => bcrypt($request['password']),
            'email' => $request['email']
        ]);

        return  response()->json([
            "mensaje"=>"Usuario creado correctamente",
            'token' => $user->createToken('API Token')->plainTextToken,
            "type"=>"bearer"
        ],201);
    }

    //iniciar sesion
    public function login(Request $request){
        $credenciales=$request->only("email","password");

        if (!Auth::attempt($credenciales)) {
            return  response()->json(["mensaje"=>"error en el usuario y la contaseña"],401);
        }

        return  response()->json([
            "message"=>"Sesion iniciada correctamente",
            'token' => Auth::user()->createToken('API Token')->plainTextToken,
            "type"=>"bearer"
        ],201);
    }

    //cerrar sesion
    public function logout(Request $request){
        Auth::user()->tokens()->logout();
        return response()->json(["mensage"=>"Sesion cerrada"], 200);

    }

    //listar usuarios
    public function show()
    {
        return response()->json(["data"=>User::all()], 200);
    }

    //modificar usuario
    public function update(Request $request){
        $usuario=User::findOrFail($request->id);
        $usuario->name=$request->name;
        $usuario->email=$request->email;
        $usuario->password=bcrypt($request["password"]);
        $usuario->update();

        return response()->json(["mensaje"=>"Usuario modificado con exito",
                                "data"=>$usuario], 200);
    }

    //eliminar usuario
    public function delete($id)
    {
        $usuario=User::findOrFail($id);
        $usuario->delete();

        return response()->json(["mensage"=>"Se elimino el usuario correctamente"], 200);
    }

    

}
