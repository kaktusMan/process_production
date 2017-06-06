<?php

namespace App\Http\Controllers\ActiuniProductie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\ActiuniProductie\Actiune;
use App\Models\Tools;
use App\Models\InstrumenteDeLucru\TipMaterial;

class ActiuniProductieController extends Controller
{   
    public function index(){ 
        // return Actiune::with('modalitati', 'tipuri')->get();
        return view('actiuni_de_productie.actiuni.index', [
            'operatii' => Actiune::with('tipuri')->get()
        ]);
    }

    public function create() 
    {       
        return view('actiuni_de_productie.actiuni.add_edit', [
            'actiuni' => new Actiune(),
            'optiuni' => Tools::options(),
            'form_title' => 'Creare acțiune de producție',
            'tipuri_materiale' => TipMaterial::getOptionsArray(),
            'form_route' => route('actiuni::store')
        ]);
    }
 
    public function store(Request $request) 
    {       
        $actiuni = new Actiune();

        $actiuni->nume = $request->input('nume');
        $actiuni->tranzitie_intre_op = $request->input('tranzitie_intre_op');
        $actiuni->stationare_op = $request->input('stationare_op');
        $actiuni->stationare_op = $request->input('stationare_op');
        $actiuni->tipuri()->associate($request->input('tipuri_id'));

        if ($actiuni->save()) 
        {   
            return redirect()->route('actiuni::list')->with('alert-success', 'Actiune salvata cu succes');
        } 
        else
        {
            return redirect()->route('actiuni::list')->with('alert-danger', 'Eroare salvare actiune');
        }
    }
 
    public function edit(Actiune $actiuni) 
    {   
        if (is_null($actiuni)) { return redirect(route('actiuni::list'))->with('alert-danger', 'Actiunea nu exista'); }

        return view('actiuni_de_productie.actiuni.add_edit', [
            'actiuni' => $actiuni,
            'optiuni' => Tools::options(),
            'tipuri_materiale' => TipMaterial::getOptionsArray(),
            'form_title' => 'Editare acțiune de producție',
            'form_route' => route('actiuni::update', ['id' => $actiuni->id])
        ]);
    }
 
    public function update(Request $request, Actiune $actiuni) 
    {
        if (is_null($actiuni)) { return redirect(route('actiuni::list'))->with('alert-danger', 'Actiunea nu exista'); }

        $actiuni->nume = $request->input('nume');
        $actiuni->tranzitie_intre_op = $request->input('tranzitie_intre_op');
        $actiuni->stationare_op = $request->input('stationare_op');
        $actiuni->stationare_op = $request->input('stationare_op');
        $actiuni->tipuri()->associate($request->input('tipuri_id'));

        if ($actiuni->save()) 
        {   
            return redirect()->route('actiuni::list')->with('alert-success', 'Actiune salvata cu succes');
        } 
        else
        {
            return redirect()->route('actiuni::list')->with('alert-danger', 'Eroare salvare actiune');
        }
    }

    public function delete(Actiune $actiuni) 
    {       
        if (is_null($actiuni)) { return redirect()->route('actiuni::list')->with('alert-danger', 'Actiunea nu exista'); }

        if ($actiuni->delete()) 
        {
            return redirect()->route('actiuni::list')->with('alert-success', 'Actiune eliminata cu succes');
        } 
        else
        {
            return redirect()->route('actiuni::list')->with('alert-danger', 'Eroare eliminare actiune');
        }
    }

    protected function validateRequest($request, $actiuni = null) 
    {
        $validator = Validator::make($request->all());

        if ($validator->fails()) 
        {
            if (!empty(($actiuni))) 
            {
                return redirect(route('actiuni::edit', ['id' => $actiuni->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('actiuni::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}