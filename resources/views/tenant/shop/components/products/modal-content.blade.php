<div class="text-center mb-3">
    <img src="{{ img64($product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="max-height: 200px;">
    @if($product->stock < 1)
        <span class="badge bg-danger position-absolute top-0 start-0 m-2">No Disponible</span>
    @else
        <span class="badge bg-success position-absolute top-0 start-0 m-2">{{ $product->stock }} Disponible{{$product->stock > 1 ? 's' : ''}}</span>
    @endif
</div>

<div class="d-flex justify-content-between">
    <div>
        <h6 class="fw-bold">{{ $product->name }}</h6>
        <p class="text-muted small">{{ $product->description }}</p>
    </div>
    <div>
        <h5 class="text-tenant fw-bold">${{ number_format($product->price, 2) }}</h5>
    </div>
</div>

@foreach($product->optionGroups as $group)
    <h6 class="fw-bold mt-4 mb-2">{{ $group->name }} @if($group->required) * @endif</h6>
    <table class="table table-sm table-striped">
        <tbody class="option-group" data-group-id="{{$group->id}}">
            @foreach($group->options as $option)
            <tr>
                <td>
                    {{ $option->name }}
                    @if($option->price > 0)
                        (+${{ number_format($option->price, 2) }})
                    @endif
                </td>
                <td class="text-end">
                    @if($group->type == 'single')
                        <input type="radio" name="options[{{ $group->id }}]" 
                               value="{{ $option->id }}" 
                               data-price="{{ $option->price }}"
                               {{ $loop->first ? 'checked' : '' }}>
                    @else
                        <input type="checkbox" name="options[{{ $group->id }}][]" 
                               value="{{ $option->id }}"
                               data-price="{{ $option->price }}">
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endforeach

<div class="my-4">
    <label for="productObservations" class="fw-bold mb-2">Observaciones</label>
    <textarea class="form-control" id="productObservations" rows="2" placeholder="Especificaciones adicionales..."></textarea>
</div>

<div class="modal-footer shadow-lg">
    <div class="d-flex w-100 gap-2">
        <div class="w-50">
            <label for="productQuantity" class="fw-bold mb-2">Cantidad</label>
            <div class="input-group" style="width: 140px;">
                <button class="btn btn-outline-dark" type="button" id="decreaseQty" @if($product->stock < 1) disabled @endif>−</button>
                <input type="number" class="form-control text-center" value="1" min="1" id="productQuantity" readonly>
                <button class="btn btn-outline-dark" type="button" id="increaseQty" @if($product->stock < 1) disabled @endif>+</button>
            </div>
        </div>
        <button type="button" class="btn btn-tenant w-100 py-2 add-to-cart-btn" @if($product->stock < 1) disabled @endif
                data-product-id="{{ $product->id }}">
            <i class="fas fa-shopping-cart"></i> Agregar al Carrito
        </button>
    </div>
</div>