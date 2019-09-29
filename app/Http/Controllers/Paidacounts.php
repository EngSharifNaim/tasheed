<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Paidacount;
class Paidacounts extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paidacounts = Paidacount::orderBy('created_at', 'DESC')->get();

        return view(ad.'.paidacounts.index',compact('paidacounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activate($todo,$id){

        $paidacount=Paidacount::find($id);
        if ($todo=='activate') {
            $activate = 'لقد تم تفعيل الاشتراك ربنجاح';
            $paidacount->active = 'yes';
            $paidacount->begin_at = now();
            $paidacount->end_at = (Carbon::now())->addMonth($paidacount->paidlong);
            }
        else
        {
            $activate = 'لقد تم ايقاف تفعيل الاشتراك ربنجاح';
            $paidacount->active = 'no';
            $paidacount->begin_at = $paidacount->created_at;

        }
        $paidacount->save();
        $paidacounts = Paidacount::orderBy('created_at', 'DESC')->get();
        return view(ad.'.paidacounts.index',compact('activate','paidacounts'));
        return $todo . '/' . $id;
    }

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
        //
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
