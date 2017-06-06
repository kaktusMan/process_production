<?php

namespace App\Http\Controllers\InstrumenteDeLucru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\InstrumenteDeLucru\Grad;

class GradeDeLibertateController extends Controller
{   
    public function index(){ 
        return view('instrumente_de_lucru.grade_de_libertate.index', [
            'grade' => Grad::all()
        ]);
    }

    public function create() 
    {        
        return view('instrumente_de_lucru.grade_de_libertate.add_edit', [
            'grad' => new Grad(),
            'form_title' => 'Creare grad de libertate a i.l',
            'form_route' => route('grade::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $grad = new Grad();

        $grad->nume = $request->input('nume');

        if ($grad->save()) 
        {   
            return redirect()->route('grade::list')->with('alert-success', 'Grad salvat cu succes');
        } 
        else
        {
            return redirect()->route('grade::list')->with('alert-danger', 'Eroare salvare grad');
        }
    }
 
    public function edit(Grad $grad) 
    {   
        if (is_null($grad)) { return redirect(route('grade::list'))->with('alert-danger', 'Gradul nu exista'); }

        return view('instrumente_de_lucru.grade_de_libertate.add_edit', [
            'grad' => $grad, 
            'form_title' => 'Editare grad de libertate a i.l',
            'form_route' => route('grade::update', ['id' => $grad->id])
        ]);
    }
 
    public function update(Request $request, Grad $grad) 
    {
    	$validation = $this->validateRequest($request, $grad);
        if ($validation) { return $validation; }

        if (is_null($grad)) { return redirect(route('grade::list'))->with('alert-danger', 'Gradul nu exista'); }

        $grad->nume = $request->input('nume');

        if ($grad->save()) 
        {   
            return redirect()->route('grade::list')->with('alert-success', 'Grad salvat cu succes');
        } 
        else
        {
            return redirect()->route('grade::list')->with('alert-danger', 'Eroare salvare grad');
        }
    }

    public function delete(Grad $grad) 
    {       
        if (is_null($grad)) { return redirect()->route('grade::list')->with('alert-danger', 'Gradul nu exista'); }

        if ($grad->delete()) 
        {
            return redirect()->route('grade::list')->with('alert-success', 'Grad eliminat cu succes');
        } 
        else
        {
            return redirect()->route('grade::list')->with('alert-danger', 'Eroare eliminare grad');
        }
    }

    protected function validateRequest($request, $grad = null) 
    {	
    	$rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($grad))) 
            {
                return redirect(route('grade::edit', ['id' => $grad->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('grade::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}