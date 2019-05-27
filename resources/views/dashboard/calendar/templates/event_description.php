<script data-template="event-description" type="text/x-handlebars-template">
    {{#if editable}}
    {{#with description}}
    <p><u>Previous</u> order: <a href="{{ order_url }}" target="_blank">{{ order_number }}</a></p>
    {{/with}}
    {{else}}
    {{#with description}}
    <p>Order: <a href="{{ order_url }}" target="_blank">{{ order_number }}</a></p>
    <p>Status: {{ order_status }}</p>
    {{/with}}
    {{/if}}
    <hr>
    {{#with description}}
    <p>Customer: <a href="{{ customer_url }}" target="_blank">{{ customer_name }}</a></p>
    <p>Address: {{ customer_address }}</p>
    <p>Phone: {{ customer_phone }}</p>
    <p>E-mail: <a href="mailto:{{ customer_email }}" target="_blank">{{ customer_email }}</a></p>
    {{/with}}
</script>