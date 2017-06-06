<?php

namespace App\Http\Controllers\InstrumenteDeLucru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\InstrumenteDeLucru\ModAlimentare;

class ModuriAlimentareController extends Controller
{   
    public function index(){ 
        return view('instrumente_de_lucru.moduri_alimentare.index', [
            'moduri_alimentare' => ModAlimentare::all()
        ]);
    }

    public function create() 
    {        
        return view('instrumente_de_lucru.moduri_alimentare.add_edit', [
            'mod_alimentare' => new ModAlimentare(),
            'form_title' => 'Creare mod de alimentare a i.l complex',
            'form_route' => route('alimentare::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $mod_alimentare = new ModAlimentare();

        $mod_alimentare->nume = $request->input('nume');

        if ($mod_alimentare->save()) 
        {   
            return redirect()->route('alimentare::list')->with('alert-success', 'Mod salvata cu succes');
        } 
        else
        {
            return redirect()->route('alimentare::list')->with('alert-danger', 'Eroare salvare mod');
        }
    }
 
    public function edit(ModAlimentare $mod_alimentare) 
    {   
        if (is_null($mod_alimentare)) { return redirect(route('alimentare::list'))->with('alert-danger', 'Mod nu exista'); }

        return view('instrumente_de_lucru.moduri_alimentare.add_edit', [
            'mod_alimentare' => $mod_alimentare, 
            'form_title' => 'Editare mod de alimentare a i.l complex',
            'form_route' => route('alimentare::update', ['id' => $mod_alimentare->id])
        ]);
    }
 
    public function update(Request $request, ModAlimentare $mod_alimentare) 
    {
    	$validation = $this->validateRequest($request, $mod_alimentare);
        if ($validation) { return $validation; }

        if (is_null($mod_alimentare)) { return redirect(route('alimentare::list'))->with('alert-danger', 'Mod nu exista'); }

        $mod_alimentare->nume = $request->input('nume');

        if ($mod_alimentare->save()) 
        {   
            return redirect()->route('alimentare::list')->with('alert-success', 'Mod salvat cu succes');
        } 
        else
        {
            return redirect()->route('alimentare::list')->with('alert-danger', 'Eroare salvare mod');
        }
    }

    public function delete(ModAlimentare $mod_alimentare) 
    {       
        if (is_null($mod_alimentare)) { return redirect()->route('alimentare::list')->with('alert-danger', 'Modul nu exista'); }

        if ($mod_alimentare->delete()) 
        {
            return redirect()->route('alimentare::list')->with('alert-success', 'Mod eliminat cu succes');
        } 
        else
        {
            return redirect()->route('alimentare::list')->with('alert-danger', 'Eroare eliminare mod');
        }
    }

    protected function validateRequest($request, $mod_alimentare = null) 
    {	
    	$rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($mod_alimentare))) 
            {
                return redirect(route('alimentare::edit', ['id' => $mod_alimentare->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('alimentare::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}