<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transport Sheet</title>
    <style>
        @set($font = 'idautomationshbc128m')
        @font-face {
            font-family: barcode;
            src: url('{{ env('APP_URL') }}/build/fonts/{{ $font }}/{{ $font }}.eot');
            src: url('{{ env('APP_URL') }}/build/fonts/{{ $font }}/{{ $font }}.eot?#iefix') format('embedded-opentype'),
            url('{{ env('APP_URL') }}/build/fonts/{{ $font }}/{{ $font }}.woff') format('woff'),
            url('{{ env('APP_URL') }}/build/fonts/{{ $font }}/{{ $font }}.ttf') format('truetype'),
            url('{{ env('APP_URL') }}/build/fonts/{{ $font }}/{{ $font }}.svg#icon') format('svg');
            font-weight: normal;
            font-style: normal;
        }

        * { box-sizing: border-box; }
        html { font-size: 15pt; }
        body {
            font: 1rem / 1.5rem 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
        }

        table {
            width: 18.2cm;
            margin: auto;
            border: 3px solid;
            border-collapse: collapse;
        }

        td {
            padding: .25cm 1cm;
            border-bottom: 1px solid;
        }

        .more-padding {
            padding-top: .5cm;
            padding-bottom: .5cm;
        }

        .no-border-bottom { border-bottom: 0; }
        .center {
            display: block;
            text-align: center;
        }

        .barcode-row.large td { padding-top: 2em; }
        .barcode {
            position: relative;
            padding-top: .5em;
            font-family: barcode;
            line-height: 2;
            text-align: center;
        }

        .barcode.first { margin-top: 1em; }
        .barcode.second {
            padding-top: 2.5em;
            font-size: 24pt;
        }

        .sscc {
            float: left;
            margin-left: 1em;
            font-family: monospace;
            text-align: center;
            font-size: 28pt;
            line-height: 1.2;
        }
    </style>
</head>
<body>
<table>
    <tbody>
    <tr>
        <td colspan="2">
            LÄHETTÄJÄ:<br>
            <b>{{ $company->legal_name }}</b><br>
            <b>{{ $company->address }}</b><br>
            <b>{{ $company->postcode }} {{ $company->region->name }}</b><br>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div class="center">
                <b class="uppercase">{{ $sheet->product_name }}</b><br>
                {{ $sheet->package_type }} x {{ $sheet->product_volume }} ml
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            SSCC:<br>
            <b class="center">{{ $sheet->number }}</b>
        </td>
    </tr>
    <tr>
        <td class="more-padding">
            GTIN:<br><br>
            <b>{{ $sheet->product_barcode }}</b>
        </td>
        <td class="more-padding">
            <div class="center">
                MYYNTIERIÄ:<br><br>
                <b>{{ $sheet->product_sales_unit_quantity }}</b>
            </div>
        </td>
    </tr>
    <tr>
        <td class="more-padding">
            PARASTA ENNEN:<br><br>
            <b>{{ $sheet->formatted_product_expire_date }}</b>
        </td>
        <td class="more-padding">
            <div class="center">
                ERÄNUMERO:<br><br>
                <b>{{ $sheet->order_number }}</b>
            </div>
        </td>
    </tr>
    <tr class="barcode-row">
        <td colspan="2" class="no-border-bottom">
            <div class="barcode first">{{ $sheet->long_barcode }}</div>
        </td>
    </tr>
    <tr class="barcode-row large">
        <td colspan="2">
            <div class="sscc">S<br>S<br>C<br>C</div>
            <div class="barcode second">{{ $sheet->short_barcode }}</div>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>