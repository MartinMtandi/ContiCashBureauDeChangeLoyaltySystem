<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ConvertController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    

    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'points' => 'required'
        ]);
        
        $user_id = Auth::user()->id;
        //get vas centre id
        $vas_centre_id = Auth::user()->vas_centre_id;

        $currency = DB::select('SELECT * FROM vas_client_session WHERE vas_client_id = ?', [$user_id ]);
        $currencyId = (int) $currency[0]->currency_id;

        $points_total = DB::table('vas_client_centre')->where([
            ['vas_client_id', '=', $user_id], 
            ['vas_centre_id', '=', $vas_centre_id],
            ['currency_id', '=', $currencyId],
            ['status', '=', 1]
        ])->get();

        $point_value = (int)$points_total[0]->point;
        $credit_value = (float)$points_total[0]->credits;
            
        // //subtract points entered with points from DB
        $new_points_balance = $point_value - $request->input('points');

        //add topup to wallet
        $new_wallet_balance = $credit_value + $request->input('amount');
        $new_wallet_balance = number_format((float)$new_wallet_balance, 2, '.', ''); 
        $reference = rand(0, 1000000);
        $ref = 'Redeem'.$reference;
        // //update points record in the db
        $query = DB::table('vas_client_centre')->where([
            ['vas_client_id', '=', $user_id], 
            ['vas_centre_id', '=', $vas_centre_id],
            ['currency_id', '=', $currencyId],
            ['status', '=', 1]
        ])->update(['point' => $new_points_balance]);

        // //update credits record in the db
        DB::table('vas_client_centre')->where([
            ['vas_client_id', '=', $user_id], 
            ['vas_centre_id', '=', $vas_centre_id],
            ['currency_id', '=', $currencyId],
            ['status', '=', 1]
        ])->update(['credits' => $new_wallet_balance ]);

        DB::table('vas_transaction_analysis')->insert([
            'vas_client_id' => Auth::user()->id,
            'vas_centre_id' => $vas_centre_id,
            'amount' => $request->amount,
            'points' => $request->points,
            'reference' => $ref,
            'currency_id' => $currencyId,
            'status' => 1,
            'action' => 'redeem']
        );

        \Session::flash('success', 'Your points have been successfully credited to your account.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
