<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function projectStats(Request $request)
    {
        //pega os projetos do usuario autenticado
        //agrupo por status
        // e conta quantos projetos existem para cada status
        $stats= $request->user()->projects()
            ->groupBy('status')
            ->select('status', DB::raw('count(*) as count'))
            ->pluck('count', 'status');

            //retorna os dados como um JSON
            return response()->json($stats);
    }
}
