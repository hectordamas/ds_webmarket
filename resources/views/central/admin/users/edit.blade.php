@extends('central.layouts.admin')

@section('metadata')
<title>{{ env('APP_NAME') }} - Editar Usuario</title>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Editar Usuario #{{$user->id}}</h5>
            </div>
            <div class="card-block">
                <form action="{{ route('') }}" class="row">
                    @method('PUT')
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection