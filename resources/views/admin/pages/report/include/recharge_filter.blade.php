<table class="responsive-table">
    <thead>
    <tr>
        <th data-field="id">Id</th>
        <th data-field="name">Mobile Number</th>
        <th data-field="id">Operator Name</th>
        <th data-field="id">Circle Name</th>
        <th data-field="name">Amount</th>
        <th data-field="name">Username</th>
        <th data-field="date">Date</th>
        <th data-field="status">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($recharges as $key => $recharge)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $recharge->recharge_num }}</td>
            <td>{{ $recharge->op_name }}</td>
            <td>{{ $recharge->circle }}</td>
            <td>{{ $recharge->amount }}</td>
            <td>{{ $recharge->username }}</td>
            <td>{{ Carbon\Carbon::parse($recharge->created_at)->format('d-m-Y') }}</td>
            <td>
                <button class="btn @if($recharge->status == \App\Model\RechargeHistory::SUCCESS) green @elseif($recharge->status == \App\Model\RechargeHistory::PENDING) yellow @else red @endif btn-md">
                    {{ ucfirst($recharge->status) }}
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>