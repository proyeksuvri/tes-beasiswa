<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\ScholarshipProgram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class ScholarshipProgramController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('MasterData/ScholarshipPrograms/Index', [
            'programs' => ScholarshipProgram::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        ScholarshipProgram::query()->create($this->validated($request));

        return to_route('master.programs.index')->with('success', 'Program beasiswa berhasil ditambahkan.');
    }

    public function update(Request $request, ScholarshipProgram $program): RedirectResponse
    {
        $program->update($this->validated($request, $program));

        return to_route('master.programs.index')->with('success', 'Program beasiswa berhasil diperbarui.');
    }

    public function destroy(ScholarshipProgram $program): RedirectResponse
    {
        abort_if($program->recipients()->exists(), 409, 'Program sudah digunakan dan tidak dapat dihapus.');
        $program->delete();

        return to_route('master.programs.index')->with('success', 'Program beasiswa berhasil dihapus.');
    }

    private function validated(Request $request, ?ScholarshipProgram $program = null): array
    {
        return $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('scholarship_programs', 'code')->ignore($program?->id)],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'is_active' => ['required', 'boolean'],
        ]);
    }
}
