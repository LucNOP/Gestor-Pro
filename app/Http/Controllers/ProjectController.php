<?php

namespace App\Http\Controllers;

use App\Models\Project; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\View\View;           
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    /* 
    Display a listing of the resource. 
    */
    public function index(): View
    {
        $projects = Auth::user()->projects()->latest()->get();

        return view('projects.index', [
            'projects' => $projects,
        ]);

    }
    /* 
    show the form for creating a new resource
     */
    public function create(): View
    {
        return view('projects.create');
    }

    /* 
    store a newly created resource in storage.
    */    
    public function store(Request $request)
    {
        // 1. Validar os dados
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // 2. Criar o projeto associado ao usuário logado
        $request->user()->projects()->create($validated);

        // 3. Redirecionar para a lista de projetos
        return redirect(route('projects.index'));
    }
    /* 
    Show the form for editing the specified resource.
     */
    public function edit(Project $project): View
    {
        return view('projects.edit', [
            'project'=> $project,
        ]);
    }
    /* 
    Update the specified resource in storage.
     */
    public function update(Request $request, Project $project):RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            ]);

            $project->update($validated);

            return redirect(route('projects.index'));
    }
    /* 
    delete the specified resource in storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect(route('projects.index'));
    }

}
