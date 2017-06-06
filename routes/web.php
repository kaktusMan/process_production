<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('welcome'); });

Route::group([
		'namespace' => 'ActiuniProductie'
		], function () { 

	Route::group([
		'prefix' => 'actiuni-productie',
			'as' => 'actiuni::'

			], function () { 
			// Actiuni de productie
	        Route::get('/', 'ActiuniProductieController@index')->name('list');
	        Route::get('creare', 'ActiuniProductieController@create')->name('create');
	        Route::post('/', 'ActiuniProductieController@store')->name('store');
	        Route::get('{actiuni}', 'ActiuniProductieController@edit')->name('edit');
	        Route::post('{actiuni}', 'ActiuniProductieController@update')->name('update');
	        Route::post('{actiuni}/stergere', 'ActiuniProductieController@delete')->name('delete');

	});

	Route::group([
		'prefix' => 'modalitati-realizare',
		'as' => 'modalitati::'
		], function () { 
	    	Route::get('/', 'ModalitatiRealizareActiuniController@index')->name('list');
	        Route::get('creare', 'ModalitatiRealizareActiuniController@create')->name('create');
	        Route::post('/', 'ModalitatiRealizareActiuniController@store')->name('store');
	        Route::get('{modalitate}', 'ModalitatiRealizareActiuniController@edit')->name('edit');
	        Route::post('{modalitate}', 'ModalitatiRealizareActiuniController@update')->name('update');
	        Route::post('{modalitate}/stergere', 'ModalitatiRealizareActiuniController@delete')->name('delete'); 
	});

	Route::group([
		'prefix' => 'nivele-grupare',
		'as' => 'nivele::'
		], function () { 
	    	Route::get('/', 'NivelDeGrupareController@index')->name('list');
	        Route::get('creare', 'NivelDeGrupareController@create')->name('create');
	        Route::post('/', 'NivelDeGrupareController@store')->name('store');
	        Route::get('{nivel}', 'NivelDeGrupareController@edit')->name('edit');
	        Route::post('{nivel}', 'NivelDeGrupareController@update')->name('update');
	        Route::post('{nivel}/stergere', 'NivelDeGrupareController@delete')->name('delete'); 
	});
 		
	Route::group([
		'prefix' => 'fluxuri-lucrari',
		'as' => 'fluxuri::'
		], function () { 
	    	Route::get('/', 'FluxuriDeLucruController@index')->name('list');
	        Route::get('creare', 'FluxuriDeLucruController@create')->name('create');
	        Route::post('/', 'FluxuriDeLucruController@store')->name('store');
	        Route::get('{flux}', 'FluxuriDeLucruController@edit')->name('edit');
	        Route::post('{flux}', 'FluxuriDeLucruController@update')->name('update');
	        Route::post('{flux}/stergere', 'FluxuriDeLucruController@delete')->name('delete'); 
	});

	Route::group([
		'prefix' => 'tipuri-operatii',
		'as' => 'operatii::'
		], function () { 
	    	Route::get('/', 'TipuriOperatiiNecesareController@index')->name('list');
	        Route::get('creare', 'TipuriOperatiiNecesareController@create')->name('create');
	        Route::post('/', 'TipuriOperatiiNecesareController@store')->name('store');
	        Route::get('{operatie}', 'TipuriOperatiiNecesareController@edit')->name('edit');
	        Route::post('{operatie}', 'TipuriOperatiiNecesareController@update')->name('update');
	        Route::post('{operatie}/stergere', 'TipuriOperatiiNecesareController@delete')->name('delete'); 
	});

	Route::group([
		'prefix' => 'mod-realizare',
		'as' => 'moduri::'
		], function () { 
	    	Route::get('/', 'ModuriRealizareActiuniController@index')->name('list');
	        Route::get('creare', 'ModuriRealizareActiuniController@create')->name('create');
	        Route::post('/', 'ModuriRealizareActiuniController@store')->name('store');
	        Route::get('{mod}', 'ModuriRealizareActiuniController@edit')->name('edit');
	        Route::post('{mod}', 'ModuriRealizareActiuniController@update')->name('update');
	        Route::post('{mod}/stergere', 'ModuriRealizareActiuniController@delete')->name('delete'); 
	});

	Route::group([
		'prefix' => 'categorii-il',
		'as' => 'categorii::'
		], function () { 
	    	Route::get('/', 'CategoriiIlController@index')->name('list');
	        Route::get('creare', 'CategoriiIlController@create')->name('create');
	        Route::post('/', 'CategoriiIlController@store')->name('store');
	        Route::get('{categorie}', 'CategoriiIlController@edit')->name('edit');
	        Route::post('{categorie}', 'CategoriiIlController@update')->name('update');
	        Route::post('{categorie}/stergere', 'CategoriiIlController@delete')->name('delete'); 
	});

});


Route::group([
		'namespace' => 'InstrumenteDeLucru'
		], function () { 


	Route::group([
		'prefix' => 'instrumente-lucru',
		'as' => 'tipuri::',

		], function () {
			Route::get('/', 'TipuriInstrumenteDeLucruController@index')->name('list');
	        Route::get('creare', 'TipuriInstrumenteDeLucruController@create')->name('create');
	        Route::post('/', 'TipuriInstrumenteDeLucruController@store')->name('store');
	        Route::get('{tip}', 'TipuriInstrumenteDeLucruController@edit')->name('edit');
	        Route::post('{tip}', 'TipuriInstrumenteDeLucruController@update')->name('update');
	        Route::post('{tip}/stergere', 'TipuriInstrumenteDeLucruController@delete')->name('delete');

	});


	Route::group([
		'prefix' => 'grade-libertate',
		'as' => 'grade::'
		], function () {
			Route::get('/', 'GradeDeLibertateController@index')->name('list');
	        Route::get('creare', 'GradeDeLibertateController@create')->name('create');
	        Route::post('/', 'GradeDeLibertateController@store')->name('store');
	        Route::get('{grad}', 'GradeDeLibertateController@edit')->name('edit');
	        Route::post('{grad}', 'GradeDeLibertateController@update')->name('update');
	        Route::post('{grad}/stergere', 'GradeDeLibertateController@delete')->name('delete');

	});
	Route::group([
		'prefix' => 'nr-grade-libertate',
		'as' => 'nr_grade::'
		], function () {
			Route::get('/', 'NrGradeDeLibertateController@index')->name('list');
	        Route::get('creare', 'NrGradeDeLibertateController@create')->name('create');
	        Route::post('/', 'NrGradeDeLibertateController@store')->name('store');
	        Route::get('{grad}', 'NrGradeDeLibertateController@edit')->name('edit');
	        Route::post('{grad}', 'NrGradeDeLibertateController@update')->name('update');
	        Route::post('{grad}/stergere', 'NrGradeDeLibertateController@delete')->name('delete');

	});

	Route::group([
		'prefix' => 'tipuri-materiale',
		'as' => 'materiale::',

		], function () {
			Route::get('/', 'TipuriMaterialeController@index')->name('list');
	        Route::get('creare', 'TipuriMaterialeController@create')->name('create');
	        Route::post('/', 'TipuriMaterialeController@store')->name('store');
	        Route::get('{tip}', 'TipuriMaterialeController@edit')->name('edit');
	        Route::post('{tip}', 'TipuriMaterialeController@update')->name('update');
	        Route::post('{tip}/stergere', 'TipuriMaterialeController@delete')->name('delete');

	});

	Route::group([
		'prefix' => 'categorii-il-complexe',
		'as' => 'categorii-complexe::'
		], function () { 
	    	Route::get('/', 'CategoriiIlComplexeController@index')->name('list');
	        Route::get('creare', 'CategoriiIlComplexeController@create')->name('create');
	        Route::post('/', 'CategoriiIlComplexeController@store')->name('store');
	        Route::get('{categorie}', 'CategoriiIlComplexeController@edit')->name('edit');
	        Route::post('{categorie}', 'CategoriiIlComplexeController@update')->name('update');
	        Route::post('{categorie}/stergere', 'CategoriiIlComplexeController@delete')->name('delete'); 
	});
	// 
	Route::group([
		'prefix' => 'moduri-alimentare',
		'as' => 'alimentare::'
		], function () { 
	    	Route::get('/', 'ModuriAlimentareController@index')->name('list');
	        Route::get('creare', 'ModuriAlimentareController@create')->name('create');
	        Route::post('/', 'ModuriAlimentareController@store')->name('store');
	        Route::get('{mod_alimentare}', 'ModuriAlimentareController@edit')->name('edit');
	        Route::post('{mod_alimentare}', 'ModuriAlimentareController@update')->name('update');
	        Route::post('{mod_alimentare}/stergere', 'ModuriAlimentareController@delete')->name('delete'); 
	});
	Route::group([
		'prefix' =>'moduri-evacuare',
		'as' => 'evacuare::'
		], function () { 
	    	Route::get('/', 'ModuriEvacuareController@index')->name('list');
	        Route::get('creare', 'ModuriEvacuareController@create')->name('create');
	        Route::post('/', 'ModuriEvacuareController@store')->name('store');
	        Route::get('{mod_evacuare}', 'ModuriEvacuareController@edit')->name('edit');
	        Route::post('{mod_evacuare}', 'ModuriEvacuareController@update')->name('update');
	        Route::post('{mod_evacuare}/stergere', 'ModuriEvacuareController@delete')->name('delete'); 
	});

	Route::group([
		'prefix' => 'tipuri-consumabile',
		'as' => 'consumabile::'
		], function () { 
	    	Route::get('/', 'TipuriConsumabileController@index')->name('list');
	        Route::get('creare', 'TipuriConsumabileController@create')->name('create');
	        Route::post('/', 'TipuriConsumabileController@store')->name('store');
	        Route::get('{tip_consumabile}', 'TipuriConsumabileController@edit')->name('edit');
	        Route::post('{tip_consumabile}', 'TipuriConsumabileController@update')->name('update');
	        Route::post('{tip_consumabile}/stergere', 'TipuriConsumabileController@delete')->name('delete'); 
	});

	Route::group([
		'prefix' => 'caracteristici-tehnice',
		'as' => 'caracteristici::'
		], function () { 
	    	Route::get('/', 'CaracteristiciTehniceController@index')->name('list');
	        Route::get('creare', 'CaracteristiciTehniceController@create')->name('create');
	        Route::post('/', 'CaracteristiciTehniceController@store')->name('store');
	        Route::get('{caracteristica}', 'CaracteristiciTehniceController@edit')->name('edit');
	        Route::post('{caracteristica}', 'CaracteristiciTehniceController@update')->name('update');
	        Route::post('{caracteristica}/stergere', 'CaracteristiciTehniceController@delete')->name('delete'); 
	});



	// componente il

	Route::group([
		'namespace' => 'Componente'
		], function(){

			Route::group([
				'prefix' => 'il-aferente-prp',
				'as' => 'aferente-prp::'
				], function () { 
			    	Route::get('/', 'IlAferentePrPController@index')->name('list');
			        Route::get('creare', 'IlAferentePrPController@create')->name('create');
			        Route::post('/', 'IlAferentePrPController@store')->name('store');
			        Route::get('{il_aferent}', 'IlAferentePrPController@edit')->name('edit');
			        Route::post('{il_aferent}', 'IlAferentePrPController@update')->name('update');
			        Route::post('{il_aferent}/stergere', 'IlAferentePrPController@delete')->name('delete'); 
			});

			Route::group([
				'prefix' => 'analiza-oprimizarii-fl',
				'as' => 'optimizari-fl::'
				], function () { 
			    	Route::get('/', 'IlPtAnalizaFlController@index')->name('list');
			        Route::get('creare', 'IlPtAnalizaFlController@create')->name('create');
			        Route::post('/', 'IlPtAnalizaFlController@store')->name('store');
			        Route::get('{optimizare_fl}', 'IlPtAnalizaFlController@edit')->name('edit');
			        Route::post('{optimizare_fl}', 'IlPtAnalizaFlController@update')->name('update');
			        Route::post('{optimizare_fl}/stergere', 'IlPtAnalizaFlController@delete')->name('delete'); 
			});

			Route::group([
				'prefix' => 'toate-il-posibile',
				'as' => 'il-posibile::'
				], function () { 
			    	Route::get('/', 'ToateIlPosibileController@index')->name('list');
			        Route::get('creare', 'ToateIlPosibileController@create')->name('create');
			        Route::post('/', 'ToateIlPosibileController@store')->name('store');
			        Route::get('{il_posibil}', 'ToateIlPosibileController@edit')->name('edit');
			        Route::post('{il_posibil}', 'ToateIlPosibileController@update')->name('update');
			        Route::post('{il_posibil}/stergere', 'ToateIlPosibileController@delete')->name('delete'); 
			});

			Route::group([
				'prefix' => 'moduri-folosinta-il',
				'as' => 'mod-aplicare::'
				], function () { 
			    	Route::get('/', 'ModuriFolosintaController@index')->name('list');
			        Route::get('creare', 'ModuriFolosintaController@create')->name('create');
			        Route::post('/', 'ModuriFolosintaController@store')->name('store');
			        Route::get('{aplicatie}', 'ModuriFolosintaController@edit')->name('edit');
			        Route::post('{aplicatie}', 'ModuriFolosintaController@update')->name('update');
			        Route::post('{aplicatie}/stergere', 'ModuriFolosintaController@delete')->name('delete'); 
			});



		});

});

Route::group([
	'prefix' => 'componente-rezultate',
	'as' => 'componente::'
	], function () { 
    	Route::get('/', 'ComponenteRezultateController@index')->name('list');
        Route::get('creare', 'ComponenteRezultateController@create')->name('create');
        Route::post('/', 'ComponenteRezultateController@store')->name('store');
        Route::get('{componente}', 'ComponenteRezultateController@edit')->name('edit');
        Route::post('{componente}', 'ComponenteRezultateController@update')->name('update');
        Route::post('{componente}/stergere', 'ComponenteRezultateController@delete')->name('delete'); 
});

Route::group([
	'prefix' => 'zone-de-lucru',
	'as' => 'zone::'
	], function () { 
    	Route::get('/', 'ZoneDeLucruController@index')->name('list');
        Route::get('creare', 'ZoneDeLucruController@create')->name('create');
        Route::post('/', 'ZoneDeLucruController@store')->name('store');
        Route::get('{zona}', 'ZoneDeLucruController@edit')->name('edit');
        Route::post('{zona}', 'ZoneDeLucruController@update')->name('update');
        Route::post('{zona}/stergere', 'ZoneDeLucruController@delete')->name('delete'); 
});

Route::group([
		'namespace' => 'MateriiPrime'
		], function () { 


	Route::group([
		'prefix' => 'tipuri-materii',
		'as' => 'tipuri_materii::',

		], function () {
			Route::get('/', 'TipuriMateriiController@index')->name('list');
	        Route::get('creare', 'TipuriMateriiController@create')->name('create');
	        Route::post('/', 'TipuriMateriiController@store')->name('store');
	        Route::get('{tip}', 'TipuriMateriiController@edit')->name('edit');
	        Route::post('{tip}', 'TipuriMateriiController@update')->name('update');
	        Route::post('{tip}/stergere', 'TipuriMateriiController@delete')->name('delete');

	});

	Route::group([
		'prefix' => 'forme-materii',
		'as' => 'forme_materii::',

		], function () {
			Route::get('/', 'FormeMateriiController@index')->name('list');
	        Route::get('creare', 'FormeMateriiController@create')->name('create');
	        Route::post('/', 'FormeMateriiController@store')->name('store');
	        Route::get('{forma}', 'FormeMateriiController@edit')->name('edit');
	        Route::post('{forma}', 'FormeMateriiController@update')->name('update');
	        Route::post('{forma}/stergere', 'FormeMateriiController@delete')->name('delete');

	});

	Route::group([
		'prefix' => 'caracteristici-materii',
		'as' => 'caract_materii::',

		], function () {
			Route::get('/', 'CaracteristiciTehnRelevController@index')->name('list');
	        Route::get('creare', 'CaracteristiciTehnRelevController@create')->name('create');
	        Route::post('/', 'CaracteristiciTehnRelevController@store')->name('store');
	        Route::get('{caracteristica}', 'CaracteristiciTehnRelevController@edit')->name('edit');
	        Route::post('{caracteristica}', 'CaracteristiciTehnRelevController@update')->name('update');
	        Route::post('{caracteristica}/stergere', 'CaracteristiciTehnRelevController@delete')->name('delete');

	});

});

Route::group([
	'namespace' => 'Componente'
	], function () { 

	Route::group([
		'prefix' => 'fabrici-de-productie',
		'as' => 'instalatii::',

		], function () {
			Route::get('/', 'InstalatiiProductieController@index')->name('list');
	        Route::get('creare', 'InstalatiiProductieController@create')->name('create');
	        Route::post('/', 'InstalatiiProductieController@store')->name('store');
	        Route::get('{instalatie}', 'InstalatiiProductieController@edit')->name('edit');
	        Route::post('{instalatie}', 'InstalatiiProductieController@update')->name('update');
	        Route::post('{instalatie}/stergere', 'InstalatiiProductieController@delete')->name('delete');

	});

	Route::group([
		'prefix' => 'fluxuri-de-lucru',
		'as' => 'fluxuri-pp::',

		], function () {
			Route::get('/', 'FluxuriAferentePpController@index')->name('list');
	        Route::get('creare', 'FluxuriAferentePpController@create')->name('create');
	        Route::post('/', 'FluxuriAferentePpController@store')->name('store');
	        Route::get('{flux}', 'FluxuriAferentePpController@edit')->name('edit');
	        Route::post('{flux}', 'FluxuriAferentePpController@update')->name('update');
	        Route::post('{flux}/stergere', 'FluxuriAferentePpController@delete')->name('delete');

	});

	Route::group([
		'prefix' => 'procese-de-productie',
		'as' => 'procese-productie::',

		], function () {
			Route::get('/', 'PrPAferenteFlController@index')->name('list');
	        Route::get('creare', 'PrPAferenteFlController@create')->name('create');
	        Route::post('/', 'PrPAferenteFlController@store')->name('store');
	        Route::get('{proces}', 'PrPAferenteFlController@edit')->name('edit');
	        Route::post('{proces}', 'PrPAferenteFlController@update')->name('update');
	        Route::post('{proces}/stergere', 'PrPAferenteFlController@delete')->name('delete');

	});

});





Route::group([
	'namespace' => 'CaracteristiciOperare'
	], function () { 

	Route::group([
		'prefix' => 'tipuri-operatori',
		'as' => 'tip-operatori::',

		], function () {
			Route::get('/', 'TipuriOperatoriController@index')->name('list');
	        Route::get('creare', 'TipuriOperatoriController@create')->name('create');
	        Route::post('/', 'TipuriOperatoriController@store')->name('store');
	        Route::get('{tip_operator}', 'TipuriOperatoriController@edit')->name('edit');
	        Route::post('{tip_operator}', 'TipuriOperatoriController@update')->name('update');
	        Route::post('{tip_operator}/stergere', 'TipuriOperatoriController@delete')->name('delete');

	});

	Route::group([
		'prefix' => 'operatori-actuali',
		'as' => 'operatori-actuali::',

		], function () {
			Route::get('/', 'OperatoriActualiController@index')->name('list');
	        Route::get('creare', 'OperatoriActualiController@create')->name('create');
	        Route::post('/', 'OperatoriActualiController@store')->name('store');
	        Route::get('{operator}', 'OperatoriActualiController@edit')->name('edit');
	        Route::post('{operator}', 'OperatoriActualiController@update')->name('update');
	        Route::post('{operator}/stergere', 'OperatoriActualiController@delete')->name('delete');

	});


	Route::group([
		'prefix' => 'operatori-simultan-necesari',
		'as' => 'operatori-necesari::',

		], function () {
			Route::get('/', 'OpSimultanNecesariController@index')->name('list');
	        Route::get('creare', 'OpSimultanNecesariController@create')->name('create');
	        Route::post('/', 'OpSimultanNecesariController@store')->name('store');
	        Route::get('{operator_necesar}', 'OpSimultanNecesariController@edit')->name('edit');
	        Route::post('{operator_necesar}', 'OpSimultanNecesariController@update')->name('update');
	        Route::post('{operator_necesar}/stergere', 'OpSimultanNecesariController@delete')->name('delete');

	}); 

	Route::group([
		'prefix' => 'numar-schimburi-de-lucru',
		'as' => 'schimburi-de-lucru::',

		], function () {
			Route::get('/', 'NrSchimburiPePrPController@index')->name('list');
	        Route::get('creare', 'NrSchimburiPePrPController@create')->name('create');
	        Route::post('/', 'NrSchimburiPePrPController@store')->name('store');
	        Route::get('{nr_schimb}', 'NrSchimburiPePrPController@edit')->name('edit');
	        Route::post('{nr_schimb}', 'NrSchimburiPePrPController@update')->name('update');
	        Route::post('{nr_schimb}/stergere', 'NrSchimburiPePrPController@delete')->name('delete');
	}); 


	Route::group([
		'prefix' => 'numar-ore-functionale',
		'as' => 'ore-functionale::',

		], function () {
			Route::get('/', 'NrOreFunctPeSchimbController@index')->name('list');
	        Route::get('creare', 'NrOreFunctPeSchimbController@create')->name('create');
	        Route::post('/', 'NrOreFunctPeSchimbController@store')->name('store');
	        Route::get('{nr_ore}', 'NrOreFunctPeSchimbController@edit')->name('edit');
	        Route::post('{nr_ore}', 'NrOreFunctPeSchimbController@update')->name('update');
	        Route::post('{nr_ore}/stergere', 'NrOreFunctPeSchimbController@delete')->name('delete');
	});

	Route::group([
		'prefix' => 'grad-incarcare-operator',
		'as' => 'grad-incarcare::',

		], function () {
			Route::get('/', 'GradeIncarcareOraraOpController@index')->name('list');
	        Route::get('creare', 'GradeIncarcareOraraOpController@create')->name('create');
	        Route::post('/', 'GradeIncarcareOraraOpController@store')->name('store');
	        Route::get('{grad}', 'GradeIncarcareOraraOpController@edit')->name('edit');
	        Route::post('{grad}', 'GradeIncarcareOraraOpController@update')->name('update');
	        Route::post('{grad}/stergere', 'GradeIncarcareOraraOpController@delete')->name('delete');
	});
	 

});




