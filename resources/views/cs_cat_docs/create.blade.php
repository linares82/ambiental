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
				<a href="{{ route('cs_cat_docs.cs_cat_doc.index') }}">{{ trans('cs_cat_docs.model_plural') }}</a>
			</li>
			<li class="active">Crear</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('cs_cat_docs.create') }}</h4>
            </span>
            @ifUserCan('cs_cat_docs.cs_cat_doc.index')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('cs_cat_docs.cs_cat_doc.index') }}" class="btn btn-primary" title="{{ trans('cs_cat_docs.show_all') }}">
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

            <form method="POST" action="{{ route('cs_cat_docs.cs_cat_doc.store') }}" accept-charset="UTF-8" id="create_cs_cat_doc_form" name="create_cs_cat_doc_form" class="">
            {{ csrf_field() }}
            @include ('cs_cat_docs.form', [
                                        'csCatDoc' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('cs_cat_docs.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


