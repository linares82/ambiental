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
				<a href="{{ route('aspectos_ambientales.aspectos_ambientale.index') }}">{{ trans('aspectos_ambientales.model_plural') }}</a>
			</li>
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : trans('aspectos_ambientales.model_plural')  }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                @ifUserCan('aspectos_ambientales.aspectos_ambientale.index')
                <a href="{{ route('aspectos_ambientales.aspectos_ambientale.index') }}" class="btn btn-primary" title="{{ trans('aspectos_ambientales.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
                @endif
                @ifUserCan('aspectos_ambientales.aspectos_ambientale.create')
                <a href="{{ route('aspectos_ambientales.aspectos_ambientale.create') }}" class="btn btn-success" title="{{ trans('aspectos_ambientales.create') }}">
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

            <form method="POST" action="{{ route('aspectos_ambientales.aspectos_ambientale.update', $aspectosAmbientale->id) }}" id="edit_aspectos_ambientale_form" name="edit_aspectos_ambientale_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('aspectos_ambientales.form', [
                                        'aspectosAmbientale' => $aspectosAmbientale,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('aspectos_ambientales.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection