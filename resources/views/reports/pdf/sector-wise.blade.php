<!DOCTYPE html>
<html>
<head>
    <title>Sector-wise Equity Report</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        h4 { text-align: center; }
    </style>
</head>
<body>
<h4>Sector-wise Equity Report</h4>
<table>
    <thead>
    <tr>
        <th>Sector</th>
        <th>Total Investment</th>
        <th>Total Holdings</th>
    </tr>
    </thead>
    <tbody>
    @foreach($report as $row)
        <tr>
            <td>{{ $row->sector }}</td>
            <td>{{ number_format($row->total_investment, 2) }}</td>
            <td>{{ $row->total_holdings }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
