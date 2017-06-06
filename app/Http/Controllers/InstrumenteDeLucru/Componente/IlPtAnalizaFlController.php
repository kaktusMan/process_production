<?php

namespace App\Http\Controllers\InstrumenteDeLucru\Componente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\ActiuniProductie\Flux;
use App\Models\InstrumenteDeLucru\Componente\AnalizaFl;



class IlPtAnalizaFlController extends Controller
{
     
    public function index(){ 
        return view('instrumente_de_lucru.~componente.analiza_fl.index', [
            'optimizari_fl' => AnalizaFl::with('tipuriFl')->get()
        ]);
    }

    public function create() 
    {        
        return view('instrumente_de_lucru.~componente.analiza_fl.add_edit', [
            'optimizare_fl' => new AnalizaFl(),
            'form_title' => 'Creare il pentru analiza optimizarii fp',
            'tipuri_fluxuri' => Flux::getOptionsArray(),
            'form_route' => route('optimizari-fl::store')
        ]);
    } 
 
    public function store(Request $request) 
    {     
        $validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $optimizare_fl = new AnalizaFl();

        $optimizare_fl->nume = $request->input('nume');
        $optimizare_fl->detalii = $request->input('detalii');
        $optimizare_fl->tipuriFl()->associate($request->input('id_fl'));

        if ($optimizare_fl->save()) 
        {   
            return redirect()->route('optimizari-fl::list')->with('alert-success', 'Il salvat cu succes');
        } 
        else
        {
            return redirect()->route('optimizari-fl::list')->with('alert-danger', 'Eroare salvare il');
        }
    }
 
    public function edit(AnalizaFl $optimizare_fl) 
    {   
        if (is_null($optimizare_fl)) { return redirect(route('optimizari-fl::list'))->with('alert-danger', 'Il nu exista'); }

        return view('instrumente_de_lucru.~componente.analiza_fl.add_edit', [
            'optimizare_fl' => $optimizare_fl, 
            'form_title' => 'Editare il pentru analiza optimizarii fp',
            'tipuri_fluxuri' => Flux::getOptionsArray(),
            'form_route' => route('optimizari-fl::update', ['id' => $optimizare_fl->id])
        ]);
    }
 
    public function update(Request $request, AnalizaFl $optimizare_fl) 
    {       
        $validation = $this->validateRequest($request, $optimizare_fl);
        if ($validation) { return $validation; }

        if (is_null($optimizare_fl)) { return redirect(route('optimizari-fl::list'))->with('alert-danger', 'Il nu exista'); }

        $optimizare_fl->nume = $request->input('nume');
        $optimizare_fl->detalii = $request->input('detalii');
        $optimizare_fl->tipuriFl()->associate($request->input('id_fl'));

        if ($optimizare_fl->save()) 
        {   
            return redirect()->route('optimizari-fl::list')->with('alert-success', 'Il salvat cu succes');
        } 
        else
        {
            return redirect()->route('optimizari-fl::list')->with('alert-danger', 'Eroare salvare il');
        }
    }

    public function delete(AnalizaFl $optimizare_fl) 
    {       
        if (is_null($optimizare_fl)) { return redirect()->route('optimizari-fl::list')->with('alert-danger', 'Il nu exista'); }

        if ($optimizare_fl->delete()) 
        {
            return redirect()->route('optimizari-fl::list')->with('alert-success', 'Il eliminat cu succes');
        } 
        else
        {
            return redirect()->route('optimizari-fl::list')->with('alert-danger', 'Eroare eliminare il');
        }
    }

    protected function validateRequest($request, $optimizare_fl = null) 
    {   
        $rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($optimizare_fl))) 
            {
                return redirect(route('optimizari-fl::edit', ['id' => $optimizare_fl->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('optimizari-fl::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}