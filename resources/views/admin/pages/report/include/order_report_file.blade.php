@if($type == 'pdf')
        <!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Report</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2 class="text-center">Order Report</h2>
    <table class="table">
        <thead>
        <tr>
            <th data-field="id">Id</th>
            <th data-field="name">Product</th>
            <th data-field="id">Order Id</th>
            <th data-field="id">Transaction Id</th>
            <th data-field="name">Subcategory</th>
            <th data-field="name">category</th>
            <th data-field="date">Date</th>
            <th data-field="status">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $key => $order)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->unique_order_id }}</td>
                <td>{{ $order->transaction_id }}</td>
                <td>{{ $order->subcategory }}</td>
                <td>{{ $order->category }}</td>
                <td>{{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                <td>
                    <button class="btn @if($order->status == \App\Model\Order::SUCCESS) green @elseif($order->status == \App\Model\Order::PENDING) yellow @else red @endif btn-md">
                        {{ ucfirst($order->status) }}
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
@else
    <table class="table">
        <thead>
        <tr>
            <th data-field="id">Id</th>
            <th data-field="name">Product</th>
            <th data-field="id">Order Id</th>
            <th data-field="id">Transaction Id</th>
            <th data-field="name">Subcategory</th>
            <th data-field="name">category</th>
            <th data-field="date">Date</th>
            <th data-field="status">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $key => $order)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->unique_order_id }}</td>
                <td>{{ $order->transaction_id }}</td>
                <td>{{ $order->subcategory }}</td>
                <td>{{ $order->category }}</td>
                <td>{{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                <td>
                    <button class="btn @if($order->status == \App\Model\Order::SUCCESS) green @elseif($order->status == \App\Model\Order::PENDING) yellow @else red @endif btn-md">
                        {{ ucfirst($order->status) }}
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif