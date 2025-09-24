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

class KotaController extends Controller
{
    public function view(){

        $kota = DB::table('tb_kota')
        ->get();

        return view('admin.kota.view', compact('kota'));
    }

    //Simpan Data
    public function store(Request $request)
    {

        $id_kota=DB::table('tb_kota')
        ->latest('id_kota', 'DESC')
        ->first();

        $kodeobjek ="KOTA-";

        if($id_kota == null){
            $nomorurut = "01";
        }else{
            $nomorurut = substr($id_kota->id_kota, 5, 2) + 1;
            $nomorurut = str_pad($nomorurut, 2, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $nama_kota      = $request->nama;



        $data = [
            'id_kota'        => $id,
            'nama_kota'      => $nama_kota,
            'status_kota'    => '1'
        ];
        $simpan = DB::table('tb_kota')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }
    }

     //Edit Data
    public function edit(Request $request)
    {
        $id_kota = $request->id_kota;
        $id = Crypt::decrypt($id_kota);

        $kota = DB::table('tb_kota')
        ->where('id_kota', $id)
        ->first();

        return view('admin.kota.edit', compact('id', 'kota'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $id_kota = Crypt::decrypt($id);

         $data = [
            'nama_kota'      => $nama
        ];

        $update = DB::table('tb_kota')->where('id_kota', $id_kota)->update($data);
          if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
    }

    //Status Data
    public function stat(Request $request)
    {
        $id_kota = $request->id_kota;
        $id = Crypt::decrypt($id_kota);

        $kota = DB::table('tb_kota')
        ->where('id_kota', $id)
        ->first();

        return view('admin.kota.status', compact('id', 'kota'));
    }


    public function status(Request $request)
    {
        $id = $request->id;
        $id_kota   = Crypt::decrypt($id);

        $kota = DB::table('tb_kota')
        ->where('id_kota', $id_kota)
        ->first();

        $status_kota = $kota->status_kota;

        $aktif = [
            'status_kota' => '1',
        ];

        $nonaktif = [
            'status_kota' => '0',
        ];

        if($status_kota == '0'){
            $update = DB::table('tb_kota')->where('id_kota', $id_kota)->update($aktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diaktifkan.']);
            }

        }else{
            $update = DB::table('tb_kota')->where('id_kota', $id_kota)->update($nonaktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dinonaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dinonaktifkan.']);
            }
        }

    }

    public function hapus(Request $request)
    {
        $id_kota = $request->id_kota;
        $id = Crypt::decrypt($id_kota);

        $kota = DB::table('tb_kota')
        ->where('id_kota', $id)
        ->first();

        $delete = $request->id;

        return view('admin.kota.hapus', compact('id', 'kota'));
    }


    public function delete(Request $request)
    {
        $id     = $request->id;
        $id_kota = Crypt::decrypt($id);
        $delete = DB::table('tb_kota')->where('id_kota', $id_kota)->delete();
          if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

}
