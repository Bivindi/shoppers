@extends('admin.layout.default')
@section('title')
    Manage Products
@endsection
@section('page-css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">
    <!--jsgrid css-->
    <!-- <link href="{{ asset('assets/js/plugins/jsgrid/css/jsgrid.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('assets/js/plugins/jsgrid/css/jsgrid-theme.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection"> -->
    <style>
        .img-thumbnail {
            padding: 4px;
            line-height: 1.42857;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 3px;
            -webkit-transition: all 0.2s ease-in-out;
            -o-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            display: inline-block;
            max-width: 100%;
            height: auto;
        }

        .dataTables_length >label
        {
            display: none;
        }
        .btn-margin
        {
            margin-top: 20px; 
        }
        input[type=search], textarea.materialize-textarea {
            height: 1.5rem; 
        }
        .btnactive
        {
            border: #ff4083 solid 1px;
            background-color: #ff4081 ;
        }
    </style>
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
                        <h5 class="breadcrumbs-title">Manage Products</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Products</a>
                            </li>
                            <li class="active">Manage Products</li>
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

                    <div class="col m4 btn-margin">
                        <a href="{{ route('get:products_export_file', 'xlsx') }}" class="btn green">Excel</a>
                        <a href="{{ route('get:products_export_file', 'csv') }}" class="btn green">CSV</a>
                        <a href="{{ route('get:products_export_file', 'pdf') }}" class="btn green">PDF</a>
                    </div>

                    <div class="col m8 btn-margin">
                        <a href="{{ route('get:manage_products', 'all') }}" class="btn @if($type=='all') btnactive @else green @endif">All</a>
                        <a href="{{ route('get:manage_products', 'active') }}" class="btn @if($type=='active') btnactive @else green @endif">Active</a>
                        <a href="{{ route('get:manage_products', 'deactive') }}" class="btn @if($type=='deactive') btnactive @else green @endif">Deactive</a>
                    </div>

                    <div class="table-responsive">
                        <table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Seller Name</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                    <th>New Arrivals</th>
                                    <th>Special Product</th>
                                    <th>Recommend</th>
                                @endif
                                <th>Model</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-left">@if($product->status == 1) Enable @else Disable @endif</td>
                                    <td class="text-centers"><img src="{{ asset('productimg/'.$product->product_img) }}"
                                                                  height="50" width="50"
                                                                  alt="{{ $product->product_img }}"
                                                                  class="img-thumbnail"></td>
                                    <td class="text-left">{{  ucwords(mb_strimwidth($product->name, 0, 20, '...')) }}</td>
                                    <td class="text-left">{{ $product->username }}</td>
                                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                        <td class="name">
                                            <p>
                                                <input type="checkbox" class="checkbox" id="new{{$key}}"
                                                       @if($product->new_arrival == 1) checked @endif name="new"
                                                       cat="new" value="{{ $product->id }}">
                                                <label for="new{{$key}}"></label>
                                            </p>
                                        </td>
                                        <td class="name">
                                            <p>
                                                <input type="checkbox" class="checkbox" id="special{{$key}}"
                                                       @if($product->special == 1) checked @endif name="special"
                                                       cat="special" value="{{ $product->id }}">
                                                <label for="special{{$key}}"></label>
                                            </p>
                                        </td>
                                        <td class="name">
                                            <p>
                                                <input type="checkbox" class="checkbox"
                                                       @if($product->recommend == 1) checked @endif id="rec{{$key}}"
                                                       name="rec" cat="rec" value="{{ $product->id }}">
                                                <label for="rec{{$key}}"></label>
                                            </p>
                                        </td>
                                    @endif
                                    <td class="text-left">{{ $product->model }}</td>
                                    <td class="text-left">{{ $product->price }}</td>
                                    <td class="text-left">{{ $product->quantity }}</td>
                                    
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('get:seller_edit_products', $product->slug) }}"
                                               class="btn tooltipped btn-small green"
                                               data-delay="20"
                                               data-tooltip="Edit"><i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <button class="btn tooltipped btn-warning deleteMember"
                                                    data-delay="20" slug="{{ $product->slug }}"
                                                    data-tooltip="Delete Member"><i class="fa fa-trash"
                                                                                    aria-hidden="true"></i>
                                            </button>
                                            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                                <button class="btn btn-warning @if( $product->status == 0) green @else red @endif approveProduct"
                                                        slug="{{ $product->slug }}">@if( $product->status == 1 )
                                                        DisApprove @else
                                                        Approve @endif
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page-js')
    <script language="JavaScript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"
            type="text/javascript"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript"
            src="//cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>

    <!--jsgrid-->
    <!-- <script type="text/javascript" src="{{ asset('assets/js/plugins/jsgrid/js/db.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/jsgrid/js/jsgrid.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/jsgrid/js/jsgrid-script.js ') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/custom-script.js') }}"></script> -->

    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable();

            // $("#example").jsGrid({
            //     height: "70%",
            //     width: "100%",
            //     filtering: true,
            //     editing: true,
            //     sorting: true,
            //     paging: true,
            //     autoload: true,
            //     pageSize: 15,
            //     pageButtonCount: 5,
            //     deleteConfirm: "Do you really want to delete the client?",
            //     controller: db,
            //     fields: [
            //         { name: "Name", type: "text", width: 150 },
            //         { name: "status", type: "select", width: 50 },
            //         { name: "Address", type: "text", width: 200 },
            //         // { name: "Country", type: "select", items: db.countries, valueField: "Id", textField: "Name" },
            //         // { name: "Married", type: "checkbox", title: "Is Married", sorting: false },
            //         // { type: "control" }
            //     ]
            // });
        });

        $(document).on('change', '.checkbox', function (e) {
            e.preventDefault();
            var catId = $(this).val();
            var type = $(this).attr('cat');
            $.ajax({
                type: 'get',
                url: '{{ route('get:manage_homepage_product') }}',
                data: {productId: catId, type: type},
                success: function (result) {
                    if (result.success == true) {
                        $.notify(result.message, "success");
                    } else {
                        $.notify(result.message, "error");
                    }
                }
            })
        });

        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).on('click', '.deleteMember', function (e) {
            e.preventDefault();
            var slug = $(this).attr('slug');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this product!",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'get',
                        url: '{{ route('get:delete_products') }}',
                        data: {slug: slug},
                        success: function (result) {
                            if (result.success == true) {
                                location.reload();
                            } else {
                                $.notify(result.message, "error");
                            }
                        }
                    })
                }
            });
        });

        $(document).on('click', '.approveProduct', function (e) {
            e.preventDefault();
            var slug = $(this).attr('slug');
            $.ajax({
                type: 'get',
                url: '{{ route('get:approve_products') }}',
                data: {slug: slug},
                success: function (result) {
                    if (result.success == true) {
                        location.reload();
                    } else {
                        $.notify(result.message, "error");
                    }
                }
            })
        });
    </script>
@endsection
