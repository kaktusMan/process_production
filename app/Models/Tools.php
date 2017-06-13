<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tools extends Model
{

    const C ='Căsătorit/ă';
    const D = 'Divorțat/ă';
    const V = 'Văduv/ă';
    const N = 'Necăsătorit/ă';


    public static function satareaCivila() 
    {
        return collect([
            self::C => 0,
            self::D => 1,
            self::V => 2,
            self::N => 3,
        ]);
    }

    const M ='Masculin';
    const F = 'Feminin';

    public static function sex() 
    {
        return collect([
            self::M => 0,
            self::F => 1,
        ]);
    }

    // const 1 = '1';
    // const 2 = '2';
    // const 3 = '3';

    public static function nr_schimburi() 
    {
        return collect([
            1 => '1',
            2 => '2',
            3 => '3',
        ]);
    }


    public static function car_tehn_relev_pt_comp_rez(){
        return collect([
             'Lungime finala'  => 'Lungime finala',
             'Latime finala'  => 'Latime finala',
             'Inaltime finala'  => 'Inaltime finala',
             'Volum brut'  => 'Volum brut',
             'Volum net'  => 'Volum net',
             'Greutate finala'  => 'Greutate finala',
             'Densitate'  => 'Densitate',
             'Gradul de rugozitate a suprafetei'  => 'Gradul de rugozitate a suprafetei',
        ]);
    }

    public static function car_tehn_relev_pt_mat_prime(){
        return collect([
             'Lungime finala'  => 'Lungime finala',
             'Latime finala'  => 'Latime finala',
             'Inaltime finala'  => 'Inaltime finala',
             'Volum brut'  => 'Volum brut',
             'Volum net'  => 'Volum net',
             'Greutate finala'  => 'Greutate finala',
             'Densitate'  => 'Densitate', 
        ]);
    }

    public static function car_tehn_relev_pt_il(){
        return collect([
             'Lungime maxima'  => 'Lungime maxima',
             'Latime maxima'  => 'Latime maxima',
             'Inaltime maxima'  => 'Inaltime maxima',
             'Volum'  => 'Volum',
             'Greutate'  => 'Greutate',
        ]);
    }


}

