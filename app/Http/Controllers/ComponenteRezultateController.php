<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\Componenta;

class ComponenteRezultateController extends Controller
{   
    public function index(){ 
        return view('componente_rezultate.index', [
            'componente' => Componenta::all()
        ]);
    }

    public function create() 
    {        
        return view('componente_rezultate.add_edit', [
            'componenta' => new Componenta(),
            'form_title' => 'Creare componentă rezultată',
            'form_route' => route('componente::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $componenta = new Componenta();

        $componenta->lungime_finala = $request->input('lungime_finala');
        $componenta->latime_finala = $request->input('latime_finala');
        $componenta->inaltime_finala = $request->input('inaltime_finala');
        $componenta->greutate_finala = $request->input('greutate_finala');
        $componenta->volum_brut = $request->input('volum_brut');
        $componenta->volum_net = $request->input('volum_net');
        $componenta->densitate = $request->input('densitate');
        $componenta->grad_rugozitate = $request->input('grad_rugozitate');

        if ($componenta->save()) 
        {   
            return redirect()->route('componente::list')->with('alert-success', 'Componenta salvata cu succes');
        } 
        else
        {
            return redirect()->route('componente::list')->with('alert-danger', 'Eroare salvare componenta');
        }
    }
 
    public function edit(Componenta $componenta) 
    {   
        if (is_null($componenta)) { return redirect(route('componente::list'))->with('alert-danger', 'Componenta nu exista'); }

        return view('componente_rezultate.add_edit', [
            'componenta' => $componenta, 
            'form_title' => 'Editare componentă rezultată',
            'form_route' => route('componente::update', ['id' => $componenta->id])
        ]);
    }
 
    public function update(Request $request, Componenta $componenta) 
    {
    	$validation = $this->validateRequest($request, $componenta);
        if ($validation) { return $validation; }

        if (is_null($componenta)) { return redirect(route('componente::list'))->with('alert-danger', 'Componenta nu exista'); }

        $componenta->lungime_finala = $request->input('lungime_finala');
        $componenta->latime_finala = $request->input('latime_finala');
        $componenta->inaltime_finala = $request->input('inaltime_finala');
        $componenta->greutate_finala = $request->input('greutate_finala');
        $componenta->volum_brut = $request->input('volum_brut');
        $componenta->volum_net = $request->input('volum_net');
        $componenta->densitate = $request->input('densitate');
        $componenta->grad_rugozitate = $request->input('grad_rugozitate');

        if ($componenta->save()) 
        {   
            return redirect()->route('componente::list')->with('alert-success', 'Componenta salvata cu succes');
        } 
        else
        {
            return redirect()->route('componente::list')->with('alert-danger', 'Eroare salvare componenta');
        }
    }

    public function delete(Componenta $componenta) 
    {       
        if (is_null($componenta)) { return redirect()->route('componente::list')->with('alert-danger', 'Componenta nu exista'); }

        if ($componenta->delete()) 
        {
            return redirect()->route('componente::list')->with('alert-success', 'Componenta eliminata cu succes');
        } 
        else
        {
            return redirect()->route('componente::list')->with('alert-danger', 'Eroare eliminare componenta');
        }
    }

    protected function validateRequest($request, $componenta = null) 
    {	
    	$rules = [ 
            'lungime_finala' => 'numeric'
            'latime_finala' => 'numeric'
            'inaltime_finala' => 'numeric'
            'greutate_finala' => 'numeric'
            'volum_brut' => 'numeric'
            'volum_net' => 'numeric'
            'densitate' => 'numeric'
        ];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($componenta))) 
            {
                return redirect(route('componente::edit', ['id' => $componenta->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('componente::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}