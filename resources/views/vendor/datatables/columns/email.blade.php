@if($email)
    {!! sprintf('<a href="mailto:%s" target="_blank">%s</a>', $email, $email) !!}
@endif
