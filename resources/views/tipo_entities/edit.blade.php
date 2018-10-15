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
				<a href="{{ route('tipo_entities.tipo_entity.index') }}">{{ trans('tipo_entities.model_plural') }}</a>
			</li>
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : '{{ trans('tipo_entities.model_plural') }}' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                @ifUserCan('tipo_entities.tipo_entity.index')
                <a href="{{ route('tipo_entities.tipo_entity.index') }}" class="btn btn-primary" title="{{ trans('tipo_entities.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
                @endif
                @ifUserCan('tipo_entities.tipo_entity.create')
                <a href="{{ route('tipo_entities.tipo_entity.create') }}" class="btn btn-success" title="{{ trans('tipo_entities.create') }}">
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

            <form method="POST" action="{{ route('tipo_entities.tipo_entity.update', $tipoEntity->id) }}" id="edit_tipo_entity_form" name="edit_tipo_entity_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('tipo_entities.form', [
                                        'tipoEntity' => $tipoEntity,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('tipo_entities.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection