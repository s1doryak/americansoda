@extends('dashboard::actions.create')

@section('modal-content')
    <div class="form-container">
        {!! form_start($form) !!}

        {!! form_rows($form, [
                'name',
                'product_barcode',
                'product_barcode_plaintext',
                'package_barcode',
                'package_barcode_plaintext',
                'product_image',
                'package_image',
                'description',
                'contents',
                'number_in_package',
                'weight',
                'volume',
                'brutto_weight',
                'brutto_volume',
                'unit_type',
                'deposit_enabled',
                'deposit_price',
                'deposit_vat',
                'deposit_vat_price',
              ]) !!}

        {!! form_rows($form, [
             'discount_price_enable'
         ]) !!}

        <div
            class="discount_price_enabled_fields collapse {{ isset($model) && is_object($model) && $model->discount_price ? 'in' : '' }}">
            {!! form_rows($form, [
            'discount_price',
            'displayed_text'
            ]) !!}
        </div>

        {!! form_rows($form, [
            'future_stock_movement_enable'
        ]) !!}

        <div
            class="future_stock_movement_enabled_fields collapse {{ isset($model) && is_object($model) && $model->future_stock_movement ? 'in' : '' }}">
            {!! form_rows($form, [
            'future_stock_movement',
            ]) !!}
        </div>

        {!! form_rows($form, [
            'new',
            'action',
            'comment',
            'brand',
            'packageType',
            'productGroup',
            'productTags',

        ]) !!}


        {!! form_end($form) !!}
    </div>
@stop
