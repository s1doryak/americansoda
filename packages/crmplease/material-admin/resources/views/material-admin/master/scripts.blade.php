@yield('pre-scripts')
<script src="{{ asset('vendor/material-admin/js/material-admin.js') }}?ver={{ config('app.version') }}"></script>
<script src="{{ asset(sprintf('vendor/material-admin/js/material-admin-%s.js', config('app.locale'))) }}?ver={{ config('app.version') }}"></script>
@yield('scripts')