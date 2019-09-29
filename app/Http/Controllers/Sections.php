<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use App\Http\Requests;
    use App\Section;
    use Carbon\Carbon;

    class Sections extends Controller
    {

        public function index()
        {
            $sections = Section::all() ;
            return view(ad.'.sections.index',compact('sections'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $section = Section::find($id) ;

            return view(ad.'.sections.show',["section"=>$section]);

        }

        /*
         *
         */
        public function create(Section $section)
        {
            $sections = Section::where('parent_id',0)->get();
            return view(ad.'.sections.add',["sections"=>$sections ]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request,Section $section)
        {
            $this->validate($request, [
                'name_ar' => 'required|unique:sections',
                'name_en' => 'required|unique:sections',
                'image' => 'bail|image|mimes:jpg,jpeg,png,gif',
            ]);


            $section->parent_id = $request->parent_id;
            $sub_section = (isset($request->sub_id)) ? $request->sub_id : 0;
            $section->sub_section = $sub_section ;
            $section->name_ar = $request->name_ar;
            $section->name_en = $request->name_en;
            $section->description_ar = $request->description_ar;
            $section->description_en = $request->description_en;
            $section->active = $request->active;

            if(!empty($request->file('image'))){
                $photo = Storage::putFile('public', $request->file('image'));
                $section->photo = Storage::url($photo);
            }

            $section->save();


            $request->session()->flash('alert-success',  __('admin.alerts_success_adding'));
            return back();
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit( $id )
        {
            $sections = Section::where('parent_id',0)->where('active' , 'yes')->get();
            $section = Section::find($id) ;
            $sub_sections = Section::where("parent_id",$section->parent_id)->get();

            return view(ad.'.sections.edite',["section"=>$section,"sections"=>$sections , 'sub_sections'=>$sub_sections  ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id )
        {
            $this->validate($request, [
                'name_ar' => 'required|unique:sections,name_ar,'.$id,
                'name_en' => 'required|unique:sections,name_en,'.$id,
                'image' => 'bail|image|mimes:jpg,jpeg,png,gif',
            ]);

            $section = Section::find($id);

            $section->parent_id = $request->parent_id;
            $section->sub_section = $request->sub_id;
            $section->name_ar = $request->name_ar;
            $section->name_en = $request->name_en;
            $section->description_ar = $request->description_ar;
            $section->description_en = $request->description_en;
            $section->active = $request->active;

            if(!empty($request->file('image'))){
                $photo = Storage::putFile('public', $request->file('image'));
                $section->photo = Storage::url($photo);
            }

            $section->save();

            $request->session()->flash('alert-success', __('admin.alerts_success_editing'));
            return back();
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Request $request,$id)
        {
            $section = Section::find($id);

            $section->delete();
            $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
            return back();
        }


        public function mass_delete(Request $request)
        {
            if(empty($request->checkboxes)){
                $request->session()->flash('alert-danger', __('admin.alerts_error_no_selection'));
                return back();
            }

            Section::destroy($request->checkboxes);
            $request->session()->flash('alert-success', __('admin.alerts_success_delete'));
            return back();
        }
        //ajax functions
        public function sections_list(Request $request)
        {
            $where = [];
            if(isset($request->id)){
                array_push($where,['sub_section','=',0]);
                array_push($where,['id','!=',$request->id]);

            }

            $sub_section = (isset($request->subsection)) ? $request->subsection : 0;
            $sections = Section::where("parent_id",$request->parent_section)->where('sub_section' , '=' , $sub_section )->where($where)->get();
            $current = (isset($request->current )) ? $request->current : 0;
            if(!empty($sections) ){
                return view(ad.'.sections.list',["current"=>$current,"sections"=>$sections]);
            }else{
                return null ;
            }

        }
        public function sections_list_subsub(Request $request)
        {
            $subsubsections = Section::where("parent_id",intval($request->parent_id))->where('sub_section' , '=' , $request->subsection)->get();
            //dd($subsubsections) ;
            $current = (isset($request->current)) ? $request->current : 0;
            $sub_sub_current = (isset($request->sub_sub_current)) ? $request->sub_sub_current : 0;
            if(!empty($subsubsections) ){
                return view(ad.'.sections.listsubsub',["current"=>$current,"sub_sub_current"=>$sub_sub_current,"subsubsections"=>$subsubsections]);
            }else{
                return null ;
            }

        }
    }
