<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ModelBuku;
use App\ModelLogin;
use App\ModelPinjaman;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function dashboard(){
        if(Session::get('login') && Session::get('type') == "admin"){
            $kiriman = [
                "title" => "Master Buku",
                "buku" => DB::table('tbl_buku')
                ->orderby('judul_buku', 'ASC')->get()
            ];
            return view('admin.dashboard', $kiriman);
        }else{
            return redirect('/')->with('alert','Kamu Harus Login !');
        }
    }

    public function anggota(){
        if(Session::get('login') && Session::get('type') == "admin"){
            $kiriman = [
                "title" => "Data Anggota",
                "anggota" => DB::table('tbl_user')
                ->where('kd_user', '!=', 'ADM1')
                ->orderby('nama', 'ASC')->get()
            ];
            return view('admin.anggota', $kiriman);
        }else{
            return redirect('/')->with('alert','Kamu Harus Login !');
        }
    }

    public function pinjaman(){
        if(Session::get('login') && Session::get('type') == "admin"){
            $kiriman = [
                "title" => "Peminjaman Buku",
                "pinjam" => DB::table('tbl_pinjaman as p')
                ->join('tbl_user as u', 'p.kd_user', '=', 'u.kd_user')
                ->join('tbl_buku as b', 'p.kd_buku', '=', 'b.kd_buku')
                ->select('p.kd_pinjam', 'b.judul_buku', 'u.nama', 'p.tanggal_pinjam')
                ->orderby('p.tanggal_pinjam', 'DESC')->get()
            ];
            return view('admin.pinjaman', $kiriman);
        }else{
            return redirect('/')->with('alert','Kamu Harus Login !');
        }
    }

    //Function Buku
    public function tambahBuku(Request $request){
        $last_kd_buku = ModelBuku::select('kd_buku')->orderby('kd_buku', 'desc')->first();
        $last_kd_buku = (int)substr($last_kd_buku, -3);
        $buk = $last_kd_buku + 1;

        $kd_buku = "BUK".$buk;

        $tambah = ModelBuku::insert(array(
            'kd_buku' => $kd_buku,
            'judul_buku' => $request->judul_buku,
            'penerbit' => $request->penerbit,
            'pengarang' => $request->pengarang,
            'tahun_terbit' => $request->tahun_terbit,
            'stok_buku' => $request->stok_buku,
            'no_rak' => $request->no_rak,
            'kategori' => $request->kategori
        ));

        if ($tambah) {
            echo "success";
        }else{
            echo "fail";
        }
    }

    public function editBuku($kd_buku) {
        $data = ModelBuku::where('kd_buku', $kd_buku)->first();
        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode("fail");
        }
    }

    public function updateBuku(Request $request, $kd_buku) {
        $kd_buku = $kd_buku;

        $update = ModelBuku::where('kd_buku', $kd_buku)->update(array(
            'judul_buku' => $request->judul_buku,
            'penerbit' => $request->penerbit,
            'pengarang' => $request->pengarang,
            'tahun_terbit' => $request->tahun_terbit,
            'stok_buku' => $request->stok_buku,
            'no_rak' => $request->no_rak,
            'kategori' => $request->kategori
        ));

        if ($update) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    public function hapusBuku($kd_buku) {
        $hapus = ModelBuku::where('kd_buku', $kd_buku)->delete();
        if ($hapus) {
            echo "success";
        } else {
            echo "fail";
        }
    }


    //Function Anggota
    public function tambahUser(Request $request){
        $last_kd_user = ModelLogin::select('kd_user')->where('kd_user', 'like', '%USR%')->orderby('kd_user', 'desc')->first();
        $last_kd_user = (int)substr($last_kd_user, -3);
        $usr = $last_kd_user + 1;

        $kd_user = "USR".$usr;

        $tambah = ModelLogin::insert(array(
            'kd_user' => $kd_user,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'type' => 'user'
        ));

        if ($tambah) {
            echo "success";
        }else{
            echo "fail";
        }
    }

    public function editUser($kd_user) {
        $data = ModelLogin::where('kd_user', $kd_user)->first();
        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode("fail");
        }
    }

    public function updateUser(Request $request, $kd_user) {
        $kd_user = $kd_user;

        $update = ModelLogin::where('kd_user', $kd_user)->update(array(
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'username' => $request->username
        ));

        if ($update) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    public function hapusUser($kd_user) {
        $hapus = ModelLogin::where('kd_user', $kd_user)->delete();
        if ($hapus) {
            echo "success";
        } else {
            echo "fail";
        }
    }


    //Function Pengajuan Buku
    public function detailPengajuan($kd_pinjam) {
        $data = DB::table('tbl_pinjaman as p')
                ->join('tbl_user as u', 'p.kd_user', '=', 'u.kd_user')
                ->join('tbl_buku as b', 'p.kd_buku', '=', 'b.kd_buku')
                ->select('p.kd_pinjam', 'p.kd_buku', 'u.nama', 'b.judul_buku', 'p.tanggal_pinjam', 'p.tanggal_kembali', 'p.status')
                ->where('p.kd_pinjam', $kd_pinjam)
                ->first();

        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode("fail");
        }
    }

    public function approved(Request $request, $kd_pinjam) {
        $update = ModelPinjaman::where('kd_pinjam', $kd_pinjam)->update(array(
            'status' => 'meminjam'
        ));

        if ($update) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    public function dikembalikan(Request $request, $kd_pinjam) {
        $update = ModelPinjaman::where('kd_pinjam', $kd_pinjam)->update(array(
            'status' => 'sudah dikembalikan'
        ));

        if ($update) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    public function rejected($kd_pinjam) {
        $hapus = ModelPinjaman::where('kd_pinjam', $kd_pinjam)->delete();
        if ($hapus) {
            echo "success";
        } else {
            echo "fail";
        }
    }
}
