<?php

namespace App\Http\Controllers\MateriiPrime;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\Tools;
use App\Models\MateriiPrime\Caracteristica;

class CaracteristiciTehnRelevController extends Controller
{   
    public function index(){ 
        return view('materii_prime.caracteristici_tehnice.index', [
            'caracteristici' => Caracteristica::all()
        ]);
    }

    public function create() 
    {        
        return view('materii_prime.caracteristici_tehnice.add_edit', [
            'caracteristica' => new Caracteristica(),
            'caracteristici_relevante' => Tools::car_tehn_relev_pt_mat_prime(),
            'form_title' => 'Creare caracteristici tehnice relevante pentru m.p',
            'form_route' => route('caract_materii::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $caracteristica = new Caracteristica();

        $caracteristica->nume = $request->input('nume'); 

        if ($caracteristica->save()) 
        {   
            return redirect()->route('caract_materii::list')->with('alert-success', 'Caracteristica salvata cu succes');
        } 
        else
        {
            return redirect()->route('caract_materii::list')->with('alert-danger', 'Eroare salvare caracteristica');
        }
    }
 
    public function edit(Caracteristica $caracteristica) 
    {   
        if (is_null($caracteristica)) { return redirect(route('caract_materii::list'))->with('alert-danger', 'Caracteristica nu exista'); }

        return view('materii_prime.caracteristici_tehnice.add_edit', [
            'caracteristica' => $caracteristica, 
            'caracteristici_relevante' => Tools::car_tehn_relev_pt_mat_prime(),
            'form_title' => 'Editare caracteristici tehnice relevante pentru m.p',
            'form_route' => route('caract_materii::update', ['id' => $caracteristica->id])
        ]);
    }
 
    public function update(Request $request, Caracteristica $caracteristica) 
    {
    	$validation = $this->validateRequest($request, $caracteristica);
        if ($validation) { return $validation; }

        if (is_null($caracteristica)) { return redirect(route('caract_materii::list'))->with('alert-danger', 'Caracteristica nu exista'); }

        $caracteristica->nume = $request->input('nume'); 

        if ($caracteristica->save()) 
        {   
            return redirect()->route('caract_materii::list')->with('alert-success', 'Caracteristica salvata cu succes');
        } 
        else
        {
            return redirect()->route('caract_materii::list')->with('alert-danger', 'Eroare salvare caracteristica');
        }
    }

    public function delete(Caracteristica $caracteristica) 
    {       
        if (is_null($caracteristica)) { return redirect()->route('caract_materii::list')->with('alert-danger', 'Caracteristica nu exista'); }

        if ($caracteristica->delete()) 
        {
            return redirect()->route('caract_materii::list')->with('alert-success', 'Caracteristica eliminata cu succes');
        } 
        else
        {
            return redirect()->route('caract_materii::list')->with('alert-danger', 'Eroare eliminare caracteristica');
        }
    }

    protected function validateRequest($request, $caracteristica = null) 
    {	
    	$rules = [ 
            'lungime_finala' => 'numeric',
            'latime_finala' => 'numeric',
            'inaltime_finala' => 'numeric',
            'greutate_finala' => 'numeric',
            'volum_brut' => 'numeric',
            'volum_net' => 'numeric',
            'densitate' => 'numeric'
        ];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($caracteristica))) 
            {
                return redirect(route('caract_materii::edit', ['id' => $caracteristica->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('caract_materii::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}