<?php

namespace App\Http\Controllers\CaracteristiciOperare;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\Tools;
use App\Models\CaracteristiciOperare\NrSchimb;
use App\Models\Componente\Instalatie;

class NrSchimburiPePrPController extends Controller
{
	public function index(){ 

        return view('caracteristici_operare.nr_schimburi_pe_prp.index', [
            'nr_schimburi' => NrSchimb::with('Prp')->get()
        ]);
    }

    public function create()
    {        

        return view('caracteristici_operare.nr_schimburi_pe_prp.add_edit', [
            'nr_schimb' => new NrSchimb(),
            'procese_productie' => Instalatie::getOptionsArray(),
            'val_optiuni' => Tools::nr_schimburi(),
            'form_title' => 'Creare număr de schimburi de lucru pe prp',
            'form_route' => route('schimburi-de-lucru::store')
        ]);
    }
 
    public function store(Request $request) 
    {     

    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $nr_schimb = new NrSchimb();
        $nr_schimb->Prp()->associate($request->input('id_prp'));
        $nr_schimb->val = $request->input('val');
	        
        if ($nr_schimb->save()) 
        {   
            return redirect()->route('schimburi-de-lucru::list')->with('alert-success', 'Salvare cu succes');
        } 
        else
        {
            return redirect()->route('schimburi-de-lucru::list')->with('alert-danger', 'Eroare salvare');
        }

    }
 
    public function edit(NrSchimb $nr_schimb) 
    {   
        if (is_null($nr_schimb)) { return redirect(route('schimburi-de-lucru::list'))->with('alert-danger', 'Tip schimb nu exista'); }

        return view('caracteristici_operare.nr_schimburi_pe_prp.add_edit', [
            'nr_schimb' => $nr_schimb,
            'procese_productie' => Instalatie::getOptionsArray(), 
            'val_optiuni' => Tools::nr_schimburi(),
            'form_title' => 'Editare număr de schimburi de lucru pe prp',
            'form_route' => route('schimburi-de-lucru::update', ['id' => $nr_schimb->id])
        ]);
    }
 
    public function update(Request $request, NrSchimb $nr_schimb) 
    {		
    	$validation = $this->validateRequest($request, $nr_schimb);
        if ($validation) { return $validation; }

        if (is_null($nr_schimb)) { return redirect(route('schimburi-de-lucru::list'))->with('alert-danger', 'Tipul nu exista'); }

        $nr_schimb->Prp()->associate($request->input('id_prp'));
        $nr_schimb->val = $request->input('val');

        if ($nr_schimb->save()) 
        {   
            return redirect()->route('schimburi-de-lucru::list')->with('alert-success', 'Tip salvat cu succes');
        } 
        else
        {
            return redirect()->route('schimburi-de-lucru::list')->with('alert-danger', 'Eroare salvare tip');
        }
    }

    public function delete(NrSchimb $nr_schimb) 
    {       
        if (is_null($nr_schimb)) { return redirect()->route('schimburi-de-lucru::list')->with('alert-danger', 'Tip nu exista'); }

        if ($nr_schimb->delete()) 
        {
            return redirect()->route('schimburi-de-lucru::list')->with('alert-success', 'Tip eliminat cu succes');
        } 
        else
        {
            return redirect()->route('schimburi-de-lucru::list')->with('alert-danger', 'Eroare eliminare tip');
        }
    }

    protected function validateRequest($request, $nr_schimb = null) 
    {	
    	$rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($nr_schimb))) 
            {
                return redirect(route('schimburi-de-lucru::edit', ['id' => $nr_schimb->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('operatori-necesari::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}