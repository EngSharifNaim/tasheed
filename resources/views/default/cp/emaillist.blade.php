@extends('layouts.cp')
@section('page_title')
    {{ __('site.setup_news_message') }}
@stop
@section('content')


            <div class="col-lg-9 content-copouns">
                <div class="">
                    <p class="title-list">اللغة المفضلة</p>
                    <div class="form-check small-space">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                        <label class="form-check-label lan-list" for="exampleRadios1">
                            عربي
                        </label>
                    </div>
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                        <label class="form-check-label lan-list" for="exampleRadios2">
                            English
                        </label>
                    </div>
                    <p class="title-list">الأخبار والمنشورات العامة</p>

                    <div class="form-check small-space">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label lan-list" for="inlineCheckbox1">العروض اليومية</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                        <label class="form-check-label lan-list" for="inlineCheckbox2">إلغاء الاشتراك من على سنود  النشرات الاخبارية والمنشورات</label>
                    </div>
                    <button class="btn svae-form btn-primary " type="submit">حفظ</button>

                </div>
            </div>
        </div>
    </div>






@stop



