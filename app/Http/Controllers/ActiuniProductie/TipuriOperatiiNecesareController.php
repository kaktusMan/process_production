<?php

namespace App\Http\Controllers\ActiuniProductie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\ActiuniProductie\TipOperatie;

class TipuriOperatiiNecesareController extends Controller
{   
    public function index(){ 
        return view('actiuni_de_productie.operatii_necesare.index', [
            'operatii' => TipOperatie::all()
        ]);
    }

    public function create() 
    {        
        return view('actiuni_de_productie.operatii_necesare.add_edit', [
            'operatie' => new TipOperatie(),
            'form_title' => 'Creare tip de operatie necesară',
            'form_route' => route('operatii::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $operatie = new TipOperatie();

        $operatie->nume = $request->input('nume');

        if ($operatie->save()) 
        {   
            return redirect()->route('operatii::list')->with('alert-success', 'Operatie salvata cu succes');
        } 
        else
        {
            return redirect()->route('operatii::list')->with('alert-danger', 'Eroare salvare operatie');
        }
    }
 
    public function edit(TipOperatie $operatie) 
    {   
        if (is_null($operatie)) { return redirect(route('operatii::list'))->with('alert-danger', 'Operatie nu exista'); }

        return view('actiuni_de_productie.operatii_necesare.add_edit', [
            'operatie' => $operatie, 
            'form_title' => 'Editare tip de operatie necesară',
            'form_route' => route('operatii::update', ['id' => $operatie->id])
        ]);
    }
 
    public function update(Request $request, TipOperatie $operatie) 
    {
    	$validation = $this->validateRequest($request, $operatie);
        if ($validation) { return $validation; }

        if (is_null($operatie)) { return redirect(route('operatii::list'))->with('alert-danger', 'Operatie nu exista'); }

        $operatie->nume = $request->input('nume');

        if ($operatie->save()) 
        {   
            return redirect()->route('operatii::list')->with('alert-success', 'Operatie salvata cu succes');
        } 
        else
        {
            return redirect()->route('operatii::list')->with('alert-danger', 'Eroare salvare operatie');
        }
    }

    public function delete(TipOperatie $operatie) 
    {       
        if (is_null($operatie)) { return redirect()->route('operatii::list')->with('alert-danger', 'Operatie nu exista'); }

        if ($operatie->delete()) 
        {
            return redirect()->route('operatii::list')->with('alert-success', 'Operatie eliminata cu succes');
        } 
        else
        {
            return redirect()->route('operatii::list')->with('alert-danger', 'Eroare eliminare operatie');
        }
    }

    protected function validateRequest($request, $operatie = null) 
    {	
    	$rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($operatie))) 
            {
                return redirect(route('operatii::edit', ['id' => $operatie->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('operatii::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}