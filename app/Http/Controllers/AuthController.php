<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function sign_up(Request $request){//(Request $request) le paso las cosas por body
        
        $data = $request->validate([//para validar los datos de entrada
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        // {
        //     "name":"Jose Marin",
        //     "email": "josemarin@email.com",
        //     "password":"123456",
        //     "password_confirmation":"123456"
        // }

        $user = User::create([//vamos a crear un usuario
            'name' => $data['name'],//se trae de $data el dato name
            'email' => $data['email'],//se trae de $data el dato email
            'password' => bcrypt($data['password'])//con bcrypt codifico el password que esta
            //validado en la request
        ]);

        $token = $user->createToken('apiToken')->plainTextToken;// aqui creamos el token
        //para el usuario creado anteriormente, tambien se añade en la base de datos

        $res = [
            'user' => $user,
            'token' => $token
        ];
        return response($res, 201);
    }


    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // {
        //     "email": "josemarin@email.com",
        //     "password":"123456"
        // }

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'msg' => 'incorrect username or password'
            ], 401);
        }

        $token = $user->createToken('apiToken')->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $token
        ];

        return response($res, 201);
    }


    public function logout(Request $request)
    {
         // Get bearer token from the request
        $accessToken = $request->bearerToken();

        // Get access token from database
        $token = PersonalAccessToken::findToken($accessToken);

        // Revoke token
        $token->delete();

        return ['message' => $request->user()];
    }
}
