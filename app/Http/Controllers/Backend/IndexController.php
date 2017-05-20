<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Permission;
use App\Models\Admins;
use App\Models\Role;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:backend');
    }

    public function index()
    {
        $admin = Auth::guard('backend')->user();
        //return $admin->name;
        return view('backend.index.index');
    }
}