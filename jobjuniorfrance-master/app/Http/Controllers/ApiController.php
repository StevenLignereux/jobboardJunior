<?php

namespace App\Http\Controllers;

use App\Models\Junior;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $juniors = Junior::whereNotNull('parrain')
            ->select(DB::raw('count(parrain) as count, parrain'))
            ->groupBy('parrain')
            ->orderBy('count', 'desc')
            ->get();
        return new JsonResponse($juniors, 200);
    }
}
