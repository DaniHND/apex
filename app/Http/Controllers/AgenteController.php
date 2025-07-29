<?php

namespace App\Http\Controllers;

use App\Models\Agente;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AgenteController extends Controller
{
    public function index(): View
    {
        $agentes = Agente::orderBy('nombre')->paginate(10);
        return view('agentes.index', compact('agentes'));
    }

    public function create(): View
    {
        $roles = Agente::getRoles();
        return view('agentes.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(Agente::rules());

        try {
            Agente::create($validated);
            return redirect()->route('agentes.index')
                ->with('success', 'Agente creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al crear el agente: ' . $e->getMessage());
        }
    }

    public function show(Agente $agente): View
    {
        return view('agentes.show', compact('agente'));
    }

    public function edit(Agente $agente): View
    {
        $roles = Agente::getRoles();
        return view('agentes.edit', compact('agente', 'roles'));
    }

    public function update(Request $request, Agente $agente): RedirectResponse
    {
        $validated = $request->validate(Agente::rules($agente->id));

        try {
            $agente->update($validated);
            return redirect()->route('agentes.index')
                ->with('success', 'Agente actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar el agente: ' . $e->getMessage());
        }
    }

    public function destroy(Agente $agente): RedirectResponse
    {
        try {
            $nombre = $agente->nombre;
            $agente->delete();
            return redirect()->route('agentes.index')
                ->with('success', "Agente '$nombre' eliminado exitosamente.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el agente: ' . $e->getMessage());
        }
    }
}