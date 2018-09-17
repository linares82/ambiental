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
				<a href="{{ route('ca_aa_docs.ca_aa_doc.index') }}">{{ trans('ca_aa_docs.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('ca_aa_docs.model_plural') }}</h4>
            </div>
            
            @ifUserCan('ca_aa_docs.ca_aa_doc.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('ca_aa_docs.ca_aa_doc.create') }}" class="btn btn-success btn-xs" title="{{ trans('ca_aa_docs.create') }}">
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
                <a href="{{ route('ca_aa_docs.ca_aa_doc.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($caAaDocs) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('ca_aa_docs.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('ca_aa_docs.ca_aa_doc.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
                                                <div class="form-group col-md-4 {{ $errors->has('material_id') ? 'has-error' : '' }}">
                                                    <label for="material_id" class="control-label">{{ trans('ca_aa_docs.material_id') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="material_id" name="material_id">
                                                                    <option value="" style="display: none;" {{ old('material_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('ca_aa_docs.material_id__placeholder') }}</option>
                                                                @foreach ($caMaterials as $key => $caMaterial)
                                                                            <option value="{{ $key }}" {{ old('material_id') == $key ? 'selected' : '' }}>
                                                                                {{ $caMaterial }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('material_id', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>

                                                <div class="form-group col-md-4 {{ $errors->has('categoria_id') ? 'has-error' : '' }}">
                                                    <label for="categoria_id" class="control-label">{{ trans('ca_aa_docs.categoria_id') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="categoria_id" name="categoria_id">
                                                                    <option value="" style="display: none;" {{ old('categoria_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('ca_aa_docs.categoria_id__placeholder') }}</option>
                                                                @foreach ($caCategorias as $key => $caCategorium)
                                                                            <option value="{{ $key }}" {{ old('categoria_id') == $key ? 'selected' : '' }}>
                                                                                {{ $caCategorium }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('categoria_id', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>

                                                <div class="form-group col-md-4 {{ $errors->has('doc') ? 'has-error' : '' }}">
                                                    <label for="doc" class="control-label">{{ trans('ca_aa_docs.doc') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <input class="form-control input-sm " name="doc" type="text" id="doc" value="{{ old('doc') }}" minlength="1" maxlength="255" placeholder="{{ trans('ca_aa_docs.doc__placeholder') }}">
                                                        {!! $errors->first('doc', '<p class="help-block">:message</p>') !!}
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
                            <th>{{ trans('ca_aa_docs.entity_id') }}</th>
                            <th>{{ trans('ca_aa_docs.material_id') }}</th>
                            <th>{{ trans('ca_aa_docs.categoria_id') }}</th>
                            <th>{{ trans('ca_aa_docs.doc') }}</th>
                            
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($caAaDocs as $caAaDoc)
                        <tr>
                            <td>{{ $caAaDoc->id }}</td>
                            <td>{{ $caAaDoc->entity->abreviatura }}</td>
                            <td>{{ optional($caAaDoc->caMaterial)->material }}</td>
                            <td>{{ optional($caAaDoc->caCategoria)->categoria }}</td>
                            <td>{{ $caAaDoc->doc }}</td>

                            <td>

                                <form method="POST" action="{!! route('ca_aa_docs.ca_aa_doc.destroy', $caAaDoc->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('ca_aa_docs.ca_aa_doc.show')
                                        <a href="{{ route('ca_aa_docs.ca_aa_doc.show', $caAaDoc->id ) }}" class="btn btn-info btn-xs" title="{{ trans('ca_aa_docs.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('ca_aa_docs.ca_aa_doc.edit')
                                        <a href="{{ route('ca_aa_docs.ca_aa_doc.edit', $caAaDoc->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('ca_aa_docs.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('ca_aa_docs.ca_aa_doc.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('ca_aa_docs.delete') }}" onclick="return confirm(&quot;{{ trans('ca_aa_docs.confirm_delete') }}&quot;)">
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
            {!! $caAaDocs->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection