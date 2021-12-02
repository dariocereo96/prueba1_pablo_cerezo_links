<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
class DatabaseSeeder extends Seeder

{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        //modelos creados por defecto para la prueba

        $user = User::create([
            'name' => "pablo",
            'password' => bcrypt("12345"),
            'email' => "pablocerezo@gmail.com"
        ]);

        $rol = Role::create([
            'name' => "rolPrueba"
        ]);
    }
}
