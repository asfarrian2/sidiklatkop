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

class AdminController extends Controller
{
    public function view(){

        $admin = DB::table('tb_admin')
        ->get();

        $seksi = DB::table('tb_seksi')
        ->where('status_seksi', '1')
        ->get();

        return view('admin.admin.view', compact('admin', 'seksi'));
    }


    //Simpan Data
    public function store(Request $request)
    {

        $id_admins =DB::table('tb_admin')
        ->latest('id_admins', 'DESC')
        ->first();

        $kodeobjek ="140520001";

        if($id_admins == null){
            $nomorurut = "001";
        }else{
            $nomorurut = substr($id_admins->id_admins, 8, 3) + 1;
            $nomorurut = str_pad($nomorurut, 3, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $nama           = $request->nama;
        $nip            = $request->nip;
        $tmp_lahir      = $request->tmp;
        $tgl_lahir      = $request->tgl;
        $alamat         = $request->alamat;
        $agama          = $request->agama;
        $jk             = $request->jk;
        $pendidikan     = $request->pendidikan;
        $no_hp          = $request->telp;
        $username       = $request->username;
        $instansi       = $request->instansi;
        $foto           = $request->foto;


        $data = [
            'id_admins'     => $id,
            'nama'          => $nama,
            'nik'           => $nik,
            'tmp_lahir'     => $tmp_lahir,
            'tgl_lahir'     => $tgl_lahir,
            'alamat'        => $alamat,
            'agama'         => $agama,
            'jk'            => $jk,
            'pendidikan'    => $pendidikan,
            'no_hp'         => $no_hp,
            'email'         => $email,
            'instansi'      => $instansi,
            'foto'          => $foto,
            'status'        => '1'
        ];
        $simpan = DB::table('tb_admin')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }
    }


}
