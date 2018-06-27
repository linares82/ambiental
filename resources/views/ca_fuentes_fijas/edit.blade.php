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
				<a href="{{ route('ca_fuentes_fijas.ca_fuentes_fija.index') }}">{{ trans('ca_fuentes_fijas.model_plural') }}</a>
			</li>
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : trans('ca_fuentes_fijas.model_plural')  }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                @ifUserCan('ca_fuentes_fijas.ca_fuentes_fija.index')
                <a href="{{ route('ca_fuentes_fijas.ca_fuentes_fija.index') }}" class="btn btn-primary" title="{{ trans('ca_fuentes_fijas.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
                @endif
                @ifUserCan('ca_fuentes_fijas.ca_fuentes_fija.create')
                <a href="{{ route('ca_fuentes_fijas.ca_fuentes_fija.create') }}" class="btn btn-success" title="{{ trans('ca_fuentes_fijas.create') }}">
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

            <form method="POST" action="{{ route('ca_fuentes_fijas.ca_fuentes_fija.update', $caFuentesFija->id) }}" id="edit_ca_fuentes_fija_form" name="edit_ca_fuentes_fija_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('ca_fuentes_fijas.form', [
                                        'caFuentesFija' => $caFuentesFija,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('ca_fuentes_fijas.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection