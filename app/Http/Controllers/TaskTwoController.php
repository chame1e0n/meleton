<?php

namespace App\Http\Controllers;

use App\Services\BTC;
use Illuminate\Http\Request;

class TaskTwoController extends Controller
{
    private $btc;

    public function __construct(BTC $btc)
    {
        $this->btc = $btc;
    }

    public function rates()
    {
        return $this->btc->rates();
    }

    public function convert(Request $request)
    {
        try {
            return $this->btc->convert($request->post());
        } catch (\Exception $e) {
            return response(['status' => 'error', 'code' => 403, 'message' => $e->getMessage()], 403);
        }
    }
}
