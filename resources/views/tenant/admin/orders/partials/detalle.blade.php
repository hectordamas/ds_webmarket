<div>
    <h6 class="fw-bold">Datos del Cliente</h6>
    <div class="row">
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
            <ul>
                <li><strong>Tipo de Pedido:</strong> {{ $order->tipo_pedido }}</li>
                <li><strong>Método de Pago:</strong> {{ $order->metodo_pago }}</li>
                <li><strong>Total:</strong> ${{ number_format($order->total, 2, '.', ',') }}</li>
            </ul>
        </div>
    </div>

    <h5 class="mb-2">Items de la Orden</h5>
    <div class="row">
        <div class="col-md-12 dt-responsive table-responsive">
            <table class="table  table-striped  nowrap">
                <thead class="table-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th style="text-align:center">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $product)
                    <tr>
                        <td>
                            <img src="{{ asset($product->product->image) }}" alt="Producto" style="width: 80px; height: auto;">
                        </td>
                        <td>
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
                        <td style="text-align:center">${{ number_format($product->subtotal, 2, '.', ',') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
