@extends('admin.layout.default')
@section('title')
    Dashboard
@endsection
@section('page-css')
    <link href="{{ asset('assets/js/plugins/chartist-js/chartist.min.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection">
    <style>
        .text-center {
            text-align: center;
        }
    </style>
@endsection

@section('page-content')
    <section id="content">
        <div id="breadcrumbs-wrapper">
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2"
                       placeholder="Explore Materialize">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h5 class="breadcrumbs-title">Dashboard</h5>
                        <ol class="breadcrumbs">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="card-stats">
                <div class="row">
                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-content  green white-text">
                                <p class="card-stats-title"><i class="mdi-social-group-add"></i> Total Orders</p>
                                <h4 class="card-stats-number">{{ $totalOrders }}</h4>
                                <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 15% <span
                                            class="green-text text-lighten-5">from yesterday</span>
                                </p>
                            </div>
                            <div class="card-action  green darken-2">
                                <div id="clients-bar" class="center-align">
                                    <canvas width="227" height="25"
                                            style="display: inline-block; width: 227px; height: 25px; vertical-align: top;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-content pink lighten-1 white-text">
                                <p class="card-stats-title"><i class="mdi-editor-insert-drive-file"></i> Today Orders
                                </p>
                                <h4 class="card-stats-number">{{ $todayOrders }}</h4>
                                <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-down"></i> 3% <span
                                            class="deep-purple-text text-lighten-5">from last month</span>
                                </p>
                            </div>
                            <div class="card-action  pink darken-2">
                                <div id="invoice-line" class="center-align">
                                    <canvas width="223" height="25"
                                            style="display: inline-block; width: 223px; height: 25px; vertical-align: top;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-content blue-grey white-text">
                                <p class="card-stats-title"><i class="mdi-action-trending-up"></i> Success Orders</p>
                                <h4 class="card-stats-number">{{ $successOrder }}</h4>
                                <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 80% <span
                                            class="blue-grey-text text-lighten-5">from yesterday</span>
                                </p>
                            </div>
                            <div class="card-action blue-grey darken-2">
                                <div id="profit-tristate" class="center-align">
                                    <canvas width="227" height="25"
                                            style="display: inline-block; width: 227px; height: 25px; vertical-align: top;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-content purple white-text">
                                <p class="card-stats-title"><i class="mdi-editor-attach-money"></i>Pending Orders</p>
                                <h4 class="card-stats-number">{{ $pendingOrder }}</h4>
                                <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 70% <span
                                            class="purple-text text-lighten-5">last month</span>
                                </p>
                            </div>
                            <div class="card-action purple darken-2">
                                <div id="sales-compositebar" class="center-align">
                                    <canvas width="214" height="25"
                                            style="display: inline-block; width: 214px; height: 25px; vertical-align: top;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- point de ralliement -->

            <div class="col m12">
                <ul id="task-card" class="collection with-header">
                    <li class="collection-header cyan">
                        <h4 class="task-card-title"> Latest Orders</h4>
                    </li>
                    <li style="padding: 20px;">
                        <table class="responsive-table">
                            <thead>
                            <tr>
                                <th data-field="id">order ID</th>
                                <th data-field="month">Customer</th>
                                <th data-field="item-sold">Status</th>
                                <th data-field="item-price">Order Date</th>
                                <th data-field="item-price">Total</th>
                                <th data-field="total-profit">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latestOrder as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->username }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td><a href="{{ route('get:manage_order') }}" tooltipped data-delay="50" data-tooltip="View" title="" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </li>
                </ul>
            </div>

            <div id="card-stats">
                <div class="row">
                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-content  green white-text">
                                <p class="card-stats-title"><i class="mdi-social-group-add"></i> Total Customers</p>
                                <h4 class="card-stats-number">@if($totalCustomers > 0){{ $totalCustomers }} @else 0 @endif</h4>
                                <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 15% <span
                                            class="green-text text-lighten-5">from yesterday</span>
                                </p>
                            </div>
                            <div class="card-action  green darken-2">
                                <div id="clients-bar" class="center-align">
                                    <canvas width="227" height="25"
                                            style="display: inline-block; width: 227px; height: 25px; vertical-align: top;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-content pink lighten-1 white-text">
                                <p class="card-stats-title"><i class="mdi-social-group-add"></i> Today Customers
                                </p>
                                <h4 class="card-stats-number">@if($todayCustomers > 0){{ $todayCustomers }} @else
                                        0 @endif</h4>
                                <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-down"></i> 3% <span
                                            class="deep-purple-text text-lighten-5">from last month</span>
                                </p>
                            </div>
                            <div class="card-action  pink darken-2">
                                <div id="invoice-line" class="center-align">
                                    <canvas width="223" height="25"
                                            style="display: inline-block; width: 223px; height: 25px; vertical-align: top;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-content blue-grey white-text">
                                <p class="card-stats-title"><i class="mdi-social-group-add"></i> Week Customers</p>
                                <h4 class="card-stats-number">@if($weekCustomers > 0){{ $weekCustomers }} @else
                                        0 @endif</h4>
                                <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 80% <span
                                            class="blue-grey-text text-lighten-5">from yesterday</span>
                                </p>
                            </div>
                            <div class="card-action blue-grey darken-2">
                                <div id="profit-tristate" class="center-align">
                                    <canvas width="227" height="25"
                                            style="display: inline-block; width: 227px; height: 25px; vertical-align: top;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-content purple white-text">
                                <p class="card-stats-title"><i class="mdi-social-group-add"></i> Month Customers</p>
                                <h4 class="card-stats-number">@if($monthCustomers > 0) {{ $monthCustomers }} @else
                                        0 @endif</h4>
                                <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 70% <span
                                            class="purple-text text-lighten-5">last month</span>
                                </p>
                            </div>
                            <div class="card-action purple darken-2">
                                <div id="sales-compositebar" class="center-align">
                                    <canvas width="214" height="25"
                                            style="display: inline-block; width: 214px; height: 25px; vertical-align: top;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page-js')
    <!-- chartjs -->
    <script type="text/javascript" src="{{ asset('assets/') }}/js/plugins/chartjs/chart.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/') }}/js/plugins/chartjs/chart-script.js"></script>


    <script>
        var trendingLineChart;
        var data = {
            labels: ["Jan", "Fab", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sept", "Oct", "Nov", "Dec"],
            datasets: [
                {
                    label: "First dataset",
                    fillColor: "rgba(128, 222, 234, 0.6)",
                    strokeColor: "#ffffff",
                    pointColor: "#00bcd4",
                    pointStrokeColor: "#ffffff",
                    pointHighlightFill: "#ffffff",
                    pointHighlightStroke: "#ffffff",
                    @if(count(App\Model\Products::where("user_id", Auth::user()->id)->get()) > 0 && !Auth::user()->hasRole("admin"))
                        data: ["{{ $totalSale->getSell('01') }}", "{{ $totalSale->getSell('02') }}", "{{ $totalSale->getSell('03') }}", "{{ $totalSale->getSell('04') }}", "{{ $totalSale->getSell('05') }}", "{{ $totalSale->getSell('06') }}", "{{ $totalSale->getSell('07') }}", "{{ $totalSale->getSell('08') }}", "{{ $totalSale->getSell('09') }}", "{{ $totalSale->getSell('10') }}", "{{ $totalSale->getSell('11') }}", "{{ $totalSale->getSell('12') }}"]
                    @else
                        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                    @endif
                },
            ]
        };

        // setInterval(function(){
        //     // Get a random index point
        //     var indexToUpdate = Math.round(Math.random() * (data.labels.length-1));
        //     if (typeof trendingLineChart != "undefined"){
        //         // Update one of the points in the second dataset
        //         if(trendingLineChart.datasets[0].points[indexToUpdate].value){
        //             trendingLineChart.datasets[0].points[indexToUpdate].value = Math.round(Math.random() * 100);
        //         }
        //         if(trendingLineChart.datasets[1].points[indexToUpdate].value){
        //             trendingLineChart.datasets[1].points[indexToUpdate].value = Math.round(Math.random() * 100);
        //         }
        //         trendingLineChart.update();
        //     }
        //
        //
        // }, 2000);

    </script>
@endsection