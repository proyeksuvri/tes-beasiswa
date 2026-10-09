<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class FacultyController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('MasterData/Faculties/Index', [
            'faculties' => Faculty::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Faculty::query()->create($this->validated($request));

        return to_route('master.faculties.index')->with('success', 'Fakultas berhasil ditambahkan.');
    }

    public function update(Request $request, Faculty $faculty): RedirectResponse
    {
        $faculty->update($this->validated($request, $faculty));

        return to_route('master.faculties.index')->with('success', 'Fakultas berhasil diperbarui.');
    }

    public function destroy(Faculty $faculty): RedirectResponse
    {
        if ($faculty->studyPrograms()->exists() || $faculty->students()->exists()) {
            return to_route('master.faculties.index')->with('error', 'Fakultas masih digunakan oleh data lain dan tidak dapat dihapus.');
        }

        $faculty->delete();

        return to_route('master.faculties.index')->with('success', 'Fakultas berhasil dihapus.');
    }

    private function validated(Request $request, ?Faculty $faculty = null): array
    {
        return $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('faculties', 'code')->ignore($faculty?->id)],
            'name' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
        ]);
    }
}
