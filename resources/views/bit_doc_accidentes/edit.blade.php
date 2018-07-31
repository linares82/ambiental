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
				<a href="{{ route('bit_doc_accidentes.bit_doc_accidente.index') }}">{{ trans('bit_doc_accidentes.model_plural') }}</a>
			</li>
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : '{{ trans('bit_doc_accidentes.model_plural') }}' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                @ifUserCan('bit_doc_accidentes.bit_doc_accidente.index')
                <a href="{{ route('bit_doc_accidentes.bit_doc_accidente.index') }}" class="btn btn-primary" title="{{ trans('bit_doc_accidentes.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
                @endif
                @ifUserCan('bit_doc_accidentes.bit_doc_accidente.create')
                <a href="{{ route('bit_doc_accidentes.bit_doc_accidente.create') }}" class="btn btn-success" title="{{ trans('bit_doc_accidentes.create') }}">
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

            <form method="POST" action="{{ route('bit_doc_accidentes.bit_doc_accidente.update', $bitDocAccidente->id) }}" id="edit_bit_doc_accidente_form" name="edit_bit_doc_accidente_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('bit_doc_accidentes.form', [
                                        'bitDocAccidente' => $bitDocAccidente,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('bit_doc_accidentes.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection