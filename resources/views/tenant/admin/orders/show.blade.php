@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ env('APP_NAME') }} - Orden #{{ $order->id }}</title>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="col-sm-12">
            <!-- Shopping cart start -->
            <div class="card">
                <div class="card-header">
                    <h5>Orden #{{ $order->id }}</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Datos del Cliente</h5>
                            <hr>
                        </div>
                        <div class="col-md-6 mb-3">
                            <ul>
                                <li><strong>Nombre:</strong> {{ $order->nombre }}</li>
                                <li><strong>Cédula:</strong> {{ $order->cedula }}</li>
                                <li><strong>Teléfono:</strong> +58 {{ $order->telefono }}</li>
                                <li><strong>Dirección:</strong> {{ $order->direccion }}</li>
                                <li>{{ $order->detalle_direccion }}</li>

                            </ul>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5></h5>
                            <ul>
                                <li><strong>Tipo de Pedido:</strong> {{ $order->tipo_pedido }}</li>
                                <li><strong>Método de Pago:</strong> {{ $order->metodo_pago }}</li>
                                <li><strong>Total:</strong> ${{ number_format($order->total, 2, '.', ',') }}</li>
                            </ul>
                        </div>

                        <div class="col-md-12">
                            <h5 class="mb-2">Items de la Orden</h5>
                            <table class="table table-responsive table-striped dt-responsive nowrap dataTable no-footer dtr-inline cart-page"
                                role="grid" style="width: 100%;">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="sorting_disabled"
                                            rowspan="1" colspan="1"
                                            style="width: 125px;">
                                            </th>
                                        <th class="sorting_disabled"
                                            rowspan="1" colspan="1"
                                            style="width: 1023px;">
                                            Producto</th>
                                        <th class="sorting_disabled"
                                            rowspan="1" colspan="1"
                                            style="width: 153px;">
                                            Precio Unitario</th>
                                        <th class="sorting_disabled"
                                            rowspan="1" colspan="1"
                                            style="width: 100px;">
                                            Cantidad</th>
                                        <th class="sorting_disabled"
                                            rowspan="1" colspan="1"
                                            style="width: 134px;text-align:center">
                                            Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->products as $product)
                                    <tr class="odd">
                                        <td class="pro-list-img"
                                            tabindex="0">
                                            <img src="{{ asset($product->product->image) }}"
                                                class="img-fluid"
                                                alt="tbl">
                                        </td>
                                        <td class="pro-name">
                                            <h6>{{ $product->product->name }}</h6>
                                            <span>{{ Str::limit($product->product->description, 50, '...') }}</span>
                                            @if ($product->options->count())
                                                <ul class="mb-0 small ps-3 text-muted">
                                                    @foreach ($product->options as $opt)
                                                        <li>{{ $opt->option_group_name }}: {{ $opt->option_name }} - ${{ number_format($opt->option_price, 2, '.', ',') }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            @if ($product->observations)
                                                <p class="mb-0 small mt-1"><strong>Nota:</strong> {{ $product->observations }}</p>
                                            @endif
                                        </td>
                                        <td>${{ number_format($product->unit_price, 2, '.', ',') }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>${{ number_format($product->subtotal, 2, '.', ',') }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Shopping cart start -->
        </div>
    </div>
</div>
@endsection