<?php

namespace App\Http\Middleware;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user() ? UserResource::make($request->user()->load('registration.vaccineCenter')) : null,
            ],
            'notification' => collect(Arr::only($request->session()->all(), ['success', 'error', 'waring', 'info']))
                ->mapWithKeys(function ($notification, $key) {
                    return ['type' => $key, 'body' => $notification];
                }),
        ];
    }
}
