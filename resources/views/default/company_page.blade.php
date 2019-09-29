
@extends('layouts.app')
@section('page_title')
{{ $user->name }}
@stop
@section('content')
<style>
.weight{
        font-weight:bold;
    }
    .m-t-30 {
        margin-top:30px;
        color:#f14444;
    }
    .col{
        color:#f14444;
    }
</style>
<div class="container" style="margin-top: 30px;">
    <div class="row">
    <div class="col-lg-2">
        <div class="col-md-offset-1 col-md-12 item-box white">
            <div class="item-media entry mem1">
                                        <img  style="height:150px;" src="@if(!empty($user->photo)) {{url('/public') }}{{$user->photo}}@else http://tsheed.com/test/public/default/images/logo.png @endif" class="img-responsive">
                                        <div class="magnifier">
                </div>
            </div><!-- end item-media -->

                        <br><br>
        </div><!-- end item-box -->
        <div class="clearfix"></div>
        <div class="company-item">
             
           
            <div class="space">
                <div class="row">
                    <div class="col-md-12">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="company-item">
           <div class="space" style="text-align:center;">
                        <a style="float:none; margin:auto;" data-toggle="modal"  href="#myModal" class="btn btn-primary client-signup"><b>مراسلة   </b></a>
						
                    </div>
            <hr>
            <div class="space">
                <div class="row">
                                                                                                                    </div>
            </div>
        </div>
    </div>
	
    <div class="col-lg-10">
          <h3 class="col box-title"><strong> البيانات الشخصية</strong></h3>
        <hr>
         <div class="row">
          <div class="col-sm-6">
      
        <div class="col-sm-12">
            <div class="space">
                <label class="weight">الاسم</label> :  {{ $user->name }}        
            </div>
             <div class="space">
                <label class="weight">البريد الالكتروني</label> :  {{ $user->email }}        
            </div>
            <div class="space">
                <label class="weight">الهاتف</label> :  {{ $user->phone }}          
            </div>
        </div>
        </div>
         <div class="col-sm-6">
         
        <div class="col-sm-12">
            @if(!empty($user->countrie))  <div class="space">
                <label class="weight">الدولة</label> : {{ $user->countrie->name_ar }}          
            </div>@endif
           @if(!empty($user->citie))   <div class="space">
                <label class="weight">المدينة </label> :  {{ $user->citie->name_ar }}         
            </div>@endif
           @if(!empty($user->region))    <div class="space">
                <label class="weight">المنطقة</label> :{{ $user->region->name_ar }}         
            </div>@endif
             
        </div>
        </div></div>
        
        
        
        
        
        
        
        
        
        
        
          <h3 class="m-t-30 box-title"><strong>   ملف الشركة</strong></h3>
        <hr>
         <div class="row">
		   @if(!empty($user->companie))
          <div class="col-sm-12">
    
        <div class="col-sm-12">
            <div class="space">
                <label class="weight">اسم الشركه</label> :@if(Lang::locale() == 'ar')  {{ $user->companie->name_ar }} @else {{ $user->companie->name_ar }} @endif
               &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            </div>
            
           
        </div>
		
        </div>
        
        
            <div class="col-sm-12">
      
        <div class="col-sm-12">
           
             <div class="space">
                <label class="weight">هاتف الشركة  </label> :  {{ $user->companie->phone }}          
            </div>
            <div class="space">
                <label class="weight">الموقع الالكتروني </label> :  {{ $user->companie->company_website }}           
            </div>
             <div class="space">
                <label class="weight"> الرقم الضريبي </label> : {{ $user->companie->tax_number }}          
            </div>
             <div class="space">
                <label class="weight">السجل التجارى  </label> :  {{ $user->companie->commercial_register }}         
            </div>
        </div>
        </div>
        @endif
        
         </div>
        
        
        
        
        
        
        
            
        
        
          <h3 class="m-t-30 box-title"><strong>   معلومات اضافية </strong></h3>
        <hr>
         <div class="row">
          <div class="col-sm-12">
      
        <div class="col-sm-12">
            <div class="space">
			{{ $user->describtion }} </div>
            
           
        </div>
        </div>
           
        
         </div>
        
          
            
            
            
          <!--  
        <h3 class="box-title"><strong>ملف الشركة</strong></h3>
        <hr>
        <div class="col-sm-12">
            <div class="space">
                <label class="weight">اسم مكتب / المؤسسة</label> : مكتب اسلوب العمران للاستشارات الهندسية المعمارية            </div>
             <div class="space">
                <label>اسم المستخدم التعريفى</label> :             </div> 

            <hr>
            <div class="space">
                <div class="row">
                    <div class="col-md-6">
                      
                        <div class="space">
                            <label  class="weight">رقم السجل التجاري</label>:
                            4030292818                        </div>
                        <div class="space">
                            <label class="weight">تاريخ الإنتهاء</label> :
                            1441-04-05                        </div>
                        
                        <div class="space">
                            <label class="weight">رقم رخصة هيئة المهندسين</label> :05140 
                        </div>                     
                    </div>
                                                
                        

                </div>
            </div>
            <div class="space">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="box-title"><strong>مشاريع الشركة</strong></h3>
                        <hr>
                        
                    </div>
                </div>
            </div>
            <hr>
            <div class="widget-title">
                <h3 class="box-title"><strong>معلومات الاتصال</strong></h3>
                <hr>
            </div> 
            <div class="space">
                <div class="row">
                    <div class="col-md-6">
                        <label>الهاتف</label> :                     </div>
                    <div class="col-md-6">
                        <label>التليفون المحمول</label> : 0599997373                    </div>
                </div>

            </div>
            <div class="space">
                <div class="row">
                    <div class="col-md-6"><label> موقع الكتروني                        </label> :                     </div>
                    <div class="col-md-6">
                        <label>البريد الإلكتروني</label> :
                        <a href="mailto:style.o.arch@gmail.com">style.o.arch@gmail.com</a>                    </div>
                </div>
            </div>
            
                <div class="space">
                    <label>عنوان</label> : الروضة، جدة السعودية                </div>
                <div class="row branch_row_166 current_branch">
               
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d463879.26526435185!2d46.5423378239366!3d24.724931564644404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489399%3A0xba974d1c98e79fd5!2sRiyadh+Saudi+Arabia!5e0!3m2!1sen!2sus!4v1537086617369" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>                     
                
                                <div class="space">
                        <a href="http://www.tobh.com/login" class="btn btn-primary btn-block btn-lg"><b>طلب خدمة مباشرة</b></a>
                    </div>
            
        </div> -->
    </div> </div>
</div> </br>
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">{{ __('site.send_messages_dealer') }}</h4>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<form>
						<input type="hidden" name="dealer_id" value="{{$user->id}}">
						<div class="form-group">
							<textarea style="min-height: 160px;" name="message" id="message" required="true" class="form-control" placeholder="{{ __('site.your_message') }}"></textarea>
						</div>
						<div class="form-group">
							<input   id="submit_message" value="{{__('site.send_message')}}" class="btn btn-primary" />
						</div>
					</form>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('site.close') }}</button>
				</div>

			</div>
		</div>
	</div>
@stop


@section('page_plugins')
	<script type="text/javascript">
	
	   $(document.body).on('click', "input[id=submit_message]", function (event) {
      //  $('input[id=submit_message]').on('click', function(event){
            var message =  $("#message").val() ;
            var dealer = '{{ $user->id }}' ;
            @if(Auth::user())			
            $.post("{{url('send_chat_message')}}",{ message : message , dealer_id :dealer})
                .done(function (data) {
                    if (data != 0) {
                        $.bootstrapGrowl('{{__('site.message_send_well')}}',{
                            type: 'success',
                            delay: 2000,
                            offset: {from: 'top', amount: 20},
                            align: '@if(Lang::locale() == 'ar') right @else left @endif',
                            width: 500,
                            delay: 4000,
                            allow_dismiss: true,
                            stackup_spacing: 10 ,
                        });
					}
				});
                  
            @else
            $.bootstrapGrowl('{{__('site.chat_message_login_first')}}',{
                type: 'danger',
                delay: 2000,
                offset: {from: 'top', amount: 20},
                align: '@if(Lang::locale() == 'ar') right @else left @endif',
                width: 500,
                delay: 4000,
				allow_dismiss: true,
                stackup_spacing: 10 ,
            });
			@endif
        })  ;
	</script>
@stop



