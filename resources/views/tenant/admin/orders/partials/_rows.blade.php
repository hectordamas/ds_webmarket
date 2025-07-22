<tr data-id="{{ $order->id }}" class="order_row_{{$order->id}} {{ !$order->is_read ? 'table-secondary' : '' }}">
  <td>{{ $order->id }}</td>
  <td>
    @if(!$order->is_read)
        {{-- Punto como reemplazo del avatar --}}
        <span class="d-inline-block rounded-circle pulse point{{$order->id}} me-2" style="width: 10px; height: 10px; margin-top: 6px; background-color: red;"></span>
    @endif
    {{ $order->nombre }}
  </td>
  <td>{{ $order->tipo_documento }}{{ $order->cedula }}</td>
  <td>{{ $order->metodo_pago }}</td>
  <td class="text-success fw-bold">${{ number_format($order->total, 2, '.', ',') }}</td>
  <td>
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
    <span class="badge bg-{{ $color }}">{{ $order->status }}</span>
  </td>
  <td>
    <a href="javascript:void(0)" data-id="{{ $order->id }}" class="btn btn-dark btn-sm viewDetailsButton">
      <i class="fas fa-list"></i> Ver Detalles
    </a>
    <a href="javascript:void(0)" 
       class="btn btn-success btn-sm updateStatusBtn" 
       data-id="{{ $order->id }}"
       data-current-status="{{ $order->status }}"
       data-bs-toggle="modal" 
       data-bs-target="#updateStatusModal">
      <i class="far fa-edit"></i> Actualizar Estatus
    </a>
  </td>
</tr>