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


class JkoperasiController extends Controller
{
     public function view(){

        $tabeldata = DB::table('tb_jkoperasi')
        ->get();

        return view('admin.jkoperasi.view', compact('tabeldata'));
    }

    //Simpan Data
    public function store(Request $request)
    {

        $id_jkoperasi =DB::table('tb_jkoperasi')
        ->latest('id_jkoperasi', 'DESC')
        ->first();

        $kodeobjek ="JK-";

        if($id_jkoperasi == null){
            $nomorurut = "01";
        }else{
            $nomorurut = substr($id_jkoperasi->id_jkoperasi, 3, 2) + 1;
            $nomorurut = str_pad($nomorurut, 2, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $nama           = $request->nama;

        $data = [
            'id_jkoperasi' => $id,
            'jenis'        => $nama,
            'status'       => '1'
        ];
        $simpan = DB::table('tb_jkoperasi')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }
    }

    //Edit Data
    public function edit(Request $request)
    {
        $id_jkoperasi = $request->id_jkoperasi;
        $id = Crypt::decrypt($id_jkoperasi);

        $jkoperasi = DB::table('tb_jkoperasi')
        ->where('id_jkoperasi', $id)
        ->first();

        return view('admin.jkoperasi.edit', compact('id', 'jkoperasi'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $id_jkoperasi = Crypt::decrypt($id);

         $data = [
            'jenis'      => $nama
        ];

        $update = DB::table('tb_jkoperasi')->where('id_jkoperasi', $id_jkoperasi)->update($data);
          if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
    }

    //Status Data
    public function stat(Request $request)
    {
        $id_jkoperasi = $request->id_jkoperasi;
        $id = Crypt::decrypt($id_jkoperasi);

        $jkoperasi = DB::table('tb_jkoperasi')
        ->where('id_jkoperasi', $id)
        ->first();

        return view('admin.jkoperasi.status', compact('id', 'jkoperasi'));
    }


    public function status(Request $request)
    {
        $id = $request->id;
        $id_jkoperasi   = Crypt::decrypt($id);

        $jkoperasi = DB::table('tb_jkoperasi')
        ->where('id_jkoperasi', $id_jkoperasi)
        ->first();

        $status = $jkoperasi->status;

        $aktif = [
            'status' => '1',
        ];

        $nonaktif = [
            'status' => '0',
        ];

        if($status == '0'){
            $update = DB::table('tb_jkoperasi')->where('id_jkoperasi', $id_jkoperasi)->update($aktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diaktifkan.']);
            }

        }else{
            $update = DB::table('tb_jkoperasi')->where('id_jkoperasi', $id_jkoperasi)->update($nonaktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dinonaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dinonaktifkan.']);
            }
        }

    }

    public function hapus(Request $request)
    {
        $id_jkoperasi = $request->id_jkoperasi;
        $id = Crypt::decrypt($id_jkoperasi);

        $jkoperasi = DB::table('tb_jkoperasi')
        ->where('id_jkoperasi', $id)
        ->first();

        $delete = $request->id;

        return view('admin.jkoperasi.hapus', compact('id', 'jkoperasi'));
    }


    public function delete(Request $request)
    {
        $id           = $request->id;
        $id_jkoperasi = Crypt::decrypt($id);
        $delete = DB::table('tb_jkoperasi')->where('id_jkoperasi', $id_jkoperasi)->delete();
          if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }



}
