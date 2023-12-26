<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PlanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Plan::all();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="#" data-id="' . $data->id . '" class="me-1 link-warning" aria-label="Editar" data-bs-tooltip="tooltip" data-bs-original-title="Editar" data-action="edit" data-bs-toggle="modal" data-bs-target="#plan-modal"><svg
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
                    $button .= '<a href="#" data-id="' . $data->id . '" data-bs-tooltip="tooltip" aria-label="Excluir" data-bs-original-title="Excluir" class="link-danger" data-bs-toggle="modal" data-bs-target="#plan-modal-delete">
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

        return view('plan.plan');
    }

    public function create(Request $request)
    {
        $isActive = $request->input('is_active');
        if (!$isActive) {
            $request['is_active'] = 0;
        }

        /* Validações */
        $request->validate([
            'name'                             => 'required',
            'piece_quantity'                   => 'required',
            'simple_piece_quantity'            => 'required',
            'difficult_piece_quantity'         => 'required',
            'simple_piece_value'               => 'required',
            'difficult_piece_value'            => 'required',
            'additional_simple_piece_value'    => 'required',
            'additional_difficult_piece_value' => 'required',

        ], [
            'name.required'                             => "Por favor, entre com o nome do usuário",
            'piece_quantity.required'                   => "Por favor, entre com a quantidade de peças",
            'simple_piece_quantity.required'            => "Por favor, entre com a quantidade de peças simples",
            'difficult_piece_quantity.required'         => "Por favor, entre com a quantidade de peças difíceis",
            'simple_piece_value.required'               => "Por favor, entre com o valor da peça simples",
            'difficult_piece_value.required'            => "Por favor, entre com o valor da peça difícil",
            'additional_simple_piece_value.required'    => "Por favor, entre com o valor da peça adicional simples",
            'additional_difficult_piece_value.required' => "Por favor, entre com o valor da peça adicional difícil",
        ]);

        Plan::create(
            $request->only([
                'name',
                'piece_quantity',
                'simple_piece_quantity',
                'difficult_piece_quantity',
                'simple_piece_value',
                'difficult_piece_value',
                'additional_simple_piece_value',
                'additional_difficult_piece_value',
                'is_active',
            ])
        );

        return response()->json(['success' => 'Plano cadastrado com sucesso!']);
    }

    public function show(Plan $plan)
    {
        return $plan;
    }

    public function update(Request $request, Plan $plan)
    {
        $isActive = $request->input('is_active');
        if (!$isActive) {
            $request['is_active'] = 0;
        }

        /* Validações */
        $request->validate([
            'name'                             => 'required',
            'piece_quantity'                   => 'required',
            'simple_piece_quantity'            => 'required',
            'difficult_piece_quantity'         => 'required',
            'simple_piece_value'               => 'required',
            'difficult_piece_value'            => 'required',
            'additional_simple_piece_value'    => 'required',
            'additional_difficult_piece_value' => 'required',
        ], [
            'name.required'                             => "Por favor, entre com o nome do usuário",
            'piece_quantity.required'                   => "Por favor, entre com a quantidade de peças",
            'simple_piece_quantity.required'            => "Por favor, entre com a quantidade de peças simples",
            'difficult_piece_quantity.required'         => "Por favor, entre com a quantidade de peças difíceis",
            'simple_piece_value.required'               => "Por favor, entre com o valor da peça simples",
            'difficult_piece_value.required'            => "Por favor, entre com o valor da peça difícil",
            'additional_simple_piece_value.required'    => "Por favor, entre com o valor da peça adicional simples",
            'additional_difficult_piece_value.required' => "Por favor, entre com o valor da peça adicional difícil",
        ]);

        $fillableFields = [
            'name',
            'piece_quantity',
            'simple_piece_quantity',
            'difficult_piece_quantity',
            'simple_piece_value',
            'difficult_piece_value',
            'additional_simple_piece_value',
            'additional_difficult_piece_value',
            'is_active'
        ];

        $plan->fill($request->only($fillableFields));
        $plan->save();

        return response()->json(['success' => 'Plano atualizado com sucesso!']);
    }

    public function delete(Plan $plan)
    {
        $plan->delete();

        return response()->json(['success' => 'Plano removido com sucesso!']);
    }

}
