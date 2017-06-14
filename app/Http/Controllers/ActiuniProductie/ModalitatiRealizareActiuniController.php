<?php

namespace App\Http\Controllers\ActiuniProductie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\ActiuniProductie\ModalitateRealizareAct;

class ModalitatiRealizareActiuniController extends Controller
{   
    public function index(){ 
        return view('actiuni_de_productie.modalitati_realizare.index', [
            'modalitati' => ModalitateRealizareAct::all()
        ]);
    }

    public function create(){

        return view('actiuni_de_productie.modalitati_realizare.add_edit', [
            'modalitate' => new ModalitateRealizareAct(),
            'form_title' => 'Creare modalitate de realizare a acțiunilor',
            'form_route' => route('modalitati::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $modalitate = new ModalitateRealizareAct();

        $modalitate->nume = $request->input('nume');

        if ($modalitate->save()) 
        {   
            return redirect()->route('modalitati::list')->with('alert-success', 'Modalitate salvata cu succes');
        } 
        else
        {
            return redirect()->route('modalitati::list')->with('alert-danger', 'Eroare salvare modalitate');
        }
    }
 
    public function edit(ModalitateRealizareAct $modalitate) 
    {   
        if (is_null($modalitate)) { return redirect(route('modalitati::list'))->with('alert-danger', 'Modul nu exista'); }

        return view('actiuni_de_productie.modalitati_realizare.add_edit', [
            'modalitate' => $modalitate, 
            'form_title' => 'Editare  modalitate de realizare a acțiunilor',
            'form_route' => route('modalitati::update', ['id' => $modalitate->id])
        ]);
    }
 
    public function update(Request $request, ModalitateRealizareAct $modalitate) 
    {   
    	$validation = $this->validateRequest($request, $modalitate);
        if ($validation) { return $validation; }

        if (is_null($modalitate)) { return redirect(route('modalitati::list'))->with('alert-danger', 'Modalitatea nu exista'); }

        $modalitate->nume = $request->input('nume');

        if ($modalitate->save()) 
        {   
            return redirect()->route('modalitati::list')->with('alert-success', 'Modalitate salvata cu succes');
        } 
        else
        {
            return redirect()->route('modalitati::list')->with('alert-danger', 'Eroare salvare modalitate');
        }
    }

    public function delete(ModalitateRealizareAct $modalitate) 
    {       
        if (is_null($modalitate)) { return redirect()->route('modalitati::list')->with('alert-danger', 'Modalitatea nu exista'); }

        if ($modalitate->delete()) 
        {
            return redirect()->route('modalitati::list')->with('alert-success', 'Modalitate eliminat cu succes');
        } 
        else
        {
            return redirect()->route('modalitati::list')->with('alert-danger', 'Eroare eliminare modalitate');
        }
    }

    protected function validateRequest($request, $modalitate = null) 
    {	
    	$rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($modalitate))) 
            {
                return redirect(route('modalitati::edit', ['id' => $modalitate->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('modalitati::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}