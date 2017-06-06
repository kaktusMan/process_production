<?php

namespace App\Http\Controllers\Componente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Models\Componente\Instalatie;

class InstalatiiProductieController extends Controller
{
    
	public function index(){ 
        return view('instalatii_productie.instalatii.index', [
            'instalatii' => Instalatie::all()
        ]);
    }

    public function create() 
    {        
        return view('instalatii_productie.instalatii.add_edit', [
            'instalatie' => new Instalatie(),
            'form_title' => 'Creare fabrică de productie',
            'form_route' => route('instalatii::store')
        ]);
    }
 
    public function store(Request $request) 
    {     
    	$validation = $this->validateRequest($request);
        if ($validation) { return $validation; }

        $instalatie = new Instalatie();

        $instalatie->nume = $request->input('nume');
        $instalatie->cod = $request->input('cod');
        $instalatie->detalii = $request->input('detalii');

        if ($instalatie->save()) 
        {   
            return redirect()->route('instalatii::list')->with('alert-success', 'Instalatie salvata cu succes');
        } 
        else
        {
            return redirect()->route('instalatii::list')->with('alert-danger', 'Eroare salvare instalatie');
        }
    }
 
    public function edit(Instalatie $instalatie) 
    {   
        if (is_null($instalatie)) { return redirect(route('instalatii::list'))->with('alert-danger', 'instalatie nu exista'); }

        return view('instalatii_productie.instalatii.add_edit', [
            'instalatie' => $instalatie, 
            'form_title' => 'Editare fabrică de productie',
            'form_route' => route('instalatii::update', ['id' => $instalatie->id])
        ]);
    }
 
    public function update(Request $request, Instalatie $instalatie) 
    {		
    	$validation = $this->validateRequest($request, $instalatie);
        if ($validation) { return $validation; }

        if (is_null($instalatie)) { return redirect(route('instalatii::list'))->with('alert-danger', 'Instalatia nu exista'); }

        $instalatie->nume = $request->input('nume');
        $instalatie->cod = $request->input('cod');
        $instalatie->detalii = $request->input('detalii');

        if ($instalatie->save()) 
        {   
            return redirect()->route('instalatii::list')->with('alert-success', 'Instalatie salvata cu succes');
        } 
        else
        {
            return redirect()->route('instalatii::list')->with('alert-danger', 'Eroare salvare instalatie');
        }
    }

    public function delete(Instalatie $instalatie) 
    {       
        if (is_null($instalatie)) { return redirect()->route('instalatii::list')->with('alert-danger', 'instalatie nu exista'); }

        if ($instalatie->delete()) 
        {
            return redirect()->route('instalatii::list')->with('alert-success', 'Instalatie eliminata cu succes');
        } 
        else
        {
            return redirect()->route('instalatii::list')->with('alert-danger', 'Eroare eliminare instalatie');
        }
    }

    protected function validateRequest($request, $instalatie = null) 
    {	
    	$rules = [];
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) 
        {
            if (!empty(($instalatie))) 
            {
                return redirect(route('instalatii::edit', ['id' => $instalatie->id]))
                        ->withErrors($validator->errors())
                        ->withInput();
            } 
            else 
            {
                return redirect(route('instalatii::create'))
                        ->withErrors($validator->errors())
                        ->withInput();
            }
        }
    }
}