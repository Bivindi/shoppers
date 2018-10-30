<table class="table table-bordered table-responsive cart_summary">
    <thead>
    <tr>
        <th class="cart_product">Operator</th>
        <th>Description</th>
        <th>Unit price</th>
        <th>Total</th>
        @if(isset($recharge->status))
            <th>Status</th>
        @endif
        <th class="action"><i class="fa fa-trash-o"></i></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="cart_product">
            <p>{{ $recharge->name }}</p>
        </td>
        <td class="cart_description">
            <p class="product-name"><a href="#">{{ $recharge->recharge_num }}</a></p>
            <small class="cart_ref">Trans. Id
                : {{ $recharge->transaction_id }}</small>
        </td>
        <td class="price"><span>{{ $recharge->amount }}<i
                        class="fas fa-rupee-sign"></i></span>
        </td>
        <td class="price">
                                        <span>@if(isset($recharge)){{ $recharge->amount }}@endif <i
                                                    class="fas fa-rupee-sign"></i></span>
        </td>
        @if(isset($recharge->status))
            <td class="cart_avail"><span
                        class="label @if($recharge->status == 'Success') label-success @elseif($recharge->status == 'Failure') label-danger @else label-warning @endif">{{ $recharge->status }}</span>
            </td>
        @endif
        <td class="action">
            <a href="{{ route('get:cancel_recharge', $recharge->transaction_id) }}">Delete
                item</a>
        </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2" rowspan="2"></td>
        <td colspan="2">Total products (tax incl.)</td>
        <td colspan="2">{{ $recharge->amount }} <i class="fa fa-inr"></i></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Total</strong></td>
        <td colspan="2"><strong>{{ $recharge->amount }} <i class="fa fa-inr"></i></strong>
        </td>
    </tr>
    </tfoot>
</table>
