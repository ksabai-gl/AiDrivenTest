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

<div class="container p-4">
    <div class="d-flex justify-content-between align-items-center">
        <a href="/dashboard">{{ __('debt::message.back_dashboard') }}</a>
        <div class="dropdown">
                <button
                    class="btn btn-sm btn-outline-secondary dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    🌐 {{ strtoupper(app()->getLocale()) }}
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{route('debt.overview',['lang' => 'vi'])}}">
                            🇻🇳 Tiếng Việt
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{route('debt.overview',['lang' => 'en'])}}">
                            🇺🇸 English
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{route('debt.overview',['lang' => 'ja'])}}">
                            🇯🇵 日本語
                        </a>
                    </li>
                </ul>
            </div>
    </div>

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <h3 class="fw-bold">
            <i class="bi bi-pie-chart-fill text-primary"></i>
            {{ __('debt::message.title') }}
        </h3>
    </div>

    <p>{{ __('debt::message.debt_desc') }}</p>

    <!-- STATISTIC -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card border-primary shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">
                        {{ __('debt::message.total_received') }}
                    </h6>
                    <h4 class="fw-bold text-primary">
                        {{ formatMoney($received->total_paid) }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card border-danger shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">
                        {{ __('debt::message.outstanding_receivables') }}
                    </h6>
                    <h4 class="fw-bold text-danger">
                        {{ formatMoney($outstandingReceivables->total_partial_payment) }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card border-success shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">
                        {{ __('debt::message.disbursed') }}
                    </h6>
                    <h4 class="fw-bold text-success">
                        {{ formatMoney($disbursed->total_paid) }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card border-danger shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">
                        {{ __('debt::message.outstanding_payables') }}
                    </h6>
                    <h4 class="fw-bold text-danger">
                        {{ formatMoney($outstandingPayables->total_partial_payment) }}
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!-- TABS -->
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#customer">
                {{ __('debt::message.customer_debts') }}
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#supplier">
                {{ __('debt::message.supplier_debts') }}
            </button>
        </li>
    </ul>

    <div class="tab-content">

        <!-- CUSTOMER DEBT -->
        <div class="tab-pane fade show active" id="customer">
            <div class="card shadow-sm">
                <div class="card-body">

                    @if(count($customer_debt) == false)
                    <div class="text-center">
                        <h4 class="text-uppercase text-success">
                            {{ __('debt::message.no_debt') }}
                        </h4>
                        <i class="bi bi-balloon-heart-fill text-danger"></i>
                    </div>
                    @else
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('debt::message.customer') }}</th>
                                <th>{{ __('debt::message.invoice_no') }}</th>
                                <th>{{ __('debt::message.total') }}</th>
                                <th>{{ __('debt::message.amount_paid') }}</th>
                                <th>{{ __('debt::message.debt') }}</th>
                                <th>{{ __('debt::message.due_date') }}</th>
                                <th>{{ __('debt::message.status') }}</th>
                                <th class="text-end">{{ __('debt::message.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customer_debt as $value)
                            <tr>
                                <td>{{ $value->customer_name }}</td>
                                <td>{{ $value->document_no }}</td>
                                <td class="fw-bold text-primary">
                                    {{ formatMoney($value->total) }}
                                </td>
                                <td class="fw-bold text-success">
                                    {{ formatMoney($value->amount_paid) }}
                                </td>
                                <td class="fw-bold text-danger">
                                    {{ formatMoney($value->total - $value->amount_paid) }}
                                </td>
                                <td>{{ $value->due_date }}</td>
                                <td>
                                    <span class="badge bg-warning text-secondary">
                                        {{ __('debt::message.' . $value->payment_status) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a
                                        href="/dashboard/invoices?form=invoiceout&id={{ $value->id }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary">
                                        {{ __('debt::message.details') }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $customer_debt->links() }}
                    @endif

                </div>
            </div>
        </div>

        <!-- SUPPLIER DEBT -->
        <div class="tab-pane fade" id="supplier">
            <div class="card shadow-sm">
                <div class="card-body">

                    @if(count($supplierDebt) == false)
                    <div class="text-center">
                        <h4 class="text-uppercase text-success">
                            {{ __('debt::message.no_debt') }}
                        </h4>
                        <i class="bi bi-balloon-heart-fill text-danger"></i>
                    </div>
                    @else
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('debt::message.supplier') }}</th>
                                <th>{{ __('debt::message.document_no') }}</th>
                                <th>{{ __('debt::message.total') }}</th>
                                <th>{{ __('debt::message.amount_paid') }}</th>
                                <th>{{ __('debt::message.debt') }}</th>
                                <th>{{ __('debt::message.due_date') }}</th>
                                <th>{{ __('debt::message.status') }}</th>
                                <th class="text-end">{{ __('debt::message.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($supplierDebt as $value)
                            <tr>
                                <td>{{ $value->supplier_name }}</td>
                                <td>{{ $value->document_no }}</td>
                                <td class="fw-bold text-danger">
                                    {{ formatMoney($value->total) }}
                                </td>
                                <td class="fw-bold text-success">
                                    {{ formatMoney($value->amount_paid) }}
                                </td>
                                <td class="fw-bold text-danger">
                                    {{ formatMoney($value->total - $value->amount_paid) }}
                                </td>
                                <td>{{ $value->due_date }}</td>
                                <td>
                                    <span class="badge bg-warning text-secondary">
                                        {{ __('debt::message.' . $value->payment_status) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a
                                        href="/dashboard/invoices?form=invoiceout&id={{ $value->id }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary">
                                        {{ __('debt::message.details') }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $supplierDebt->links() }}
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>

@endsection