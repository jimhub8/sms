<!doctype html>
<html lang="en">
{{--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  --}}

<head>
    <meta charset="UTF-8">
    <title>Call center</title>

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
                        <b>Client</b>: {{ $report->client }} <br>
                        <b>Date</b>:{{ ($report->start_date) }} to {{ $report->end_date }}<br>
                        <b>Comment</b>: {{ $report->comment }} <br>
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
                            <th>Status</th>
                            <th>Count</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($report->data as $key => $data)
                        {{-- @foreach ($data['data'] as $key => $value) --}}
                        <tr>
                            <td>{{ $data['status'] }}</td>
                            <td>{{ $data['count'] }}</td>
                            <td>{{ number_format((float)$data['count'] / $report['total_orders'] * 100, 2, '.', '') }}%
                            </td>
                            {{-- <td>{{ $data['count'] / $report['total_orders'] * 100 }}%</td> --}}
                        </tr>
                        {{-- @endforeach --}}
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="1"></td>
                            <td align="left">Total Orders</td>
                            <td align="left">{{ $report['total_orders'] }}</td>
                            {{-- <td align="left" class="gray">{{ $currency }} {{ $sale->sub_total }}</td> --}}
                        </tr>
                    </tfoot>
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
