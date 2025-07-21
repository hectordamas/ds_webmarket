@extends('tenant.layouts.app')

@section('metadata')
<title>Servicio Inactivo - {{ config('app.name') }} </title>
@endsection

@section('content')
<style>
  body, html {
    height: 100%;
    margin: 0;
    background: #f8fafc;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .container-center {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1rem;
  }

  .card-clean {
    background: #fff;
    max-width: 500px;
    width: 100%;
    padding: 2.5rem 2rem;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.07);
    text-align: center;
  }

  .logo {
    max-width: 140px;
    height: auto;
    margin-bottom: 1.5rem;
  }

  .icon-warning {
    font-size: 3rem;
    color: #d9534f; /* bootstrap danger */
    margin-bottom: 1.25rem;
  }

  h2 {
    margin-bottom: 1rem;
    font-weight: 700;
    color: #333;
  }

  p {
    color: #555;
    font-size: 1rem;
    line-height: 1.5;
    margin-bottom: 2rem;
  }

  .btn-contact {
    display: inline-block;
    padding: 0.6rem 2.2rem;
    border-radius: 9999px;
    background-color: #5cb85c; /* bootstrap success */
    color: #fff;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 4px 8px rgba(92,184,92,0.3);
    transition: background-color 0.3s ease;
  }
  .btn-contact:hover, .btn-contact:focus {
    background-color: #4cae4c;
    text-decoration: none;
  }
</style>

<div class="container-center">
  <div class="card-clean">
    <img src="{{ asset('assets/img/logo-color.png') }}" alt="Logo {{ config('app.name') }}" class="logo" />
    <i class="bi bi-exclamation-triangle-fill icon-warning"></i>
    <h2>Servicio Inactivo</h2>
    <p>Este servicio está temporalmente desactivado.<br>Si crees que es un error, por favor contacta con soporte para renovar tu licencia.</p>
    <a href="{{ url(env('WHATSAPP_SUPPORT_URL')) }}" target="_blank" class="btn-contact" tabindex="0">Contactar Soporte</a>
  </div>
</div>
@endsection


