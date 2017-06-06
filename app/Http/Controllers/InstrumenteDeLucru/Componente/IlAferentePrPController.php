<?php

namespace App\Http\Controllers\InstrumenteDeLucru\Componente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\Componente\ProcesProductie;
use App\Models\InstrumenteDeLucru\Componente\IlAferentPrp;



class IlAferentePrPController extends Controller
{
     
    public function index(){ 
        return view('instrumente_de_lucru.~componente.aferente_prp.index', [
            'il_aferente' => IlAferentPrp::with('tipuriPrP')->get()
        ]);
    }

    public function create() 
    {        
        return view('instrumente_de_lucru.~componente.aferente_prp.add_edit', [
            'il_aferent' => new IlAferentPrp(),
            'form_title' => 'Creare il aferent proceselor de productie',
            'tipuri_procese' => ProcesProductie::getOptionsArray(),
            'form_route' => route('aferente-prp::store')
        ]);
    } 
 
    public function store(Request $request) 
    {     
        $validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $il_aferent = new IlAferentPrp();

        $il_aferent->nume = $request->input('nume');
        $il_aferent->cod = $request->input('cod');
        $il_aferent->detalii = $request->input('detalii');
        $il_aferent->nr_inventar = $request->input('nr_inventar');
        $il_aferent->tipuriPrp()->associate($request->input('id_prp'));

        if ($il_aferent->save()) 
        {   
            return redirect()->route('aferente-prp::list')->with('alert-success', 'Il aferent salvat cu succes');
        } 
        else
        {
            return redirect()->route('aferente-prp::list')->with('alert-danger', 'Eroare salvare il aferent');
        }
    }
 
    public function edit(IlAferentPrp $il_aferent) 
    {   
        if (is_null($il_aferent)) { return redirect(route('aferente-prp::list'))->with('alert-danger', 'Il aferent  nu exista'); }

        return view('instrumente_de_lucru.~componente.aferente_prp.add_edit', [
            'il_aferent' => $il_aferent, 
            'form_title' => 'Editare il aferent proceselor de productie',
            'tipuri_procese' => ProcesProductie::getOptionsArray(),
            'form_route' => route('aferente-prp::update', ['id' => $il_aferent->id])
        ]);
    }
 
    public function update(Request $request, IlAferentPrp $il_aferent) 
    {       
        $validation = $this->validateRequest($request, $il_aferent);
        if ($validation) { return $validation; }

        if (is_null($il_aferent)) { return redirect(route('aferente-prp::list'))->with('alert-danger', 'Il aferent nu exista'); }

        $il_aferent->nume = $request->input('nume');
        $il_aferent->cod = $request->input('cod');
        $il_aferent->detalii = $request->input('detalii');
        $il_aferent->nr_inventar = $request->input('nr_inventar');
        $il_aferent->tipuriPrp()->associate($request->input('id_prp'));

        if ($il_aferent->save()) 
        {   
            return redirect()->route('aferente-prp::list')->with('alert-success', 'Il aferent salvat cu succes');
        } 
        else
        {
            return redirect()->route('aferente-prp::list')->with('alert-danger', 'Eroare salvare il aferent');
        }
    }

    public function delete(IlAferentPrp $il_aferent) 
    {       
        if (is_null($il_aferent)) { return redirect()->route('aferente-prp::list')->with('alert-danger', 'Il aferent nu exista'); }

        if ($il_aferent->delete()) 
        {
            return redirect()->route('aferente-prp::list')->with('alert-success', 'Il aferent eliminat cu succes');
        } 
        else
        {
            return redirect()->route('aferente-prp::list')->with('alert-danger', 'Eroare eliminare il aferent');
        }
    }

    protected function validateRequest($request, $il_aferent = null) 
    {   
        $rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($il_aferent))) 
            {
                return redirect(route('aferente-prp::edit', ['id' => $il_aferent->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('aferente-prp::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}