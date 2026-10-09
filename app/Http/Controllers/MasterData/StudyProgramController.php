<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\StudyProgram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class StudyProgramController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('MasterData/StudyPrograms/Index', [
            'studyPrograms' => StudyProgram::query()->with('faculty:id,name')->orderBy('name')->get(),
            'faculties' => Faculty::query()->where('is_active', true)->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        StudyProgram::query()->create($this->validated($request));
        return to_route('master.study-programs.index')->with('success', 'Program studi berhasil ditambahkan.');
    }

    public function update(Request $request, StudyProgram $studyProgram): RedirectResponse
    {
        $studyProgram->update($this->validated($request, $studyProgram));
        return to_route('master.study-programs.index')->with('success', 'Program studi berhasil diperbarui.');
    }

    public function destroy(StudyProgram $studyProgram): RedirectResponse
    {
        if ($studyProgram->students()->exists()) {
            return to_route('master.study-programs.index')->with('error', 'Program studi masih digunakan oleh data mahasiswa dan tidak dapat dihapus.');
        }

        $studyProgram->delete();
        return to_route('master.study-programs.index')->with('success', 'Program studi berhasil dihapus.');
    }

    private function validated(Request $request, ?StudyProgram $studyProgram = null): array
    {
        return $request->validate([
            'faculty_id' => ['required', 'integer', Rule::exists('faculties', 'id')->where('is_active', true)],
            'code' => ['required', 'string', 'max:50', Rule::unique('study_programs', 'code')->ignore($studyProgram?->id)],
            'name' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
        ]);
    }
}
