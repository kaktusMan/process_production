<?php

namespace App\Http\Controllers\InstrumenteDeLucru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\InstrumenteDeLucru\ModEvacuare;

class ModuriEvacuareController extends Controller
{   
    public function index(){ 
        return view('instrumente_de_lucru.moduri_evacuare.index', [
            'moduri_evacuare' => ModEvacuare::all()
        ]);
    }

    public function create() 
    {        
        return view('instrumente_de_lucru.moduri_evacuare.add_edit', [
            'mod_evacuare' => new ModEvacuare(),
            'form_title' => 'Creare mod de evacuare a componentelor rezultate',
            'form_route' => route('evacuare::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
        $validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $mod_evacuare = new ModEvacuare();

        $mod_evacuare->nume = $request->input('nume');

        if ($mod_evacuare->save()) 
        {   
            return redirect()->route('evacuare::list')->with('alert-success', 'Mod salvata cu succes');
        } 
        else
        {
            return redirect()->route('evacuare::list')->with('alert-danger', 'Eroare salvare mod');
        }
    }
 
    public function edit(ModEvacuare $mod_evacuare) 
    {   
        if (is_null($mod_evacuare)) { return redirect(route('evacuare::list'))->with('alert-danger', 'Mod nu exista'); }

        return view('instrumente_de_lucru.moduri_evacuare.add_edit', [
            'mod_evacuare' => $mod_evacuare, 
            'form_title' => 'Editare mod de evacuare a componentelor rezultate',
            'form_route' => route('evacuare::update', ['id' => $mod_evacuare->id])
        ]);
    }
 
    public function update(Request $request, ModEvacuare $mod_evacuare) 
    {
        $validation = $this->validateRequest($request, $mod_evacuare);
        if ($validation) { return $validation; }

        if (is_null($mod_evacuare)) { return redirect(route('evacuare::list'))->with('alert-danger', 'Mod nu exista'); }

        $mod_evacuare->nume = $request->input('nume');

        if ($mod_evacuare->save()) 
        {   
            return redirect()->route('evacuare::list')->with('alert-success', 'Mod salvat cu succes');
        } 
        else
        {
            return redirect()->route('evacuare::list')->with('alert-danger', 'Eroare salvare mod');
        }
    }

    public function delete(ModEvacuare $mod_evacuare) 
    {       
        if (is_null($mod_evacuare)) { return redirect()->route('evacuare::list')->with('alert-danger', 'Modul nu exista'); }

        if ($mod_evacuare->delete()) 
        {
            return redirect()->route('evacuare::list')->with('alert-success', 'Mod eliminat cu succes');
        } 
        else
        {
            return redirect()->route('evacuare::list')->with('alert-danger', 'Eroare eliminare mod');
        }
    }

    protected function validateRequest($request, $mod_evacuare = null) 
    {   
        $rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($mod_evacuare))) 
            {
                return redirect(route('evacuare::edit', ['id' => $mod_evacuare->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('evacuare::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}