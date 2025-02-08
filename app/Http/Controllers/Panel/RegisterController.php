<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Register\RegisterRequest;
use App\Models\User;
use App\Services\UniqueCafeSlugService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Register/Create');
    }

    public function store(RegisterRequest $request, UniqueCafeSlugService $slugService): RedirectResponse
    {
        $request->validated();

        $user = User::create($request->only('name', 'surname', 'email', 'password'));

        event(new Registered($user));

        Auth::login($user);

        $cafeName = sprintf('%s Kafesi', $user->full_name);
        $uniqueSlug = $slugService->generate($cafeName);

        $cafe = $user->cafes()->create([
            'title' => $cafeName,
            'slug' => $uniqueSlug,
        ]);

        $user->update([
            'current_cafe_id' => $cafe->id,
        ]);

        return to_route('dashboard');
    }
}
