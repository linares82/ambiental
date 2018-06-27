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
				<a href="{{ route('aa_condiciones.aa_condicione.index') }}">{{ trans('aa_condiciones.model_plural') }}</a>
			</li>
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : '{{ trans('aa_condiciones.model_plural') }}' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                @ifUserCan('aa_condiciones.aa_condicione.index')
                <a href="{{ route('aa_condiciones.aa_condicione.index') }}" class="btn btn-primary" title="{{ trans('aa_condiciones.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
                @endif
                @ifUserCan('aa_condiciones.aa_condicione.create')
                <a href="{{ route('aa_condiciones.aa_condicione.create') }}" class="btn btn-success" title="{{ trans('aa_condiciones.create') }}">
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

            <form method="POST" action="{{ route('aa_condiciones.aa_condicione.update', $aaCondicione->id) }}" id="edit_aa_condicione_form" name="edit_aa_condicione_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('aa_condiciones.form', [
                                        'aaCondicione' => $aaCondicione,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('aa_condiciones.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection