<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tools extends Model
{
	const Afirmativ = 'Da';
    const Negativ = 'Nu';

	public static function options() 
    {
        return collect([
            self::Afirmativ => 'Da',
            self::Negativ => 'Nu',
        ]);
    }

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
}

