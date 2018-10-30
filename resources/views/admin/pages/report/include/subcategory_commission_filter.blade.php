<table class="responsive-table">
    <thead>
    <tr>
        <th data-field="id">Id</th>
        <th data-field="id">Subcategory Name</th>
        <th data-field="id">Product Name</th>
        <th data-field="name">Commission</th>
        <th data-field="name">Product Amount</th>
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