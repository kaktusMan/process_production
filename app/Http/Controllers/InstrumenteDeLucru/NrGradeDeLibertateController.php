<?php

namespace App\Http\Controllers\InstrumenteDeLucru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\InstrumenteDeLucru\NrGrad;

class NrGradeDeLibertateController extends Controller
{   
    public function index(){ 
        return view('instrumente_de_lucru.nr_grade_de_libertate.index', [
            'grade' => NrGrad::all()
        ]);
    }

    public function create() 
    {        
        return view('instrumente_de_lucru.nr_grade_de_libertate.add_edit', [
            'grad' => new NrGrad(),
            'form_title' => 'Creare numar grade de libertate a i.l',
            'form_route' => route('nr_grade::store')
        ]);
    }
 
    public function store(Request $request) 
    {     

    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $grad = new NrGrad();

        $grad->nume = $request->input('nume');

        if ($grad->save()) 
        {   
            return redirect()->route('nr_grade::list')->with('alert-success', 'Numarul de grade salvat cu succes');
        } 
        else
        {
            return redirect()->route('nr_grade::list')->with('alert-danger', 'Eroare salvare');
        }
    }
 
    public function edit(NrGrad $grad) 
    {   
        if (is_null($grad)) { return redirect(route('nr_grade::list'))->with('alert-danger', 'Numarul de grade nu exista'); }

        return view('instrumente_de_lucru.nr_grade_de_libertate.add_edit', [
            'grad' => $grad, 
            'form_title' => 'Editare numar grade de libertate a i.l',
            'form_route' => route('nr_grade::update', ['id' => $grad->id])
        ]);
    }
 
    public function update(Request $request, NrGrad $grad) 
    {
    	$validation = $this->validateRequest($request, $grad);
        if ($validation) { return $validation; }

        if (is_null($grad)) { return redirect(route('nr_grade::list'))->with('alert-danger', 'Numarul de grade nu exista'); }

        $grad->nume = $request->input('nume');

        if ($grad->save()) 
        {   
            return redirect()->route('nr_grade::list')->with('alert-success', 'Numarul de grade salvat cu succes');
        } 
        else
        {
            return redirect()->route('nr_grade::list')->with('alert-danger', 'Eroare salvare');
        }
    }

    public function delete(NrGrad $grad) 
    {       
        if (is_null($grad)) { return redirect()->route('nr_grade::list')->with('alert-danger', 'Numarul de grade nu exista'); }

        if ($grad->delete()) 
        {
            return redirect()->route('nr_grade::list')->with('alert-success', 'Eliminare cu succes');
        } 
        else
        {
            return redirect()->route('nr_grade::list')->with('alert-danger', 'Eroare eliminare');
        }
    }

    protected function validateRequest($request, $grad = null) 
    {	
    	// $rules = ['nume' => 'numeric'];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {    
            if (!empty(($grad))) 
            {
                return redirect(route('nr_grade::edit', ['id' => $grad->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('nr_grade::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}