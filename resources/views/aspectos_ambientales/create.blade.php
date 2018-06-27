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
			<li class="active">Crear</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('aspectos_ambientales.create') }}</h4>
            </span>
            @ifUserCan('aspectos_ambientales.aspectos_ambientale.index')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('aspectos_ambientales.aspectos_ambientale.index') }}" class="btn btn-primary" title="{{ trans('aspectos_ambientales.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
            </div>
            @endif
        </div>

        <div class="panel-body">
        
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('aspectos_ambientales.aspectos_ambientale.store') }}" accept-charset="UTF-8" id="create_aspectos_ambientale_form" name="create_aspectos_ambientale_form" class="">
            {{ csrf_field() }}
            @include ('aspectos_ambientales.form', [
                                        'aspectosAmbientale' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('aspectos_ambientales.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


