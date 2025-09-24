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

class SkpdController extends Controller
{
    public function view(){

        $skpd = DB::table('tb_skpd')
        ->leftJoin('tb_kota', 'tb_skpd.id_kota', '=', 'tb_kota.id_kota')
        ->select('tb_skpd.*', 'tb_kota.nama_kota')
        ->get();

        $kota=DB::table('tb_kota')
        ->where('status_kota', '1')
        ->get();

        return view('admin.skpd.view', compact('skpd', 'kota'));
    }

    //Simpan Data
    public function store(Request $request)
    {

        $id_skpd=DB::table('tb_skpd')
        ->latest('id_skpd', 'DESC')
        ->first();

        $kodeobjek ="SKPD-";

        if($id_skpd == null){
            $nomorurut = "01";
        }else{
            $nomorurut = substr($id_skpd->id_skpd, 5, 2) + 1;
            $nomorurut = str_pad($nomorurut, 2, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $nama_skpd      = $request->nama;
        $alamat_skpd    = $request->alamat;
        $kabupaten_skpd = $request->kabupaten;
        $telp_skpd      = $request->telepon;
        $email_skpd     = $request->email;


        $data = [
            'id_skpd'        => $id,
            'nama_skpd'      => $nama_skpd,
            'alamat_skpd'    => $alamat_skpd,
            'id_kota'        => $kabupaten_skpd,
            'telp_skpd'      => $telp_skpd,
            'email_skpd'     => $email_skpd,
            'status_skpd'    => '1'
        ];
        $simpan = DB::table('tb_skpd')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }
    }


    //Edit Data
    public function edit(Request $request)
    {
        $id_skpd = $request->id_skpd;
        $id = Crypt::decrypt($id_skpd);

        $skpd = DB::table('tb_skpd')
        ->leftJoin('tb_kota', 'tb_skpd.id_kota', '=', 'tb_kota.id_kota')
        ->select('tb_skpd.*', 'tb_kota.nama_kota')
        ->where('id_skpd', $id)
        ->first();

        $kota=DB::table('tb_kota')
        ->where('status_kota', '1')
        ->get();

        return view('admin.skpd.edit', compact('id', 'skpd', 'kota'));
    }

     public function update(Request $request)
    {
        $id             = $request->id;
        $nama_skpd      = $request->nama;
        $alamat_skpd    = $request->alamat;
        $kabupaten_skpd = $request->kabupaten;
        $telp_skpd      = $request->telepon;
        $email_skpd     = $request->email;

        $id_skpd = Crypt::decrypt($id);

        $data = [
            'nama_skpd'      => $nama_skpd,
            'alamat_skpd'    => $alamat_skpd,
            'id_skpd' => $kabupaten_skpd,
            'telp_skpd'      => $telp_skpd,
            'email_skpd'     => $email_skpd,
        ];

        $update = DB::table('tb_skpd')->where('id_skpd', $id_skpd)->update($data);
          if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
    }


    //Status Data
    public function stat(Request $request)
    {
        $id_skpd = $request->id_skpd;
        $id      = Crypt::decrypt($id_skpd);

        $skpd = DB::table('tb_skpd')
        ->where('id_skpd', $id)
        ->first();

        return view('admin.skpd.status', compact('id', 'skpd'));
    }


    public function status(Request $request)
    {
        $id = $request->id;
        $id_skpd   = Crypt::decrypt($id);

        $skpd = DB::table('tb_skpd')
        ->where('id_skpd', $id_skpd)
        ->first();

        $status_skpd = $skpd->status_skpd;

        $aktif = [
            'status_skpd' => '1',
        ];

        $nonaktif = [
            'status_skpd' => '0',
        ];

        if($status_skpd == '0'){
            $update = DB::table('tb_skpd')->where('id_skpd', $id_skpd)->update($aktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diaktifkan.']);
            }

        }else{
            $update = DB::table('tb_skpd')->where('id_skpd', $id_skpd)->update($nonaktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dinonaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dinonaktifkan.']);
            }
        }

    }


    public function hapus(Request $request)
    {
        $id_skpd = $request->id_skpd;
        $id = Crypt::decrypt($id_skpd);

        $skpd = DB::table('tb_skpd')
        ->where('id_skpd', $id)
        ->first();

        $delete = $request->id;

        return view('admin.skpd.hapus', compact('id', 'skpd'));
    }


    public function delete(Request $request)
    {
        $id      = $request->id;
        $id_skpd = Crypt::decrypt($id);
        $delete  = DB::table('tb_skpd')->where('id_skpd', $id_skpd)->delete();
          if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

}
