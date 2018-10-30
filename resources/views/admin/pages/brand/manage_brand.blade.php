@extends('admin.layout.default')
@section('title')
    Manage Brands
@endsection
@section('page-css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">
    <style>

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
                        <h5 class="breadcrumbs-title">Manage Brands</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Brands</a>
                            </li>
                            <li class="active">Manage Brands</li>
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
                    <div class="table-responsive">
                        <table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Brand Name</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Documents</th>
                                 @if(Auth::user()->hasRole('admin'))
                                <th>Actions</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $key => $brand)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="name">{{ ucwords(strtolower($brand->name)) }}</td>
                                    <td class="name">{{ ucwords(strtolower($brand->categoryname)) }}</td>
                                    <td>@if($brand->status==1) Active @else Pending @endif</td>
                                    <td>
                                        <a href="{{ route('get:add_brand_doc', $brand->slug) }}"
                                               class="btn tooltipped btn-small green"
                                               data-delay="20"
                                               data-tooltip="Upload Documents">Documents</a>
                                    </td>

                                    @if(Auth::user()->hasRole('admin'))
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('get:edit_brand', $brand->slug) }}"
                                               class="btn tooltipped btn-small green"
                                               data-delay="20"
                                               data-tooltip="Edit"><i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <button class="btn tooltipped btn-warning deleteMember"
                                                    data-delay="20" slug="{{ $brand->slug }}"
                                                    data-tooltip="Delete"><i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>

                                            <button class="btn tooltipped @if($brand->status==1) green @else Approve @endif  approveBrand" data-delay="20"
                                                    data-tooltip="@if($brand->status==1) Approved @else Approve @endif" slug="{{ $brand->slug }}" >@if($brand->status==1) Approved @else Approve @endif
                                            </button>
                                        </div>
                                    </td>
                                    @endif
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable();
        });

        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).on('click', '.deleteMember', function (e) {
            e.preventDefault();
            var slug = $(this).attr('slug');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this brand!",
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
                        url: '{{ route('get:delete_brand') }}',
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


        $(document).on('click', '.approveBrand', function (e) {
            e.preventDefault();
            var slug = $(this).attr('slug');
            if (slug) {
                $.ajax({
                    type: 'get',
                    url: '{{ route('get:approve_brand') }}',
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



        // function approveBrand(brandId) 
        // {
        //     if (brandId) {
        //         $.ajax({
        //             type: 'get',
        //             url: '{{ route('get:approve_brand') }}',
        //             data: {brandId: brandId},
        //             success: function (result) {
        //                 if (result.success == true) {
        //                     location.reload();
        //                 } else {
        //                     $.notify(result.message, "error");
        //                 }
        //             }
        //         })
        //     }
        // }
    </script>
@endsection
