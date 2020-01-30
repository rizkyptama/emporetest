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

class UserController extends Controller
{

    public function dashboard(){
        if(Session::get('login') && Session::get('type') == "user"){
            $kiriman = [
                "title" => "Pinjam Buku",
                "buku" => DB::table('tbl_buku')
                ->where('stok_buku', '>', '0')
                ->orderby('judul_buku', 'ASC')->get()
            ];
            return view('anggota.dashboard', $kiriman);
        }else{
            return redirect('/')->with('alert','Kamu Harus Login !');
        }
    }

    public function detailPinjam($kd_buku) {
        $data = ModelBuku::where('kd_buku', $kd_buku)->first();
        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode("fail");
        }
    }

    public function pinjam(Request $request){
        $check1 = ModelPinjaman::where('kd_user', Session::get('kd_user'))
                ->where('kd_buku', $request->kd_buku)
                ->where('status', 'menunggu approval')
                ->exists();

        $check2 = ModelPinjaman::where('kd_user', Session::get('kd_user'))
                ->where('kd_buku', $request->kd_buku)
                ->where('status', 'meminjam')
                ->exists();

        if ($check1) {
            echo "exists";
        }
        else if ($check2) {
            echo "meminjam";
        }
        else {
            $last_kd_pinjam = ModelPinjaman::select('kd_pinjam')->orderby('kd_pinjam', 'desc')->first();
            $last_kd_pinjam = (int)substr($last_kd_pinjam, -3);
            $pjm = $last_kd_pinjam + 1;

            $kd_pinjam = "PJM".$pjm;

            $tambah = ModelPinjaman::insert(array(
                'kd_pinjam' => $kd_pinjam,
                'kd_user' => Session::get('kd_user'),
                'kd_buku' => $request->kd_buku,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status' => 'menunggu approval'
            ));

            if ($tambah) {
                echo $kd_pinjam;
            }else{
                echo "fail";
            }
        }
    }

}
