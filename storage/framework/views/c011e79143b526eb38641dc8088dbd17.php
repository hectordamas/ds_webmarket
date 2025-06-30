<!-- Offcanvas del Carrito con pestañas -->
<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasCartLabel">🛒 Carrito de Compras</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column" id="cart-offcanvas-container">



        <!-- Navegación de pestañas -->
        <ul class="nav nav-tabs nav-justified mb-3" id="cartTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link disabled active text-tenant fw-semibold d-flex flex-column align-items-center py-2" id="pedido-tab" data-bs-toggle="tab" data-bs-target="#pedido" type="button" role="tab" aria-controls="pedido" aria-selected="true">
                    <i class="fas fa-shopping-bag mb-1 fs-5"></i>
                    Pedido
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link disabled text-muted fw-semibold d-flex flex-column align-items-center py-2" id="checkout-tab" data-bs-toggle="tab" data-bs-target="#checkout" type="button" role="tab" aria-controls="checkout" aria-selected="false">
                    <i class="fas fa-credit-card mb-1 fs-5"></i>
                    Checkout
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link disabled text-muted fw-semibold d-flex flex-column align-items-center py-2" id="confirmar-tab" data-bs-toggle="tab" data-bs-target="#confirmar" type="button" role="tab" aria-controls="confirmar" aria-selected="false">
                    <i class="fas fa-check-double mb-1 fs-5"></i>
                    Confirmar
                </button>
            </li>
        </ul>

        <!-- Contenido de las pestañas -->
        <div class="tab-content flex-grow-1" id="cartTabsContent">
            <!-- TAB: Pedido -->
            <div class="tab-pane fade show active" id="pedido" role="tabpanel" aria-labelledby="pedido-tab">
                <?php echo $__env->make('tenant.shop.components.cart.items', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <!-- TAB: Checkout -->
            <div class="tab-pane fade" id="checkout" role="tabpanel" aria-labelledby="checkout-tab">
                <?php echo $__env->make('tenant.shop.components.cart.checkout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <!-- TAB: Confirmar -->
            <div class="tab-pane fade" id="confirmar" role="tabpanel" aria-labelledby="confirmar-tab">
                <?php echo $__env->make('tenant.shop.components.cart.confirmar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>  


    </div>
</div>

<!-- Botón flotante del carrito -->
<a href="javascript:void(0);" id="btnCartManual"
    class="btn btn-tenant position-fixed d-flex align-items-center justify-content-between shadow-lg btn-cart-fixed">
    <?php echo $__env->make('tenant.shop.components.cart.button-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</a>
<?php /**PATH C:\laragon\www\ds_webmarket\resources\views/tenant/shop/components/cart/index.blade.php ENDPATH**/ ?>