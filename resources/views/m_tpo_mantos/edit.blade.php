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
				<a href="{{ route('m_tpo_mantos.m_tpo_manto.index') }}">{{ trans('m_tpo_mantos.model_plural') }}</a>
			</li>
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : trans('m_tpo_mantos.model_plural') }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                @ifUserCan('m_tpo_mantos.m_tpo_manto.index')
                <a href="{{ route('m_tpo_mantos.m_tpo_manto.index') }}" class="btn btn-primary" title="{{ trans('m_tpo_mantos.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
                @endif
                @ifUserCan('m_tpo_mantos.m_tpo_manto.create')
                <a href="{{ route('m_tpo_mantos.m_tpo_manto.create') }}" class="btn btn-success" title="{{ trans('m_tpo_mantos.create') }}">
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

            <form method="POST" action="{{ route('m_tpo_mantos.m_tpo_manto.update', $mTpoManto->id) }}" id="edit_m_tpo_manto_form" name="edit_m_tpo_manto_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('m_tpo_mantos.form', [
                                        'mTpoManto' => $mTpoManto,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('m_tpo_mantos.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection