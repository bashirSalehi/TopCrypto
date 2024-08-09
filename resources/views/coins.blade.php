<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width initial-scale=1">

    <title>Top 10 Coins</title>

    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
</head>
<body>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Coin Id</th>
        <th>Symbol</th>
        <th>Name</th>
        <th>Image</th>
        <th>Current Price</th>
        <th>Market Cap</th>
        <th>Rank</th>
        <th>Total Volume</th>
        <th>High 24h</th>
        <th>Low 24h</th>
        <th>Price Change 24h</th>
        <th>Update Time</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($coins as $coin)
        <tr>
            <td>{{ $coin->id }}</td>
            <td>{{ $coin->coin_id }}</td>
            <td>{{ $coin->symbol }}</td>
            <td>{{ $coin->name }}</td>
            <td class="img_box"><img class="coin_icon" src="{{ $coin->image }}"></td>
            <td>{{ $coin->current_price }}</td>
            <td>{{ $coin->market_cap }}</td>
            <td>{{ $coin->market_cap_rank }}</td>
            <td>{{ $coin->total_volume }}</td>
            <td>{{ $coin->high_24h }}</td>
            <td>{{ $coin->low_24h }}</td>
            <td>{{ $coin->price_change_24h }} ({{ $coin->price_change_percentage_24h }}%)</td>
            <td>{{ $coin->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="refresh">
    <button class="button" id="refreshButton">Refresh Data</button>
</div>
<script>
    document.getElementById('refreshButton').addEventListener('click', function () {
        fetch('/api/v1/fetch-manual-cryptocurrency-data')
            .then(response => response.json())
            .then(data => {
                location.reload();
            })
            .catch(error => console.error('Error:', error));
    });
</script>
</body>
</html>
