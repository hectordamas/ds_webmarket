<tr data-id="{{ $order->id }}">
  <td>{{ $order->id }}</td>
  <td>
    @if(!$order->is_read)
      <span class="badge bg-warning">Nuevo</span>
    @else
      <span class="badge bg-success">Leído</span>
    @endif
  </td>
  <td>{{ $order->nombre }}</td>
  <td>{{ $order->cedula }}</td>
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