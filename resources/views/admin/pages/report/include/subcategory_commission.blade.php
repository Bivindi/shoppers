@if($type == 'pdf')
        <!DOCTYPE html>
<html lang="en">
<head>
    <title>Subcategory Commission</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Subcategory Commission</h2>
    <table class="table">
        <thead>
        <tr>
            <th data-field="id">Id</th>
            <th data-field="id">Subcategory</th>
            <th data-field="id">Product</th>
            <th data-field="name">Commission</th>
            <th data-field="name">Amount</th>
            <th data-field="price">Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($commissions as $key => $commission)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $commission->subcategory }}</td>
                <td>{{ $commission->name }}</td>
                <td>@if($commission->isAdmin()) {{ $commission->getCommissionByTransactionId() }} @else
                        0 @endif</td>
                <td>{{ $commission->price }}</td>
                <td>{{ Carbon\Carbon::parse($commission->created_at)->format('d-m-Y') }}</td>
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
            <th data-field="id">Subcategory</th>
            <th data-field="id">Product</th>
            <th data-field="name">Commission</th>
            <th data-field="name">Amount</th>
            <th data-field="price">Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($commissions as $key => $commission)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $commission->subcategory }}</td>
                <td>{{ $commission->name }}</td>
                <td>@if($commission->isAdmin()) {{ $commission->getCommissionByTransactionId() }} @else
                        0 @endif</td>
                <td>{{ $commission->price }}</td>
                <td>{{ Carbon\Carbon::parse($commission->created_at)->format('d-m-Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
