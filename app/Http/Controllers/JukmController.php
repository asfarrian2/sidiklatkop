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

class JukmController extends Controller
{
     public function view(){

        $tabeldata = DB::table('tb_jukm')
        ->orderBy('jenis', 'DESC')
        ->get();

        return view('admin.jukm.view', compact('tabeldata'));
    }

    //Simpan Data
    public function store(Request $request)
    {

        $id_jukm =DB::table('tb_jukm')
        ->latest('id_jukm', 'DESC')
        ->first();

        $kodeobjek ="JU-";

        if($id_jukm == null){
            $nomorurut = "01";
        }else{
            $nomorurut = substr($id_jukm->id_jukm, 3, 2) + 1;
            $nomorurut = str_pad($nomorurut, 2, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $nama           = $request->nama;

        $data = [
            'id_jukm' => $id,
            'jenis'   => $nama,
            'status'  => '1'
        ];
        $simpan = DB::table('tb_jukm')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }
    }

    //Edit Data
    public function edit(Request $request)
    {
        $id_jukm = $request->id_jukm;
        $id = Crypt::decrypt($id_jukm);

        $jukm = DB::table('tb_jukm')
        ->where('id_jukm', $id)
        ->first();

        return view('admin.jukm.edit', compact('id', 'jukm'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $id_jukm = Crypt::decrypt($id);

         $data = [
            'jenis'      => $nama
        ];

        $update = DB::table('tb_jukm')->where('id_jukm', $id_jukm)->update($data);
          if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
    }

    //Status Data
    public function stat(Request $request)
    {
        $id_jukm = $request->id_jukm;
        $id = Crypt::decrypt($id_jukm);

        $jukm = DB::table('tb_jukm')
        ->where('id_jukm', $id)
        ->first();

        return view('admin.jukm.status', compact('id', 'jukm'));
    }


    public function status(Request $request)
    {
        $id = $request->id;
        $id_jukm   = Crypt::decrypt($id);

        $jukm = DB::table('tb_jukm')
        ->where('id_jukm', $id_jukm)
        ->first();

        $status = $jukm->status;

        $aktif = [
            'status' => '1',
        ];

        $nonaktif = [
            'status' => '0',
        ];

        if($status == '0'){
            $update = DB::table('tb_jukm')->where('id_jukm', $id_jukm)->update($aktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diaktifkan.']);
            }

        }else{
            $update = DB::table('tb_jukm')->where('id_jukm', $id_jukm)->update($nonaktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dinonaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dinonaktifkan.']);
            }
        }

    }

    public function hapus(Request $request)
    {
        $id_jukm = $request->id_jukm;
        $id = Crypt::decrypt($id_jukm);

        $jukm = DB::table('tb_jukm')
        ->where('id_jukm', $id)
        ->first();

        $delete = $request->id;

        return view('admin.jukm.hapus', compact('id', 'jukm'));
    }


    public function delete(Request $request)
    {
        $id           = $request->id;
        $id_jukm = Crypt::decrypt($id);
        $delete = DB::table('tb_jukm')->where('id_jukm', $id_jukm)->delete();
          if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }



}
