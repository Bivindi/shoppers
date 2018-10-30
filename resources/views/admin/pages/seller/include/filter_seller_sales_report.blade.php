<table class="responsive-table">
    <thead>
    <tr>
        <th data-field="id">Id</th>
        <th data-field="name">Seller Name</th>
        <th data-field="price">Product</th>
        <th data-field="id">Price</th>
        <th data-field="id">Fee Deduction</th>
    </tr>
        </thead>
        @if(count($salesReports)>0)
        <tbody>
        @foreach($salesReports as $key => $salesReport)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $salesReport->first_name }}</td>
                <td>{{ $salesReport->productname }}</td>
                <td>{{ $salesReport->price }}</td>
                <!-- <td><a class="waves-effect waves-light btn red modal-trigger feeBtn modalClick2"
                 productid="{{ $salesReport->productid }}" id='modalClick' href="#paymentModal">View</a></td> -->
                 <td><a class="waves-effect waves-light btn red  feeBtn modalClick"
                                     productid="{{ $salesReport->productid }}"  onclick="myFunction( $(this).attr('productid'))" href="#paymentModal">View</a></td>
            </tr>
        @endforeach
        </tbody>
        @else
        <tr class="text-center">
            <td>No Data Found</td>
        </tr>
     @endif
</table>