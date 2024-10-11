<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->wantsJson()) {
            return UserResource::collection(
                User::search($request->search)
                    ->query(function ($query) {
                        $query->with('registration.vaccineCenter');
                    })->get()
            );
        }

        return inertia()->render('Home');
    }
}
