<?php

    namespace Database\Seeders;

    use App\Models\User;
    use App\Models\User_rol;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;

    class UsuariosTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $contrasenaHasheada = bcrypt('admin-tronador');
            //inserto usuario admin
            $user = new User();
            $user->name = "Administrador";
            $user->email = "administrador@tronador.com.ar";
            $user->lastname = "administrador";
            $user->institution_id = 1;
            $user->nationality_id = 1;
            $user->password = $contrasenaHasheada;
            $user->email_verified_at = now();
            $user->created_at = now();
            $user->updated_at = now();
            $user->save();

            //inserto rol admin del usuario creado
            $user_rol = new User_rol();
            $user_rol->user_id = $user->id;
            $user_rol->rol_id = 1;
            $user_rol->created_at = now();
            $user_rol->updated_at = now();
            $user_rol->save();


            $contrasenaHasheada = bcrypt('editor-tronador');

            //inserto usuario admin
            $user2 = new User();
            $user2->name = "Editor";
            $user2->email = "editor@tronador.com.ar";
            $user2->lastname = "editor";
            $user2->password = $contrasenaHasheada;
            $user2->institution_id = 1;
            $user2->nationality_id = 1;
            $user2->email_verified_at = now();
            $user2->created_at = now();
            $user2->updated_at = now();
            $user2->save();

            //inserto rol admin del usuario creado
            $user_rol2 = new User_rol();
            $user_rol2->user_id = $user->id;
            $user_rol2->rol_id = 2;
            $user_rol2->created_at = now();
            $user_rol2->updated_at = now();
            $user_rol2->save();
        }
    }
