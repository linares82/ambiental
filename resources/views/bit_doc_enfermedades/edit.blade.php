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
				<a href="{{ route('bit_doc_enfermedades.bit_doc_enfermedade.index') }}">{{ trans('bit_doc_enfermedades.model_plural') }}</a>
			</li>
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : '{{ trans('bit_doc_enfermedades.model_plural') }}' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                @ifUserCan('bit_doc_enfermedades.bit_doc_enfermedade.index')
                <a href="{{ route('bit_doc_enfermedades.bit_doc_enfermedade.index') }}" class="btn btn-primary" title="{{ trans('bit_doc_enfermedades.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
                @endif
                @ifUserCan('bit_doc_enfermedades.bit_doc_enfermedade.create')
                <a href="{{ route('bit_doc_enfermedades.bit_doc_enfermedade.create') }}" class="btn btn-success" title="{{ trans('bit_doc_enfermedades.create') }}">
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

            <form method="POST" action="{{ route('bit_doc_enfermedades.bit_doc_enfermedade.update', $bitDocEnfermedade->id) }}" id="edit_bit_doc_enfermedade_form" name="edit_bit_doc_enfermedade_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('bit_doc_enfermedades.form', [
                                        'bitDocEnfermedade' => $bitDocEnfermedade,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('bit_doc_enfermedades.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection