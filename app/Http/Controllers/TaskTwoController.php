<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskTwoController extends Controller
{
    public function rates()
    {
        return ['action' => 'rates'];
    }

    public function convert()
    {
        return ['action' => 'convert'];
    }
}
