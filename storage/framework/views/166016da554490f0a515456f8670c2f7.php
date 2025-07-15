<tr data-id="<?php echo e($order->id); ?>">
  <td><?php echo e($order->id); ?></td>
  <td>
    <?php if(!$order->is_read): ?>
      <span class="badge bg-danger">Nuevo</span>
    <?php else: ?>
      <span class="badge bg-success">Leído</span>
    <?php endif; ?>
  </td>
  <td><?php echo e($order->nombre); ?></td>
  <td><?php echo e($order->cedula); ?></td>
  <td><?php echo e($order->metodo_pago); ?></td>
  <td class="text-success fw-bold">$<?php echo e(number_format($order->total, 2, '.', ',')); ?></td>
  <td>
    <?php
      $statusColors = [
        'Pendiente'   => 'secondary',
        'Confirmado'  => 'info',
        'Enviado'     => 'primary',
        'Entregado'   => 'success',
        'Cancelado'   => 'danger',
      ];
      $color = $statusColors[$order->status] ?? 'dark';
    ?>
    <span class="badge bg-<?php echo e($color); ?>"><?php echo e($order->status); ?></span>
  </td>
  <td>
    <a href="javascript:void(0)" data-id="<?php echo e($order->id); ?>" class="btn btn-dark btn-sm viewDetailsButton">
      <i class="fas fa-list"></i> Ver Detalles
    </a>
    <a href="javascript:void(0)" 
       class="btn btn-success btn-sm updateStatusBtn" 
       data-id="<?php echo e($order->id); ?>"
       data-current-status="<?php echo e($order->status); ?>"
       data-bs-toggle="modal" 
       data-bs-target="#updateStatusModal">
      <i class="far fa-edit"></i> Actualizar Estatus
    </a>
  </td>
</tr><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/admin/orders/partials/_rows.blade.php ENDPATH**/ ?>