<?php

namespace App\Http\Controllers;

use App\Enums\ClothinTypeEnum;
use App\Models\Clothin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class ClothController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Clothin::with(
                ['branch:id,name']
            )
                ->select('id', 'name', 'type', 'branch_id')
                ->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="#" data-id="' . $data->id . '" class="me-1 link-warning" aria-label="Editar" data-bs-tooltip="tooltip" data-bs-original-title="Editar" data-action="edit" data-bs-toggle="modal" data-bs-target="#clothin-modal"><svg
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
                    $button .= '<a href="#" data-id="' . $data->id . '" data-bs-tooltip="tooltip" aria-label="Excluir" data-bs-original-title="Excluir" class="link-danger" data-bs-toggle="modal" data-bs-target="#clothin-modal-delete">
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

        return view('clothin.clothin');
    }


    public function create(Request $request)
    {
        /* Validações */
        $validated = Validator::make($request->all(), [
            'name'      => 'required',
            'branch_id' => 'required',
            'type'      => [
                'required',
                Rule::enum(ClothinTypeEnum::class)
            ],
        ], [
            'name.required'      => "Por favor, entre com o nome da peça de roupa",
            'branch_id.required' => "Por favor, escolha uma filial",
            'type.required'      => "Por favor, escolha uma dificuldade",
            'type.enum'          => "Por favor, escolha uma dificuldade válida",
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        Clothin::create(
            $request->only([
                'name',
                'type',
            ]) + [
                'branch_id' => $request->input('branch_id')
            ]
        );

        return response()->json(['success' => 'Roupa cadastrada com sucesso!']);
    }

    public function show(Clothin $clothin)
    {
        return $clothin->load(['branch']);
    }


    public function update(Request $request, Clothin $clothin)
    {
        $request->validate([
            'name'      => 'required',
            'branch_id' => 'required',
            'type'      => [
                'required',
                Rule::enum(ClothinTypeEnum::class)
            ],
        ], [
            'name.required'      => "Por favor, entre com o nome da peça de roupa",
            'branch_id.required' => "Por favor, escolha uma filial",
            'type.required'      => "Por favor, escolha uma dificuldade",
            'type.enum'          => "Por favor, escolha uma dificuldade válida",
        ]);

        $fillableFields = [
            'branch_id',
            'name',
            'type',
        ];

        $clothin->fill($request->only($fillableFields));
        $clothin->save();

        return response()->json(['success' => 'Roupa atualizada com sucesso!']);
    }


    public function destroy(Clothin $clothin)
    {
        $clothin->delete();

        return response()->json(['success' => 'Roupa removida com sucesso!']);
    }

}
