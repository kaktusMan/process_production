<?php

namespace App\Http\Controllers\InstrumenteDeLucru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\InstrumenteDeLucru\TipConsumabile;

class TipuriConsumabileController extends Controller
{   
    public function index(){ 
        return view('instrumente_de_lucru.tipuri_consumabile.index', [
            'tipuri_consumabile' => TipConsumabile::all()
        ]);
    }

    public function create() 
    {        
        return view('instrumente_de_lucru.tipuri_consumabile.add_edit', [
            'tip_consumabile' => new TipConsumabile(),
            'form_title' => 'Creare tip consumabile ale i.l',
            'form_route' => route('consumabile::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
        $validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $tip_consumabile = new TipConsumabile();

        $tip_consumabile->nume = $request->input('nume');

        if ($tip_consumabile->save()) 
        {   
            return redirect()->route('consumabile::list')->with('alert-success', 'Tip salvata cu succes');
        } 
        else
        {
            return redirect()->route('consumabile::list')->with('alert-danger', 'Eroare salvare tip');
        }
    }
 
    public function edit(TipConsumabile $tip_consumabile) 
    {   
        if (is_null($tip_consumabile)) { return redirect(route('consumabile::list'))->with('alert-danger', 'Tip nu exista'); }

        return view('instrumente_de_lucru.tipuri_consumabile.add_edit', [
            'tip_consumabile' => $tip_consumabile, 
            'form_title' => 'Editare tip consumabile ale i.l',
            'form_route' => route('consumabile::update', ['id' => $tip_consumabile->id])
        ]);
    }
 
    public function update(Request $request, TipConsumabile $tip_consumabile) 
    {
        $validation = $this->validateRequest($request, $tip_consumabile);
        if ($validation) { return $validation; }

        if (is_null($tip_consumabile)) { return redirect(route('consumabile::list'))->with('alert-danger', 'Tip nu exista'); }

        $tip_consumabile->nume = $request->input('nume');

        if ($tip_consumabile->save()) 
        {   
            return redirect()->route('consumabile::list')->with('alert-success', 'Tip salvat cu succes');
        } 
        else
        {
            return redirect()->route('consumabile::list')->with('alert-danger', 'Eroare salvare tip');
        }
    }

    public function delete(TipConsumabile $tip_consumabile) 
    {       
        if (is_null($tip_consumabile)) { return redirect()->route('consumabile::list')->with('alert-danger', 'Tipul nu exista'); }

        if ($tip_consumabile->delete()) 
        {
            return redirect()->route('consumabile::list')->with('alert-success', 'Tip eliminat cu succes');
        } 
        else
        {
            return redirect()->route('consumabile::list')->with('alert-danger', 'Eroare eliminare tip');
        }
    }

    protected function validateRequest($request, $tip_consumabile = null) 
    {   
        $rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($tip_consumabile))) 
            {
                return redirect(route('consumabile::edit', ['id' => $tip_consumabile->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('consumabile::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}