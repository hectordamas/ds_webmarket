@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ config('app.name') }} - Orden {{$order->id}}</title>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Detalles de la Orden</h5>
                <a href="{{ url('orders') }}" class="btn btn-primary">Lista de Órdenes</a>
            </div>
            <div class="card-block">
                @include('tenant.admin.orders.partials.detalle')
            </div>
        </div>
    </div>
</div>
@endsection
