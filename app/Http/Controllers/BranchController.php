<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Branch::with('address:branch_id,id,street,number,complement,district,city')
                ->select('id', 'name', 'phone', 'whatsapp')
                ->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="#" data-id="' . $data->id . '" class="me-1 link-warning" aria-label="Editar" data-bs-tooltip="tooltip" data-bs-original-title="Editar" data-action="edit" data-bs-toggle="modal" data-bs-target="#branch-modal"><svg
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
                    $button .= '<a href="#" data-id="' . $data->id . '" data-bs-tooltip="tooltip" aria-label="Excluir" data-bs-original-title="Excluir" class="link-danger" data-bs-toggle="modal" data-bs-target="#branch-modal-delete">
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

        return view('branch.branch');
    }

    public function create(Request $request)
    {
        /* Validações */
        $validated = Validator::make($request->all(), [
            'name'     => 'required|unique:branches',
            'email'    => 'nullable|email|unique:branches',
            'cep'      => 'required',
            'street'   => 'required',
            'district' => 'required',
            'city'     => 'required',
            'state'    => 'required',
        ], [
            'name.required'     => "Por favor, entre com o nome da filial",
            'name.unique'       => "Já existe uma filial cadastrada com esse nome",
            'cep.required'      => "Por favor, entre com o cep da filial",
            'street.required'   => "Por favor, entre com o nome da rua",
            'district.required' => "Por favor, entre com o nome do bairro",
            'city.required'     => "Por favor, entre com o nome da cidade",
            'state.required'    => "Por favor, entre com o nome do estado",
            'email.email'       => "Por favor, entre com um endereço de e-mail válido",
            'email.unique'      => "Já existe uma filial cadastrada com esse email",
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        $branch = Branch::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'phone'    => $request->input('phone'),
            'whatsapp' => $request->input('whatsapp')
        ]);

        $address = Address::create([
            'cep'        => $request->input('cep'),
            'street'     => $request->input('street'),
            'number'     => $request->input('number'),
            'complement' => $request->input('complement'),
            'district'   => $request->input('district'),
            'city'       => $request->input('city'),
            'state'      => $request->input('state'),
            'branch_id'  => $branch->id,
        ]);

        return response()->json(['success' => 'Filial cadastrada com sucesso!']);
    }

    public function show(Branch $branch)
    {
        return $branch->load('address');
    }

    public function update(Request $request, Branch $branch)
    {
        /* Validações */
        $validated = Validator::make($request->all(), [
            'name'     => [
                'required',
                Rule::unique('branches')->ignore($branch->id),
            ],
            'email'    => [
                'nullable',
                'email',
                Rule::unique('branches')->ignore($branch->id),
            ],
            'cep'      => 'required',
            'street'   => 'required',
            'district' => 'required',
            'city'     => 'required',
            'state'    => 'required',
        ], [
            'name.required'     => "Por favor, entre com o nome da filial",
            'name.unique'       => "Já existe uma filial cadastrada com esse nome",
            'email.email'       => "Por favor, entre com um endereço de e-mail válido",
            'email.unique'      => "Já existe uma filial cadastrada com esse email",
            'cep.required'      => "Por favor, entre com o cep da filial",
            'street.required'   => "Por favor, entre com o nome da rua",
            'district.required' => "Por favor, entre com o nome do bairro",
            'city.required'     => "Por favor, entre com o nome da cidade",
            'state.required'    => "Por favor, entre com o nome do estado",
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        $branch->update([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'phone'    => $request->input('phone'),
            'whatsapp' => $request->input('whatsapp'),
        ]);

        $address = $branch->address()->first();

        $address->update([
            'cep'        => $request->input('cep'),
            'street'     => $request->input('street'),
            'number'     => $request->input('number'),
            'complement' => $request->input('complement'),
            'district'   => $request->input('district'),
            'city'       => $request->input('city'),
            'state'      => $request->input('state')
        ]);

        return response()->json(['success' => 'Filial atualizada com sucesso!']);
    }

    public function delete(Branch $branch)
    {
        $branch->address()->delete();
        $branch->delete();

        return response()->json(['success' => 'Filial removida com sucesso!']);
    }
}
