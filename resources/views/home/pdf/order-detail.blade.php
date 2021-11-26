<!DOCTYPE html>
<html>
<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>

<h1>History - {{$customer->customerName}}</h1>

<table id="customers">
    @foreach($orderDetails as $order)
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    <tr>
        <td>{{$order->productName}}</td>
        <td>{{$order->quantity}}</td>
        <td>{{number_format($order->productPrice)}}</td>
        <td>{{number_format($order->total)}}</td>
    </tr>

    @endforeach
</table>

<h3 style="margin: 50px auto">Techshop - Sell what you need to improve your life.</h3>
</body>
</html>
