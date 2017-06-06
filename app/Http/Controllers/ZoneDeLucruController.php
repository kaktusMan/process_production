<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\ZonaLucru;

class ZoneDeLucruController extends Controller
{   
    public function index(){ 
        return view('zone_de_lucru.index', [
            'zone' => ZonaLucru::all()
        ]);
    }

    public function create() 
    {        
        return view('zone_de_lucru.add_edit', [
            'zona' => new ZonaLucru(),
            'form_title' => 'Adauga zona de lucru',
            'form_route' => route('zone::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $zona = new ZonaLucru();

        $zona->nume = $request->input('nume');

        if ($zona->save()) 
        {   
            return redirect()->route('zone::list')->with('alert-success', 'Zona salvata cu succes');
        } 
        else
        {
            return redirect()->route('zone::list')->with('alert-danger', 'Eroare salvare zona');
        }
    }
 
    public function edit(ZonaLucru $zona) 
    {   
        if (is_null($zona)) { return redirect(route('zone::list'))->with('alert-danger', 'Zona nu exista'); }

        return view('zone_de_lucru.add_edit', [
            'zona' => $zona, 
            'form_title' => 'Editare zona',
            'form_route' => route('zone::update', ['id' => $zona->id])
        ]);
    }
 
    public function update(Request $request, ZonaLucru $zona) 
    {
    	$validation = $this->validateRequest($request, $zona);
        if ($validation) { return $validation; }

        if (is_null($zona)) { return redirect(route('zone::list'))->with('alert-danger', 'Zona nu exista'); }

        $zona->nume = $request->input('nume');

        if ($zona->save()) 
        {   
            return redirect()->route('zone::list')->with('alert-success', 'Zona salvata cu succes');
        } 
        else
        {
            return redirect()->route('zone::list')->with('alert-danger', 'Eroare salvare zona');
        }
    }

    public function delete(ZonaLucru $zona) 
    {       
        if (is_null($zona)) { return redirect()->route('zone::list')->with('alert-danger', 'Zona nu exista'); }

        if ($zona->delete()) 
        {
            return redirect()->route('zone::list')->with('alert-success', 'Zona eliminata cu succes');
        } 
        else
        {
            return redirect()->route('zone::list')->with('alert-danger', 'Eroare eliminare zona');
        }
    }

    protected function validateRequest($request, $zona = null) 
    {	
    	$rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($zona))) 
            {
                return redirect(route('zone::edit', ['id' => $zona->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('zone::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}