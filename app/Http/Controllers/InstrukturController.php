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

class InstrukturController extends Controller
{
    public function view(){

        $instruktur = DB::table('tb_instruktur')
        ->get();

        return view('admin.instruktur.view', compact('instruktur'));
    }

    public function profile($id_instruktur){

        $id = Crypt::decrypt($id_instruktur);

        $instruktur = DB::table('tb_instruktur')
        ->where('id_instruktur', $id)
        ->first();

        return view('admin.instruktur.profile', compact('instruktur'));
    }

    //Simpan Data
    public function store(Request $request)
    {

        $id_instruktur =DB::table('tb_instruktur')
        ->latest('id_instruktur', 'DESC')
        ->first();

        $kodeobjek ="INS-";

        if($id_instruktur == null){
            $nomorurut = "001";
        }else{
            $nomorurut = substr($id_instruktur->id_instruktur, 4, 3) + 1;
            $nomorurut = str_pad($nomorurut, 3, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $nama           = $request->nama;
        $nik            = $request->nik;
        $tmp_lahir      = $request->tmp;
        $tgl_lahir      = $request->tgl;
        $alamat_rmh     = $request->alamat;
        $agama          = $request->agama;
        $jk             = $request->jk;
        $pendidikan     = $request->pendidikan;
        $no_hp          = $request->telp;
        $email          = $request->email;
        $instansi       = $request->instansi;
        $foto           = $request->foto;


        $data = [
            'id_instruktur'       => $id,
            'nama'          => $nama,
            'nik'           => $nik,
            'tmp_lahir'    => $tmp_lahir,
            'tgl_lahir'     => $tgl_lahir,
            'alamat_rmh'    => $alamat_rmh,
            'agama'         => $agama,
            'jk'            => $jk,
            'pendidikan'    => $pendidikan,
            'no_hp'         => $no_hp,
            'email'         => $email,
            'instansi'      => $instansi,
            'foto'          => $foto,
            'status'   => '1'
        ];
        $simpan = DB::table('tb_instruktur')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }
    }

    //Edit Data
    public function edit(Request $request)
    {
        $id_instruktur = $request->id_instruktur;
        $id = Crypt::decrypt($id_instruktur);

        $instruktur = DB::table('tb_instruktur')
        ->where('id_instruktur', $id)
        ->first();

        return view('admin.instruktur.edit', compact('id', 'instruktur'));
    }

         public function update(Request $request)
    {
        $id             = $request->id;
        $nama           = $request->nama;
        $nik            = $request->nik;
        $tmp_lahir      = $request->tmp;
        $tgl_lahir      = $request->tgl;
        $alamat_rmh     = $request->alamat;
        $agama          = $request->agama;
        $jk             = $request->jk;
        $pendidikan     = $request->pendidikan;
        $no_hp          = $request->telp;
        $email          = $request->email;
        $instansi       = $request->instansi;
        $foto           = $request->foto;

        $id_instruktur = Crypt::decrypt($id);

        $data = [
            'nama'          => $nama,
            'nik'           => $nik,
            'tmp_lahir'    => $tmp_lahir,
            'tgl_lahir'     => $tgl_lahir,
            'alamat_rmh'    => $alamat_rmh,
            'agama'         => $agama,
            'jk'            => $jk,
            'pendidikan'    => $pendidikan,
            'no_hp'         => $no_hp,
            'email'         => $email,
            'instansi'      => $instansi,
            'foto'          => $foto,
        ];

        $update = DB::table('tb_instruktur')->where('id_instruktur', $id_instruktur)->update($data);
          if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
    }



    //Status Data
    public function stat(Request $request)
    {
        $id_instruktur = $request->id_instruktur;
        $id      = Crypt::decrypt($id_instruktur);

        $instruktur = DB::table('tb_instruktur')
        ->where('id_instruktur', $id)
        ->first();

        return view('admin.instruktur.status', compact('id', 'instruktur'));
    }


    public function status(Request $request)
    {
        $id = $request->id;
        $id_instruktur   = Crypt::decrypt($id);

        $instruktur = DB::table('tb_instruktur')
        ->where('id_instruktur', $id_instruktur)
        ->first();

        $status = $instruktur->status;

        $aktif = [
            'status' => '1',
        ];

        $nonaktif = [
            'status' => '0',
        ];

        if($status == '0'){
            $update = DB::table('tb_instruktur')->where('id_instruktur', $id_instruktur)->update($aktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diaktifkan.']);
            }

        }else{
            $update = DB::table('tb_instruktur')->where('id_instruktur', $id_instruktur)->update($nonaktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dinonaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dinonaktifkan.']);
            }
        }

    }


    public function hapus(Request $request)
    {
        $id_instruktur = $request->id_instruktur;
        $id = Crypt::decrypt($id_instruktur);

        $instruktur = DB::table('tb_instruktur')
        ->where('id_instruktur', $id)
        ->first();

        $delete = $request->id;

        return view('admin.instruktur.hapus', compact('id', 'instruktur'));
    }


     public function delete(Request $request)
    {
        $id      = $request->id;
        $id_instruktur = Crypt::decrypt($id);
        $delete  = DB::table('tb_instruktur')->where('id_instruktur', $id_instruktur)->delete();
          if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }








}
