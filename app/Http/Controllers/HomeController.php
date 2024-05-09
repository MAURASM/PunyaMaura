<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $userTypeId = Auth::user()->user_type_id;

        if ($userTypeId == 1) {
            return view('admin.index', ['title' => 'Dashboard']);
        } elseif ($userTypeId == 2) {
            return redirect('/supplier');
        } elseif ($userTypeId == 3) {
            return redirect('/reseller');
        }
    }
}
