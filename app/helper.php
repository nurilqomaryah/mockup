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
