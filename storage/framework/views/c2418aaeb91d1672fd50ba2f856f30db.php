<?php $__env->startSection('metadata'); ?>
<title><?php echo e(env('APP_NAME')); ?> - Crea tu catálogo en línea integrado con Saint</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
  <style>
    body {
      background: linear-gradient(to right, #141e30, #243b55);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .form-card {
      background-color: rgba(255, 255, 255, 0.05);
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.4);
      backdrop-filter: blur(8px);
      width: 100%;
      max-width: 700px;
    }

    .form-card input, .form-card input:focus,
    .form-card textarea , .form-card textarea:focus{
      background-color: rgba(255,255,255,0.1);
      border: none;
      color: white;
    }

    .form-card input::placeholder, .form-card textarea::placeholder {
      color: rgba(255, 255, 255, 0.6);
    }

    .btn-success {
      background-color: #00ffa2;
      border: none;
      color: #000;
      font-weight: bold;
    }

    .btn-success:hover {
      background-color: #00cc82;
    }

    label {
      font-weight: 500;
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12 py-3 mt-2 text-center">
                    <img src="<?php echo e(asset('central/assets/img/logo-light.png')); ?>" alt="" style="max-width: 250px; max-height: 200px;">
                </div>
                <div class="col-md-12 pb-3 d-flex justify-content-center">
                    <div class="form-card">
                      <h3 class="text-center mb-3">💚✨</h3>
                      <h5 class="text-center mb-4">Envíanos tus datos y obtén <strong>3 días de prueba</strong></h5>
                      <form method="POST" action="#" class="row">
                        <div class="col-md-6 mb-3">
                          <label class="mb-2">Nombre y apellido *</label>
                          <input type="text" class="form-control" name="nombre" required placeholder="Ej: Ana Pérez">
                        </div>
                        <div class="col-md-6 mb-3">
                          <label class="mb-2">Correo electrónico *</label>
                          <input type="email" class="form-control" name="email" required placeholder="Ej: ana@email.com">
                        </div>
                        <div class="col-md-6 mb-3">
                          <label class="mb-2">Nombre de su empresa *</label>
                          <input type="text" class="form-control" name="negocio" required placeholder="Ej: Zapatería El Paso">
                        </div>
                        <div class="col-md-6 mb-3">
                          <label class="mb-2">Whatsapp de su empresa *</label>
                          <div class="input-group">
                            <span class="input-group-text text-light" style="background: transparent;">+58</span>
                            <input type="text" class="form-control" name="whatsapp" required placeholder="Ej: 0412-1234567">
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label class="mb-2">¿A qué se dedica su negocio? *</label>
                          <textarea class="form-control" name="actividad" required rows="2" placeholder="Ej: Venta de repuestos para motos"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label class="mb-2">Usuario de Instagram (opcional)</label>
                          <input type="text" class="form-control" name="instagram" placeholder="@mi_negocio">
                        </div>
                        <div class="col-md-12 d-flex mb-4">
                          <input class="form-check-input" type="checkbox" value="1" id="autorizo" required>
                          <label class="form-check-label mx-3" for="autorizo">
                            Autorizo a <?php echo e(env('APP_NAME')); ?> a enviarme información relevante de mi suscripción a su plataforma.
                          </label>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success w-100">¡Quiero mi prueba gratis!</button>
                        </div>
                      </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/central/index.blade.php ENDPATH**/ ?>