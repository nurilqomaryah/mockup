<?php

use Illuminate\Support\Facades\Http;

if(!function_exists('count_data_database'))
{
    function count_data_database($tablename)
    {
        $query = \Illuminate\Support\Facades\DB::select("SELECT COUNT(ID) as TOTAL_DATA FROM ".$tablename);
        return $query[0]->TOTAL_DATA;
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
