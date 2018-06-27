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
				<a href="{{ route('ln_caracteristicas.ln_caracteristica.index') }}">{{ trans('ln_caracteristicas.model_plural') }}</a>
			</li>
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : trans('ln_caracteristicas.model_plural') }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                @ifUserCan('ln_caracteristicas.ln_caracteristica.index')
<!--                <a href="{{ route('ln_caracteristicas.ln_caracteristica.index') }}" class="btn btn-primary" title="{{ trans('ln_caracteristicas.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>-->
                @endif
                @ifUserCan('ln_caracteristicas.ln_caracteristica.create')
<!--                <a href="{{ route('ln_caracteristicas.ln_caracteristica.create') }}" class="btn btn-success" title="{{ trans('ln_caracteristicas.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>-->
                @endif
                <a href="javascript:window.history.back()" class="btn btn-success">Regresar</a>
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

            <form method="POST" action="{{ route('ln_caracteristicas.ln_caracteristica.update', $lnCaracteristica->id) }}" id="edit_ln_caracteristica_form" name="edit_ln_caracteristica_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('ln_caracteristicas.form', [
                                        'lnCaracteristica' => $lnCaracteristica,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('ln_caracteristicas.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection