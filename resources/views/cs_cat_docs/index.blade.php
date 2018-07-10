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
		</ul><!-- /.breadcrumb -->
	</div>

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif
	
    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('cs_cat_docs.model_plural') }}</h4>
            </div>
            
            @ifUserCan('cs_cat_docs.cs_cat_doc.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('cs_cat_docs.cs_cat_doc.create') }}" class="btn btn-success btn-xs" title="{{ trans('cs_cat_docs.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>
            @endif
			<div class="btn-group btn-group-sm pull-right" role="group">
                <button id="search_btn" class="btn btn-warning btn-xs" title="Buscar">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
				</button>
            </div>
			<div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('cs_cat_docs.cs_cat_doc.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($csCatDocs) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('cs_cat_docs.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('cs_cat_docs.cs_cat_doc.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
                                                <div class="form-group col-md-4 {{ $errors->has('cat_doc') ? 'has-error' : '' }}">
                                                    <label for="cat_doc" class="control-label">{{ trans('cs_cat_docs.cat_doc') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <input class="form-control input-sm " name="cat_doc" type="text" id="cat_doc" value="{{ old('cat_doc') }}" minlength="1" maxlength="255" placeholder="{{ trans('cs_cat_docs.cat_doc__placeholder') }}">
                                                        {!! $errors->first('cat_doc', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>
						<div class="form-group">
							<div class="col-md-offset-2 col-md-10">
								<input class="btn btn-info btn-app btn-xs" type="submit" value="Buscar">
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="table-responsive">

                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>{{ trans('cs_cat_docs.cat_doc') }}</th>
                            
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($csCatDocs as $csCatDoc)
                        <tr>
                            <td>{{ $csCatDoc->id }}</td>
                            <td>{{ $csCatDoc->cat_doc }}</td>
                            
                            <td>

                                <form method="POST" action="{!! route('cs_cat_docs.cs_cat_doc.destroy', $csCatDoc->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('cs_cat_docs.cs_cat_doc.show')
                                        <a href="{{ route('cs_cat_docs.cs_cat_doc.show', $csCatDoc->id ) }}" class="btn btn-info btn-xs" title="{{ trans('cs_cat_docs.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('cs_cat_docs.cs_cat_doc.edit')
                                        <a href="{{ route('cs_cat_docs.cs_cat_doc.edit', $csCatDoc->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('cs_cat_docs.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('cs_cat_docs.cs_cat_doc.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('cs_cat_docs.delete') }}" onclick="return confirm(&quot;{{ trans('cs_cat_docs.confirm_delete') }}&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                        @endif
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $csCatDocs->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection