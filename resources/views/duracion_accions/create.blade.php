@extends('layouts.master1')

@section('content')
	<div class="breadcrumbs ace-save-state" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<a href="{{route('home')}}">
				<i class="ace-icon fa fa-home home-icon"></i>
				</a>
			</li>

			<li>
				<a href="{{ route('duracion_accions.duracion_accion.index') }}">{{ trans('duracion_accions.model_plural') }}</a>
			</li>
			<li class="active">Crear</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('duracion_accions.create') }}</h4>
            </span>
            @ifUserCan('duracion_accions.duracion_accion.index')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('duracion_accions.duracion_accion.index') }}" class="btn btn-primary" title="{{ trans('duracion_accions.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
            </div>
            @endif
        </div>

        <div class="panel-body">
        
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('duracion_accions.duracion_accion.store') }}" accept-charset="UTF-8" id="create_duracion_accion_form" name="create_duracion_accion_form" class="">
            {{ csrf_field() }}
            @include ('duracion_accions.form', [
                                        'duracionAccion' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('duracion_accions.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


