@extends('admin.layout.default')
@section('title')
    Manage Seller
@endsection
@section('page-css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="{{ asset('assets/') }}/js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('assets/') }}/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('assets/') }}/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
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
                        <h5 class="breadcrumbs-title">Manage Seller</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Seller</a>
                            </li>
                            <li class="active">Manage Seller</li>
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
                                <th>FirstName</th>
                                <th>LastName</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>Details</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="name">{{ ucwords(strtolower($user->first_name)) }}</td>
                                    <td class="name">{{ ucwords(strtolower($user->last_name)) }}</td>
                                    <td class="name">{{ ucwords(strtolower($user->username)) }}</td>
                                    <td class="name">{{ $user->email }}</td>
                                    <td class="name">{{ $user->mobile_num }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="waves-effect waves-light btn modal-trigger userDetails  light-blue" userId="{{ $user->id }}" href="#modal1">Details</a>
                                        </div>
                                    </td>
                                    <td>
                                        <a userId="{{ $user->id }}"
                                           class="waves-effect waves-light btn @if($user->status == 1) green @else red @endif btn-small approve">@if($user->status == 1)
                                                Approved @else Approve @endif</a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn tooltipped btn-warning deleteMember"
                                                    data-delay="20" userId="{{ $user->id }}"
                                                    data-tooltip="Delete Member"><i class="fa fa-trash"
                                                                                    aria-hidden="true"></i>
                                            </button>
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
    <div id="modal1" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Disagree</a>
            <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Agree</a>
        </div>
    </div>
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

        $(document).on('click', '.deleteMember', function (e) {
            e.preventDefault();
            var userId = $(this).attr('userId');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this seller!",
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
                        url: '{{ route('get:delete_seller') }}',
                        data: {userId: userId},
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


        $(document).on('click', '.userDetails', function (e) {
            e.preventDefault();
            var userId = $(this).attr('userId');
            $.ajax({
                type: 'get',
                data: {userId: userId},
                url: "{{ route('get:seller_details') }}",
                success: function (result) {
                    $('.modal-title').html('Seller Details');
                    $('.modal-body').html(result);
                    if(result.error == true){
                        $.notify(result.message, "error");
                    }
                }
            });
        });

        $(document).on('click', '.approve', function (e) {
            e.preventDefault();
            var $this = $(this);
            var userId = $(this).attr('userId');
            $.ajax({
                type: 'get',
                url: '{{ route('get:seller_approve') }}',
                data: {userId: userId},
                beforeSend: function () {
                    $this.html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $this.attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        location.reload();
                    } else {
                        $.notify(result.message, "error");
                        $this.html('Approve');
                        $this.attr('disabled', false);
                    }
                }
            })
        });
    </script>
@endsection
