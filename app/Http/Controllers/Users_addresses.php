<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Citie;
use App\Countrie;
use App\Region;
use App\Users_addresse ;

class Users_addresses extends Controller
{


    public function index()
    {
        $user_addresses = Users_addresse::all();
        
        return view(ad.'.users_addresses.index',compact('user_addresses'));
    }
    /**
     * show function just read onlu
     */
    public function show($id)
    {
        $users_addresse = Users_addresse::find($id) ;
        return view(ad.'.users_addresses.show' , compact('users_addresse')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Users_addresse $user_addresse)
    {
        $countries = Countrie::all();
        return view(ad.'.users_addresses.add',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Users_addresse $users_addresse)
    {

        $this->validate($request, [
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3',
            'countrie_id' => 'required|integer',
            'citie_id' => 'required|integer',
            'region' => 'integer',
        ]);

        $region_id = (isset($request->region_id)) ? $request->region_id : 0 ;
      //  $users_addresse->user_id = $request->user_id ;
        $users_addresse->addresse_ar = $request->name_ar ;
        $users_addresse->addresse_en = $request->name_en ;
        $users_addresse->countrie_id = $request->countrie_id ;
        $users_addresse->citie_id = $request->citie_id ;
        $users_addresse->region_id = $region_id ;
        $users_addresse->active = 'yes' ;

        $users_addresse->save() ;

        $request->session()->flash('alert-success', __('admin.alerts_success_adding'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Countrie::all();
        $region = Region::find($id);
        $users_addresse = Users_addresse::find($id) ;
        return view(ad.'.users_addresses.edite',['region'=>$region,'countries'=>$countries , 'users_addresse' => $users_addresse]);
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

        $this->validate($request, [
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3',
            'countrie_id' => 'required|integer',
            'citie_id' => 'required|integer',
            'region' => 'integer',
        ]);

        $users_addresse = Users_addresse::find($id) ;

        $region_id = (isset($request->region_id)) ? $request->region_id : 0 ;
       // $users_addresse->user_id = $request->user_id ;
        $users_addresse->addresse_ar = $request->name_ar ;
        $users_addresse->addresse_en = $request->name_en ;
        $users_addresse->countrie_id = $request->countrie_id ;
        $users_addresse->citie_id = $request->citie_id ;
        $users_addresse->region_id = $region_id ;
        $users_addresse->active = 'yes' ;

        $users_addresse->save() ;

        $request->session()->flash('alert-success', __('admin.alerts_success_editing'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_addresse = Users_addresse::find($id);

        $user_addresse->delete();
        return back();
    }

    /**
     * @param Request $request
     * @param Region region
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mass_delete(Request $request)
    {

        if(empty($request->checkboxes)){
            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }

        Users_addresse::destroy($request->checkboxes);

        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }
}
