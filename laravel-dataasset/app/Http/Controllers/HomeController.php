<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Kategori;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        $users = User::count();
        $kategoris = Kategori::count();
        $assets = Asset::count();
        $totals = Asset::sum('harga');
        $chartassets = Kategori::all();
        // $idkategori = Asset:select('idkategori');


        // Chart Batang
        $data = [];
        foreach ($chartassets as $items) {
            $assetsjoin = Asset::where('idkategori', $items->id)->count();
            array_push($data, $assetsjoin);
        }

        $data = json_encode($data);

        $kategoricharts = $chartassets->pluck('kategori');

        // Chart Pie
        $data1 = Asset::select('idkategori', DB::raw('SUM(harga) as total'))
                ->groupBy('idkategori')
                ->get();

        $data1 = $data1->pluck('total');

        $chartpie = json_encode($data1);

        $widget = [
            'users' => $users,  
            'kategoris' => $kategoris,
            'assets' => $assets,
            'totals' => $totals
        ];

        return view('home', compact('widget', 'kategoricharts', 'data', 'chartpie'));
    }
}
