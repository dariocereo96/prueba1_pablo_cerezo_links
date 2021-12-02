<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //crear rol
    public function create(Request $request)
    {
        $role=Role::create(["name"=>$request->name]);
        return response()->json(["mensaje"=>"Rol creado correctamente",
                                "data"=>$role]);
    }

    //listar roles
    public function show()
    {
        $listaRoles=Role::all();
        return response()->json(["data:"=>$listaRoles], 200);
    }
    
    //modificar rol
    public function update(Request $request){
        $role=Role::findOrFail($request->id);
        $role->name=$request->name;
        $role->update();

        return response()->json(["mensaje"=>"Rol modificado con exito",
                                "data"=>$role], 200);
    }

     //eliminar rol
     public function delete($id)
     {
         $rol=Role::findOrFail($id);
         $rol->delete();
         return response()->json(["mensage"=>"Se elimino el rol correctamente"], 200);
     }

     //asignar rol a usuario
     public function asignarRol(Request $request)
     {
        $user=User::findOrFail($request->id);
        $role=Role::findOrFail($request->idRol);
        $user->assignRole($role);

        return response()->json(["mensaje"=>"rol asignado con exito"], 200);
     }

     //listar usuarios que pertenecen a un rol
     public function listaRolUsuarios(Request $request)
     {
        $rol=Role::findOrFail($request->id);
        $usuarios=$rol->users()->get();
        return response()->json(["data"=>$usuarios], 200);
     }
}
