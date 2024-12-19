<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usage Logs Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header img {
            margin-bottom: 10px;
        }

        header h1 {
            margin: 0;
            font-size: 16px;
        }

        header p {
            margin: 5px 0;
            font-size: 12px;
        }

        .line {
            border-bottom: 2px solid #000;
            margin: 3px 0;
        }

        .lineKecil {
            border-bottom: 1px solid #1a57a7;
        }

        .date {
            text-align: right;
            font-size: 12px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            padding: 8px;
            font-size: 12px;
            border: 1px solid #bbc7d4;
        }

        table th {
            background-color: #205fa3; /* Biru tua untuk header */
            color: white; /* Teks putih pada header */
            text-align: left;
        }

        table td {
            text-align: left;
        }

        table tr:nth-child(even) td {
            background-color: #f0f9ff; /* Biru muda pada baris genap */
        }

        table tr:nth-child(odd) td {
            background-color: white; /* Putih pada baris ganjil */
        }
    </style>
</head>
<body>
    <header>
        <img src="assets/img/kop.png" alt="Logo">
        <br>
        <h1>Sekawan Vehicle</h1>
        <p>Jl. Raya Sekawan No. 1, Pegunungan Ancol, Ancol Timur</p>
        <p>Telepon: 08xxx xxxx xxxx</p>
        <div class="line"></div>
        <div class="lineKecil"></div>
    </header>

    <div class="date">
        <p>Pegunungan Ancol, {{ now()->format('d-m-Y') }}</p>
    </div>

    <h2 style="text-align: center;">Vehicle Usage Report</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Vehicle Name</th>
                <th>Plate Number</th>
                <th>Booking ID</th>
                <th>Start Point</th>
                <th>End Point</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Distance (KM)</th>
                <th>Fuel Used(Liter)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $key => $report)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $report->vehicle->name }}</td>
                    <td>{{ $report->vehicle->plate_number }}</td>
                    <td>{{ $report->booking_id }}</td>
                    <td>{{ $report->start_point }}</td>
                    <td>{{ $report->end_point }}</td>
                    <td>{{ \Carbon\Carbon::parse($report->start_date)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($report->end_date)->format('d-m-Y') }}</td>
                    <td>{{ $report->distance_km }}</td>
                    <td>{{ $report->fuel_used }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
