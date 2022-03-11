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

    public function deletePilota($id) {
        return DB::delete("DELETE FROM versenyzok WHERE ID = ?", array($id));
    }

    public function insertPilota(Request $request) {

        $validated = $request->validate([
            'nev' => 'required',
            'szuletes' => 'required',
            'magassag' => 'required|integer',
            'csapat' => 'required|array',
        ]);

        return DB::insert("INSERT INTO versenyzok (nev, nemzet, szuletes, magassag, csapat)
                            VALUES (?, ?, ?, ?, ?)", array(
                                $validated["nev"],
                                "magyar",
                                date("Y-m-d", strtotime($validated["szuletes"])),
                                $validated["magassag"],
                                $validated["csapat"]["csapatid"]
                            ));
    }

    public function updatePilota($id, Request $request) {

        $validated = $request->validate([
            'nev' => 'required',
            'szuletes' => 'required',
            'magassag' => 'required|integer',
            'csapat' => 'required|array',
        ]);

        return DB::update("UPDATE versenyzok SET nev = ?, nemzet = ?, szuletes= ?, magassag= ?, csapat = ?
                            WHERE id = ?", array(
                                $validated["nev"],
                                "magyar",
                                date("Y-m-d", strtotime($validated["szuletes"])),
                                $validated["magassag"],
                                $validated["csapat"]["csapatid"],
                                $id
                            ));
    }
}
