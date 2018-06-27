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
				<a href="{{ route('cs_tpo_bitacoras.cs_tpo_bitacora.index') }}">{{ trans('cs_tpo_bitacoras.model_plural') }}</a>
			</li>
			<li class="active">Crear</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('cs_tpo_bitacoras.create') }}</h4>
            </span>
            @ifUserCan('cs_tpo_bitacoras.cs_tpo_bitacora.index')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('cs_tpo_bitacoras.cs_tpo_bitacora.index') }}" class="btn btn-primary" title="{{ trans('cs_tpo_bitacoras.show_all') }}">
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

            <form method="POST" action="{{ route('cs_tpo_bitacoras.cs_tpo_bitacora.store') }}" accept-charset="UTF-8" id="create_cs_tpo_bitacora_form" name="create_cs_tpo_bitacora_form" class="">
            {{ csrf_field() }}
            @include ('cs_tpo_bitacoras.form', [
                                        'csTpoBitacora' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('cs_tpo_bitacoras.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


