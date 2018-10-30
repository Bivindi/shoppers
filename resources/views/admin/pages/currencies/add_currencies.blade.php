@extends('admin.layout.default')
@section('title')
    @if(isset($currency))
        Edit Currencies
    @else
        Add Currencies
    @endif
@endsection
@section('page-css')
@endsection
@section('page-content')
    <section id="content">
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2"
                       placeholder="Explore Materialize">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h5 class="breadcrumbs-title">
                            @if(isset($currency))
                                Edit Currencies
                            @else
                                Add Currencies
                            @endif</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Currencies</a>
                            </li>
                            <li class="active">@if(isset($currency))
                                    Edit Currencies
                                @else
                                    Add Currencies
                                @endif</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumbs end-->
        <!--start container-->
        <div class="container">
            <!--Form Advance-->
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card-panel">
                        <h4 class="header2">@if(isset($currency))
                                Edit Currencies
                            @else
                                Add Currencies
                            @endif</h4>
                        <div class="row">
                            <form id="formValidate" class="col s12" action="{{ route('post:add_currencies') }}"
                                  method="post">
                                {{ csrf_field() }}
                                @if(isset($currency))
                                    <input type="hidden" name="currencyId" value="{{ $currency->id }}">
                                @endif
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="name" name="name"
                                               value="{{ (isset($currency)) ? $currency->name : old('name') }}"
                                               type="text">
                                        <label for="name">Currency Title</label>
                                        <span class="error">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="Code" name="code"
                                               value="{{ (isset($currency)) ? $currency->code : old('code') }}"
                                               type="text">
                                        <label for="Code">Code</label>
                                        <span class="error">{{ $errors->first('code') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="Value" name="value"
                                               value="{{ (isset($currency)) ? $currency->value : old('value') }}"
                                               type="text">
                                        <label for="Value">Value</label>
                                        <span class="error">{{ $errors->first('value') }}</span>
                                    </div>
                                    <div class="input-field col s12 6">
                                        <p>Status</p>
                                        <input name="status" value="1"
                                               @if(isset($currency)) {{ ($currency->status == 1) ? 'checked' : ''}} @endif type="radio"
                                               id="test1"/>
                                        <label for="test1">Enable</label>
                                        <input name="status" value="0"
                                               @if(isset($currency)) {{ ($currency->status == 0) ? 'checked' : ''}} @endif type="radio"
                                               id="test2"/>
                                        <label for="test2">Disable</label>
                                        <span class="error">{{ $errors->first('status') }}</span>
                                    </div>
                                </div>
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                        @if(isset($currency))
                                            Update
                                        @else
                                            Submit
                                        @endif
                                        <i class="mdi-content-send right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page-js')
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script type="text/javascript">
        $("#formValidate").validate({
            rules: {
                name: 'required',
                code: 'required',
                value: 'required',
                status: 'required',
            },
            //For custom messages
            messages: {
                name: "Please enter tax currency name..!",
                code: "Please enter currency code..!",
                value: "Please enter currency value..!",
                status: "Please select status..!",
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>
@endsection
