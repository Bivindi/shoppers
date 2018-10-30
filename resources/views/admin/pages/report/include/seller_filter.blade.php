<table class="responsive-table">
    <thead>
    <tr>
        <th data-field="id">Id</th>
        <th data-field="name">Seller Name</th>
        <th data-field="id">Commission</th>
        <th data-field="id">Order Id</th>
        <th data-field="id">Paid Amount</th>
        <th data-field="name">Total</th>
        <th data-field="name">Return Amount</th>
        <th data-field="date">Date</th>
        <th data-field="status">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $key => $user)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->number_format_short($user->getSellerCommission()) }}</td>
            <td>{{ $user->transaction_id }}</td>
            <td>{{ $user->number_format_short($user->price - $user->getSellerCommission()) }}</td>
            <td>{{ $user->number_format_short($user->price) }}</td>
            <td>{{ $user->number_format_short($user->price - $user->getSellerCommission()) }}</td>
            <td>{{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
            <td>
                <button class="btn @if($user->status == \App\Model\Order::SUCCESS) green @elseif($user->status == \App\Model\Order::PENDING) yellow @else red @endif btn-md">
                    {{ ucfirst($user->status) }}
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>