<style>
    :root {
        --tenant-primary-color: <?php echo e($settings['color_primary'] ?? '#198754'); ?>;
    }

    .btn-tenant {
        background-color: var(--tenant-primary-color) !important;
        border-color: var(--tenant-primary-color) !important;
        color: #fff !important;
    }

    .btn-tenant:hover {
        filter: brightness(0.95);
    }

    .text-tenant {
        color: var(--tenant-primary-color) !important;
    }

    .badge-tenant {
        background-color: var(--tenant-primary-color) !important;
        color: #fff !important;
    }

    .nav-link.tenant-active {
        color: var(--tenant-primary-color) !important;
        border-bottom: 2px solid var(--tenant-primary-color);
    }

    /* Nuevas clases extraídas */
    .logo-main {
        max-width: 250px;
        max-height: 200px;
    }

    .category-btn {
        font-size: 0.7rem !important;
    }

    .btn-search-trigger {
        background-color: var(--tenant-primary-color);
        border: none;
        color: #fff;
    }

    .product-card {
        height: 90% !important;
        position: relative;
    }

    .product-image-clickable {
        cursor: pointer;
    }

    .footer-text {
        font-size: 14px;
    }

    .cart-empty-animation {
        width: 200px;
    }

    .cart-product-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
    }

    .btn-cart-fixed {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 10;
        padding: 20px 20px !important;
        font-weight: 600;
        width: 300px;
    }

    .modal-quantity-group {
        width: 140px;
    }
</style><?php /**PATH C:\laragon\www\ds_webmarket\resources\views/tenant/shop/styles.blade.php ENDPATH**/ ?>