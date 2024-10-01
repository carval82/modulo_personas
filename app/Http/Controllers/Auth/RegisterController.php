<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Personas;
use App\Models\Roles;
use App\Models\Grupo_sanguineo;
use App\Models\Contratos;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';  // Ajusta esta ruta según tus necesidades

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'documento' => ['required', 'string', 'max:20', 'unique:personas'],
            'pnombre' => ['required', 'string', 'max:50'],
            'snombre' => ['nullable', 'string', 'max:50'],
            'papellido' => ['required', 'string', 'max:50'],
            'sapellido' => ['nullable', 'string', 'max:50'],
            'telefono' => ['required', 'string', 'max:20'],
            'direccion' => ['required', 'string', 'max:255'],
            'tipo_sangre_id' => ['required', 'exists:grupo_sanguineos,id'],
            'tipo_contrato_id' => ['required', 'exists:contratos,id'],
            'rol_id' => ['required', 'exists:roles,id'],
        ]);
    }

    protected function create(array $data)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => $data['rol_id'],
            ]);

            $persona = Personas::create([
                'documento' => $data['documento'],
                'pnombre' => $data['pnombre'],
                'snombre' => $data['snombre'],
                'papellido' => $data['papellido'],
                'sapellido' => $data['sapellido'],
                'telefono' => $data['telefono'],
                'correo' => $data['email'],
                'direccion' => $data['direccion'],
                'tipo_sangre_id' => $data['tipo_sangre_id'],
                'tipo_contrato_id' => $data['tipo_contrato_id'],
                'user_id' => $user->id,
            ]);

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear usuario y persona: ' . $e->getMessage());
            throw $e;
        }
    }

    public function showRegistrationForm()
    {
        $roles = Roles::select('id', 'name', 'descripcion')->get();
        $gruposSanguineos = Grupo_sanguineo::select('id', 'descripcion')->get();
        $tiposContratos = Contratos::select('id', 'descripcion')->get();
        return view('auth.register', compact('roles', 'gruposSanguineos', 'tiposContratos'));
    }
}