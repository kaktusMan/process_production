<?php

namespace App\Http\Controllers\CaracteristiciOperare;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\Tools;
use App\Models\CaracteristiciOperare\OperatorActual;
use App\Models\Componente\Instalatie;
use App\Models\CaracteristiciOperare\TipOperator;

class OperatoriActualiController extends Controller
{
    
	 public function index(){ 
        return view('caracteristici_operare.operatori_actuali.index', [
            'operatori' => OperatorActual::with('PP', 'tipOp')->get()
        ]);
    }

    public function create() 
    {       
        return view('caracteristici_operare.operatori_actuali.add_edit', [
            'operator' => new OperatorActual(),
            'sex_optiuni' => Tools::sex(),
            'starea_civila_optiuni' => Tools::satareaCivila(),
            'form_title' => 'Creare operator',
            'tipuri_operatori' => TipOperator::getOptionsArray(),
            'instalatii' => Instalatie::getOptionsArray(),
            'form_route' => route('operatori-actuali::store')
        ]);
    }
 
    public function store(Request $request) 
    {    
        $operator = new OperatorActual();

        $operator->nume = $request->input('nume');
        $operator->varsta = $request->input('varsta');
        $operator->sex = $request->input('sex');
        $operator->stare_civila = $request->input('stare_civila');
        $operator->salar_brut = $request->input('salar_brut');
        $operator->data_angajarii = $request->input('data_angajarii');
        $operator->nivel_performanta = $request->input('nivel_performanta');
        $operator->val_bonuri_de_masa = $request->input('val_bonuri_de_masa');
        $operator->PP()->associate($request->input('id_pp'));
        $operator->tipOp()->associate($request->input('id_tip_op'));

        if ($operator->save()) 
        {   
            return redirect()->route('operatori-actuali::list')->with('alert-success', 'Operator adaugat cu succes');
        } 
        else
        {
            return redirect()->route('operatori-actuali::list')->with('alert-danger', 'Eroare adaugare operator');
        }
    }
 
    public function edit(OperatorActual $operator) 
    {   
        if (is_null($operator)) { return redirect(route('operatori-actuali::list'))->with('alert-danger', 'Operatorul nu exista'); }

        return view('caracteristici_operare.operatori_actuali.add_edit', [
            'operator' => $operator,
            'sex_optiuni' => Tools::sex(),
            'starea_civila_optiuni' => Tools::satareaCivila(),
            'tipuri_operatori' => TipOperator::getOptionsArray(),
            'instalatii' => Instalatie::getOptionsArray(),
            'form_title' => 'Editare detalii operator',
            'form_route' => route('operatori-actuali::update', ['id' => $operator->id])
        ]);
    }
 
    public function update(Request $request, OperatorActual $operator) 
    {
        if (is_null($operator)) { return redirect(route('operatori-actuali::list'))->with('alert-danger', 'Operatorul nu exista'); }

        $operator->nume = $request->input('nume');
        $operator->varsta = $request->input('varsta');
        $operator->sex = $request->input('sex');
        $operator->stare_civila = $request->input('stare_civila');
        $operator->salar_brut = $request->input('salar_brut');
        $operator->data_angajarii = $request->input('data_angajarii');
        $operator->nivel_performanta = $request->input('nivel_performanta');
        $operator->val_bonuri_de_masa = $request->input('val_bonuri_de_masa');
        $operator->PP()->associate($request->input('id_pp'));
        $operator->tipOp()->associate($request->input('id_tip_op'));

        if ($operator->save()) 
        {   
            return redirect()->route('operatori-actuali::list')->with('alert-success', 'Operator adaugat cu succes');
        } 
        else
        {
            return redirect()->route('operatori-actuali::list')->with('alert-danger', 'Eroare adaugare operator');
        }
    }

    public function delete(OperatorActual $operator) 
    {       
        if (is_null($operator)) { return redirect()->route('operatori-actuali::list')->with('alert-danger', 'Operatorul nu exista'); }

        if ($operator->delete()) 
        {
            return redirect()->route('operatori-actuali::list')->with('alert-success', 'Operator eliminat cu succes');
        } 
        else
        {
            return redirect()->route('operatori-actuali::list')->with('alert-danger', 'Eroare eliminare operator');
        }
    }

    protected function validateRequest($request, $operator = null) 
    {   
        $rules = [ 
            'varsta' => 'integer',
            'salar_brut' => 'numeric',
            'val_bonuri_de_masa' => 'numeric'

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {
            if (!empty(($operator))) 
            {
                return redirect(route('operatori-actuali::edit', ['id' => $operator->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('operatori-actuali::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}