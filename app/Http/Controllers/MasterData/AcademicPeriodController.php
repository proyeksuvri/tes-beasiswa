<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\AcademicPeriod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class AcademicPeriodController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('MasterData/AcademicPeriods/Index', ['periods' => AcademicPeriod::query()->orderByDesc('academic_year_start')->orderBy('semester')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        AcademicPeriod::query()->create($this->validated($request));
        return to_route('master.periods.index')->with('success', 'Periode akademik berhasil ditambahkan.');
    }

    public function update(Request $request, AcademicPeriod $period): RedirectResponse
    {
        $period->update($this->validated($request, $period));
        return to_route('master.periods.index')->with('success', 'Periode akademik berhasil diperbarui.');
    }

    public function destroy(AcademicPeriod $period): RedirectResponse
    {
        $period->delete();
        return to_route('master.periods.index')->with('success', 'Periode akademik berhasil dihapus.');
    }

    private function validated(Request $request, ?AcademicPeriod $period = null): array
    {
        return $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('academic_periods', 'code')->ignore($period?->id)],
            'name' => ['required', 'string', 'max:255'],
            'semester' => ['nullable', 'string', 'max:30'],
            'academic_year_start' => ['nullable', 'integer', 'min:2000', 'max:2200'],
            'academic_year_end' => ['nullable', 'integer', 'min:2000', 'max:2200', 'gte:academic_year_start'],
            'is_active' => ['required', 'boolean'],
        ]);
    }
}
