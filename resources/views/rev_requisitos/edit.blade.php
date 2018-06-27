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
				<a href="{{ route('rev_requisitos.rev_requisito.index') }}">{{ trans('rev_requisitos.model_plural') }}</a>
			</li>
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : trans('rev_requisitos.model_plural')  }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                @ifUserCan('rev_requisitos.rev_requisito.index')
                <a href="{{ route('rev_requisitos.rev_requisito.index') }}" class="btn btn-primary" title="{{ trans('rev_requisitos.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
                @endif
                @ifUserCan('rev_requisitos.rev_requisito.create')
                <a href="{{ route('rev_requisitos.rev_requisito.create') }}" class="btn btn-success" title="{{ trans('rev_requisitos.create') }}">
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

            <form method="POST" action="{{ route('rev_requisitos.rev_requisito.update', $revRequisito->id) }}" id="edit_rev_requisito_form" name="edit_rev_requisito_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('rev_requisitos.form', [
                                        'revRequisito' => $revRequisito,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('rev_requisitos.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection