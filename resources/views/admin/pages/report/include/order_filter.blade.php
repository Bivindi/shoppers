<table class="responsive-table">
    <thead>
    <tr>
        <th data-field="id">Id</th>
        <th data-field="name">Product Name</th>
        <th data-field="id">Order Id</th>
        <th data-field="id">Transaction Id</th>
        <th data-field="name">Subcategory Name</th>
        <th data-field="name">category Name</th>
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
            <td><button class="btn @if($order->status == \App\Model\Order::SUCCESS) green @elseif($order->status == \App\Model\Order::PENDING) yellow @else red @endif btn-md">
                    {{ ucfirst($order->status) }}
                </button></td>
        </tr>
    @endforeach
    </tbody>
</table>