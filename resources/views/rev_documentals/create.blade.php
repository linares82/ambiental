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
				<a href="{{ route('rev_documentals.rev_documental.index') }}">{{ trans('rev_documentals.model_plural') }}</a>
			</li>
			<li class="active">Crear</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('rev_documentals.create') }}</h4>
            </span>
            @ifUserCan('rev_documentals.rev_documental.index')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('rev_documentals.rev_documental.index') }}" class="btn btn-primary" title="{{ trans('rev_documentals.show_all') }}">
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

            <form method="POST" action="{{ route('rev_documentals.rev_documental.store') }}" accept-charset="UTF-8" id="create_rev_documental_form" name="create_rev_documental_form" class="">
            {{ csrf_field() }}
            @include ('rev_documentals.form', [
                                        'revDocumental' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('rev_documentals.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


