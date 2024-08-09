<!DOCTYPE html>
<html>
<head>
    <title>Coin Price Changed</title>
</head>
<body>
@if($emailData['priceChangeType'] == 'increase')
    <p>The price of {{ $emailData['coin']->name }} has increased by {{ $emailData['priceChangePercentage'] }}%</p>
@else
    <p>The price of {{ $emailData['coin']->name }} has decreased by {{ $emailData['priceChangePercentage'] }}%</p>
@endif
</body>
</html>
