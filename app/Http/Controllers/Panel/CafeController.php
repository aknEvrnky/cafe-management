<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Cafe\CreateCafeRequest;
use App\Http\Requests\Panel\Cafe\UpdateCurrentCafeRequest;
use App\Models\Cafe;
use App\Services\UniqueCafeSlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CafeController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Cafe/Create');
    }

    public function store(CreateCafeRequest $request): RedirectResponse
    {
        $request->validated();

        $cafe = $request->user()->cafes()->create($request->only('title', 'slug'));

        $request->user()->switchCafe($cafe);

        return to_route('dashboard')->with('success', 'Kafe başarıyla oluşturuldu.');
    }

    public function uniqueSlug(Request $request, UniqueCafeSlugService $slugService): JsonResponse
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $title = $request->input('title');

        $slug = $slugService->generate($title);

        return response()->json([
            'slug' => $slug,
        ]);
    }

    public function switchCafe(Request $request): RedirectResponse
    {
        $request->validate([
            'cafe_id' => 'required|integer|exists:cafes,id',
        ]);

        $cafe = Cafe::find($request->input('cafe_id'));

        if ($request->user()->cannot('switch', $cafe)) {
            abort(403);
        }

        $request->user()->switchCafe($cafe);

        return to_route('dashboard')->with('success', 'Kafe başarıyla değiştirildi.');
    }

    public function editCurrentCafe(Request $request): Response
    {
        return Inertia::render('Cafe/EditCurrentCafe');
    }

    public function updateCurrentCafe(UpdateCurrentCafeRequest $request): RedirectResponse
    {
        $request->validated();

        $cafe = $request->user()->currentCafe;

        $cafe->update($request->only('title', 'slug'));

        return to_route('cafes.edit-current-cafe')->with('info', 'Kafe başarıyla güncellendi.');
    }
}
