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


class TahunanggaranController extends Controller
{
    public function view(){

        $tabeldata = DB::table('tb_tahunanggaran')
        ->get();

        return view('admin.tahunanggaran.view', compact('tabeldata'));
    }

    //Simpan Data
    public function store(Request $request)
    {

        $id_tahunanggaran=DB::table('tb_tahunanggaran')
        ->latest('id_tahunanggaran', 'DESC')
        ->first();

        $kodeobjek ="TA-";

        if($id_tahunanggaran == null){
            $nomorurut = "001";
        }else{
            $nomorurut = substr($id_tahunanggaran->id_tahunanggaran, 3, 3) + 1;
            $nomorurut = str_pad($nomorurut, 3, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $nama = $request->nama;

        $data = [
            'id_tahunanggaran'   => $id,
            'tahun'              => $nama,
            'status'             => '1'
        ];
        $simpan = DB::table('tb_tahunanggaran')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }
    }

    //Edit Data
    public function edit(Request $request)
    {
        $id_tahunanggaran = $request->id_tahunanggaran;
        $id = Crypt::decrypt($id_tahunanggaran);

        $tahunanggaran = DB::table('tb_tahunanggaran')
        ->where('id_tahunanggaran', $id)
        ->first();

        return view('admin.tahunanggaran.edit', compact('id', 'tahunanggaran'));
    }


    public function update(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $id_tahunanggaran = Crypt::decrypt($id);

         $data = [
            'tahun'      => $nama
        ];

        $update = DB::table('tb_tahunanggaran')->where('id_tahunanggaran', $id_tahunanggaran)->update($data);
          if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
    }

    //Status Data
    public function stat(Request $request)
    {
        $id_tahunanggaran = $request->id_tahunanggaran;
        $id = Crypt::decrypt($id_tahunanggaran);

        $tahunanggaran = DB::table('tb_tahunanggaran')
        ->where('id_tahunanggaran', $id)
        ->first();

        return view('admin.tahunanggaran.status', compact('id', 'tahunanggaran'));
    }


    public function status(Request $request)
    {
        $id = $request->id;
        $id_tahunanggaran   = Crypt::decrypt($id);

        $tahunanggaran = DB::table('tb_tahunanggaran')
        ->where('id_tahunanggaran', $id_tahunanggaran)
        ->first();

        $status = $tahunanggaran->status;

        $aktif = [
            'status' => '1',
        ];

        $nonaktif = [
            'status' => '0',
        ];

        if($status == '0'){
            $update = DB::table('tb_tahunanggaran')->where('id_tahunanggaran', $id_tahunanggaran)->update($aktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diaktifkan.']);
            }

        }else{
            $update = DB::table('tb_tahunanggaran')->where('id_tahunanggaran', $id_tahunanggaran)->update($nonaktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dinonaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dinonaktifkan.']);
            }
        }

    }

    public function hapus(Request $request)
    {
        $id_tahunanggaran = $request->id_tahunanggaran;
        $id = Crypt::decrypt($id_tahunanggaran);

        $tahunanggaran = DB::table('tb_tahunanggaran')
        ->where('id_tahunanggaran', $id)
        ->first();

        $delete = $request->id;

        return view('admin.tahunanggaran.hapus', compact('id', 'tahunanggaran'));
    }


    public function delete(Request $request)
    {
        $id = $request->id;
        $id_tahunanggaran = Crypt::decrypt($id);
        $delete = DB::table('tb_tahunanggaran')->where('id_tahunanggaran', $id_tahunanggaran)->delete();
          if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }



}
