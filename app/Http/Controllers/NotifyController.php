<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Inertia\Inertia;
use App\Models\Pair;
use Illuminate\Http\Request;

use App\Traits\ExchangeApiClient;
use Illuminate\Support\Facades\Storage;

class NotifyController extends Controller
{
    use ExchangeApiClient;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notify()
    {
        /**
         * Swap commented line in production 
         */
        // $exchange = $this->get('GBP', 'USD');
        // $exchange = json_decode(Storage::disk('local')->get('exchnge_06_03_2022.json'));
        // dd($exchange);

        return Inertia::render('Notify/Index', [
            'pairs' => Pair::all(),
            'notifications' => Notification::latest()->paginate(10)
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    
}
