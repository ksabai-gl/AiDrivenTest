@extends('admin.layouts.dashboard')
@section('content')
<?php
function formatMoney($amount)
{
    $formatter = new NumberFormatter(
        env('APP_CURRENCY_LOCALE'),
        NumberFormatter::CURRENCY
    );
    return $formatter->formatCurrency(floatval($amount), env('APP_CURRENCY'));
}
?>
<!-- ACTION BAR -->
<div class="container my-3 no-print">
    <div class="d-flex justify-content-between align-items-center">
        
        <!-- Language select -->
        <select class="form-select w-auto" onchange="window.invoiceinpdf?.changeLanguage(this.value)">
            <option {{$lang === 'vi' ? 'selected' : ''}} value="vi">🇻🇳 Tiếng Việt</option>
            <option {{$lang === 'en' ? 'selected' : ''}} value="en">🇬🇧 English</option>
            <option {{$lang === 'ja' ? 'selected' : ''}} value="ja">🇯🇵 日本語</option>
        </select>

        <!-- Print button -->
        <button class="btn btn-outline-secondary" onclick="window.print()">
            🖨️ {{ __('invoiceinpdf::messages.print') }}
        </button>

    </div>
</div>


<div class="invoice-box container">

    <!-- HEADER -->
    <div class="row mb-4">
        <div class="col-6">
            <h3 class="fw-bold mb-1 h5">{{__("invoiceinpdf::messages.title")}}</h3>
            <div class="muted">{{__("invoiceinpdf::messages.document_no")}} #: <strong>{{$purchase->document_no}}</strong></div>
            <div class="muted">{{__("invoiceinpdf::messages.invoice_date")}}: {{$purchase->invoice_date}}</div>
            <div class="muted">{{__("invoiceinpdf::messages.due_date")}}: {{$purchase->due_date}}</div>
        </div>
        <div class="col-6 text-end">
            <h5 class="fw-bold">{{$purchase->unit_name}}</h5>
            <div>{{$purchase->address}}</div>
            <div class="mt-2">{{$purchase->email}}</div>
        </div>
    </div>

    <!-- BILL TO -->
    <div class="row mb-4">
        <div class="col-6">
            
        </div>
        <div class="col-6 text-end">
            <h6 class="fw-bold">{{__("invoiceinpdf::messages.payment")}}</h6>
            <div>{{__("invoiceinpdf::messages.amount_paid")}}: {{formatMoney($purchase->amount_paid)}}</div>
            <div>{{__("invoiceinpdf::messages.payment_status")}}: {{$purchase->payment_status}}</div>
        </div>
    </div>

    <!-- ITEMS -->
    <table class="table table-bordered mb-4">
        <thead class="table-light">
        <tr class="text-center">
            <th style="width:5%">#</th>
            <th class="text-start">{{__("invoiceinpdf::messages.name")}}</th>
            <th style="width:10%">{{__("invoiceinpdf::messages.buy")}}</th>
            <th style="width:10%">{{__("invoiceinpdf::messages.gift")}}</th>
            <th style="width:10%">{{__("invoiceinpdf::messages.compensation")}}</th>
            <th style="width:10%">{{__("invoiceinpdf::messages.conversion")}}</th>
            <th style="width:15%">{{__("invoiceinpdf::messages.unit_cost")}}</th>
            <th style="width:15%">{{__("invoiceinpdf::messages.amount")}}</th>
            <th style="width:15%">{{__("invoiceinpdf::messages.tax")}}(%)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $key => $value )
        <tr>
            <td class="text-center">{{$value->id}}</td>
            <td>{{$value->name}}</td>
            <td class="text-end">{{$value->buy_quantity}}</td>
            <td class="text-end">{{$value->gift_quantity}}</td>
            <td class="text-end">{{$value->compensation_quantity}}</td>
            <td class="text-end">{{$value->conversion_quantity}}</td>
            <td class="text-end">{{formatMoney($value->unit_cost)}}</td>
            <td class="text-end">{{formatMoney($value->unit_cost * $value->buy_quantity)}}</td>
            <td class="text-end">{{$value->tax}}%</td>
        </tr>
        @endforeach 
        </tbody>
    </table>

    <!-- TOTALS -->
    <div class="row">
        <div class="col-6">
            <h6 class="fw-bold">{{__("invoiceinpdf::messages.note")}}</h6>
            <p class="muted mb-1">
                {{$purchase->note}}
            </p>
        </div>

        <div class="col-6">
            <table class="table table-sm">
                <tr>
                    <td>{{__("invoiceinpdf::messages.subtotal")}}</td>
                    <td class="text-end">{{formatMoney($purchase->subtotal)}}</td>
                </tr>
                <tr>
                    <td>{{__("invoiceinpdf::messages.tax")}}</td>
                    <td class="text-end">{{formatMoney($purchase->tax)}}</td>
                </tr>
                <tr>
                    <td>{{__("invoiceinpdf::messages.shipping_fee")}}</td>
                    <td class="text-end">{{formatMoney($purchase->shipping_fee)}}</td>
                </tr>
                <tr class="fw-bold">
                    <td>{{__("invoiceinpdf::messages.total")}}</td>
                    <td class="text-end">{{formatMoney($purchase->total)}}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="text-center mt-5 muted">
        {{__("invoiceinpdf::messages.footer")}}
        
    </div>

</div>

@endsection 