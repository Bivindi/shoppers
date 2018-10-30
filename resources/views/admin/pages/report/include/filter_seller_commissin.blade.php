<table class="responsive-table">
    <thead>
    <tr>
        <th data-field="id">Id</th>
        <th data-field="id">Seller Name</th>
        <th data-field="name">Commission</th>
        <th data-field="price">Date</th>
    </tr>
    </thead>
    @if(count($commissions)>0)
    <tbody>
        @foreach($commissions as $key => $commission)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $commission->username }}</td>
                <td>{{ $commission->getCommissionByOrderId() }}</td>
                <td>{{ Carbon\Carbon::parse($commission->created_at)->format('d-m-Y') }}</td>
            </tr>
        @endforeach
    </tbody>
    @else
        <tr class="text-center">
            <td>No Data Found</td>
        </tr>
    @endif
</table>