<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class BankController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('MasterData/Banks/Index', ['banks' => Bank::query()->orderBy('name')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Bank::query()->create($this->validated($request));
        return to_route('master.banks.index')->with('success', 'Bank berhasil ditambahkan.');
    }

    public function update(Request $request, Bank $bank): RedirectResponse
    {
        $bank->update($this->validated($request, $bank));
        return to_route('master.banks.index')->with('success', 'Bank berhasil diperbarui.');
    }

    public function destroy(Bank $bank): RedirectResponse
    {
        $bank->delete();
        return to_route('master.banks.index')->with('success', 'Bank berhasil dihapus.');
    }

    private function validated(Request $request, ?Bank $bank = null): array
    {
        return $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('banks', 'code')->ignore($bank?->id)],
            'name' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
        ]);
    }
}
