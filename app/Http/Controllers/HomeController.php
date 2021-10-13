<?php

namespace App\Http\Controllers;
use App\Models\Bonus;
use App\Models\Subject;
use Carbon\Carbon;
use App\Models\Balance;
use App\Models\User;
use App\Models\AcountIn;
use App\Models\AcountOut;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        completeInvestment();

$subjects = Subject::where('tablenumber','=', Auth::user()->phone )
                      ->Where('type','=','Investment')
                      ->orderBy('id','DESC')
                      ->paginate(2000);


return view('home',compact('subjects'))
->with('i', (request()->input('page', 1) - 1) * 40);
    }


}
