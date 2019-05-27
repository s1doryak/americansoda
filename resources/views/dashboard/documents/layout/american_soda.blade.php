<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        @yield('title')
    </title>
    <style>
        @font-face {
            font-family: viisaseanmatala;
            src: url('{{ env('APP_URL') }}/build/fonts/viisaseanmatala/viisaseanmatala.eot');
            src: url('{{ env('APP_URL') }}/build/fonts/viisaseanmatala/viisaseanmatala.eot?#iefix') format('embedded-opentype'),
            url('{{ env('APP_URL') }}/build/fonts/viisaseanmatala/viisaseanmatala.woff') format('woff'),
            url('{{ env('APP_URL') }}/build/fonts/viisaseanmatala/viisaseanmatala.ttf') format('truetype'),
            url('{{ env('APP_URL') }}/build/fonts/viisaseanmatala/viisaseanmatala.svg#icon') format('svg');
            font-weight: normal;
            font-style: normal;
        }

        html {
            font-size: 16px;
        }

        body {
            width: 21cm;
            margin: 1em auto;
            font: .8rem / 1.5rem 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        caption, .caption {
            margin-bottom: 1.5rem;
            font-size: 1.15rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        th {
            text-align: left;
            font-weight: normal;
            font-size: 1.5rem;
        }

        th, td {
            height: 1.25rem;
            padding: 0;
            vertical-align: middle;
        }

        small, .small {
            display: block;
            line-height: 1.2em;
            font-size: .5rem;
            font-weight: normal;
        }

        .logo {
            padding-bottom: 0.5cm;
        }

        .logo img {
            max-width: 4cm;
            height: auto;
        }

        .upper {
            text-transform: uppercase;
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
            text-align: right;
        }

        .transporter {
            vertical-align: middle;
            font-weight: bold;
        }

        .border-left {
            padding-left: .15rem;
            border-left: 2px solid;
        }

        .border-bottom {
            border-bottom: 2px solid;
        }

        .one-six td {
            width: 5.5rem;
            height: 5rem;
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

        .barcode {
            margin: .2em;
            font-family: viisaseanmatala;
            font-size: 3.2em;
        }

        .products-table tr.muted {
            color: #999;
        }

        .products-table td {
            font-size: .8em;
            line-height: 1.1;
            text-align: center;
        }

        .products-table td.price {
            padding-left: 4px;
            padding-right: 4px;
        }

        .incomterms {
            font-weight: bold;
        }

        .table-33p td {
            width: 33%;
        }

        .table-50p td {
            width: 50%;
        }

        .table-50p3 td:nth-child(1) {
            width: 50%;
        }
    </style>
</head>
<body>
@yield('content')
</body>
</html>