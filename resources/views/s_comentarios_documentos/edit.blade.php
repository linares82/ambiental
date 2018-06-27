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
				<a href="{{ route('s_comentarios_documentos.s_comentarios_documento.index') }}">{{ trans('s_comentarios_documentos.model_plural') }}</a>
			</li>
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : '{{ trans('s_comentarios_documentos.model_plural') }}' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                @ifUserCan('s_comentarios_documentos.s_comentarios_documento.index')
                <a href="{{ route('s_comentarios_documentos.s_comentarios_documento.index') }}" class="btn btn-primary" title="{{ trans('s_comentarios_documentos.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
                @endif
                @ifUserCan('s_comentarios_documentos.s_comentarios_documento.create')
                <a href="{{ route('s_comentarios_documentos.s_comentarios_documento.create') }}" class="btn btn-success" title="{{ trans('s_comentarios_documentos.create') }}">
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

            <form method="POST" action="{{ route('s_comentarios_documentos.s_comentarios_documento.update', $sComentariosDocumento->id) }}" id="edit_s_comentarios_documento_form" name="edit_s_comentarios_documento_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('s_comentarios_documentos.form', [
                                        'sComentariosDocumento' => $sComentariosDocumento,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('s_comentarios_documentos.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection