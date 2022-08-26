<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Province;
use GuzzleHttp\Client;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Laravel\Fortify\Fortify;
use Illuminate\Validation\ValidationException;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Fortify::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Fortify::authenticateUsing(function (Request $request) {

            $user = User::where('email', $request->email)->first();
            if ($user) {
                if ($user &&  Hash::check($request->password, $user->password)) {
                    if (!$user->canLogin()) {
                        throw ValidationException::withMessages([__('Your account dont have access to the system')]);
                    }
                    return $user;
                }
            }
            if (!strpos($request->email, "utm.edu.ec")) {
                throw ValidationException::withMessages([__('The email must contain @utm.edu.ec')]);
                return;
            }

            try {
                $response = Http::withHeaders([
                    'X-API-KEY' => '3ecbcb4e62a00d2bc58080218a4376f24a8079e1',
                    'accept' => 'application/json'
                ])->post('https://app.utm.edu.ec/becas/api/publico/IniciaSesion', [
                    'usuario' => $request->email,
                        'clave' => $request->password,
                ]);
                $output = $response->json();
            } catch (\Throwable $th) {
                throw ValidationException::withMessages([$th]);
                return;
            }

            if ($output["state"] != "success") {
                throw ValidationException::withMessages([__('The system is out of service')]);
                return;
            }

            $usuario_utm = $output["value"];
            $nombres_utm = explode(" ", $usuario_utm["nombres"], 3);
            $PhotoPath = generateProfilePhotoPath($nombres_utm["2"]);

            $id_province = Province::where('name', 'Manabi')
                ->orWhere('name', 'Manabí')
                ->orWhere('name', 'manabí')
                ->orWhere('name', 'manabi')
                ->orWhere('name', 'MANABI')
                ->orWhere('name', 'MANABÍ')
                ->first()
                ->id;


            $new_user = User::create([
                'user_id' => $usuario_utm["cedula"],
                'name' => $nombres_utm["2"],
                'last_name1' => $nombres_utm["0"],
                'last_name2' => $nombres_utm["1"],
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => date('Y-m-d h:i:s'),
                'id_province' => $id_province ?? 1,
                'api_token' => Str::random(25),
                'profile_photo_path' => $PhotoPath,
            ]);
            return $new_user;
        });


        /* RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        }); */
    }
}
