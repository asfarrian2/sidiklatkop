<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class DiklatController extends Controller
{
    public function view(){

        $tabeldata = DB::table('tb_diklat')
        ->leftJoin('tb_seksi', 'tb_diklat.id_seksi', '=', 'tb_seksi.id_seksi')
        ->select('tb_diklat.*', 'tb_seksi.nama_seksi')
        ->get();

        $seksi = DB::table('tb_seksi')
        ->where('status_seksi', '1')
        ->get();

        return view('admin.diklat.view', compact('tabeldata', 'seksi'));
    }
}
