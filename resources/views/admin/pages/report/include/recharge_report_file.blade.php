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
    <h2 class="text-center">Recharge Report</h2>
    <table class="table">
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
</div>
</body>
</html>
@else
    <table class="table">
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
@endif