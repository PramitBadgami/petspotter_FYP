<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
</head>
<body>

    

    @if($mailData['verification']->user->status == 'Verified')
    <h2>You have been verified successfully. Now you can adopt any pet as you please.</h2>
    @elseif($mailData['verification']->user->status == 'Rejected')
    <h2>Your form has been rejected for some reason. Please revise the form with correct details.</h2>
    @endif

    <h3>Thanks for submitting verification form</h3>
</body>
</html>