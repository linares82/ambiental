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
				<a href="{{ route('a_archivos_leyes.a_archivos_leye.index') }}">{{ trans('a_archivos_leyes.model_plural') }}</a>
			</li>
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title :  trans('a_archivos_leyes.model_plural') }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                @ifUserCan('a_archivos_leyes.a_archivos_leye.index')
                <a href="{{ route('a_archivos_leyes.a_archivos_leye.index') }}" class="btn btn-primary" title="{{ trans('a_archivos_leyes.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
                @endif
                @ifUserCan('a_archivos_leyes.a_archivos_leye.create')
                <a href="{{ route('a_archivos_leyes.a_archivos_leye.create') }}" class="btn btn-success" title="{{ trans('a_archivos_leyes.create') }}">
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

            <form method="POST" action="{{ route('a_archivos_leyes.a_archivos_leye.update', $aArchivosLeye->id) }}" id="edit_a_archivos_leye_form" name="edit_a_archivos_leye_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('a_archivos_leyes.form', [
                                        'aArchivosLeye' => $aArchivosLeye,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('a_archivos_leyes.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection