<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }
        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }
        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
    </style>
</head>
<body>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Reference</th>
                <th>Vehicle</th>
                <th>Buying</th>
                <th>Rate</th>
                <th>Price</th>
                <th>Clerk</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $duty)
                <tr>
                    <td>{{ $duty->reference }}</td>
                    <td>{{ $duty->vehicle_id }}</td>
                    <td>{{ $duty->amount }}</td>
                    <td>{{ $duty->percentage_rate }}</td>
                    <td>{{ $duty->total }}</td>
                    <td>{{ $duty->user_id }}</td>
                    <td>{{ $duty->created_at }}</td>
                </tr>
            @endforeach
            {{-- <tr class="active-row">
                <td>Melissa</td>
                <td>5150</td>
            </tr> --}}
            <!-- and so on... -->
        </tbody>
    </table>
</body>
</html>
