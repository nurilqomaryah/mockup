<?php

use Illuminate\Support\Facades\Http;

if(!function_exists('count_data_database'))
{
    function count_data_database($tablename)
    {
        return \Illuminate\Support\Facades\DB::table($tablename)->count();
    }
}

if(!function_exists('count_data_bisma'))
{
    function count_data_bisma($tablename)
    {
        $result = Http::get('https://apip.bpkp.go.id/bewise/mockup/'.$tablename)->collect();
        return count($result);
    }
}

if(!function_exists('bulan'))
{
    function bulan($idBulan)
    {
        switch ($idBulan)
        {
            case "1":
                echo 'Januari';
                break;
            case "2":
                echo 'Februari';
                break;
            case "3":
                echo 'Maret';
                break;
            case "4":
                echo 'April';
                break;
            case "5":
                echo 'Mei';
                break;
            case "6":
                echo 'Juni';
                break;
            case "7":
                echo 'Juli';
                break;
            case "8":
                echo 'Agustus';
                break;
            case "9":
                echo 'September';
                break;
            case "10":
                echo 'Oktober';
                break;
            case "11":
                echo 'November';
                break;
            case "12":
                echo 'Desember';
                break;
            default:
                echo "Tidak ada data bulan";
        }
    }
}
