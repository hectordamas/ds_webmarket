@extends('tenant.layouts.app')
@section('metadata')
<title>Seguimiento de Pedido #{{$order->id}} - {{ tenant('nombre_empresa') }}</title>
@endsection
@section('content')
<div class="container my-4" >
    
    <div id="track-container">

        @include('tenant.shop.orders.track-content')

    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        const orderId = {{ $order->id }};
        const $trackContainer = $('#track-container');

        function updateTrackingContent() {
            $.ajax({
                url: `/track-content/${orderId}`,
                method: 'GET',
                beforeSend: function(){
                    $trackContainer.addClass('opacity-50')
                },
                success: function (data) {
                    $trackContainer.removeClass('opacity-50')
                    $trackContainer.html(data.html)
                },
                error: function (xhr, status, error) {
                    console.error('Error al actualizar el tracking:', error);
                    $trackContainer.removeClass('opacity-50');
                }
            });
        }

        // Ejecutar cada 15 segundos
        setInterval(updateTrackingContent, 15000);
    });
</script>
@endsection

