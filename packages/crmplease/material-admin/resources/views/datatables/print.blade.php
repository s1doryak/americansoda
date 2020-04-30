<!DOCTYPE html>
<html lang="en">
<head>
    <title>Print Table</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="http://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        body {
            margin: 20px
        }
    </style>
</head>
<body>
<table class="table table-bordered table-condensed table-striped">
    @foreach($data as $idx => $row)
        @if (!$idx)
            <tr>
                @foreach($row as $key => $value)
                    <th>{!! $key !!}</th>
                @endforeach
            </tr>
        @endif
        <tr>
            @foreach($row as $key => $value)
                @if(is_string($value) || is_numeric($value))
                    <td>{!! $value !!}</td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
    @endforeach
</table>
</body>
</html>
