<table class="responsive-table">
    <thead>
    <tr>
        <th data-field="id">Fee Types</th>
        <th data-field="id">Amount</th>
    </tr>
    </thead>
    @if(count($data)>0)
    <tbody>
        @if($data->deduction_type="percentage")
        <tr>
            <td>Deduction Fee</td>
            <td>{{ ($data->deduction_charge / 100) * $data->price}}</td>
        </tr>
        <tr>
            <td>Selling Fee</td>
            <td>{{ ($data->selling_fee / 100) * $data->price}}</td>
        </tr>
         <tr>
            <td>Closing Fee</td>
            <td>{{ ($data->closing_fee / 100) * $data->price}}</td>
        </tr>
        <tr>
            <td>Service Tax Fee</td>
            <td>{{ ($data->service_tax / 100) * $data->price}}</td>
        </tr>
         <tr>
            <td>Total Fee</td>
            <td>{{ ($data->total_fee / 100) * $data->price}}</td>
        </tr>
        @else
        <tr>
            <td>Deduction Fee</td>
            <td>{{$data->deduction_charge}}</td>
        </tr>
        <tr>
            <td>Selling Fee</td>
            <td>{{$data->selling_fee}}</td>
        </tr>
         <tr>
            <td>Closing Fee</td>
            <td>{{$data->closing_fee}}</td>
        </tr>
        <tr>
            <td>Service Tax Fee</td>
            <td>{{$data->service_tax}}</td>
        </tr>
        <tr>
            <td>Total Fee</td>
            <td>{{$data->total_fee}}</td>
        </tr>
        @endif
    </tbody>
    @else
        <tr class="text-center">
            <td>No Data Found</td>
        </tr>
    @endif
</table>