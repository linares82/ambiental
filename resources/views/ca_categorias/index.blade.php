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
				<a href="{{ route('ca_categorias.ca_categoria.index') }}">{{ trans('ca_categorias.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('ca_categorias.model_plural') }}</h4>
            </div>
            
            @ifUserCan('ca_categorias.ca_categoria.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('ca_categorias.ca_categoria.create') }}" class="btn btn-success btn-xs" title="{{ trans('ca_categorias.create') }}">
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
                <a href="{{ route('ca_categorias.ca_categoria.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($caCategorias) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('ca_categorias.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('ca_categorias.ca_categoria.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
                                                <div class="form-group col-md-4 {{ $errors->has('ca_material_id') ? 'has-error' : '' }}">
                                                    <label for="ca_material_id" class="control-label">{{ trans('ca_categorias.ca_material_id') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="ca_material_id" name="ca_material_id">
                                                                    <option value="" style="display: none;" {{ old('ca_material_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('ca_categorias.ca_material_id__placeholder') }}</option>
                                                                @foreach ($caMaterials as $key => $caMaterial)
                                                                            <option value="{{ $key }}" {{ old('ca_material_id') == $key ? 'selected' : '' }}>
                                                                                {{ $caMaterial }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('ca_material_id', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>

                                                <div class="form-group col-md-4 {{ $errors->has('categoria') ? 'has-error' : '' }}">
                                                    <label for="categoria" class="control-label">{{ trans('ca_categorias.categoria') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <input class="form-control input-sm " name="categoria" type="text" id="categoria" value="{{ old('categoria') }}" minlength="1" maxlength="255" placeholder="{{ trans('ca_categorias.categoria__placeholder') }}">
                                                        {!! $errors->first('categoria', '<p class="help-block">:message</p>') !!}
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
                            <th>{{ trans('ca_categorias.ca_material_id') }}</th>
                            <th>{{ trans('ca_categorias.categoria') }}</th>
                   
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($caCategorias as $caCategoria)
                        <tr>
                            <td>{{ $caCategoria->id }}</td>
                            <td>{{ optional($caCategoria->caMaterial)->material }}</td>
                            <td>{{ $caCategoria->categoria }}</td>
                   
                            <td>

                                <form method="POST" action="{!! route('ca_categorias.ca_categoria.destroy', $caCategoria->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('ca_categorias.ca_categoria.show')
                                        <a href="{{ route('ca_categorias.ca_categoria.show', $caCategoria->id ) }}" class="btn btn-info btn-xs" title="{{ trans('ca_categorias.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('ca_categorias.ca_categoria.edit')
                                        <a href="{{ route('ca_categorias.ca_categoria.edit', $caCategoria->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('ca_categorias.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('ca_categorias.ca_categoria.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('ca_categorias.delete') }}" onclick="return confirm(&quot;{{ trans('ca_categorias.confirm_delete') }}&quot;)">
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
            {!! $caCategorias->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection