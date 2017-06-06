<?php

namespace App\Http\Controllers\ActiuniProductie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\ActiuniProductie\CategorieIl;

class CategoriiIlController extends Controller
{   
    public function index(){ 
        return view('actiuni_de_productie.categorii_il.index', [
            'categorii' => CategorieIl::all()
        ]);
    }

    public function create() 
    {        
        return view('actiuni_de_productie.categorii_il.add_edit', [
            'categorie' => new CategorieIl(),
            'form_title' => 'Creare categorie de instrumente de lucru',
            'form_route' => route('categorii::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $categorie = new CategorieIl();

        $categorie->nume = $request->input('nume');

        if ($categorie->save()) 
        {   
            return redirect()->route('categorii::list')->with('alert-success', 'Categorie salvata cu succes');
        } 
        else
        {
            return redirect()->route('categorii::list')->with('alert-danger', 'Eroare salvare Categorie');
        }
    }
 
    public function edit(CategorieIl $categorie) 
    {   
        if (is_null($categorie)) { return redirect(route('categorii::list'))->with('alert-danger', 'Categoria nu exista'); }

        return view('actiuni_de_productie.categorii_il.add_edit', [
            'categorie' => $categorie, 
            'form_title' => 'Editare categorie de instrumente de lucru',
            'form_route' => route('categorii::update', ['id' => $categorie->id])
        ]);
    }
 
    public function update(Request $request, CategorieIl $categorie) 
    {
    	$validation = $this->validateRequest($request, $categorie);
        if ($validation) { return $validation; }

        if (is_null($categorie)) { return redirect(route('categorii::list'))->with('alert-danger', 'Categoria nu exista'); }

        $categorie->nume = $request->input('nume');

        if ($categorie->save()) 
        {   
            return redirect()->route('categorii::list')->with('alert-success', 'Categorie salvata cu succes');
        } 
        else
        {
            return redirect()->route('categorii::list')->with('alert-danger', 'Eroare salvare Categorie');
        }
    }

    public function delete(CategorieIl $categorie) 
    {       
        if (is_null($categorie)) { return redirect()->route('categorii::list')->with('alert-danger', 'Categoria nu exista'); }

        if ($categorie->delete()) 
        {
            return redirect()->route('categorii::list')->with('alert-success', 'Categorie eliminata cu succes');
        } 
        else
        {
            return redirect()->route('categorii::list')->with('alert-danger', 'Eroare eliminare Categorie');
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
                return redirect(route('categorii::edit', ['id' => $categorie->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('categorii::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}