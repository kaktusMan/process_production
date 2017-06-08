<?php

namespace App\Http\Controllers\ActiuniProductie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\ActiuniProductie\NivelGrupare;

class NivelDeGrupareController extends Controller
{   
    public function index(){ 
        return view('actiuni_de_productie.nivele_grupare.index', [
            'nivele' => NivelGrupare::all()
        ]);
    }

    public function create() 
    {        
        return view('actiuni_de_productie.nivele_grupare.add_edit', [
            'nivel' => new NivelGrupare(),
            'form_title' => 'Creare nivel de grupare a acțiunilor',
            'form_route' => route('nivele::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $nivel = new NivelGrupare();

        $nivel->nume = $request->input('nume');

        if ($nivel->save()) 
        {   
            return redirect()->route('nivele::list')->with('alert-success', 'Nivel salvat cu succes');
        } 
        else
        {
            return redirect()->route('nivele::list')->with('alert-danger', 'Eroare salvare nivel');
        }
    }
 
    public function edit(NivelGrupare $nivel) 
    {   
        if (is_null($nivel)) { return redirect(route('nivele::list'))->with('alert-danger', 'Nivelul nu exista'); }

        return view('actiuni_de_productie.nivele_grupare.add_edit', [
            'nivel' => $nivel, 
            'form_title' => 'Editare nivel de grupare a acțiunilor',
            'form_route' => route('nivele::update', ['id' => $nivel->id])
        ]);
    }
 
    public function update(Request $request, NivelGrupare $nivel) 
    {
    	$validation = $this->validateRequest($request, $nivel);
        if ($validation) { return $validation; }

        if (is_null($nivel)) { return redirect(route('nivele::list'))->with('alert-danger', 'Nivelul nu exista'); }

        $nivel->nume = $request->input('nume');

        if ($nivel->save()) 
        {   
            return redirect()->route('nivele::list')->with('alert-success', 'Nivel salvat cu succes');
        } 
        else
        {
            return redirect()->route('nivele::list')->with('alert-danger', 'Eroare salvare nivel');
        }
    }

    public function delete(NivelGrupare $nivel) 
    {       
        if (is_null($nivel)) { return redirect()->route('nivele::list')->with('alert-danger', 'Nivelul nu exista'); }

        if ($nivel->delete()) 
        {
            return redirect()->route('nivele::list')->with('alert-success', 'Nivel eliminat cu succes');
        } 
        else
        {
            return redirect()->route('nivele::list')->with('alert-danger', 'Eroare eliminare nivel');
        }
    }

    protected function validateRequest($request, $nivel = null) 
    {	
    	$rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($nivel))) 
            {
                return redirect(route('nivele::edit', ['id' => $nivel->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('nivele::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}