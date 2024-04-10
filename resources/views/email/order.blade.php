<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Email</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: black;">

    @if ($mailData['userType'] == 'customer')
    <h1 style= "color: black;">Thanks for Ordering From PetSpotter!!</h1>
    <h2>Your Order Id is: #{{ $mailData['order']->id }}</h2>

    @else
    <h1 style= "color: black;">You have recieved an order!!</h1>
    <h2>Order Id: #{{ $mailData['order']->id }}</h2>
    @endif
      

    
        <address style= "color: black;">
            <strong style= "color: black;">{{ $mailData['order']->first_name.' '.$mailData['order']->last_name  }}</strong><br>
            <h2 style= "color: black;">Shipping Address</h2>
            {{ $mailData['order']->address }}<br>
            {{ $mailData['order']->city }}, {{ $mailData['order']->zip }}, {{ getCountryInfo($mailData['order']->country_id)->name }}<br>
            Phone: {{ $mailData['order']->mobile }}<br>
            Email: {{ $mailData['order']->email }}
        </address>

    <h2 style= "color: black;">Products</h2>

    <table  cellpadding="3" cellspacing="3" border="0" width="700">
        <thead>
            <tr style="background: #CCC">
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>                                        
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mailData['order']->items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>Rs.{{ number_format($item->price,2) }}</td>                                        
                <td>{{ $item->qty }}</td>
                <td>Rs.{{ number_format($item->total,2) }}</td>
            </tr>
            @endforeach
            <tr>
                <th colspan="3" align="right">Subtotal:</th>
                <td>Rs.{{ number_format($mailData['order']->subtotal,2) }}</td>
            </tr>
            
            <tr>
                <th colspan="3" align="right">Shipping:</th>
                <td>Rs.{{ number_format($mailData['order']->shipping,2) }}</td>
            </tr>
            <tr>
                <th colspan="3" align="right">Grand Total:</th>
                <td>Rs.{{ number_format($mailData['order']->grand_total,2) }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>