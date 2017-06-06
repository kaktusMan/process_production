<?php

namespace App\Http\Controllers\Componente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\Componente\FluxAferentPp;
use App\Models\Componente\Instalatie;

class FluxuriAferentePpController extends Controller
{

public function index(){ 
        return view('instalatii_productie.fluxuri_aferente.index', [
            'fluxuri' => FluxAferentPp::with('tipuriPp')->get()
        ]);
    }

    public function create() 
    {        
        return view('instalatii_productie.fluxuri_aferente.add_edit', [
            'flux' => new FluxAferentPp(),
            'form_title' => 'Creare flux de lucru a pp',
            'tipuri_instalatii' => Instalatie::getOptionsArray(),
            'form_route' => route('fluxuri-pp::store')
        ]);
    } 
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $flux = new FluxAferentPp();

        $flux->nume = $request->input('nume');
        $flux->cod = $request->input('cod');
        $flux->detalii = $request->input('detalii');
        $flux->tipuriPp()->associate($request->input('id_pp'));

        if ($flux->save()) 
        {   
            return redirect()->route('fluxuri-pp::list')->with('alert-success', 'Flux salvat cu succes');
        } 
        else
        {
            return redirect()->route('fluxuri-pp::list')->with('alert-danger', 'Eroare salvare flux');
        }
    }
 
    public function edit(FluxAferentPp $flux) 
    {   
        if (is_null($flux)) { return redirect(route('fluxuri-pp::list'))->with('alert-danger', 'Fluxul nu exista'); }

        return view('instalatii_productie.fluxuri_aferente.add_edit', [
            'flux' => $flux, 
            'form_title' => 'Editare flux de lucru a pp',
            'tipuri_instalatii' => Instalatie::getOptionsArray(),
            'form_route' => route('fluxuri-pp::update', ['id' => $flux->id])
        ]);
    }
 
    public function update(Request $request, FluxAferentPp $flux) 
    {		
    	$validation = $this->validateRequest($request, $flux);
        if ($validation) { return $validation; }

        if (is_null($flux)) { return redirect(route('fluxuri-pp::list'))->with('alert-danger', 'Fluxul nu exista'); }

        $flux->nume = $request->input('nume');
        $flux->cod = $request->input('cod');
        $flux->detalii = $request->input('detalii');
        $flux->tipuriPp()->associate($request->input('id_pp'));

        if ($flux->save()) 
        {   
            return redirect()->route('fluxuri-pp::list')->with('alert-success', 'Flux salvat cu succes');
        } 
        else
        {
            return redirect()->route('fluxuri-pp::list')->with('alert-danger', 'Eroare salvare flux');
        }
    }

    public function delete(FluxAferentPp $flux) 
    {       
        if (is_null($flux)) { return redirect()->route('fluxuri-pp::list')->with('alert-danger', 'Fluxul nu exista'); }

        if ($flux->delete()) 
        {
            return redirect()->route('fluxuri-pp::list')->with('alert-success', 'Flux eliminat cu succes');
        } 
        else
        {
            return redirect()->route('fluxuri-pp::list')->with('alert-danger', 'Eroare eliminare flux');
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
                return redirect(route('fluxuri-pp::edit', ['id' => $flux->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('fluxuri-pp::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}