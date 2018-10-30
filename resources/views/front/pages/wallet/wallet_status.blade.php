@extends('front.auth.layout.default')
@section('title')
    LozyPay Wallet
@endsection
@section('page-css')

@endsection

@section('body-class')
    class="category-page"
@endsection
@section('page-content')

@endsection
@section('page-js')
    <script>
        $(window).on('load', function () {
            var status = '{{ $status }}';
            showAndroidToast(status);

            function showAndroidToast(status) {
                Android.showAndroid(status);
            }
        });
    </script>
@endsection