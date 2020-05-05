@extends('dashboard::documents.layout.american_soda')
@section('title', 'Laskufaktura')
@section('content')
    <table class="table-33p">
        <tr>
            <td class="logo">
                <img src="{{ asset('/assets/dashboard/img/american_soda/logo_document.png') }}" alt="{{ $company->name }}">
            </td>
            <td class="caption text-center">
                Laskufaktura #{{ $invoice->invoice_nr }}
            </td>
            <td>
                <!-- ... -->
            </td>
        </tr>
    </table>
    <table class="table-50p3">
        <tbody class="divider-thick">
        <tr>
            <td>
                <small>Toimittaja</small>
            </td>
            <td>
                <small>Päivämäärä</small>
            </td>
            <td class="text-right">
                <small>Viitenumero</small>
            </td>
        </tr>
        <tr>
            <td class="upper">
                {{ $company->name }} / {{ $company->legal_name }}
            </td>
            <td>
                {{ $invoice->created_at->format('d.m.Y') }}
            </td>
            <td class="number">
                {{ $invoice->reference_nr }}
            </td>
        </tr>
        <tr>
            <td>
                {{ $company->address }}, {{ $company->postcode }} {{ $company->region->name }}
            </td>
            <td>
                <small>Toimittaja viite</small>
            </td>
            <td class="text-right">
                <small>Yhteensä</small>
            </td>
        </tr>
        <tr>
            <td>
                Y-tunnus: {{ $company->bid }}
            </td>
            <td>
                {{ $customer->user->name }}
            </td>
            <td class="text-right">
                {!! auto_number_format($totalVatPrice, 2, ',', '&nbsp;') !!} €
            </td>
        </tr>
{{--        <tr>--}}
{{--            <td>--}}

{{--            </td>--}}
{{--            <td>--}}
{{--                <small>Vastaanottajan viite</small>--}}
{{--            </td>--}}
{{--            <td>--}}

{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                {{ $invoice->batch_number }}--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <!-- ... -->--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <!-- ... -->--}}
{{--            </td>--}}
{{--        </tr>--}}
        </tbody>
    </table>
    <table class="table-50p">
        <tbody class="divider-thin">
        <tr>
            <td>
                <small>Tilaaja</small>
            </td>
            <td class="border-left">
                <small>Edunsaajan tilitiedot</small>
            </td>
        </tr>
        <tr>
            <td>
                {{ $customer->legal_name }}
            </td>
            <td class="border-left transporter">
                {{ $companyBankAccount->bank }}
            </td>
        </tr>
        <tr>
            <td>
                {{ $customer->name }}
            </td>
            <td class="border-left">
                {{ $companyBankAccount->account }}
            </td>
        </tr>
        <tr>
            <td>
                {{ $customer->billing_address }},
                {{ $customer->billing_postcode }}
                {{ $customer->billingRegion->name }}
            </td>
            <td class="border-left">
                {{ $companyBankAccount->iban }}
            </td>
        </tr>
        <tr>
            <td>
                Y-tunnus: {{ $customer->bid }}
            </td>
            <td class="border-left border-bottom">
                {{ $companyBankAccount->swift }}
            </td>
        </tr>
        </tbody>
    </table>
    <table class="products-table">
        <tbody class="divider-thin">
        <tr>
            <td class="text-left" colspan="2">
                <small>Nimike</small>
            </td>
            <td>
                <small>Yksiköitä</small>
            </td>
            <td>
                <small>Hinta yks.<br>(Veroton)</small>
            </td>
            <td>
                <small>Alv %</small>
            </td>
            <td>
                <small>Hinta yks.<br>(Verollinen)</small>
            </td>
            <td>
                <small>Yhteensä<br>(Veroton)</small>
            </td>
            <td>
                <small>Yhteensä<br>(Verollinen)</small>
            </td>
        </tr>
        <tr>
            <td colspan="8">
                <!-- ... -->
            </td>
        </tr>
        @foreach($invoiceItems as $item)
            @if($item->customerOrderItem)
                <tr class="{{ $item->customerOrderItem->expected_week || $item->customerOrderItem->back_order || $item->customerOrderItem->cancelled ? 'muted' : '' }}">
                    <td class="text-left" colspan="2">
                        <b>{{ $item->customerOrderItem->product_name }}</b>
                    </td>
                    <td>
                        <b>{{ $item->customerOrderItem->products_quantity }}</b>
                    </td>
                    <td class="price">
                        {!! auto_number_format($item->customerOrderItem->product_price, 4, ',', '&nbsp;') !!}
                    </td>
                    <td class="price">
                        {!! $item->customerOrderItem->vat !!}%
                    </td>
                    <td class="price">
                        {!! auto_number_format($item->customerOrderItem->product_vat_price, 2, ',', '&nbsp;') !!}
                    </td>
                    <td class="price">
                        {!! auto_number_format($item->customerOrderItem->total_price, 2, ',', '&nbsp;') !!}
                    </td>
                    <td class="price">
                        {!! auto_number_format($item->customerOrderItem->total_vat_price, 2, ',', '&nbsp;') !!}
                    </td>
                </tr>
            @else
                <tr class="">
                    <td class="text-left" colspan="2">
                        <b>{{ $item->subject }}</b>
                    </td>
                    <td>
                        <b>{{ $item->amount }}</b><br>{{ $item->unit_type }}
                    </td>
                    <td class="price">
                        {!! auto_number_format($item->price, 4, ',', '&nbsp;') !!}
                    </td>
                    <td class="price">
                        {!! $item->tax !!}%
                    </td>
                    <td class="price">
                        {!! auto_number_format($item->price_tax, 2, ',', '&nbsp;') !!}
                    </td>
                    <td class="price">
                        {!! auto_number_format($item->sum, 2, ',', '&nbsp;') !!}
                    </td>
                    <td class="price">
                        {!! auto_number_format($item->sum_tax, 2, ',', '&nbsp;') !!}
                    </td>
                </tr>
            @endif
        @endforeach
        <tr class="divider-thick">
            <td colspan="8">
                <!-- ... -->
            </td>
        </tr>
        </tbody>
        <tbody>
        <tr>
            <td colspan="3">
                <!-- ... -->
            </td>
            <td colspan="3">
                Veroton
            </td>
            <td colspan="2">
                {!! auto_number_format($totalPrice, 2, ',', '&nbsp;') !!} €
            </td>
        </tr>
        @foreach ($totalVats as $vat => $total)
            <tr>
                <td colspan="3">
                    <!-- ... -->
                </td>
                <td colspan="3">
                    Vero ALV {{ $vat }}%
                </td>
                <td colspan="2">
                    {!! auto_number_format($total, 2, ',', '&nbsp;') !!} €
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">
                <!-- ... -->
            </td>
            <td colspan="3">
                Yhteensä
            </td>
            <td colspan="2">
                {!! auto_number_format($totalVatPrice, 2, ',', '&nbsp;') !!} €
            </td>
        </tr>
        </tbody>
    </table>
    <table>
        <tbody>
        <tr>
            <td colspan="8">
                <small>Lisätiedot</small>
            </td>
        </tr>
        <tr>
            <td colspan="8">
                {!! $invoice->notes !!}
            </td>
        </tr>
        </tbody>
    </table>
@stop
