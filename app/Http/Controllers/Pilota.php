<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Pilota extends Controller
{
    public function getPilotak() {

        return DB::select("SELECT versenyzok.ID, versenyzok.nev, versenyzok.nemzet,
                            versenyzok.szuletes, versenyzok.magassag, csapatok.csapatid,
                            csapatok.csapatnev, csapatok.nemzet AS 'csapatnemzet'
                            FROM versenyzok
                            INNER JOIN csapatok ON csapatok.csapatid = versenyzok.csapat");
                            
    }
}
