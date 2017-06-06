<?php

namespace App\Http\Controllers\InstrumenteDeLucru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\InstrumenteDeLucru\CategorieIlComplexa;

class CategoriiIlComplexeController extends Controller
{   
    public function index(){ 
        return view('instrumente_de_lucru.categorii_il_complexe.index', [
            'categorii' => CategorieIlComplexa::all()
        ]);
    }

    public function create() 
    {        
        return view('instrumente_de_lucru.categorii_il_complexe.add_edit', [
            'categorie' => new CategorieIlComplexa(),
            'form_title' => 'Creare categorie de instrumente de lucru complexe',
            'form_route' => route('categorii-complexe::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $categorie = new CategorieIlComplexa();

        $categorie->nume = $request->input('nume');

        if ($categorie->save()) 
        {   
            return redirect()->route('categorii-complexe::list')->with('alert-success', 'Categorie salvata cu succes');
        } 
        else
        {
            return redirect()->route('categorii-complexe::list')->with('alert-danger', 'Eroare salvare Categorie');
        }
    }
 
    public function edit(CategorieIlComplexa $categorie) 
    {   
        if (is_null($categorie)) { return redirect(route('categorii-complexe::list'))->with('alert-danger', 'Categoria nu exista'); }

        return view('instrumente_de_lucru.categorii_il_complexe.add_edit', [
            'categorie' => $categorie, 
            'form_title' => 'Editare categorie de instrumente de lucru complexe',
            'form_route' => route('categorii-complexe::update', ['id' => $categorie->id])
        ]);
    }
 
    public function update(Request $request, CategorieIlComplexa $categorie) 
    {
    	$validation = $this->validateRequest($request, $categorie);
        if ($validation) { return $validation; }

        if (is_null($categorie)) { return redirect(route('categorii-complexe::list'))->with('alert-danger', 'Categoria nu exista'); }

        $categorie->nume = $request->input('nume');

        if ($categorie->save()) 
        {   
            return redirect()->route('categorii-complexe::list')->with('alert-success', 'Categorie salvata cu succes');
        } 
        else
        {
            return redirect()->route('categorii-complexe::list')->with('alert-danger', 'Eroare salvare categorie');
        }
    }

    public function delete(CategorieIlComplexa $categorie) 
    {       
        if (is_null($categorie)) { return redirect()->route('categorii-complexe::list')->with('alert-danger', 'Categoria nu exista'); }

        if ($categorie->delete()) 
        {
            return redirect()->route('categorii-complexe::list')->with('alert-success', 'Categorie eliminata cu succes');
        } 
        else
        {
            return redirect()->route('categorii-complexe::list')->with('alert-danger', 'Eroare eliminare categorie');
        }
    }

    protected function validateRequest($request, $categorie = null) 
    {	
    	$rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($categorie))) 
            {
                return redirect(route('categorii-complexe::edit', ['id' => $categorie->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('categorii-complexe::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}