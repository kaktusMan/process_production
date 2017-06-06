<?php

namespace App\Http\Controllers\MateriiPrime;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\MateriiPrime\Forma;

class FormeMateriiController extends Controller
{   
    public function index(){ 
        return view('materii_prime.forme_materie.index', [
            'forme' => Forma::all()
        ]);
    }

    public function create() 
    {        
        return view('materii_prime.forme_materie.add_edit', [
            'forma' => new Forma(),
            'form_title' => 'Creare forma materie primă',
            'form_route' => route('forme_materii::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
        $validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $forma = new Forma();

        $forma->nume = $request->input('nume');

        if ($forma->save()) 
        {   
            return redirect()->route('forme_materii::list')->with('alert-success', 'Forma salvata cu succes');
        } 
        else
        {
            return redirect()->route('forme_materii::list')->with('alert-danger', 'Eroare salvare forma');
        }
    }
 
    public function edit(Forma $forma) 
    {   
        if (is_null($forma)) { return redirect(route('forme_materii::list'))->with('alert-danger', 'Forma nu exista'); }

        return view('materii_prime.forme_materie.add_edit', [
            'forma' => $forma, 
            'form_title' => 'Editare forma materie primă',
            'form_route' => route('forme_materii::update', ['id' => $forma->id])
        ]);
    }
 
    public function update(Request $request, Forma $forma) 
    {
        $validation = $this->validateRequest($request, $forma);
        if ($validation) { return $validation; }

        if (is_null($forma)) { return redirect(route('forme_materii::list'))->with('alert-danger', 'Forma nu exista'); }

        $forma->nume = $request->input('nume');

        if ($forma->save()) 
        {   
            return redirect()->route('forme_materii::list')->with('alert-success', 'Forma salvata cu succes');
        } 
        else
        {
            return redirect()->route('forme_materii::list')->with('alert-danger', 'Eroare salvare forma');
        }
    }

    public function delete(Forma $forma) 
    {       
        if (is_null($forma)) { return redirect()->route('forme_materii::list')->with('alert-danger', 'Forma nu exista'); }

        if ($forma->delete()) 
        {
            return redirect()->route('forme_materii::list')->with('alert-success', 'Forma eliminata cu succes');
        } 
        else
        {
            return redirect()->route('forme_materii::list')->with('alert-danger', 'Eroare eliminare forma');
        }
    }

    protected function validateRequest($request, $forma = null) 
    {   
        $rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($forma))) 
            {
                return redirect(route('forme_materii::edit', ['id' => $forma->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('forme_materii::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}