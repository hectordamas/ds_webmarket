@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ env('APP_NAME') }} - Métodos de Pago</title>
@endsection

@section('content')
<!-- Modal -->
<div class="modal fade" id="createPayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="exampleModalLabel">Crear Método de Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ url('payments/store') }}" method="POST" class="row">
            @csrf

            <div class="col-md-6 form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" required name="name">
            </div>

            <div class="col-md-6 form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="active" checked>
                  <label class="form-check-label" for="checkDefault">
                    Activo
                  </label>
                </div>
            </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Lista de Métodos de Pago</h5>
                <a href="javascript:void(0)" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createPayment">
                    <i class="fas fa-plus"></i> Nuevo Métodos de Pago

                </a>
            </div>

            <div class="card-body table-responsive">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-striped" id="datatable-buttons-table">
                    <thead class="table-dark">
                        <th>#</th>
                        <th>Método de Pago</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->name }}</td>
                            <td>
                                <input type="checkbox" {{ $payment->active ? 'checked' : '' }} name="active" data-id="{{ $payment->id }}" class="active-payment">
                            </td>
                            <td>
                                <form action="{{ url('payments/destroy/'.$payment->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este método de pago?');">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </td>                     
                          </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script>
    $(document).on('change', '.active-payment', function () {
        var id = $(this).data('id');
        var active = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: "{{ url('payments/toggle-active') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                active: active
            },
            success: function (response) {
                console.log('Estado actualizado');
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo actualizar el estado del método de pago.'
                });
            }
        });
    });

</script>
@endsection