@extends('admin.layout.default')
@section('title')
    @if(isset($taxclass))
        Edit Tax Class
    @else
        Add Tax Class
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
                            @if(isset($taxclass))
                                Edit Tax Class
                            @else
                                Add TaxClass
                            @endif</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Tax Class</a>
                            </li>
                            <li class="active">@if(isset($taxclass))
                                    Edit Tax Class
                                @else
                                    Add Tax Class
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
                        <h4 class="header2">@if(isset($taxclass))
                                Edit Tax Class
                            @else
                                Add Tax Class
                            @endif</h4>
                        <div class="row">
                            <form id="formValidate" class="col s12" action="{{ route('post:add_tax_class') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @if(isset($taxclass))
                                    <input type="hidden" name="taxClassId" value="{{ $taxclass->id }}">
                                @endif
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="name" name="name"
                                               value="{{ (isset($taxclass)) ? $taxclass->name : old('name') }}"
                                               type="text">
                                        <label for="name">Tax Class</label>
                                        <span class="error">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="taxRate" name="tax_rate"
                                               value="{{ (isset($taxclass)) ? $taxclass->tax_rate : old('tax_rate') }}"
                                               type="text">
                                        <label for="taxRate">Tax Rate</label>
                                        <span class="error">{{ $errors->first('tax_rate') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <select name="type" id="type">
                                            <option value="">Select Type</option>
                                            <option value="{{ \App\Model\TaxClass::FLAT }}" @if(isset($taxclass)) {{ ($taxclass->type == \App\Model\TaxClass::FLAT) ? 'selected' : '' }} @endif>{{ \App\Model\TaxClass::PERCENTAGE }}</option>
                                            <option value="{{ \App\Model\TaxClass::PERCENTAGE }}" @if(isset($taxclass)) {{ ($taxclass->type == \App\Model\TaxClass::PERCENTAGE) ? 'selected' : '' }} @endif>{{ \App\Model\TaxClass::FLAT }}</option>
                                        </select>
                                        <label for="category">Select Tax Type</label>
                                        <span class="error">{{ $errors->first('type') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                            @if(isset($taxclass))
                                                Update
                                            @else
                                                Submit
                                            @endif
                                            <i class="mdi-content-send right"></i>
                                        </button>
                                    </div>
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
                tax_rate: 'required',
                type: 'required',
            },
            //For custom messages
            messages: {
                name: "Please enter tax class name..!",
                tax_rate: "Please enter tax rate..!",
                type: "Please select tax type..!",
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
