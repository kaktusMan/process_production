<?php

namespace App\Http\Controllers\CaracteristiciOperare;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator; 
use App\Models\CaracteristiciOperare\NrOre;
use App\Models\CaracteristiciOperare\NrSchimb;


class NrOreFunctPeSchimbController extends Controller
{
    
	public function index(){ 

        return view('caracteristici_operare.ore_nete_functionale.index', [
            'nr_ore' => NrOre::with('nrSchimb')->get()
        ]);
    }

    public function create()
    {        

        return view('caracteristici_operare.ore_nete_functionale.add_edit', [
            'nr_ore' => new NrOre(),
            'nr_schimburi' => NrSchimb::orderBy('id', 'asc')->pluck('id', 'id')->all(),
            'form_title' => 'Creare număr ore nete funcționale pe schimb de lucru',
            'form_route' => route('ore-functionale::store')
        ]);
    }
 
    public function store(Request $request) 
    {     

    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $nr_ore = new NrOre();
        $nr_ore->ore_nete_op = $request->input('ore_nete_op');
        $nr_ore->ore_nete_il = $request->input('ore_nete_il');
        $nr_ore->nrSchimb()->associate($request->input('id_nr_schimb'));
	        
        if ($nr_ore->save()) 
        {   
            return redirect()->route('ore-functionale::list')->with('alert-success', 'Salvare cu succes');
        } 
        else
        {
            return redirect()->route('ore-functionale::list')->with('alert-danger', 'Eroare salvare');
        }

    }
 
    public function edit(NrOre $nr_ore) 
    {   
        if (is_null($nr_ore)) { return redirect(route('ore-functionale::list'))->with('alert-danger', 'Numar de ore nu exista'); }

        return view('caracteristici_operare.ore_nete_functionale.add_edit', [
            'nr_ore' => $nr_ore,
            'nr_schimburi' => NrSchimb::orderBy('id', 'asc')->pluck('id', 'id')->all(), 
            'form_title' => 'Editare număr ore nete funcționale pe schimb de lucru',
            'form_route' => route('ore-functionale::update', ['id' => $nr_ore->id])
        ]);
    }
 
    public function update(Request $request, NrOre $nr_ore) 
    {		
    	$validation = $this->validateRequest($request, $nr_ore);
        if ($validation) { return $validation; }

        if (is_null($nr_ore)) { return redirect(route('ore-functionale::list'))->with('alert-danger', 'Numar de ore  nu exista'); }

        $nr_ore->nrSchimb()->associate($request->input('id_nr_schimb'));
        $nr_ore->ore_nete_op = $request->input('ore_nete_op');
        $nr_ore->ore_nete_il = $request->input('ore_nete_il');

        if ($nr_ore->save()) 
        {   
            return redirect()->route('ore-functionale::list')->with('alert-success', 'Numar de ore salvat cu succes');
        } 
        else
        {
            return redirect()->route('ore-functionale::list')->with('alert-danger', 'Eroare salvare');
        }
    }

    public function delete(NrOre $nr_ore) 
    {       
        if (is_null($nr_ore)) { return redirect()->route('ore-functionale::list')->with('alert-danger', 'Numar de ore nu exista'); }

        if ($nr_ore->delete()) 
        {
            return redirect()->route('ore-functionale::list')->with('alert-success', 'Numar de ore eliminat cu succes');
        } 
        else
        {
            return redirect()->route('ore-functionale::list')->with('alert-danger', 'Eroare eliminare');
        }
    }

    protected function validateRequest($request, $nr_ore = null) 
    {	
    	$rules = [ 
            'ore_nete_op' => 'numeric',
            'ore_nete_il' => 'numeric'  
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {
            if (!empty(($nr_ore))) 
            {
                return redirect(route('ore-functionale::edit', ['id' => $nr_ore->id]))
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