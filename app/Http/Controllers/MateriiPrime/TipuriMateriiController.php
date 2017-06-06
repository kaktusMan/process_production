<?php

namespace App\Http\Controllers\MateriiPrime;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\MateriiPrime\Tip;

class TipuriMateriiController extends Controller
{   
    public function index(){ 
        return view('materii_prime.tipuri_materie.index', [
            'tipuri' => Tip::all()
        ]);
    }

    public function create() 
    {        
        return view('materii_prime.tipuri_materie.add_edit', [
            'tip' => new Tip(),
            'form_title' => 'Creare tip materie primă',
            'form_route' => route('tipuri_materii::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $tip = new Tip();

        $tip->nume = $request->input('nume');

        if ($tip->save()) 
        {   
            return redirect()->route('tipuri_materii::list')->with('alert-success', 'Tip salvat cu succes');
        } 
        else
        {
            return redirect()->route('tipuri_materii::list')->with('alert-danger', 'Eroare salvare tip');
        }
    }
 
    public function edit(Tip $tip) 
    {   
        if (is_null($tip)) { return redirect(route('tipuri_materii::list'))->with('alert-danger', 'Tipul nu exista'); }

        return view('materii_prime.tipuri_materie.add_edit', [
            'tip' => $tip, 
            'form_title' => 'Editare tip materie primă',
            'form_route' => route('tipuri_materii::update', ['id' => $tip->id])
        ]);
    }
 
    public function update(Request $request, Tip $tip) 
    {
    	$validation = $this->validateRequest($request, $tip);
        if ($validation) { return $validation; }

        if (is_null($tip)) { return redirect(route('tipuri_materii::list'))->with('alert-danger', 'Tipul nu exista'); }

        $tip->nume = $request->input('nume');

        if ($tip->save()) 
        {   
            return redirect()->route('tipuri_materii::list')->with('alert-success', 'Tipul salvat cu succes');
        } 
        else
        {
            return redirect()->route('tipuri_materii::list')->with('alert-danger', 'Eroare salvare tip');
        }
    }

    public function delete(Tip $tip) 
    {       
        if (is_null($tip)) { return redirect()->route('tipuri_materii::list')->with('alert-danger', 'Tip nu exista'); }

        if ($tip->delete()) 
        {
            return redirect()->route('tipuri_materii::list')->with('alert-success', 'Tip eliminat cu succes');
        } 
        else
        {
            return redirect()->route('tipuri_materii::list')->with('alert-danger', 'Eroare eliminare tip');
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
                return redirect(route('tipuri_materii::edit', ['id' => $tip->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('tipuri_materii::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}