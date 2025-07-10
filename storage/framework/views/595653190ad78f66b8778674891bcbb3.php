<h2>Nuevo formulario recibido</h2>

<p><strong>Nombre:</strong> <?php echo e($nombre); ?></p>
<p><strong>Email:</strong> <?php echo e($email); ?></p>
<p><strong>Negocio:</strong> <?php echo e($negocio); ?></p>
<p><strong>Whatsapp:</strong> +58 <?php echo e($whatsapp); ?></p>
<p><strong>Actividad:</strong> <?php echo e($actividad); ?></p>
<?php if($instagram): ?>
  <p><strong>Instagram:</strong> <?php echo e($instagram); ?></p>
<?php endif; ?>
<?php /**PATH C:\laragon\www\dswebmarket\resources\views/emails/formulario.blade.php ENDPATH**/ ?>