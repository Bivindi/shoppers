@if($type == 'pdf')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Products</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Manage Products</h2>
    <table class="table">
        <thead>
        <tr>
            <th data-field="id">Id</th>
            <th data-field="name">Name</th>
            <th data-field="desc">Seller Name</th>
            <th data-field="new_arrivals">New Arrivals</th>
            <th data-field="special_product">Special Product</th>
            <th data-field="recommanded">Recommanded</th>
            <th data-field="model">Model</th>
            <th data-field="quantity">Quantity</th>
            <th data-field="status">Status</th>
            <th data-field="image">Image</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $key => $product)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->first_name }}</td>
                <td>{{ $product->new_arrival }}</td>
                <td>{{ $product->special }}</td>
                <td>{{ $product->recommend }}</td>
                <td>{{ $product->model }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ asset('productimg/'.$product->product_img) }}</td>
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
            <th data-field="name">Name</th>
            <th data-field="desc">Seller Name</th>
            <th data-field="new_arrivals">New Arrivals</th>
            <th data-field="special_product">Special Product</th>
            <th data-field="recommanded">Recommanded</th>
            <th data-field="model">Model</th>
            <th data-field="quantity">Quantity</th>
            <th data-field="status">Status</th>
            <th data-field="image">Image</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $key => $product)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->first_name }}</td>
                <td>{{ $product->new_arrival }}</td>
                <td>{{ $product->special }}</td>
                <td>{{ $product->recommend }}</td>
                <td>{{ $product->model }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ asset('productimg/'.$product->product_img) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif