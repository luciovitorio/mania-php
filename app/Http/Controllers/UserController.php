<?php

namespace App\Http\Controllers;

use App\Enums\UserProfileEnum;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('branch')
                ->select('id', 'name', 'email', 'cpf', 'profile', 'is_active', 'branch_id')
                ->get();

            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="#" data-id="' . $data->id . '" class="me-1 link-warning" aria-label="Editar" data-bs-tooltip="tooltip" data-bs-original-title="Editar" data-action="edit" data-bs-toggle="modal" data-bs-target="#user-modal"><svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="icon icon-tabler icon-tabler-edit"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path
                        stroke="none"
                        d="M0 0h24v24H0z"
                        fill="none"/>
                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                    <path d="M16 5l3 3"/>
                </svg></a>';
                    $button .= '<a href="#" data-id="' . $data->id . '" data-bs-tooltip="tooltip" aria-label="Excluir" data-bs-original-title="Excluir" class="link-danger" data-bs-toggle="modal" data-bs-target="#user-modal-delete">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-trash"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                stroke="none"
                                d="M0 0h24v24H0z"
                                fill="none"/>
                            <path d="M4 7l16 0"/>
                            <path d="M10 11l0 6"/>
                            <path d="M14 11l0 6"/>
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                        </svg>
                    </a>';
                    return $button;
                })->make(true);
        }

        return view('user.user');
    }

    public function create(Request $request)
    {
        $isActive = $request->input('is_active');
        if (!$isActive) {
            $request['is_active'] = 0;
        }

        /* Validações */
        $validated = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'nullable|email|unique:users',
            'branch'   => 'required',
            'password' => 'required',
            'profile'  => [
                'required',
                Rule::enum(UserProfileEnum::class)
            ],
            'cpf'      => [
                'required',
                Rule::unique('users'),
                function ($attribute, $value, $fail) {
                    if (!validaCPF($value)) {
                        $fail('Por favor, entre com um CPF válido.');
                    }
                },
            ],
            'cep'      => 'required',
            'street'   => 'required',
            'district' => 'required',
            'city'     => 'required',
            'state'    => 'required',
        ], [
            'name.required'     => "Por favor, entre com o nome do usuário",
            'email.email'       => "Por favor, entre com um endereço de e-mail válido",
            'email.unique'      => "Já existe um usuário cadastrado com esse email",
            'branch.required'   => "Por favor, escolha uma filial",
            'cpf.required'      => "Por favor, entre com um cpf",
            'cpf.unique'        => "Já existe um usuário cadastrado com esse cpf",
            'password.required' => "Por favor, entre com uma senha",
            'profile.required'  => "Por favor, escolha um perfil",
            'profile.enum'      => "Por favor, escolha um valor válido",
            'cep.required'      => "Por favor, entre com o cep da filial",
            'street.required'   => "Por favor, entre com o nome da rua",
            'district.required' => "Por favor, entre com o nome do bairro",
            'city.required'     => "Por favor, entre com o nome da cidade",
            'state.required'    => "Por favor, entre com o nome do estado",
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        $user = User::create(
            $request->only([
                'name',
                'email',
                'password',
                'cpf',
                'date_of_birth',
                'profile',
                'percent',
                'is_active',
            ]) + [
                'branch_id' => $request->input('branch')
            ]
        );

        $address = Address::create([
            'cep'        => $request->input('cep'),
            'street'     => $request->input('street'),
            'number'     => $request->input('number'),
            'complement' => $request->input('complement'),
            'district'   => $request->input('district'),
            'city'       => $request->input('city'),
            'state'      => $request->input('state'),
            'user_id'    => $user->id,
        ]);

        return response()->json(['success' => 'Usuário cadastrado com sucesso!']);
    }

    public function show(User $user)
    {
        return $user->load(['branch', 'address']);
    }

    public function update(Request $request, User $user)
    {
        $isActive = $request->input('is_active');
        if (!$isActive) {
            $request['is_active'] = 0;
        }

        $request->validate([
            'branch'   => 'required',
            'name'     => 'required',
            'email'    => [
                'nullable',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'profile'  => [
                'required',
                Rule::enum(UserProfileEnum::class)
            ],
            'cpf'      => [
                'required',
                Rule::unique('users')->ignore($user->id),
                function ($attribute, $value, $fail) {
                    if (!validaCPF($value)) {
                        $fail('Por favor, entre com um CPF válido.');
                    }
                },
            ],
            'cep'      => 'required',
            'street'   => 'required',
            'district' => 'required',
            'city'     => 'required',
            'state'    => 'required',
        ], [
            'name.required'     => "Por favor, entre com o nome do usuário",
            'email.email'       => "Por favor, entre com um endereço de e-mail válido",
            'email.unique'      => "Já existe um usuário cadastrado com esse email",
            'branch.required'   => "Por favor, escolha uma filial",
            'cpf.required'      => "Por favor, entre com um cpf",
            'cpf.unique'        => "Já existe um usuário cadastrado com esse cpf",
            'profile.required'  => "Por favor, escolha um perfil",
            'profile.enum'      => "Por favor, escolha um valor válido",
            'cep.required'      => "Por favor, entre com o cep da filial",
            'street.required'   => "Por favor, entre com o nome da rua",
            'district.required' => "Por favor, entre com o nome do bairro",
            'city.required'     => "Por favor, entre com o nome da cidade",
            'state.required'    => "Por favor, entre com o nome do estado",
        ]);

        $fillableFields = ['branch_id', 'name', 'email', 'cpf', 'date_of_birth', 'profile', 'percent', 'is_active'];

        // Se a senha estiver presente e não estiver vazia, atualize-a
        if ($request->filled('password')) {
            $fillableFields[] = 'password';
            $user->password = Hash::make($request->input('password'));
        }

        $user->fill($request->only($fillableFields));
        $user->save();

        $address = $user->address()->first();

        $address->update([
            'cep'        => $request->input('cep'),
            'street'     => $request->input('street'),
            'number'     => $request->input('number'),
            'complement' => $request->input('complement'),
            'district'   => $request->input('district'),
            'city'       => $request->input('city'),
            'state'      => $request->input('state')
        ]);

        return response()->json(['success' => 'Usuário atualizado com sucesso!']);
    }

    public function delete(User $user)
    {
        $user->address()->delete();
        $user->delete();

        return response()->json(['success' => 'Usuário removido com sucesso!']);
    }
}

function validaCPF($cpf)
{
    // Remove caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verifica se o CPF tem 11 dígitos
    if (strlen($cpf) !== 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Calcula o primeiro dígito verificador
    $sum = 0;
    for ($i = 0; $i < 9; $i++) {
        $sum += (10 - $i) * intval($cpf[$i]);
    }
    $digit1 = 11 - ($sum % 11);
    $digit1 = ($digit1 >= 10) ? 0 : $digit1;

    // Calcula o segundo dígito verificador
    $sum = 0;
    for ($i = 0; $i < 10; $i++) {
        $sum += (11 - $i) * intval($cpf[$i]);
    }
    $digit2 = 11 - ($sum % 11);
    $digit2 = ($digit2 >= 10) ? 0 : $digit2;

    // Verifica se os dígitos verificadores estão corretos
    if ($digit1 == intval($cpf[9]) && $digit2 == intval($cpf[10])) {
        return true;
    } else {
        return false;
    }
}
