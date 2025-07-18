

<?php $__env->startSection('metadata'); ?>
<title><?php echo e(config('app.name')); ?> - Restablecer Contraseña</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-sm-12">
            <form class="md-float-material form-material" method="POST" action="<?php echo e(url('password/reset-code')); ?>">
                <?php echo csrf_field(); ?>
                <div class="text-center mb-3">
                    <img src="<?php echo e(asset('assets/img/logo-light.png')); ?>" alt="Logo <?php echo e(config('app.name')); ?>" width="180">
                </div>
                <div class="auth-box card">
                    <div class="card-block">
                        <div class="row m-b-20">
                            <div class="col-md-12">
                                <h3 class="text-center">Restablecer Contraseña</h3>
                                <p class="text-center text-muted">Ingresa el código recibido por correo y una nueva contraseña</p>
                            </div>
                        </div>

                        <?php if(session('error')): ?>
                            <div class="alert alert-danger text-center"><?php echo e(session('error')); ?></div>
                        <?php endif; ?>

                        <div class="mb-3 form-primary">
                            <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('email')); ?>" required placeholder="Correo Electrónico">
                            <span class="form-bar"></span>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3 form-primary">
                            <input type="text" name="code" class="form-control <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="Código recibido" required>
                            <span class="form-bar"></span>
                            <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3 form-primary">
                            <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="Nueva contraseña" required>
                            <span class="form-bar"></span>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3 form-primary">
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="Confirmar contraseña" required>
                            <span class="form-bar"></span>
                        </div>

                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-md waves-effect waves-light text-center m-b-20">
                                        Restablecer contraseña
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="<?php echo e(url('login')); ?>" class="f-w-600">← Volver al inicio de sesión</a>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-10">
                                <p class="text-inverse text-start m-b-0">Gracias por usar DS WebMarket.</p>
                                <p class="text-inverse text-start">
                                    <a href="<?php echo e(url('/')); ?>"><b class="f-w-600">Volver al sitio</b></a>
                                </p>
                            </div>
                            <div class="col-2 text-end">
                                <img src="<?php echo e(asset('assets/img/favicon.png')); ?>" class="w-100" alt="Logo pequeño">
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('tenant.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/password/reset-code.blade.php ENDPATH**/ ?>