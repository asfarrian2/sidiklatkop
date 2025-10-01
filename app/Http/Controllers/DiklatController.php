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

        //Simpan Data
    public function store(Request $request)
    {

        $id_diklat =DB::table('tb_diklat')
        ->latest('id_diklat', 'DESC')
        ->first();

        $kodeobjek ="DIK-";

        if($id_diklat == null){
            $nomorurut = "01";
        }else{
            $nomorurut = substr($id_diklat->id_diklat, 7, 2) + 1;
            $nomorurut = str_pad($nomorurut, 7, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $nama           = $request->nama;
        $tgl_mulai      = $request->tgl_mulai;
        $tgl_akhir      = $request->tgl_akhir;
        $lokasi         = $request->lokasi;
        $id_seksi       = $request->seksi;


        $data = [
            'id_diklat' => $id,
            'judul'     => $nama,
            'tgl_mulai' => $tgl_mulai,
            'tgl_akhir' => $tgl_akhir,
            'lokasi'    => $lokasi,
            'id_seksi'  => $id_seksi,
            'status'    => '0'
        ];
        $simpan = DB::table('tb_diklat')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }
    }

    //Edit Data
    public function edit(Request $request)
    {
        $id_diklat = $request->id_diklat;
        $id = Crypt::decrypt($id_diklat);

        $diklat = DB::table('tb_diklat')
        ->where('id_diklat', $id)
        ->first();

        return view('admin.diklat.edit', compact('id', 'diklat'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $id_diklat = Crypt::decrypt($id);

         $data = [
            'jenis'      => $nama
        ];

        $update = DB::table('tb_diklat')->where('id_diklat', $id_diklat)->update($data);
          if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
    }

    //Status Data
    public function stat(Request $request)
    {
        $id_diklat = $request->id_diklat;
        $id = Crypt::decrypt($id_diklat);

        $diklat = DB::table('tb_diklat')
        ->where('id_diklat', $id)
        ->first();

        return view('admin.diklat.status', compact('id', 'diklat'));
    }


    public function status(Request $request)
    {
        $id = $request->id;
        $id_diklat   = Crypt::decrypt($id);

        $diklat = DB::table('tb_diklat')
        ->where('id_diklat', $id_diklat)
        ->first();

        $status = $diklat->status;

        $aktif = [
            'status' => '1',
        ];

        $nonaktif = [
            'status' => '0',
        ];

        if($status == '0'){
            $update = DB::table('tb_diklat')->where('id_diklat', $id_diklat)->update($aktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diaktifkan.']);
            }

        }else{
            $update = DB::table('tb_diklat')->where('id_diklat', $id_diklat)->update($nonaktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dinonaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dinonaktifkan.']);
            }
        }

    }

    public function hapus(Request $request)
    {
        $id_diklat = $request->id_diklat;
        $id = Crypt::decrypt($id_diklat);

        $diklat = DB::table('tb_diklat')
        ->where('id_diklat', $id)
        ->first();

        $delete = $request->id;

        return view('admin.diklat.hapus', compact('id', 'diklat'));
    }


    public function delete(Request $request)
    {
        $id           = $request->id;
        $id_diklat = Crypt::decrypt($id);
        $delete = DB::table('tb_diklat')->where('id_diklat', $id_diklat)->delete();
          if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }


}
