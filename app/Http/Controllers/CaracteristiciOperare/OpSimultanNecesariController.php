<?php

namespace App\Http\Controllers\CaracteristiciOperare;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use DB;
use App\Models\CaracteristiciOperare\OperatorActual;
use App\Models\CaracteristiciOperare\OperatorNecesar;
use App\Models\InstrumenteDeLucru\Componente\IlPosibil;

class OpSimultanNecesariController extends Controller
{
    
	public function index(){ 
        return view('caracteristici_operare.operatori_necesari_simultan.index', [
            'operatori_necesari' => OperatorNecesar::with('Il')->get(),
            'lista_operatori' => OperatorActual::getOptionsArray(),
            'test' => new OpSimultanNecesariController
        ]);
    }

    public function create() 
    {        
        return view('caracteristici_operare.operatori_necesari_simultan.add_edit', [
            'operator_necesar' => new OperatorNecesar(),
            'operatori' => OperatorActual::getOptionsArray(),
            'lista_il' => IlPosibil::getOptionsArray(),
            'form_title' => 'Creare număr operatori necesari simultan pentru i.l',
            'form_route' => route('operatori-necesari::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $operator_necesar = new OperatorNecesar();
        $operator_necesar->Il()->associate($request->input('id_il'));
        $operator_necesar->id_op = implode('', $request->input('operatori'));
	        
        if ($operator_necesar->save()) 
        {   
            return redirect()->route('operatori-necesari::list')->with('alert-success', 'Tip salvat cu succes');
        } 
        else
        {
            return redirect()->route('operatori-necesari::list')->with('alert-danger', 'Eroare salvare tip');
        }

    }
 
    public function edit(OperatorNecesar $operator_necesar) 
    {   
        if (is_null($operator_necesar)) { return redirect(route('operatori-necesari::list'))->with('alert-danger', 'Tip nu exista'); }
        return view('caracteristici_operare.operatori_necesari_simultan.add_edit', [
            'operator_necesar' => $operator_necesar,
            'operatori' => OperatorActual::getOptionsArray(), 
            'lista_il' => IlPosibil::getOptionsArray(), 
            'form_title' => 'Editare număr operatori necesari simultan pentru i.l',
            'form_route' => route('operatori-necesari::update', ['id' => $operator_necesar->id])
        ]);
    }
 
    public function update(Request $request, OperatorNecesar $operator_necesar) 
    {		
    	$validation = $this->validateRequest($request, $operator_necesar);
        if ($validation) { return $validation; }

        if (is_null($operator_necesar)) { return redirect(route('operatori-necesari::list'))->with('alert-danger', 'Tipul nu exista'); }

        $operator_necesar->Il()->associate($request->input('id_il'));
        $operator_necesar->id_op = implode('', $request->input('operatori'));

        if ($operator_necesar->save()) 
        {   
            return redirect()->route('operatori-necesari::list')->with('alert-success', 'Tip salvat cu succes');
        } 
        else
        {
            return redirect()->route('operatori-necesari::list')->with('alert-danger', 'Eroare salvare tip');
        }
    }

    public function delete(OperatorNecesar $operator_necesar) 
    {       
        if (is_null($operator_necesar)) { return redirect()->route('operatori-necesari::list')->with('alert-danger', 'Tip nu exista'); }

        if ($operator_necesar->delete()) 
        {
            return redirect()->route('operatori-necesari::list')->with('alert-success', 'Tip eliminat cu succes');
        } 
        else
        {
            return redirect()->route('operatori-necesari::list')->with('alert-danger', 'Eroare eliminare tip');
        }
    }

    protected function validateRequest($request, $operator_necesar = null) 
    {	
    	$rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($operator_necesar))) 
            {
                return redirect(route('operatori-necesari::edit', ['id' => $operator_necesar->id]))
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

    public static function opName($op_ids){
        //preluarea numelor operatorilor asignati pr il
        $op_ids = str_split($op_ids);
        $nume_op = '';
        foreach ($op_ids as $key => $value) {
            foreach (OperatorActual::getOptionsArray() as $key => $option) {
                if ($key == $value) {
                    $nume_op.= $option.', ';  
                }
            } 
        }
        return substr($nume_op, 0, -2);
    }
}








