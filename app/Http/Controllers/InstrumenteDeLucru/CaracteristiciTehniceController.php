<?php

namespace App\Http\Controllers\InstrumenteDeLucru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\Tools;
use App\Models\InstrumenteDeLucru\CaracteristicaTehnica;

class CaracteristiciTehniceController extends Controller


{   
    public function index(){ 
        return view('instrumente_de_lucru.caracteristici_tehnice.index', [
            'caracteristici' => CaracteristicaTehnica::all()
        ]);
    }

    public function create() 
    {        
        return view('instrumente_de_lucru.caracteristici_tehnice.add_edit', [
            'caracteristica' => new CaracteristicaTehnica(),
            'caracteristici_relevante' => Tools::car_tehn_relev_pt_il(),
            'form_title' => 'Creare caracteristici tehnice relevante pentru i.l',
            'form_route' => route('caracteristici::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
        $validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $caracteristica = new CaracteristicaTehnica();

        $caracteristica->nume = $request->input('nume'); 


        if ($caracteristica->save()) 
        {   
            return redirect()->route('caracteristici::list')->with('alert-success', 'Caracteristica salvata cu succes');
        } 
        else
        {
            return redirect()->route('caracteristici::list')->with('alert-danger', 'Eroare salvare caracteristica');
        }
    }
 
    public function edit(CaracteristicaTehnica $caracteristica) 
    {   
        if (is_null($caracteristica)) { return redirect(route('caracteristici::list'))->with('alert-danger', 'Caracteristica nu exista'); }

        return view('instrumente_de_lucru.caracteristici_tehnice.add_edit', [
            'caracteristica' => $caracteristica, 
            'caracteristici_relevante' => Tools::car_tehn_relev_pt_il(),
            'form_title' => 'Editare caracteristici tehnice relevante pentru i.l',
            'form_route' => route('caracteristici::update', ['id' => $caracteristica->id])
        ]);
    }
 
    public function update(Request $request, CaracteristicaTehnica $caracteristica) 
    {
        $validation = $this->validateRequest($request, $caracteristica);
        if ($validation) { return $validation; }

        if (is_null($caracteristica)) { return redirect(route('caracteristici::list'))->with('alert-danger', 'Caracteristica nu exista'); }

        $caracteristica->nume = $request->input('nume'); 

        if ($caracteristica->save()) 
        {   
            return redirect()->route('caracteristici::list')->with('alert-success', 'Caracteristica salvat cu succes');
        } 
        else
        {
            return redirect()->route('caracteristici::list')->with('alert-danger', 'Eroare salvare caracteristica');
        }
    }

    public function delete(CaracteristicaTehnica $caracteristica) 
    {       
        if (is_null($caracteristica)) { return redirect()->route('caracteristici::list')->with('alert-danger', 'Caracteristica nu exista'); }

        if ($caracteristica->delete()) 
        {
            return redirect()->route('caracteristici::list')->with('alert-success', 'Caracteristica eliminat cu succes');
        } 
        else
        {
            return redirect()->route('caracteristici::list')->with('alert-danger', 'Eroare eliminare caracteristica');
        }
    }

    protected function validateRequest($request, $caracteristica = null) 
    {   
        $rules = [ 
            'lungime_maxima' => 'numeric',
            'latime_maxima' => 'numeric',
            'inaltime_maxima' => 'numeric',
            'volum' => 'numeric',
            'greutate' => 'numeric' 
        ];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($caracteristica))) 
            {
                return redirect(route('caracteristici::edit', ['id' => $caracteristica->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('caracteristici::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}