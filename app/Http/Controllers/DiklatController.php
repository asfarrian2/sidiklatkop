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

        $kategori = DB::table('tb_kdiklat')
        ->leftJoin('tb_diklat', 'tb_kdiklat.id_diklat', '=', 'tb_diklat.id_diklat')
        ->leftJoin('tb_kategori', 'tb_kdiklat.id_kategori', '=', 'tb_kategori.id_kategori')
        ->select('tb_kdiklat.*', 'tb_kategori.kategori')
        ->get();

        return view('admin.diklat.view', compact('tabeldata', 'seksi', 'kategori'));
    }

    //Simpan Data
    public function store(Request $request)
    {

        $id_diklat =DB::table('tb_diklat')
        ->latest('id_diklat', 'DESC')
        ->first();

        $kodeobjek ="DIK-";

        if($id_diklat == null){
            $nomorurut = "0000001";
        }else{
            $nomorurut = substr($id_diklat->id_diklat, 4, 7) + 1;
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

        $seksi = DB::table('tb_seksi')
        ->where('status_seksi', '1')
        ->get();

        return view('admin.diklat.edit', compact('id', 'diklat', 'seksi'));
    }


    public function update(Request $request)
    {
        $id = $request->id;
        $nama           = $request->nama;
        $tgl_mulai      = $request->tgl_mulai;
        $tgl_akhir      = $request->tgl_akhir;
        $lokasi         = $request->lokasi;
        $id_seksi       = $request->seksi;
        $id_diklat = Crypt::decrypt($id);

         $data = [
            'judul'     => $nama,
            'tgl_mulai' => $tgl_mulai,
            'tgl_akhir' => $tgl_akhir,
            'lokasi'    => $lokasi,
            'id_seksi'  => $id_seksi,
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
        $id        = $request->id;
        $id_diklat = Crypt::decrypt($id);
        $delete = DB::table('tb_diklat')->where('id_diklat', $id_diklat)->delete();
          if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

    //Kategori Data
    public function kategori(Request $request)
    {
        $id_diklat = $request->id_diklat;
        $id = Crypt::decrypt($id_diklat);

        $diklat = DB::table('tb_diklat')
        ->where('id_diklat', $id)
        ->first();

        $kategori = DB::table('tb_kategori')
        ->where('status', '1')
        ->get();

        return view('admin.diklat.kategori.add', compact('id', 'diklat', 'kategori'));
    }

    //Simpan Data
    public function kategoristore(Request $request)
    {

        $id_diklat = $request->id;
        $id_diklat = Crypt::decrypt($id_diklat);

        $id_kdiklat =DB::table('tb_kdiklat')
        ->where('id_diklat', $id_diklat)
        ->latest('id_diklat', 'DESC')
        ->first();

        $kodeobjek =$id_diklat."-";

        if($id_kdiklat == null){
            $nomorurut = "001";
        }else{
            $nomorurut = substr($id_kdiklat->id_kdiklat, 12, 3) + 1;
            $nomorurut = str_pad($nomorurut, 3, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;
        $kategori       = $request->kategori;

        $data = [
            'id_kdiklat'   => $id,
            'id_diklat'    => $id_diklat,
            'id_kategori'  => $kategori
        ];
        $simpan = DB::table('tb_kdiklat')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }
    }

    //Edit Kategori Data
    public function editkategori(Request $request)
    {
        $id_kdiklat = $request->id_kdiklat;
        $id = Crypt::decrypt($id_kdiklat);

        $kdiklat = DB::table('tb_kdiklat')
        ->where('id_kdiklat', $id)
        ->first();

        $kategori = DB::table('tb_kategori')
        ->where('status', '1')
        ->get();

        return view('admin.diklat.kategori.edit', compact('id', 'kdiklat', 'kategori'));
    }


        public function updatekategori(Request $request)
    {
        $id = $request->id;
        $id_kategori       = $request->kategori;
        $id_kdiklat = Crypt::decrypt($id);

         $data = [
            'id_kategori'  => $id_kategori
        ];

        $update = DB::table('tb_kdiklat')->where('id_kdiklat', $id_kdiklat)->update($data);
          if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
    }

    public function hapuskategori(Request $request)
    {
        $id_kdiklat = $request->id_kdiklat;
        $id = Crypt::decrypt($id_kdiklat);

        $kdiklat = DB::table('tb_kdiklat')
        ->leftJoin('tb_kategori', 'tb_kdiklat.id_kategori', '=', 'tb_kategori.id_kategori')
        ->select('tb_kdiklat.*', 'tb_kategori.kategori')
        ->where('id_kdiklat', $id)
        ->first();

        $delete = $request->id;

        return view('admin.diklat.kategori.hapus', compact('id', 'kdiklat'));
    }


    public function deletekategori(Request $request)
    {
        $id        = $request->id;
        $id_kdiklat = Crypt::decrypt($id);
        $delete = DB::table('tb_kdiklat')->where('id_kdiklat', $id_kdiklat)->delete();
          if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }



}
