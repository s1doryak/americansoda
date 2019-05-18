@if (Session::has('success'))
    <script class="js-notification" type="text/html" data-type="success">
            {{ Session::get('success') }}
    </script>
@endif

@if (Session::has('errors'))
    <script class="js-notification" type="text/html" data-type="danger">
            {{ Session::get('errors')->first() }}
    </script>
@endif