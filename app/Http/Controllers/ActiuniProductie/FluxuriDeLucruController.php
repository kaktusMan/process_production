<?php

namespace App\Http\Controllers\ActiuniProductie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\ActiuniProductie\Flux;

class FluxuriDeLucruController extends Controller
{   
    public function index(){ 
        return view('actiuni_de_productie.fluxuri_de_lucru.index', [
            'fluxuri' => Flux::all()
        ]);
    }

    public function create() 
    {        
        return view('actiuni_de_productie.fluxuri_de_lucru.add_edit', [
            'flux' => new Flux(),
            'form_title' => 'Creare flux de lucru',
            'form_route' => route('fluxuri::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $flux = new Flux();

        $flux->nume = $request->input('nume');

        if ($flux->save()) 
        {   
            return redirect()->route('fluxuri::list')->with('alert-success', 'Flux salvat cu succes');
        } 
        else
        {
            return redirect()->route('fluxuri::list')->with('alert-danger', 'Eroare salvare flux');
        }
    }
 
    public function edit(Flux $flux) 
    {   
        if (is_null($flux)) { return redirect(route('fluxuri::list'))->with('alert-danger', 'Fluxul nu exista'); }

        return view('actiuni_de_productie.fluxuri_de_lucru.add_edit', [
            'flux' => $flux, 
            'form_title' => 'Editare flux de lucru',
            'form_route' => route('fluxuri::update', ['id' => $flux->id])
        ]);
    }
 
    public function update(Request $request, Flux $flux) 
    {
    	$validation = $this->validateRequest($request, $flux);
        if ($validation) { return $validation; }

        if (is_null($flux)) { return redirect(route('fluxuri::list'))->with('alert-danger', 'Fluxul nu exista'); }

        $flux->nume = $request->input('nume');

        if ($flux->save()) 
        {   
            return redirect()->route('fluxuri::list')->with('alert-success', 'Flux salvat cu succes');
        } 
        else
        {
            return redirect()->route('fluxuri::list')->with('alert-danger', 'Eroare salvare flux');
        }
    }

    public function delete(Flux $flux) 
    {       
        if (is_null($flux)) { return redirect()->route('fluxuri::list')->with('alert-danger', 'Fluxul nu exista'); }

        if ($flux->delete()) 
        {
            return redirect()->route('fluxuri::list')->with('alert-success', 'Flux eliminat cu succes');
        } 
        else
        {
            return redirect()->route('fluxuri::list')->with('alert-danger', 'Eroare eliminare flux');
        }
    }

    protected function validateRequest($request, $flux = null) 
    {	
    	$rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($flux))) 
            {
                return redirect(route('fluxuri::edit', ['id' => $flux->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('fluxuri::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}