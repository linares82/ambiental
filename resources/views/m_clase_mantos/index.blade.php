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
				<a href="{{ route('m_clase_mantos.m_clase_manto.index') }}">{{ trans('m_clase_mantos.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('m_clase_mantos.model_plural') }}</h4>
            </div>
            
            @ifUserCan('m_clase_mantos.m_clase_manto.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('m_clase_mantos.m_clase_manto.create') }}" class="btn btn-success btn-xs" title="{{ trans('m_clase_mantos.create') }}">
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
                <a href="{{ route('m_clase_mantos.m_clase_manto.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($mClaseMantos) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('m_clase_mantos.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('m_clase_mantos.m_clase_manto.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
                                                <div class="form-group col-md-4 {{ $errors->has('clase_manto') ? 'has-error' : '' }}">
                                                    <label for="clase_manto" class="control-label">{{ trans('m_clase_mantos.clase_manto') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <input class="form-control input-sm " name="clase_manto" type="text" id="clase_manto" value="{{ old('clase_manto') }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('m_clase_mantos.clase_manto__placeholder') }}">
                                                        {!! $errors->first('clase_manto', '<p class="help-block">:message</p>') !!}
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
                            <th>{{ trans('m_clase_mantos.clase_manto') }}</th>
                           
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($mClaseMantos as $mClaseManto)
                        <tr>
                            <td>{{ $mClaseManto->id }}</td>
                            <td>{{ $mClaseManto->clase_manto }}</td>
                           
                            <td>

                                <form method="POST" action="{!! route('m_clase_mantos.m_clase_manto.destroy', $mClaseManto->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('m_clase_mantos.m_clase_manto.show')
                                        <a href="{{ route('m_clase_mantos.m_clase_manto.show', $mClaseManto->id ) }}" class="btn btn-info btn-xs" title="{{ trans('m_clase_mantos.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('m_clase_mantos.m_clase_manto.edit')
                                        <a href="{{ route('m_clase_mantos.m_clase_manto.edit', $mClaseManto->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('m_clase_mantos.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('m_clase_mantos.m_clase_manto.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('m_clase_mantos.delete') }}" onclick="return confirm(&quot;{{ trans('m_clase_mantos.confirm_delete') }}&quot;)">
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
            {!! $mClaseMantos->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection