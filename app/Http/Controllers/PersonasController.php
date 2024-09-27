<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;
use App\Models\Grupo_sanguineo;
use App\Models\Contratos;
use Illuminate\Support\Facades\Log;

class PersonasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $personas = Personas::with(['rol', 'grupoSanguineo', 'tipoContrato'])->get();
        return view('personas.index', compact('personas'));
    }

    public function create()
    {
        if (Auth::user()->persona) {
            return redirect()->route('home')->with('error', 'Ya tienes un perfil de persona creado.');
        }
        
        $roles = Roles::pluck('descripcion', 'id');
        $gruposSanguineos = Grupo_sanguineo::pluck('descripcion', 'id');
        $tiposContratos = Contratos::pluck('descripcion', 'id');
        
        return view('personas.create', compact('roles', 'gruposSanguineos', 'tiposContratos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'documento' => 'required',
            'pnombre' => 'required',
            'snombre' => 'nullable',
            'papellido' => 'required',
            'sapellido' => 'nullable',
            'telefono' => 'required',
            'correo' => 'required|email',
            'direccion' => 'required',
            'rol_id' => 'required|exists:roles,id',
            'tipo_sangre_id' => 'required|exists:grupo_sanguineos,id',
            'tipo_contrato_id' => 'required|exists:contratos,id',
        ]);

        $validatedData['user_id'] = Auth::id();

        try {
            Personas::create($validatedData);
            return redirect()->route('personas.index')->with('success', 'Perfil completado con éxito');
        } catch (\Exception $e) {
            Log::error('Error al crear persona: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al crear el perfil. Por favor, intenta de nuevo.');
        }
    }

    public function show(Personas $persona)
    {
        return view('personas.show', compact('persona'));
    }

    public function edit(Personas $persona)
    {
    $roles = Roles::select('descripcion', 'id')->get();
    $gruposSanguineos = Grupo_Sanguineo::select('descripcion', 'id')->get();
    $tiposContratos = Contratos::select('descripcion', 'id')->get();
        
        return view('personas.edit', compact('persona', 'roles', 'gruposSanguineos', 'tiposContratos'));
    }

    public function update(Request $request, Personas $persona)
    {
        $validatedData = $request->validate([
            'documento' => 'required',
            'pnombre' => 'required',
            'snombre' => 'nullable',
            'papellido' => 'required',
            'sapellido' => 'nullable',
            'telefono' => 'required',
            'correo' => 'required|email',
            'direccion' => 'required',
            'rol_id' => 'required|exists:roles,id',
            'tipo_sangre_id' => 'required|exists:grupo_sanguineos,id',
            'tipo_contrato_id' => 'required|exists:contratos,id',
        ]);

        try {
            $persona->update($validatedData);
            return redirect()->route('personas.index')->with('success', 'Persona actualizada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al actualizar persona: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al actualizar el perfil. Por favor, intenta de nuevo.');
       }
    }

    public function destroy(Personas $persona)
    {
        try {
            $persona->delete();
            return redirect()->route('personas.index')->with('success', 'Persona eliminada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar persona: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al eliminar el perfil. Por favor, intenta de nuevo.');
        }
    }
}