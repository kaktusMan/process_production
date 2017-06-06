<?php

namespace App\Http\Controllers\CaracteristiciOperare;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\CaracteristiciOperare\GradIncarcareOrara;
use App\Models\CaracteristiciOperare\OperatorActual;

class GradeIncarcareOraraOpController extends Controller
{
    
	public function index(){ 
        return view('caracteristici_operare.grade_incarcare_op.index', [
            'grade' => GradIncarcareOrara::with('operatori')->get()
        ]);
    }

    public function create()
    {        
        return view('caracteristici_operare.grade_incarcare_op.add_edit', [
            'grad' => new GradIncarcareOrara(),
            'operatori' => OperatorActual::getOptionsArray(),
            'form_title' => 'Creare grad de incărcare a operatorilor',
            'form_route' => route('grad-incarcare::store')
        ]);
    }
 
    public function store(Request $request) 
    {     

    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $grad = new GradIncarcareOrara();
        $grad->grad_de_incarcare = $request->input('grad_de_incarcare');
        $grad->operatori()->associate($request->input('id_op'));
	        
        if ($grad->save()) 
        {   
            return redirect()->route('grad-incarcare::list')->with('alert-success', 'Salvare cu succes');
        } 
        else
        {
            return redirect()->route('grad-incarcare::list')->with('alert-danger', 'Eroare salvare');
        }

    }
 
    public function edit(GradIncarcareOrara $grad) 
    {   
        if (is_null($grad)) { return redirect(route('grad-incarcare::list'))->with('alert-danger', 'Tip schimb nu exista'); }

        return view('caracteristici_operare.grade_incarcare_op.add_edit', [
            'grad' => $grad,
            'operatori' => OperatorActual::getOptionsArray(),
            'form_title' => 'Editare grad de incărcare a operatorilor',
            'form_route' => route('grad-incarcare::update', ['id' => $grad->id])
        ]);
    }
 
    public function update(Request $request, GradIncarcareOrara $grad) 
    {		
    	$validation = $this->validateRequest($request, $grad);
        if ($validation) { return $validation; }

        if (is_null($grad)) { return redirect(route('grad-incarcare::list'))->with('alert-danger', 'Tipul nu exista'); }

        $grad->grad_de_incarcare = $request->input('grad_de_incarcare');
        $grad->operatori()->associate($request->input('id_op'));

        if ($grad->save()) 
        {   
            return redirect()->route('grad-incarcare::list')->with('alert-success', 'Tip salvat cu succes');
        } 
        else
        {
            return redirect()->route('grad-incarcare::list')->with('alert-danger', 'Eroare salvare tip');
        }
    }

    public function delete(GradIncarcareOrara $grad) 
    {       
        if (is_null($grad)) { return redirect()->route('grad-incarcare::list')->with('alert-danger', 'Tip nu exista'); }

        if ($grad->delete()) 
        {
            return redirect()->route('grad-incarcare::list')->with('alert-success', 'Tip eliminat cu succes');
        } 
        else
        {
            return redirect()->route('grad-incarcare::list')->with('alert-danger', 'Eroare eliminare tip');
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
                return redirect(route('grad-incarcare::edit', ['id' => $grad->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('operatori-necesari::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}