<?php

namespace App\Http\Controllers\AsyncRequest;

use App\Http\Controllers\Controller;
use App\Models\RefIKK;
use Illuminate\Http\Request;

class RefIkkAsyncRequest extends Controller
{
    protected $refIkk;

    public function __construct()
    {
        $this->refIkk = new RefIKK();
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function onRequestRefIkk(Request $request)
    {
        $idIkk = $request->post('idIkk');
        $dataIkk = $this->refIkk->find($idIkk);
        return $dataIkk->target;
    }
}
