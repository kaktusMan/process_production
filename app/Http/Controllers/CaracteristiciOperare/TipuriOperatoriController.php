<?php

namespace App\Http\Controllers\CaracteristiciOperare;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\CaracteristiciOperare\TipOperator;

class TipuriOperatoriController extends Controller
{
    
	public function index(){ 
        return view('caracteristici_operare.tipuri_operatori.index', [
            'tip_operatori' => TipOperator::all()
        ]);
    }

    public function create() 
    {        
        return view('caracteristici_operare.tipuri_operatori.add_edit', [
            'tip_operator' => new TipOperator(),
            'form_title' => 'Creare tip operator necesar pentru funcționarea i.l',
            'form_route' => route('tip-operatori::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $tip_operator = new TipOperator();

        $tip_operator->nume = $request->input('nume');

        if ($tip_operator->save()) 
        {   
            return redirect()->route('tip-operatori::list')->with('alert-success', 'Tip salvat cu succes');
        } 
        else
        {
            return redirect()->route('tip-operatori::list')->with('alert-danger', 'Eroare salvare tip');
        }
    }
 
    public function edit(TipOperator $tip_operator) 
    {   
        if (is_null($tip_operator)) { return redirect(route('tip-operatori::list'))->with('alert-danger', 'Tip nu exista'); }

        return view('caracteristici_operare.tipuri_operatori.add_edit', [
            'tip_operator' => $tip_operator, 
            'form_title' => 'Editare tip operator necesar pentru funcționarea i.l',
            'form_route' => route('tip-operatori::update', ['id' => $tip_operator->id])
        ]);
    }
 
    public function update(Request $request, TipOperator $tip_operator) 
    {		
    	$validation = $this->validateRequest($request, $tip_operator);
        if ($validation) { return $validation; }

        if (is_null($tip_operator)) { return redirect(route('tip-operatori::list'))->with('alert-danger', 'Tipul nu exista'); }

        $tip_operator->nume = $request->input('nume');

        if ($tip_operator->save()) 
        {   
            return redirect()->route('tip-operatori::list')->with('alert-success', 'Tip salvat cu succes');
        } 
        else
        {
            return redirect()->route('tip-operatori::list')->with('alert-danger', 'Eroare salvare tip');
        }
    }

    public function delete(TipOperator $tip_operator) 
    {       
        if (is_null($tip_operator)) { return redirect()->route('tip-operatori::list')->with('alert-danger', 'Tip nu exista'); }

        if ($tip_operator->delete()) 
        {
            return redirect()->route('tip-operatori::list')->with('alert-success', 'Tip eliminat cu succes');
        } 
        else
        {
            return redirect()->route('tip-operatori::list')->with('alert-danger', 'Eroare eliminare tip');
        }
    }

    protected function validateRequest($request, $tip_operator = null) 
    {	
    	$rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($tip_operator))) 
            {
                return redirect(route('tip-operatori::edit', ['id' => $tip_operator->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('tip-operatori::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}