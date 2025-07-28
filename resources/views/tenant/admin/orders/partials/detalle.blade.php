<div class="container">

    {{-- Encabezado --}}
    <div class="row mb-2">
        <div class="col">
            <h4 class="fw-bold"><i class="fas fa-user me-2"></i>Datos del Cliente</h4>
        </div>
    </div>

    {{-- Datos del cliente y pedido --}}
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="bg-light p-3 rounded shadow-sm h-100">
                <ul class="list-unstyled mb-0">
                    <li><i class="fas fa-user me-2 text-dark"></i><strong>Nombre:</strong> {{ $order->nombre }}</li>
                    <li><i class="fas fa-id-card me-2 text-dark"></i><strong>Cédula:</strong> {{ $order->tipo_documento }}{{ $order->cedula }}</li>
                    <li><i class="fas fa-phone me-2 text-dark"></i><strong>Teléfono:</strong> +58 {{ $order->telefono }}</li>
                    @if($order->tipo_pedido == 'Delivery')
                        <li><i class="fas fa-map-marker-alt me-2 text-dark"></i><strong>Dirección:</strong> {{ $order->direccion }}</li>
                        <li class="ms-4">{{ $order->detalle_direccion }}</li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="bg-light p-3 rounded shadow-sm h-100">
                <ul class="list-unstyled mb-0">
                    <li><i class="fas fa-truck me-2 text-dark"></i><strong>Tipo de Pedido:</strong> {{ $order->tipo_pedido }}</li>
                    <li><i class="fas fa-credit-card me-2 text-dark"></i><strong>Método de Pago:</strong> {{ $order->payment->name }}</li>
                    @php
                        $statusColors = [
                            'Pendiente'   => 'warning',
                            'Confirmado'  => 'info',
                            'Enviado'     => 'primary',
                            'Entregado'   => 'success',
                            'Cancelado'   => 'danger',
                        ];
                        $color = $statusColors[$order->status] ?? 'dark';
                    @endphp
                    <li>
                        <i class="fas fa-info-circle me-2 text-dark"></i><strong>Status:</strong>
                        <span class="badge bg-{{ $color }}">{{ $order->status }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Tabla de productos --}}
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-bordered align-middle table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th colspan="2">Producto</th>
                        <th>SKU</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $product)
                    <tr>
                        <td class="text-center" style="width:70px;">
                            <img src="{{ img64($product->product->image) }}" alt="Producto" class="img-thumbnail rounded" style="width: 60px; height: auto;">
                        </td>
                        <td>
                            <h6 class="mb-1">{{ $product->product->name }}</h6>
                            <p class="text-muted mb-1">{{ Str::limit($product->product->description, 50, '...') }}</p>

                            @if ($product->options->count())
                                <ul class="small ps-3 mb-1">
                                    @foreach ($product->options as $opt)
                                        <li>{{ $opt->option_group_name }}: {{ $opt->option_name }} - ${{ number_format($opt->option_price, 2, '.', ',') }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            @if ($product->observations)
                                <p class="small text-info mb-0"><strong>Nota:</strong> {{ $product->observations }}</p>
                            @endif
                        </td>
                        <td class="text-center">{{ $product->product->sku ?? 'N/A' }}</td>
                        <td class="text-center">${{ number_format($product->unit_price, 2, '.', ',') }}</td>
                        <td class="text-center">{{ $product->quantity }}</td>
                        <td class="text-center fw-bold">${{ number_format($product->subtotal, 2, '.', ',') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-dark text-end">
                    <tr>
                        <td colspan="5"><strong>Total:</strong></td>
                        <td><strong>$ {{ number_format($order->total, 2, '.', ',') }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
