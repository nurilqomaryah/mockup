<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Satker;
use App\Models\Sima\SuratTugas;
use App\Models\Sima\SuratTugasTim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;


class LoginController extends Controller
{

    public function __construct()
    {

    }

    public function username()
    {
        return 'username';
    }

    public function index()
    {
        return view('auth.login');
    }

    public function onSubmit(Request $request)
    {
        $now = Carbon::now('Asia/Jakarta');
        $username = $request->input('username'); 
        $password = $request->input('password');

        $loginSima = Http::post('http://api-stara.bpkp.go.id/api/auth/login', [
            'Password' => $password,
            'Username' => $username,
        ]);

        $status = $loginSima['status_code'];

        if($status != 200){
            return redirect()
            ->route('login')
            ->with('error','User tidak ditemukan');
        }

        $nipSima = $loginSima['data']['user_info']['nipbaru'];
        $unit = $loginSima['data']['user_info']['key_sort_unit'];

        if($nipSima) {
            $userMockup = User::where('nipbaru',$nipSima)->first();
            $credentials = $request->only('username', 'password');

            if ($userMockup) {
                $userMockup->token_sima =  $loginSima['data']['token'];  
                $userMockup->save();
            } else {
                $id = new User;
                $id->nipbaru = $nipSima;
                $id->username = $username;
                $id->password = Hash::make($password);
                $id->nama = $loginSima['data']['user_info']['name'];
                $id->role_id = 1;
                $id->key_sort_unit = $unit;
                $id->token_sima = $loginSima['data']['token'];
                $id->created_at = $now;
                $id->save();
            }            

            if (Auth::attempt($credentials)) {
                $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', $unit)->first();

                if($kodeSatker) {
                    $user = Http::withToken(Auth::user()->token_sima)->get('http://api-stara.bpkp.go.id/api/surat-tugas?sumber_data=pkau&kode_satker='.$kodeSatker->kode_satker);

                    $dataSt = $user['data'];

                    foreach ($dataSt as $insert) {
                        $res = SuratTugas::firstOrNew(['id_st' => $insert['id_st']]);
                        $res->sumber_data = $insert['sumber_data'];
                        $res->status_st = $insert['status_st'];
                        $res->status_workflow = $insert['status_workflow'];
                        $res->no_surat_tugas = $insert['no_surat_tugas'];
                        $res->tanggal_surat_tugas = $insert['tanggal_surat_tugas'];
                        $res->nama_penugasan = $insert['nama_penugasan'];
                        $res->tanggal_mulai = $insert['tanggal_mulai'];
                        $res->tanggal_selesai = $insert['tanggal_selesai'];
                        $res->sumber_dana_id = $insert['sumber_dana_id'];
                        $res->pembebanan = $insert['pembebanan'];
                        $res->ro_kode = $insert['ro_kode'];
                        $res->kdsatker = $insert['kdsatker'];
                        $res->kode_pkau_pkpt = $insert['kode_pkau_pkpt'];
                        $res->uraian_pkau_pkpt = $insert['uraian_pkau_pkpt'];
                        $res->save();
                    }

                    Cookie::queue('satker', $kodeSatker->key_sort_unit, 120);
                }                

                return redirect()->intended('dashboard')
                            ->withSuccess('You have Successfully loggedin');
            }
        } else {
            return redirect()
            ->route('login')
            ->with('error','User tidak ditemukan');
        }
    }

}
