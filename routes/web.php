<?php

use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');

Route::get('/login/google/redirect', function(){
    return Socialite::driver('google')->redirect();

});


Route::get('/login/google/callback', function(){
    try{
        $googleUser = Socialite::driver('google')->user();
    }
    catch(Exception $e){
        return redirect('/login');
    }

    $user = User::where([
        'provider_id' => $googleUser->getId(),
        'provider' => 'google'
    ])->first();


    if(!$user){

        $validate = Validator::make(
            ['email' => $googleUser->getEmail()],
            ['email' => ['unique:users,email']],
            ['email.unique' => 'Login gagal. Mungkin Anda pernah login menggunakan Google.']
        );

        if($validate->fails()){
            return redirect('/login')->withErrors($validate);
        }

        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'provider_id' => $googleUser->getId(),
            'provider' => 'google',
            'email_verified_at' => now()
        ]);
    }

    Auth::login($user);
    return redirect('/');

});
