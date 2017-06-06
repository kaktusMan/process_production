<?php

namespace App\Http\Controllers\Componente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\Componente\ProcesProductie;
use App\Models\ActiuniProductie\Flux;

class PrPAferenteFlController extends Controller
{

    public function index(){ 
        return view('instalatii_productie.procese_productie.index', [
            'procese' => ProcesProductie::with('tipuriFl')->get()
        ]);
    }

    public function create() 
    {        
        return view('instalatii_productie.procese_productie.add_edit', [
            'proces' => new ProcesProductie(),
            'form_title' => 'Creare proces de producție ale f.l',
            'tipuri_fluxuri' => Flux::getOptionsArray(),
            'form_route' => route('procese-productie::store')
        ]);
    } 
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $proces = new ProcesProductie();

        $proces->nume = $request->input('nume');
        $proces->cod = $request->input('cod');
        $proces->detalii = $request->input('detalii');
        $proces->tipuriFl()->associate($request->input('id_fl'));

        if ($proces->save()) 
        {   
            return redirect()->route('procese-productie::list')->with('alert-success', 'Proces salvata cu succes');
        } 
        else
        {
            return redirect()->route('procese-productie::list')->with('alert-danger', 'Eroare salvare proces');
        }
    }
 
    public function edit(ProcesProductie $proces) 
    {   
        if (is_null($proces)) { return redirect(route('procese-productie::list'))->with('alert-danger', 'Procesul de productie nu exista'); }

        return view('instalatii_productie.procese_productie.add_edit', [
            'proces' => $proces, 
            'form_title' => 'Editare proces de producție ale f.l',
            'tipuri_fluxuri' => Flux::getOptionsArray(),
            'form_route' => route('procese-productie::update', ['id' => $proces->id])
        ]);
    }
 
    public function update(Request $request, ProcesProductie $proces) 
    {		
    	$validation = $this->validateRequest($request, $proces);
        if ($validation) { return $validation; }

        if (is_null($proces)) { return redirect(route('procese-productie::list'))->with('alert-danger', 'Procesul nu exista'); }

        $proces->nume = $request->input('nume');
        $proces->cod = $request->input('cod');
        $proces->detalii = $request->input('detalii');
        $proces->tipuriFl()->associate($request->input('id_fl'));

        if ($proces->save()) 
        {   
            return redirect()->route('procese-productie::list')->with('alert-success', 'Proces salvat cu succes');
        } 
        else
        {
            return redirect()->route('procese-productie::list')->with('alert-danger', 'Eroare salvare proces');
        }
    }

    public function delete(ProcesProductie $proces) 
    {       
        if (is_null($proces)) { return redirect()->route('procese-productie::list')->with('alert-danger', 'Procesul nu exista'); }

        if ($proces->delete()) 
        {
            return redirect()->route('procese-productie::list')->with('alert-success', 'Proces eliminat cu succes');
        } 
        else
        {
            return redirect()->route('procese-productie::list')->with('alert-danger', 'Eroare eliminare proces');
        }
    }

    protected function validateRequest($request, $proces = null) 
    {	
    	$rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($proces))) 
            {
                return redirect(route('procese-productie::edit', ['id' => $proces->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('procese-productie::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}