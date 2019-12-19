@if (Session::has('success'))
    <script data-role="notification" data-type="success" type="text/html">
            {{ Session::get('success') }}
    </script>
@endif

@if (Session::has('errors'))
    <script data-role="notification" data-type="danger" type="text/html">
            {{ Session::get('errors')->first() }}
    </script>
@endif