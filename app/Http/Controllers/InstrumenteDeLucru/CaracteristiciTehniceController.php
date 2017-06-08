<?php

namespace App\Http\Controllers\InstrumenteDeLucru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
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
            'form_title' => 'Creare caracteristici tehnice relevante pentru i.l',
            'form_route' => route('caracteristici::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
        $validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $caracteristica = new CaracteristicaTehnica();

        $caracteristica->lungime_maxima = $request->input('lungime_maxima');
        $caracteristica->latime_maxima = $request->input('latime_maxima');
        $caracteristica->inaltime_maxima = $request->input('inaltime_maxima');
        $caracteristica->volum = $request->input('volum');
        $caracteristica->greutate = $request->input('greutate');


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
            'form_title' => 'Editare caracteristici tehnice relevante pentru i.l',
            'form_route' => route('caracteristici::update', ['id' => $caracteristica->id])
        ]);
    }
 
    public function update(Request $request, CaracteristicaTehnica $caracteristica) 
    {
        $validation = $this->validateRequest($request, $caracteristica);
        if ($validation) { return $validation; }

        if (is_null($caracteristica)) { return redirect(route('caracteristici::list'))->with('alert-danger', 'Caracteristica nu exista'); }

        $caracteristica->lungime_maxima = $request->input('lungime_maxima');
        $caracteristica->latime_maxima = $request->input('latime_maxima');
        $caracteristica->inaltime_maxima = $request->input('inaltime_maxima');
        $caracteristica->volum = $request->input('volum');
        $caracteristica->greutate = $request->input('greutate');

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