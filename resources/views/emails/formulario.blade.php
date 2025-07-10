<h2>Nuevo formulario recibido</h2>

<p><strong>Nombre:</strong> {{ $nombre }}</p>
<p><strong>Email:</strong> {{ $email }}</p>
<p><strong>Negocio:</strong> {{ $negocio }}</p>
<p><strong>Whatsapp:</strong> +58 {{ $whatsapp }}</p>
<p><strong>Actividad:</strong> {{ $actividad }}</p>
@if($instagram)
  <p><strong>Instagram:</strong> {{ $instagram }}</p>
@endif
