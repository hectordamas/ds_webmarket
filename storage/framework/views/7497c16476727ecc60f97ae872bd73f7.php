<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Código de recuperación</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                    <tr style="background-color: #3CB05F;">
                        <td align="center" style="padding: 20px;">
                            <img src="<?php echo e(asset('assets/img/logo-color.png')); ?>" alt="Logo" width="160" style="display: block;">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px;">
                            <h2 style="margin: 0 0 10px 0; color: #333;">Hola,</h2>
                            <p style="font-size: 16px; color: #555;">Has solicitado restablecer tu contraseña. Utiliza el siguiente código para completar el proceso:</p>
                            <p style="font-size: 24px; color: #3CB05F; font-weight: bold; margin: 20px 0; text-align: center;">
                                <?php echo e($code); ?>

                            </p>
                            <p style="font-size: 14px; color: #888; text-align: center;">Este código es válido por 10 minutos.</p>

                            <hr style="margin: 30px 0; border: none; border-top: 1px solid #eee;">

                            <p style="font-size: 14px; color: #999;">Si no solicitaste este cambio, puedes ignorar este mensaje.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f8f8f8; padding: 20px; text-align: center; font-size: 12px; color: #aaa;">
                            © <?php echo e(now()->year); ?> <?php echo e(env('APP_NAME')); ?>. Todos los derechos reservados.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
</html><?php /**PATH C:\laragon\www\dswebmarket\resources\views/emails/reset_code.blade.php ENDPATH**/ ?>