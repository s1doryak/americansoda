<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Keräyslista</title>
    <style>
        html {
            font-size: 16px;
        }

        body {
            width: 27cm;
            margin: 1em auto;
            font: .8rem / 1.5rem 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        caption {
            margin-bottom: 1.5rem;
            font-size: 1.15rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        th {
            text-align: left;
            font-weight: normal;
        }

        th, td {
            padding: 0;
            vertical-align: middle;
        }

        small {
            display: block;
            line-height: 1.2em;
            font-size: .5rem;
            font-weight: normal;
        }

        .divider-thick {
            border-bottom: 4px solid #333;
        }

        .divider-thin {
            border-bottom: 2px solid #333;
        }

        .number {
            font-size: 1rem;
            font-weight: bold;
        }

        .border-left {
            padding-left: .15rem;
            border-left: 1px solid;
        }

        .border-bottom {
            border-bottom: 1px solid;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-left {
            text-align: left !important;
        }

        .text-upper {
            text-transform: uppercase;
        }

        .text-bold {
            font-weight: bold !important;
        }

        .table-50p td {
            width: 50%;
        }

        .table-50p3 td:nth-child(1) {
            width: 50%;
        }

        .products-table {
            width: 50%;
            float: left;
            margin-bottom: 20px;
        }

        .products-table th,
        .products-table td {
            padding: 0;
            line-height: 1.6em;
            font-size: 9px;
        }

        .products-table tbody tr:nth-of-type(odd) {
            background-color: #eee;
        }

        .products-table thead tr th,
        .products-table tfoot tr th {
            background-color: #666699;
            color: #fff;
            font-weight: bold;
        }

        .general-info-table {
            width: 40%;
            float: right;
            font-size: 11px;
            margin-bottom: 20px;
        }

        .comment-table {
            width: 40%;
            float: right;
            border-top: 2px solid;
            font-size: 11px;
            font-weight: bold;
        }

        .comment-table td {
            padding: 4px 0;
        }

        .assembly-items-table {
            font-size: 11px;
        }

        .assembly-items-table tr:nth-of-type(odd) {
            background-color: #eee;
        }

        .assembly-items-table th,
        .assembly-items-table td {
            padding: 0;
            line-height: 1.6em;
            font-size: 9px;
        }

        .assembly-items-table th {
            background-color: #666699;
            color: #fff;
            font-weight: bold;
        }

        .assembly-items-table .divider th {

        }
    </style>
</head>
<body>
<table class="products-table">
    <thead>
        <tr>
            <th class="text-upper text-bold">Product</th>
            <th class="text-center text-upper text-bold">Units</th>
            <th class="text-center text-upper text-bold">Packs</th>
            <th class="text-center text-upper text-bold">Products</th>
            <th class="text-upper text-bold">L-numbers</th>
        </tr>
    </thead>
    <tbody>

    @foreach($assemblyItems->groupBy(function($item) { return $item->product->name; }) as $productName => $items)

        <tr>
            <td class="text-upper">{{ $productName }}</td>
            <td class="text-center text-upper">{{ $items->sum('sales_unit_quantity') }}</td>
            <td class="text-center text-upper">{{ $items->sum('packages_quantity') }}</td>
            <td class="text-center text-upper">{{ $items->sum('products_quantity') }}</td>
            <td class="text-upper">{{ get_delivery_numbers($items) }}</td>
        </tr>

    @endforeach

    </tbody>
    <tfoot>
        <tr>
            <th class="text-upper text-bold">Total</th>
            <th class="text-center text-upper text-bold">{{ $assemblyItems->sum('sales_unit_quantity') }}</th>
            <th class="text-center text-upper text-bold">{{ $assemblyItems->sum('packages_quantity') }}</th>
            <th class="text-center text-upper text-bold">{{ $assemblyItems->sum('products_quantity') }}</th>
            <th class="text-upper text-bold"></th>
        </tr>
    </tfoot>
</table>
<table class="general-info-table">
    <tbody>
    <tr>
        <td class="number">{{ $assembly->number }}</td>
    </tr>
    <tr>
        <td>{{ $company->legal_name }} / {{ $company->name }}</td>
    </tr>
    <tr>
        <td>{{ $company->address }}</td>
    </tr>
    <tr>
        <td>Y-tunnus: {{ $company->bid }}</td>
    </tr>
    <tr>
        <td>Puh: {{ $company->phone }}</td>
    </tr>
    </tbody>
</table>
<table class="comment-table">
    <tbody>
    <tr>
        <td>HUOMAUTUKSET: {{ $assembly->comment }}</td>
    </tr>
    </tbody>
</table>
<table class="assembly-items-table">
    <tbody>
    <tr class="divider">
        <th colspan="7">&nbsp;</th>
    </tr>
    <tr>
        <th class="text-upper">SHIPMENT NUMBER</th>
        <th class="text-upper">TILAUSNUMERO</th>
        <th class="text-upper">JAKELUKOHDE</th>
        <th class="text-upper">ERÄNUMERO</th>
        <th class="text-upper">MAKU</th>
        <th class="text-upper">PAKATTUNA</th>
        <th class="text-upper">PAKKAUKSET</th>
    </tr>
    <tr class="divider">
        <th colspan="7">&nbsp;</th>
    </tr>

    @foreach($assemblyItems->groupBy(function($item) { return $item->customer->getKey(); }) as $items)

        @foreach($items as $item)
            <tr>
                <td class="text-upper">{{ $item->customerShipment->number }}</td>
                <td class="text-upper">{{ $item->customerOrder->number }}</td>
                <td class="text-upper">{{ $item->customerOrder->customer->name ?? null }}</td>
                <td class="text-upper">{{ $item->delivery_numbers }}</td>
                <td class="text-bold text-upper">{{ $item->product->name }}</td>
                <td class="text-center text-bold text-upper">
                    @if($item->customerShipment->packageType)
                    {{ $item->customerShipment->packageType->name }} &times; {{ $item->customerShipment->packages_quantity }}</td>
                @endif
                <td class="text-center text-bold text-upper">{{ $item->packages_quantity }}</td>
            </tr>
        @endforeach
        <tr class="divider">
            <th colspan="7">&nbsp;</th>
        </tr>
    @endforeach

    </tbody>
</table>
</body>
</html>
