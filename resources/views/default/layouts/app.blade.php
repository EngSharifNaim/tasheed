<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.meta_data')
    <style>
        #error-container {
            margin-top:100px;
            position: fixed;
        }

    </style>
</head>
<!-- Modal -->
<body>

<!---product popup model --------->
<div id="show_product_model" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="fast_preview_content">

        </div>
    </div>
</div>
<!---end product popup model -------->
@include('layouts.header')
@yield('content')
@include('layouts.footer')
