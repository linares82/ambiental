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
				<a href="{{ route('intensidad_impactos.intensidad_impacto.index') }}">{{ trans('intensidad_impactos.model_plural') }}</a>
			</li>
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : '{{ trans('intensidad_impactos.model_plural') }}' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                @ifUserCan('intensidad_impactos.intensidad_impacto.index')
                <a href="{{ route('intensidad_impactos.intensidad_impacto.index') }}" class="btn btn-primary" title="{{ trans('intensidad_impactos.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
                @endif
                @ifUserCan('intensidad_impactos.intensidad_impacto.create')
                <a href="{{ route('intensidad_impactos.intensidad_impacto.create') }}" class="btn btn-success" title="{{ trans('intensidad_impactos.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
                @endif
            </div>
        </div>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('intensidad_impactos.intensidad_impacto.update', $intensidadImpacto->id) }}" id="edit_intensidad_impacto_form" name="edit_intensidad_impacto_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('intensidad_impactos.form', [
                                        'intensidadImpacto' => $intensidadImpacto,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('intensidad_impactos.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection