<!DOCTYPE html>
<html>
<head>
    <title>Client-wise Report PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #444;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>
<body>
<h3>Client-wise Equity Report</h3>
<table>
    <thead>
    <tr>
        <th>Client Name</th>
        <th>Client Email</th>
        <th>Client Phone</th>
        <th>Sector</th>
        <th>Total Investment</th>
        <th>Current Value</th>
        <th>Total Holdings</th>
    </tr>
    </thead>
    <tbody>
    @foreach($report as $row)
        <tr>
            <td>{{ $row['client_name'] }}</td>
            <td>{{ $row['client_email'] }}</td>
            <td>{{ $row['client_phone'] }}</td>
            <td>{{ $row['sector'] }}</td>
            <td>{{ number_format($row['total_investment'], 2) }}</td>
            <td>{{ number_format($row['current_value'], 2) }}</td>
            <td>{{ $row['total_holdings'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
