<div class="d-flex align-items-center justify-content-center gap-3">
    <label class="form-check-label">
        <input type="checkbox" name="active" class="form-check-input product-active" data-id="{{ $product->id }}" {{ $product->active ? 'checked' : '' }} disabled>
        Activo
    </label>

    <label class="form-check-label">
        <input type="checkbox" name="visible" class="form-check-input product-visible" data-id="{{ $product->id }}" {{ $product->visible ? 'checked' : '' }}>
        Visible
    </label>
</div>