@extends('layouts.app')
@section('page_title')
    {{ __('site.login_title') }}
@endsection
@section('content')
<div class="container bg1">
    <div class="row">
        <div class="col-md-12 general-title">
            <h4>اختر نوع المستخدم</h4>
            <p>اختيار نوع الخدمة المطلوبة كما هو موضح أدناه بدقة</p>
            <hr>
        </div><!-- end col -->
    </div><!-- end row -->
    <div class="row">
                <div class="col-md-offset-2 col-md-2 col-sm-6">
            <div class="item-box white">
                <div class="item-media entry">
                    <a href="#"><img src="http://tsheed.com/public/default/images/owner.svg" alt="" class=""></a>
                    <div class="magnifier">
                    </div>
                </div><!-- end item-media -->
                <h4><a href="#">مالك</a></h4>
                <p>لديك مشروع وتريد أن تنجزه</p>
            </div><!-- end item-box -->
        </div><!-- end col -->
        <div class="col-md-2 col-sm-6">
            <div class="item-box white">
                <div class="item-media entry">
                    <a href="#"><img src="http://tsheed.com/public/default/images/engineer.svg" alt="" class="img-responsive"></a>
                    <div class="magnifier white">
                    </div>
                </div><!-- end item-media -->
                <h4><a href="#">مكتب هندسي</a></h4>
                <p>ترغب في تقديم الخدمات الهندسية</p>
            </div><!-- end item-box -->
        </div><!-- end col -->
        <div class="col-md-2 col-sm-6">
            <div class="item-box white">
                <div class="item-media entry">
                    <a href="#"><img src="http://tsheed.com/public/default/images/contractor.svg" alt="" class="img-responsive"></a>
                    <div class="magnifier white">
                    </div>
                </div><!-- end item-media -->
                <h4><a href="#">شركة مقاولات</a></h4>
                <p>مقاول وتريد بناء مشاريع جديده</p>
            </div><!-- end item-box -->
        </div><!-- end col -->
        
        <!-- Freelancer --> 
        <div class="col-md-2 col-sm-6">
            <div class="item-box white">
                <div class="item-media entry">
                    <a href="#"><img src="http://tsheed.com/public/default/images/independent-engineer.svg" alt="" class="img-responsive"></a>
                    <div class="magnifier white">
                    </div>
                </div><!-- end item-media -->
                <h4><a href="#">مهندس مستقل</a></h4>
                <p>ترغب بتقديم التصاميم الهندسية وثلاثية الابعاد بشكل فردي</p>
            </div><!-- end item-box -->
        </div><!-- end col -->
    <!-- End Freelancer -->
    
    
    </div><!-- end row -->
</div>
@endsection




