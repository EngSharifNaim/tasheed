<?php

namespace App\Http\Controllers;

use App\Paidacount;
use Illuminate\Http\Request;
use App\paidacounttype;
use App\Userlevel;
use Illuminate\Support\Facades\DB;
class Paidacounttypes extends Controller
{
    public function index()
    {
        $paidacounttypes = Paidacounttype::orderBy('created_at', 'DESC')->get();

        return view(ad.'.paidacounttypes.index',compact('paidacounttypes'));
    }

    public function show($id)
    {
        $section = Section::find($id) ;

        return view(ad.'.sections.show',["section"=>$section]);

    }

    /*
     *
     */
    public function update(Request $request,$id){
        $this->validate($request,[
            'title' => 'required',
            'month' => 'required',
            'year' => 'required',

            ]);
        $paidt = Paidacounttype::find($id);
        $paidt->title = $request->title;
        $paidt->month_value = $request->month;
        $paidt->year_value = $request->year;

        $paidt->save();
        return back();
    }
    public function create(Paidacounttype $paidacounttypes)
    {
        $userlevels=DB::table('userlevels')
            ->select('*')
            ->get();
        $paidacounttypes = Paidacounttype::all();
        return view(ad.'.paidacounttypes.add',['paidacounttypes'=>$paidacounttypes,'userlevels'=>$userlevels ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:paidacounttypes',
        ]);
        $acount=Paidacounttype::where('user_type','=',$request->user_type)->get();
        if(count($acount)>0){
            $msg='الاشتراك موجود من قبل';
            return back()->with(['msg' => $msg]);

        }

        $paidacounttype=new Paidacounttype();
        $paidacounttype->user_type = $request->user_type;
        $paidacounttype->title = $request->title;
        $paidacounttype->level_slug = $request->title;
        $paidacounttype->month_value = $request->month_value;
        $paidacounttype->year_value = $request->year_value;

        $paidacounttype->save();



//        $request->session()->flash('alert-success',  __('admin.alerts_success_adding'));
        return back();
    }

    public function mass_delete(Request $request)
    {
        if(empty($request->checkboxes)){
//            $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
            return back();
        }

        paidacounttype::destroy($request->checkboxes);
//        $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
        return back();
    }

    public function edit($id){
        $paidacounttype = Paidacounttype::find($id);
        $levels=Userlevel::all();
        return view(ad.'.paidacounttypes.edite',compact( 'paidacounttype','levels'));


    }

}
