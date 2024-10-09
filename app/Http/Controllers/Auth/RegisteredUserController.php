<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\VaccineCenterResource;
use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register', [
            'centers' => VaccineCenterResource::collection(VaccineCenter::all()),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'nid' => $request->nid,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->registration()->create([
            'vaccine_center_id' => $request->vaccine_center_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}
