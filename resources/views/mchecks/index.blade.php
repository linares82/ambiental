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
				<a href="{{ route('mchecks.mcheck.index') }}">{{ trans('mchecks.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('mchecks.model_plural') }}</h4>
            </div>
            
            @ifUserCan('mchecks.mcheck.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('mchecks.mcheck.create') }}" class="btn btn-success btn-xs" title="{{ trans('mchecks.create') }}">
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
                <a href="{{ route('mchecks.mcheck.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($mchecks) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('mchecks.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('mchecks.mcheck.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
                                                <div class="form-group col-md-4 {{ $errors->has('a_chequeo') ? 'has-error' : '' }}">
                                                    <label for="a_chequeo" class="control-label">{{ trans('mchecks.a_chequeo') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="a_chequeo" name="a_chequeo">
                                                                    <option value="" style="display: none;" {{ old('a_chequeo') == '' ? 'selected' : '' }} disabled selected>{{ trans('mchecks.a_chequeo__placeholder') }}</option>
                                                                @foreach ($achecks as $key => $acheck)
                                                                            <option value="{{ $key }}" {{ old('a_chequeo') == $key ? 'selected' : '' }}>
                                                                                {{ $acheck }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('a_chequeo', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>

                                                <div class="form-group col-md-4 {{ $errors->has('norma_id') ? 'has-error' : '' }}">
                                                    <label for="norma_id" class="control-label">{{ trans('mchecks.norma_id') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="norma_id" name="norma_id" >
                                                                    <option value="" style="display: none;" {{ old('norma_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('mchecks.norma_id__placeholder') }}</option>
                                                                @foreach ($normas as $key => $norma)
                                                                            <option value="{{ $key }}" {{ old('norma_id') == $key ? 'selected' : '' }}>
                                                                                {{ $norma }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('norma_id', '<p class="help-block">:message</p>') !!}
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
                            <th>{{ trans('mchecks.a_chequeo') }}</th>
                            <th>{{ trans('mchecks.norma_id') }}</th>
                            <th>{{ trans('mchecks.no_conformidad') }}</th>
                            <th>{{ trans('mchecks.requisito') }}</th>
                            <th>{{ trans('mchecks.rnc') }}</th>
                            <th>{{ trans('mchecks.minimo_vsm') }}</th>
                            <th>{{ trans('mchecks.maximo_vsm') }}</th>
                            <th>{{ trans('mchecks.orden') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($mchecks as $mcheck)
                        <tr>
                            <td>{{ $mcheck->id }}</td>
                            <td>{{ optional($mcheck->acheck)->area }}</td>
                            <td>{{ optional($mcheck->norma)->norma }}</td>
                            <td>{{ $mcheck->no_conformidad }}</td>
                            <td>{{ $mcheck->requisito }}</td>
                            <td>{{ $mcheck->rnc }}</td>
                            <td>{{ $mcheck->minimo_vsm }}</td>
                            <td>{{ $mcheck->maximo_vsm }}</td>
                            <td>{{ $mcheck->orden }}</td>
                            <td>

                                <form method="POST" action="{!! route('mchecks.mcheck.destroy', $mcheck->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('mchecks.mcheck.show')
                                        <a href="{{ route('mchecks.mcheck.show', $mcheck->id ) }}" class="btn btn-info btn-xs" title="{{ trans('mchecks.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('mchecks.mcheck.edit')
                                        <a href="{{ route('mchecks.mcheck.edit', $mcheck->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('mchecks.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('mchecks.mcheck.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('mchecks.delete') }}" onclick="return confirm(&quot;{{ trans('mchecks.confirm_delete') }}&quot;)">
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
            {!! $mchecks->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection