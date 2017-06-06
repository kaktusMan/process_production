<?php

namespace App\Http\Controllers\ActiuniProductie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\ActiuniProductie\ModRealizareAct;

class ModuriRealizareActiuniController extends Controller
{   
    public function index(){ 
        return view('actiuni_de_productie.moduri_realizare.index', [
            'moduri' => ModRealizareAct::all()
        ]);
    }

    public function create() 
    {        
        return view('actiuni_de_productie.moduri_realizare.add_edit', [
            'mod' => new ModRealizareAct(),
            'form_title' => 'Creare mod de realizare a acțiunilor',
            'form_route' => route('moduri::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $mod = new ModRealizareAct();

        $mod->nume = $request->input('nume');

        if ($mod->save()) 
        {   
            return redirect()->route('moduri::list')->with('alert-success', 'Mod salvat cu succes');
        } 
        else
        {
            return redirect()->route('moduri::list')->with('alert-danger', 'Eroare salvare mod');
        }
    }
 
    public function edit(ModRealizareAct $mod) 
    {   
        if (is_null($mod)) { return redirect(route('moduri::list'))->with('alert-danger', 'Modul nu exista'); }

        return view('actiuni_de_productie.moduri_realizare.add_edit', [
            'mod' => $mod, 
            'form_title' => 'Editare mod de realizare a acțiunilor',
            'form_route' => route('moduri::update', ['id' => $mod->id])
        ]);
    }
 
    public function update(Request $request, ModRealizareAct $mod) 
    {
    	$validation = $this->validateRequest($request, $mod);
        if ($validation) { return $validation; }

        if (is_null($mod)) { return redirect(route('moduri::list'))->with('alert-danger', 'Modul nu exista'); }

        $mod->nume = $request->input('nume');

        if ($mod->save()) 
        {   
            return redirect()->route('moduri::list')->with('alert-success', 'Mod salvat cu succes');
        } 
        else
        {
            return redirect()->route('moduri::list')->with('alert-danger', 'Eroare salvare mod');
        }
    }

    public function delete(ModRealizareAct $mod) 
    {       
        if (is_null($mod)) { return redirect()->route('moduri::list')->with('alert-danger', 'Modul nu exista'); }

        if ($mod->delete()) 
        {
            return redirect()->route('moduri::list')->with('alert-success', 'Mod eliminat cu succes');
        } 
        else
        {
            return redirect()->route('moduri::list')->with('alert-danger', 'Eroare eliminare mod');
        }
    }

    protected function validateRequest($request, $mod = null) 
    {	
    	$rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($mod))) 
            {
                return redirect(route('moduri::edit', ['id' => $mod->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('moduri::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}