<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Email</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: black;">
    <h1>Thank you for contributing for the welfare of pets.</h1>
    <h2>Your donation id is: #{{ $mailData['donation']->id }}</h2>

    <table  cellpadding="2" cellspacing="2" border="0" width="500">
        <tbody border="0">
            <tr>
                <td style="text-align:left;padding-left:10px;padding-right:30px;padding-bottom:10px;font-size:15px">Name: </td>
                <td style="color:#333238;font-weight:bold"><span style="font-size:15px">{{ $mailData['donation']->name }}</span></td>
            </tr>
            <tr>
                <td style="text-align:left;padding-left:10px;padding-right:30px;padding-bottom:10px;font-size:15px">Donation Id: </td>
                <td style="color:#333238;font-weight:bold"><span style="font-size:15px">#{{ $mailData['donation']->id }}</span></td>
            </tr>   
            <tr>
                <td style="text-align:left;padding-left:10px;padding-right:30px;padding-bottom:10px;font-size:15px">Donation Amount: </td>
                <td style="color:#333238;font-weight:bold"><span style="font-size:15px">Rs.{{ number_format($mailData['donation']->amount, 2) }}</td>
            </tr>  
            <tr>                                 
                <td style="text-align:left;padding-left:10px;padding-right:30px;padding-bottom:10px;font-size:15px">Donation Date: </td>
                <td style="color:#333238;font-weight:bold"><span style="font-size:15px">{{ \Carbon\Carbon::parse($mailData['donation']->created_at)->format('d M, Y') }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>