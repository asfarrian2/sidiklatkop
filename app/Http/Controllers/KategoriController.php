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

class KategoriController extends Controller
{
     public function view(){

        $tabeldata = DB::table('tb_kategori')
        ->leftJoin('tb_seksi', 'tb_kategori.id_seksi', '=', 'tb_seksi.id_seksi')
        ->select('tb_kategori.*', 'tb_seksi.nama_seksi')
        ->get();

        $seksi = DB::table('tb_seksi')
        ->where('status_seksi', '1')
        ->get();

        return view('admin.kategori.view', compact('tabeldata', 'seksi'));
    }

    //Simpan Data
    public function store(Request $request)
    {

        $id_kategori =DB::table('tb_kategori')
        ->latest('id_kategori', 'DESC')
        ->first();

        $kodeobjek ="KT-";

        if($id_kategori == null){
            $nomorurut = "0001";
        }else{
            $nomorurut = substr($id_kategori->id_kategori, 3, 4) + 1;
            $nomorurut = str_pad($nomorurut, 4, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $nama           = $request->nama;
        $seksi           = $request->seksi;

        $data = [
            'id_kategori' => $id,
            'kategori'   => $nama,
            'id_seksi'   => $seksi,
            'status'  => '1'
        ];
        $simpan = DB::table('tb_kategori')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }
    }

    //Edit Data
    public function edit(Request $request)
    {
        $id_kategori = $request->id_kategori;
        $id = Crypt::decrypt($id_kategori);

        $kategori = DB::table('tb_kategori')
        ->where('id_kategori', $id)
        ->first();

        $seksi = DB::table('tb_seksi')
        ->where('status_seksi', '1')
        ->get();


        return view('admin.kategori.edit', compact('id', 'kategori', 'seksi'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $seksi = $request->seksi;
        $id_kategori = Crypt::decrypt($id);

         $data = [
            'kategori'   => $nama,
            'id_seksi'      => $seksi
        ];

        $update = DB::table('tb_kategori')->where('id_kategori', $id_kategori)->update($data);
          if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
    }

    //Status Data
    public function stat(Request $request)
    {
        $id_kategori = $request->id_kategori;
        $id = Crypt::decrypt($id_kategori);

        $kategori = DB::table('tb_kategori')
        ->where('id_kategori', $id)
        ->first();

        return view('admin.kategori.status', compact('id', 'kategori'));
    }


    public function status(Request $request)
    {
        $id = $request->id;
        $id_kategori   = Crypt::decrypt($id);

        $kategori = DB::table('tb_kategori')
        ->where('id_kategori', $id_kategori)
        ->first();

        $status = $kategori->status;

        $aktif = [
            'status' => '1',
        ];

        $nonaktif = [
            'status' => '0',
        ];

        if($status == '0'){
            $update = DB::table('tb_kategori')->where('id_kategori', $id_kategori)->update($aktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diaktifkan.']);
            }

        }else{
            $update = DB::table('tb_kategori')->where('id_kategori', $id_kategori)->update($nonaktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dinonaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dinonaktifkan.']);
            }
        }

    }

    public function hapus(Request $request)
    {
        $id_kategori = $request->id_kategori;
        $id = Crypt::decrypt($id_kategori);

        $kategori = DB::table('tb_kategori')
        ->where('id_kategori', $id)
        ->first();

        $delete = $request->id;

        return view('admin.kategori.hapus', compact('id', 'kategori'));
    }


    public function delete(Request $request)
    {
        $id           = $request->id;
        $id_kategori = Crypt::decrypt($id);
        $delete = DB::table('tb_kategori')->where('id_kategori', $id_kategori)->delete();
          if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
}
