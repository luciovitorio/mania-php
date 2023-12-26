<?php

namespace App\Http\Controllers;

use App\Enums\ClientCollectionDayEnum;
use App\Enums\ClientCollectionFrequencyEnum;
use App\Enums\ClientDeliveryDayEnum;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Client::with(
                ['address:client_id,id,street,number,complement,district,city', 'plan:id,name', 'branch:id,name']
            )
                ->select('id', 'name', 'cpf', 'cell_phone', 'plan_id', 'is_active', 'branch_id')
                ->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="#" data-id="' . $data->id . '" class="me-1 link-warning" aria-label="Editar" data-bs-tooltip="tooltip" data-bs-original-title="Editar" data-action="edit" data-bs-toggle="modal" data-bs-target="#client-modal"><svg
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
                    $button .= '<a href="#" data-id="' . $data->id . '" data-bs-tooltip="tooltip" aria-label="Excluir" data-bs-original-title="Excluir" class="link-danger" data-bs-toggle="modal" data-bs-target="#client-modal-delete">
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

        return view('client.client');
    }

    public function create(Request $request)
    {
        $isActive = $request->input('is_active');
        if (!$isActive) {
            $request['is_active'] = 0;
        }

        /* Validações */
        $validated = Validator::make($request->all(), [
            'name'                 => 'required',
            'email'                => 'nullable|email|unique:clients',
            'branch'               => 'required',
            'plan'                 => 'required',
            'cpf'                  => 'nullable|unique:clients',
            'cep'                  => 'required',
            'street'               => 'required',
            'district'             => 'required',
            'city'                 => 'required',
            'state'                => 'required',
            'collection_frequency' => [
                'required',
                Rule::enum(ClientCollectionFrequencyEnum::class)
            ],
            'collection_day'       => [
                'nullable',
                Rule::enum(ClientCollectionDayEnum::class)
            ],
            'delivery_day'         => [
                'nullable',
                Rule::enum(ClientDeliveryDayEnum::class)
            ],
        ], [
            'name.required'                 => "Por favor, entre com o nome do usuário",
            'email.email'                   => "Por favor, entre com um endereço de e-mail válido",
            'email.unique'                  => "Já existe um cliente cadastrado com esse email",
            'branch.required'               => "Por favor, escolha uma filial",
            'plan.required'                 => "Por favor, escolha um plano",
            'cpf.unique'                    => "Já existe um cliente cadastrado com esse cpf",
            'collection_frequency.required' => "Por favor, escolha uma frequência",
            'collection_frequency.enum'     => "Por favor, escolha um valor válido",
            'collection_day.enum'           => "Por favor, escolha um valor válido",
            'delivery_day.enum'             => "Por favor, escolha um valor válido",
            'cep.required'                  => "Por favor, entre com o cep da filial",
            'street.required'               => "Por favor, entre com o nome da rua",
            'district.required'             => "Por favor, entre com o nome do bairro",
            'city.required'                 => "Por favor, entre com o nome da cidade",
            'state.required'                => "Por favor, entre com o nome do estado",
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        $client = Client::create(
            $request->only([
                'name',
                'cpf',
                'rg',
                'date_of_birth',
                'email',
                'home_phone',
                'cell_phone',
                'collection_frequency',
                'collection_day',
                'collection_time',
                'delivery_day',
                'delivery_time',
                'collection_start',
                'description',
                'delivery_fee',
                'delivery_amount',
                'due_date',
                'is_active',
            ]) + [
                'branch_id' => $request->input('branch')
            ] + [
                'plan_id' => $request->input('plan')
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
            'client_id'  => $client->id,
        ]);

        return response()->json(['success' => 'Cliente cadastrado com sucesso!']);
    }


}
