<?php

namespace App\Http\Controllers\InstrumenteDeLucru\Componente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\InstrumenteDeLucru\Componente\ModFolosinta;


class ModuriFolosintaController extends Controller
{
     
    public function index(){ 
        return view('instrumente_de_lucru.~componente.moduri_folosinta.index', [
            'aplicatii' => ModFolosinta::all()
        ]);
    }

    public function create() 
    {        
        return view('instrumente_de_lucru.~componente.moduri_folosinta.add_edit', [
            'aplicatie' => new ModFolosinta(),
            'form_title' => 'Creare mod folosinta pentru instrumente de lucru existente',
            'form_route' => route('mod-aplicare::store')
        ]);
    } 
 
    public function store(Request $request) 
    {     
        $validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $aplicatie = new ModFolosinta();

        $aplicatie->nume = $request->input('nume');

        if ($aplicatie->save()) 
        {   
            return redirect()->route('mod-aplicare::list')->with('alert-success', 'Mod salvat cu succes');
        } 
        else
        {
            return redirect()->route('mod-aplicare::list')->with('alert-danger', 'Eroare salvare mod');
        }
    }
 
    public function edit(ModFolosinta $aplicatie) 
    {   
        if (is_null($aplicatie)) { return redirect(route('mod-aplicare::list'))->with('alert-danger', 'Mod nu exista'); }

        return view('instrumente_de_lucru.~componente.moduri_folosinta.add_edit', [
            'aplicatie' => $aplicatie, 
            'form_title' => 'Editare mod folosinta pentru instrumente de lucru existente',
            'form_route' => route('mod-aplicare::update', ['id' => $aplicatie->id])
        ]);
    }
 
    public function update(Request $request, ModFolosinta $aplicatie) 
    {       
        $validation = $this->validateRequest($request, $aplicatie);
        if ($validation) { return $validation; }

        if (is_null($aplicatie)) { return redirect(route('mod-aplicare::list'))->with('alert-danger', 'Mod nu exista'); }

        $aplicatie->nume = $request->input('nume');

        if ($aplicatie->save()) 
        {   
            return redirect()->route('mod-aplicare::list')->with('alert-success', 'Mod salvat cu succes');
        } 
        else
        {
            return redirect()->route('mod-aplicare::list')->with('alert-danger', 'Eroare salvare mod');
        }
    }

    public function delete(ModFolosinta $aplicatie) 
    {       
        if (is_null($aplicatie)) { return redirect()->route('mod-aplicare::list')->with('alert-danger', 'Mod nu exista'); }

        if ($aplicatie->delete()) 
        {
            return redirect()->route('mod-aplicare::list')->with('alert-success', 'Mod eliminat cu succes');
        } 
        else
        {
            return redirect()->route('mod-aplicare::list')->with('alert-danger', 'Eroare eliminare mod');
        }
    }

    protected function validateRequest($request, $aplicatie = null) 
    {   
        $rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($aplicatie))) 
            {
                return redirect(route('mod-aplicare::edit', ['id' => $aplicatie->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('mod-aplicare::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}