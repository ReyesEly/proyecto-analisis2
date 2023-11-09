<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    //
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(){

        $fecha = Carbon::now();
        $userGoogle = Socialite::driver('google')->user();
     //  dd($userGoogle);

        $user = User::updateOrCreate([
            'google_id' => $userGoogle->id,
        ], [
            'name' => $userGoogle->name,
            'email' => $userGoogle->email,
            'email_verified_at' =>$fecha,
            'google_id' => $userGoogle->id,
            'google_token' => $userGoogle->token,
       
        ]);
     
        Auth::login($user);
     
        return redirect('/dashboard');
        
    }

    public function mostrarMensaje() {
        if (auth()->check()) {
            $user = auth()->user(); // Esto obtiene el usuario autenticado
            return view('/dashboard', compact('user'));
        } else {
            return view('/dashboard'); // Manejo de caso si el usuario no está autenticado
        }
    }
}
