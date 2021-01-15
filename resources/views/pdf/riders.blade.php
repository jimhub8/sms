<!doctype html>
<html lang="en">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<head>
    <meta charset="UTF-8">
    <title>Riders</title>

    <style type="text/css">
        @page {
            margin: 20px;
        }

        body {
            margin: 0px;
            background: #f8fafc;
        }

        * {
            font-family: Verdana, Arial, sans-serif;
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .invoice table {
            margin: 15px;
        }

        .invoice h3 {
            margin-left: 15px;
        }


        .information .logo {
            margin: 5px;
        }

        .information table {
            padding: 10px;
        }

        .page-break {
            page-break-after: always;
        }

        .table thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }

        .table tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        .table tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }

        .page-break {
            page-break-after: always;
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        th {
            text-align: inherit;
        }
    </style>

</head>

<body>
    {{-- {{ dd($report) }} --}}
    <div class="page-break">
        <div class="information">
            <table width="100%">
                <tr>
                    <td align="left">
                        <img src="http://mftfulfillmentcentre.com/images/logo.png" alt=""
                            style="width: 200px; height: 120px">
                    </td>
                    <td align="" style="width: 40%;">
                        <h3>Report</h3>
                        <b>Rider</b>: {{ $request_data['rider'] }} <br>
                        <b>Date</b>:{{ ($request_data['start_date']) }} to {{ $request_data['end_date'] }}<br>
                        {{-- <b>Comment</b>: {{ $data->comment }} <br> --}}
                        {{-- <b>Phone</b>: {{ $sale->client->phone }} --}}
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <div class="invoice">
                <table width="100%" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Total Orders</th>
                            <th>Delivered</th>
                            <th>Returned</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($report as $key => $data)
                        {{-- @foreach ($data['data'] as $key => $value) --}}
                        <tr>
                            <td> {{ $data['date'] }} </td>
                            <td> {{ $data['total_orders'] }} </td>
                            <td>
                                {{ $data['delivered'] }}
                                <span class="badge bg-primary" style="color: #fff;margin-top: 3px;font-size: 10px">{{ number_format((float) $data['delivered'] / $data['total_orders'] * 100) }}% </span>
                            </td>
                            <td>
                                {{ $data['returned'] }}
                                <span class="badge bg-primary" style="color: #fff;margin-top: 3px;font-size: 10px">{{ number_format((float) $data['returned'] / $data['total_orders'] * 100) }}% </span>
                                </td>
                            <td> {{ $data['comment'] }} </td>
                        </tr>
                        {{-- @endforeach --}}
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="information" style="position: absolute; bottom: 0;">
                <table width="100%">
                    <tr>
                        <td align="left" style="width: 50%;">
                            &copy; {{ date('Y') }} <a href="http://mftfulfillmentcentre.com"
                                style="color: rgb(9, 9, 61)">
                                MFT</a> - All rights reserved.
                        </td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</body>

</html>
