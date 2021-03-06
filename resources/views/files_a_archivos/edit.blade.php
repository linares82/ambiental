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
				<a href="{{ route('files_a_archivos.files_a_archivo.index') }}">{{ trans('files_a_archivos.model_plural') }}</a>
			</li>
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : '{{ trans('files_a_archivos.model_plural') }}' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                @ifUserCan('files_a_archivos.files_a_archivo.index')
                <a href="{{ route('files_a_archivos.files_a_archivo.index') }}" class="btn btn-primary" title="{{ trans('files_a_archivos.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
                @endif
                @ifUserCan('files_a_archivos.files_a_archivo.create')
                <a href="{{ route('files_a_archivos.files_a_archivo.create') }}" class="btn btn-success" title="{{ trans('files_a_archivos.create') }}">
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

            <form method="POST" action="{{ route('files_a_archivos.files_a_archivo.update', $filesAArchivo->id) }}" id="edit_files_a_archivo_form" name="edit_files_a_archivo_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('files_a_archivos.form', [
                                        'filesAArchivo' => $filesAArchivo,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('files_a_archivos.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection