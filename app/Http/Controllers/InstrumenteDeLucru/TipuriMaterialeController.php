<?php

namespace App\Http\Controllers\InstrumenteDeLucru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\InstrumenteDeLucru\TipMaterial;

class TipuriMaterialeController  extends Controller
{   
    public function index(){ 
        return view('instrumente_de_lucru.tipuri_materiale.index', [
            'tipuri' => TipMaterial::all()
        ]);
    }

    public function create() 
    {        
        return view('instrumente_de_lucru.tipuri_materiale.add_edit', [
            'tip' => new TipMaterial(),
            'form_title' => 'Adauga tip',
            'form_route' => route('materiale::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $tip = new TipMaterial();

        $tip->nume = $request->input('nume');

        if ($tip->save()) 
        {   
            return redirect()->route('materiale::list')->with('alert-success', 'Tip salvat cu succes');
        } 
        else
        {
            return redirect()->route('materiale::list')->with('alert-danger', 'Eroare salvare tip');
        }
    }
 
    public function edit(TipMaterial $tip) 
    {   
        if (is_null($tip)) { return redirect(route('materiale::list'))->with('alert-danger', 'Tipul nu exista'); }

        return view('instrumente_de_lucru.tipuri_materiale.add_edit', [
            'tip' => $tip, 
            'form_title' => 'Editare tip',
            'form_route' => route('materiale::update', ['id' => $tip->id])
        ]);
    }
 
    public function update(Request $request, TipMaterial $tip) 
    {
    	$validation = $this->validateRequest($request, $tip);
        if ($validation) { return $validation; }

        if (is_null($tip)) { return redirect(route('materiale::list'))->with('alert-danger', 'Tipul nu exista'); }

        $tip->nume = $request->input('nume');

        if ($tip->save()) 
        {   
            return redirect()->route('materiale::list')->with('alert-success', 'Tip salvat cu succes');
        } 
        else
        {
            return redirect()->route('materiale::list')->with('alert-danger', 'Eroare salvare tip');
        }
    }

    public function delete(TipMaterial $tip) 
    {       
        if (is_null($tip)) { return redirect()->route('materiale::list')->with('alert-danger', 'Tipul nu exista'); }

        if ($tip->delete()) 
        {
            return redirect()->route('materiale::list')->with('alert-success', 'Tip eliminat cu succes');
        } 
        else
        {
            return redirect()->route('materiale::list')->with('alert-danger', 'Eroare eliminare tip');
        }
    }

    protected function validateRequest($request, $tip = null) 
    {	
    	$rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($tip))) 
            {
                return redirect(route('materiale::edit', ['id' => $tip->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('materiale::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}