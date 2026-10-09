<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\StudyProgram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class StudentController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('MasterData/Students/Index', [
            'students' => Student::query()->with(['faculty:id,name', 'studyProgram:id,name,faculty_id'])->orderBy('name')->get(),
            'faculties' => Faculty::query()->where('is_active', true)->orderBy('name')->get(['id', 'name']),
            'studyPrograms' => StudyProgram::query()->where('is_active', true)->orderBy('name')->get(['id', 'name', 'faculty_id']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Student::query()->create($this->validated($request));
        return to_route('master.students.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $student->update($this->validated($request, $student));
        return to_route('master.students.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();
        return to_route('master.students.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    private function validated(Request $request, ?Student $student = null): array
    {
        $facultyId = $request->input('faculty_id');
        $studyProgramId = $request->input('study_program_id');

        return $request->validate([
            'nim' => ['required', 'string', 'max:50', Rule::unique('students', 'nim')->ignore($student?->id)],
            'name' => ['required', 'string', 'max:255'],
            'faculty_id' => ['nullable', 'integer', Rule::exists('faculties', 'id')->where('is_active', true)],
            'study_program_id' => [
                'nullable',
                'integer',
                Rule::exists('study_programs', 'id')
                    ->where('is_active', true)
                    ->where(fn ($query) => $query->where('faculty_id', $facultyId)),
                Rule::requiredIf(fn () => filled($studyProgramId) && blank($facultyId)),
            ],
            'entry_year' => ['nullable', 'integer', 'min:1900', 'max:2200'],
            'is_active' => ['required', 'boolean'],
        ], [
            'study_program_id.exists' => 'Program studi harus aktif dan berada di fakultas yang dipilih.',
            'study_program_id.required' => 'Fakultas harus dipilih sebelum memilih program studi.',
        ]);
    }
}
