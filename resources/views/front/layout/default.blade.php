<!doctype html>
<html class="no-js" lang="">
@include('front.layout.include.head')

<body class="">
    <div class="preloader"></div>
    
    @include('front.layout.include.header')
    @yield('page-content')
    
    @include('front.layout.include.footer')
    <style>
        .form-group{width:100%;}
    </style>
    <div class="modal fade" id="defaultModal">
    <div class="modal-dialog modal-md animated">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

    @include('front.layout.include.script')
    
</body>
</html>