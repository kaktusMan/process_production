<?php

namespace App\Http\Controllers\InstrumenteDeLucru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\InstrumenteDeLucru\TipIl;
use App\Models\ActiuniProductie\NivelGrupare;
use App\Models\ActiuniProductie\ModalitateRealizareAct;

class TipuriInstrumenteDeLucruController extends Controller
{   
    public function index(){ 
        return view('instrumente_de_lucru.tipuri.index', [
            'tipuri' => TipIl::with('nivele_grupare','modalitati_realiz')->get()
        ]);
    }

    public function create() 
    {        
        return view('instrumente_de_lucru.tipuri.add_edit', [
            'tip' => new TipIl(),
            'nivele_grupare' => NivelGrupare::getOptionsArray(),
            'modalitati_realiz' => ModalitateRealizareAct::getOptionsArray(),
            'form_title' => 'Creare tip de instrumente de lucru',
            'form_route' => route('tipuri::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $tip = new TipIl();

        $tip->nume = $request->input('nume');
        $tip->nivele_grupare()->associate($request->input('id_niv_grupare'));
        $tip->modalitati_realiz()->associate($request->input('id_modalit_realiz'));

        if ($tip->save()) 
        {   
            return redirect()->route('tipuri::list')->with('alert-success', 'Tip salvat cu succes');
        } 
        else
        {
            return redirect()->route('tipuri::list')->with('alert-danger', 'Eroare salvare tip');
        }
    }
 
    public function edit(TipIl $tip) 
    {   
        if (is_null($tip)) { return redirect(route('tipuri::list'))->with('alert-danger', 'Tipul nu exista'); }

        return view('instrumente_de_lucru.tipuri.add_edit', [
            'tip' => $tip, 
            'nivele_grupare' => NivelGrupare::getOptionsArray(),
            'modalitati_realiz' => ModalitateRealizareAct::getOptionsArray(),
            'form_title' => 'Editare tip de instrumente de lucru',
            'form_route' => route('tipuri::update', ['id' => $tip->id])
        ]);
    }
 
    public function update(Request $request, TipIl $tip) 
    {
    	$validation = $this->validateRequest($request, $tip);
        if ($validation) { return $validation; }

        if (is_null($tip)) { return redirect(route('tipuri::list'))->with('alert-danger', 'Tipul nu exista'); }

        $tip->nume = $request->input('nume');
        $tip->nivele_grupare()->associate($request->input('id_niv_grupare'));
        $tip->modalitati_realiz()->associate($request->input('id_modalit_realiz'));

        if ($tip->save()) 
        {   
            return redirect()->route('tipuri::list')->with('alert-success', 'Tip salvat cu succes');
        } 
        else
        {
            return redirect()->route('tipuri::list')->with('alert-danger', 'Eroare salvare tip');
        }
    }

    public function delete(TipIl $tip) 
    {       
        if (is_null($tip)) { return redirect()->route('tipuri::list')->with('alert-danger', 'Tipul nu exista'); }

        if ($tip->delete()) 
        {
            return redirect()->route('tipuri::list')->with('alert-success', 'Tip eliminat cu succes');
        } 
        else
        {
            return redirect()->route('tipuri::list')->with('alert-danger', 'Eroare eliminare tip');
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
                return redirect(route('tipuri::edit', ['id' => $tip->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('tipuri::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}