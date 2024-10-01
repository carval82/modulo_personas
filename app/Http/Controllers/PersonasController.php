<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;
use App\Models\Grupo_sanguineo;
use App\Models\Contratos;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class PersonasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $personas = Personas::with(['user.role', 'grupoSanguineo', 'tipoContrato'])->get();
        return view('personas.index', compact('personas'));
    }

    public function create()
    {
        if (Auth::user()->persona) {
            return redirect()->route('home')->with('error', 'Ya tienes un perfil de persona creado.');
        }
        
        // Ya no necesitamos pasar los roles al formulario
        $gruposSanguineos = Grupo_sanguineo::pluck('descripcion', 'id');
        $tiposContratos = Contratos::pluck('descripcion', 'id');
        
        return view('personas.create', compact('gruposSanguineos', 'tiposContratos'));
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
    $roles = Roles::select('id', 'name', 'descripcion')->get();
    $gruposSanguineos = Grupo_sanguineo::select('id', 'descripcion')->get();
    $tiposContratos = Contratos::select('id', 'descripcion')->get();
    
    // Determinar si el usuario puede cambiar de rol
    $canChangeRole = $persona->user->role->name === 'instructor';
    
    return view('personas.edit', compact('persona', 'roles', 'gruposSanguineos', 'tiposContratos', 'canChangeRole'));
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
        'tipo_sangre_id' => 'required|exists:grupo_sanguineos,id',
        'tipo_contrato_id' => 'required|exists:contratos,id',
        'rol_id' => 'sometimes|required|exists:roles,id',
        'change_password' => 'boolean',
        'password' => 'required_if:change_password,1|nullable|min:8|confirmed',
    ]);

    try {
        DB::beginTransaction();

        $persona->update($validatedData);

        // Actualizar el rol solo si el usuario es un instructor
        if ($persona->user->role->name === 'instructor' && isset($validatedData['rol_id'])) {
            $persona->user->update(['role_id' => $validatedData['rol_id']]);
        }

        // Cambiar la contraseña si se solicita
        if ($request->boolean('change_password') && isset($validatedData['password'])) {
            $persona->user->update([
                'password' => Hash::make($validatedData['password'])
            ]);
        }

        DB::commit();
        return redirect()->route('personas.index')->with('success', 'Persona actualizada exitosamente');
    } catch (\Exception $e) {
        DB::rollBack();
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