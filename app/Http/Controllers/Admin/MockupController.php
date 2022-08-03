<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AllSchema;
use App\Models\BagiPagu;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;

class MockupController extends Controller
{
    protected $allSchema;

    public function __construct()
    {
        $this->allSchema = new AllSchema();
    }

    public function viewDashboard(){
        $schemaTable = $this->allSchema->getAllTables();
        $result = $this->__combineDataBismaAndDataLocal($schemaTable);
        return View::make('dashboard/dashboard', ['result' => $result]);
    }

    public function bagipagu()
    {
        // Ambil data dari BISMA
        $result = Http::get('https://apip.bpkp.go.id/bewise/mockup/bagipagu')->collect();

        // Menghitung jumlah data dari BISMA
        $count = count($result);

        // Update tabel d_bagipagu dari data BISMA
        foreach ($result as $insert) {
            $res = BagiPagu::firstOrNew(['id' => $insert['id']]);
            $res->thang = $insert['thang'];
            $res->kdsatker = $insert['kdsatker'];
            $res->kddept = $insert['kddept'];
            $res->kdunit = $insert['kdunit'];
            $res->kdprogram = $insert['kdprogram'];
            $res->kdgiat = $insert['kdgiat'];
            $res->kdoutput = $insert['kdoutput'];
            $res->kdsoutput = $insert['kdsoutput'];
            $res->kdkmpnen = $insert['kdkmpnen'];
            $res->kdindex = $insert['kdindex'];
            $res->user_id = $insert['user_id'];
            $res->unit_id = $insert['unit_id'];
            $res->role_id = $insert['role_id'];
            $res->ppk_id = $insert['ppk_id'];
            $res->save();
        }

        return redirect()
            ->route('dashboardadmin');
    }

    private function __combineDataBismaAndDataLocal(array $queryAllSchema)
    {
        $result = array();
        foreach ($queryAllSchema as $item)
        {
            $data = (object)array(
                'TABLE_NAME' => $item->table_name,
                'DATA_BISMA' => count_data_bisma(substr($item->table_name,2)),
                'DATA_LOCAL' => count_data_database($item->table_name)
            );

            array_push($result, $data);
        }
        return $result;
    }

}
