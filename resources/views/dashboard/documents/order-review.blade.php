@extends('dashboard::documents.layout.american_soda')
@section('title', 'Tilausvahvistus')
@section('content')
    <table class="table-33p">
        <tr>
            <td class="logo">
                <img src="{{ asset('assets/dashboard/img/american_soda/logo_document.png') }}">
            </td>
            @if($hasNegativeItems)
                <td class="caption text-center">Hyvityslasku</td>
            @else
                <td class="caption text-center">Tilausvahvistus</td>
            @endif
            <td></td>
        </tr>
    </table>
    <table class="table-50p3">
        <tbody class="divider-thick">
        <tr>
            <td><small>Toimittaja</small></td>
            <td><small>Päivämäärä</small></td>
            <td class="text-right"><small>Tilausnumero</small></td>
        </tr>
        <tr>
            <td class="upper">{{ $company->name }} / {{ $company->legal_name }}</td>
            <td>{{ $order->created_at->format('d.m.Y') }}</td>
            <td class="number">{{ $order->number }}</td>
        </tr>
        <tr>
            <td>{{ $company->address }}</td>
            <td colspan="2"><small>Toimittaja viite</small></td>
        </tr>
        <tr>
            <td>{{ $company->postcode }} {{ $company->region->name }}</td>
            <td colspan="2">{{ $customer->user->name }}</td>
        </tr>
        <tr>
            <td rowspan="2">Y-tunnus: {{ $company->bid }}</td>
            <td colspan="2"><small>Vastaanottajan viite</small></td>
        </tr>
        <tr>
            <td colspan="2">{{ $order->batch_number }}</td>
        </tr>
        </tbody>
    </table>
    <table class="table-50p">
        <tbody class="divider-thin">
        <tr>
            <td><small>Tilaaja</small></td>
            <td class="border-left"><small>Rahdinkuljettaja ja/tai Huolitsija</small></td>
        </tr>
        <tr>
            <td>{{ $customer->legal_name }}</td>
            <td class="border-left transporter">{{ $company->name }} / {{ $company->legal_name }}</td>
        </tr>
        <tr>
            <td><b class="upper">{{ $customer->name }}</b></td>
            <td class="border-left">Puh. <b>{{ $company->phone }}</b> Toimisto</td>
        </tr>
        <tr>
            <td>
                {{ $customer->billing_address }},
                {{ $customer->billing_postcode }}
                {{ $customer->billingRegion->name }}
            </td>
            <td class="border-left">Puh. <b>{{ $customer->user->phone }}</b> Myyjä</td>
        </tr>
        <tr>
            <td>Y-tunnus: {{ $customer->bid }}</td>
            <td class="border-left border-bottom">S-posti: {{ $customer->user->email }}</td>
        </tr>
        <tr>
            <td><small>Tavaran toimitusosoite</small></td>
            <td class="border-left"><small>Maksuehto</small></td>
        </tr>
        <tr>
            <td>
                {{ $customer->shipping_address }},
                {{ $customer->shipping_postcode }}
                {{ $customer->shippingRegion->name }}
            </td>
            <td class="border-left">{{ $customer->payment_conditions }}</td>
        </tr>
        </tbody>
        <tbody class="divider-thin">
        <tr>
            <td><small>Lähtö-ja lastauspaikka</small></td>
            <td class="border-left"><small>Toimituslauseke</small></td>
        </tr>
        <tr>
            <td>
                {{ $customer->stock->address }},
                {{ $customer->stock->postcode }}
                {{ $customer->stock->region->name }}
            </td>
            <td class="border-left incomterms">{{ $customer->incomterms }}</td>
        </tr>
        <tr>
            <td><small>Määräpaikka</small></td>
            <td class="border-left"><small>Rahdinmaksaja</small></td>
        </tr>
        <tr>
            <td>
                {{ $customer->shipping_address }},
                {{ $customer->shipping_postcode }}
                {{ $customer->shippingRegion->name }}
            </td>
            <td class="border-left">{{ $customer->delivery_payer }}</td>
        </tr>
        </tbody>
    </table>
    <table class="products-table">
        <tbody class="divider-thin">
        <tr>
            <td><small>Jälkitoimitus</small></td>
            <td><small>Pakkauksia</small></td>
            <td colspan="2"><small>Nimike</small></td>
            <td><small>Yksiköitä</small></td>
            <td><small>Paino yht. (kg)</small></td>
            <td><small>Hinta yks.<br>(Veroton)</small></td>
            <td><small>Alv %</small></td>
            <td><small>Hinta yks.<br>(Verollinen)</small></td>
            <td><small>Yhteensä<br>(Veroton)</small></td>
            <td><small>Yhteensä<br>(Verollinen)</small></td>
        </tr>
        <tr>
            <td colspan="11"></td>
        </tr>
        @foreach($orderItems as $item)
            <tr class="{{ $item->expected_week || $item->back_order || $item->cancelled ? 'muted' : '' }}">
                <td>
                    @if($item->cancelled)
                        {{ sprintf('cancelled') }}
                    @else
                        @if($item->back_order)
                            @if($item->expected_week)
                                {{ sprintf('vko %s', $item->expected_week) }}
                            @else
                                {{ sprintf('backorder') }}
                            @endif
                        @endif
                    @endif
                </td>
                <td class="text-center">
                    <b>{{ $item->packages_quantity }}</b><br>{{ $item->product->packageType->name }}
                </td>
                <td colspan="2"><b>{{ $item->product_name }}</b></td>
                <td><b>{{ $item->products_quantity }}</b></td>
                <td>{!! auto_number_format($item->product->brutto_weight * $item->packages_quantity, 2, ',', '&nbsp;') !!}</td>
                <td class="price">{!! auto_number_format($item->product_price, 4, ',', '&nbsp;') !!}</td>
                <td class="price">{{ $item->vat }}%</td>
                <td class="price">{!! auto_number_format($item->product_vat_price, 2, ',', '&nbsp;') !!}</td>
                <td class="price">{!! auto_number_format($item->total_price, 2, ',', '&nbsp;') !!}</td>
                <td class="price">{!! auto_number_format($item->total_vat_price, 2, ',', '&nbsp;') !!}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="11"></td>
        </tr>
        @foreach($totalDeposits as $depositVat => $depositGrouped)
            @foreach($depositGrouped as $depositPrice => $deposit)
                <tr>
                    <td></td>
                    <td class="text-center">&ndash;</td>
                    <td colspan="2"><b>PANTTI &times; {{ $deposit->sum('products_quantity') }}</b></td>
                    <td class="text-center"></td>
                    <td class="text-center">&ndash;</td>
                    <td class="price">{!! auto_number_format($deposit->first()->deposit_price, 4, ',', '&nbsp;') !!}</td>
                    <td class="price">{{ $deposit->first()->deposit_vat }}%</td>
                    <td class="price">{!! auto_number_format($deposit->first()->deposit_vat_price, 4, ',', '&nbsp;') !!}</td>
                    <td class="price">{!! auto_number_format($deposit->sum('deposit_total_price'), 4, ',', '&nbsp;') !!}</td>
                    <td class="price">{!! auto_number_format($deposit->sum('deposit_total_vat_price'), 2, ',', '&nbsp;') !!}</td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
        <tbody>
        <tr>
            <td></td>
            <td class="border-left"><small>Pakkauksia yht.</small></td>
            <td colspan="2" class="border-left"></td>
            <td class="border-left"><small>Yksiköitä yht.</small></td>
            <td class="border-left"><small>Paino yht. (kg)</small></td>
            <td colspan="3" class="border-left"></td>
            <td colspan="2"><small>ALV 0% Veroton</small></td>
        </tr>
        <tr class="divider-thick">
            <td></td>
            <td class="border-left">{{ $orderItems->sum('packages_quantity') }}</td>
            <td colspan="2" class="border-left"></td>
            <td class="border-left">{{ $orderItems->sum('products_quantity')  }}</td>
            <td class="border-left">
                {!! auto_number_format($orderItems->sum(function($item) { return $item->product->brutto_weight * $item->packages_quantity; }), 2, ',', '&nbsp;') !!}
            </td>
            <td colspan="3" class="border-left"></td>
            <td colspan="2">{!! auto_number_format($totalPrice, 2, ',', '&nbsp;') !!} €</td>
        </tr>
        @foreach ($totalVats as $vat => $total)
            <tr>
                <td colspan="6"></td>
                <td colspan="3"><small>Vero ALV {{ $vat }}%</small></td>
                <td colspan="2">{!! auto_number_format($total, 2, ',', '&nbsp;') !!} €</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" rowspan="4"></td>
            <td colspan="3"><small>Yhteensä</small></td>
            <td colspan="2">{!! auto_number_format($totalVatPrice, 2, ',', '&nbsp;') !!} €</td>
        </tr>
        </tbody>
    </table>
    <table>
        <tbody class="divider-thin">
        <tr>
            <td colspan="11"><small>Lisätiedot</small></td>
        </tr>
        <tr>
            <td colspan="11">{!! $order->comment !!}</td>
        </tr>
        </tbody>
    </table>
@stop
