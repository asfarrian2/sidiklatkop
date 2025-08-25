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

class SeksiController extends Controller
{
    public function view(){

        $seksi = DB::table('tb_seksi')
        ->get();

        return view('admin.seksi.view', compact('seksi'));
    }

    //Simpan Data
    public function store(Request $request)
    {

        $id_seksi=DB::table('tb_seksi')
        ->latest('id_seksi', 'DESC')
        ->first();

        $kodeobjek ="SE-";

        if($id_seksi == null){
            $nomorurut = "01";
        }else{
            $nomorurut = substr($id_seksi->id_seksi, 3, 2) + 1;
            $nomorurut = str_pad($nomorurut, 2, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $nama_seksi = $request->nama;

        $data = [
            'id_seksi'        => $id,
            'nama_seksi'      => $nama_seksi,
            'status_seksi'    => '1',
            'tipe_seksi'      => '1'
        ];
        $simpan = DB::table('tb_seksi')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }
    }

    //Status Data
    public function status($id_seksi)
    {
        $id_seksi   = Crypt::decrypt($id_seksi);

        $seksi = DB::table('tb_seksi')
        ->where('id_seksi', $id_seksi)
        ->first();

        $status_seksi = $seksi->status_seksi;

        $aktif = [
            'status_seksi' => '1',
        ];

        $nonaktif = [
            'status_seksi' => '0',
        ];

        if($status_seksi == '0'){
            $update = DB::table('tb_seksi')->where('id_seksi', $id_seksi)->update($aktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diaktifkan.']);
            }

        }else{
            $update = DB::table('tb_seksi')->where('id_seksi', $id_seksi)->update($nonaktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dinonaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dinonaktifkan.']);
            }
        }

    }

    public function hapus(Request $request)
    {
        $id_seksi = $request->id_seksi;
        $id = Crypt::decrypt($id_seksi);

        $seksi = DB::table('tb_seksi')
        ->where('id_seksi', $id)
        ->first();

        $delete = $request->id;

        return view('admin.seksi.hapus', compact('id', 'seksi'));

    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $id_seksi = Crypt::decrypt($id);
        $delete = DB::table('tb_seksi')->where('id_seksi', $id_seksi)->delete();
          if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }


}
