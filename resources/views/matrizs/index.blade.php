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
            <a href="{{ route('matrizs.matriz.index') }}">{{ trans('matrizs.model_plural') }}</a>
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
            <h4 class="mt-5 mb-5">{{ trans('matrizs.model_plural') }}</h4>
        </div>

        @ifUserCan('matrizs.matriz.create')
        <div class="btn-group btn-group-sm pull-right" role="group">
            <a href="{{ route('matrizs.matriz.create') }}" class="btn btn-success btn-xs" title="{{ trans('matrizs.create') }}">
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
            <a href="{{ route('matrizs.matriz.index') }}" class="btn btn-xs" title="Refrescar">
                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
            </a>
        </div>
    </div>

    @if(count($matrizs) == 0)
    <div class="panel-body text-center">
        <h4>{{ trans('matrizs.none_available') }}</h4>
    </div>
    @else
    <div class="panel-body panel-body-with-table">
        <div class="row" >
            <div class="col-md-12">
                <form method="GET" action="{{ route('matrizs.matriz.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="GET">
                    <div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
                        <label for="id" class="control-label">Id</label>
                        <input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
                    </div>
                    <div class="form-group col-md-4 {{ $errors->has('tipo_impacto_id') ? 'has-error' : '' }}">
                        <label for="tipo_impacto_id" class="control-label">{{ trans('matrizs.tipo_impacto_id') }}</label>
                        <!--<div class="col-md-10">-->
                        <select class="form-control chosen" id="tipo_impacto_id" name="tipo_impacto_id">
                            <option value="" style="display: none;" {{ old('tipo_impacto_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('matrizs.tipo_impacto_id__placeholder') }}</option>
                            @foreach ($tipoImpactos as $key => $tipoImpacto)
                            <option value="{{ $key }}" {{ old('tipo_impacto_id') == $key ? 'selected' : '' }}>
                                    {{ $tipoImpacto }}
                        </option>
                        @endforeach
                    </select>

                    {!! $errors->first('tipo_impacto_id', '<p class="help-block">:message</p>') !!}
                    <!--</div>-->
                </div>

                <div class="form-group col-md-4 {{ $errors->has('factor_id') ? 'has-error' : '' }}">
                    <label for="factor_id" class="control-label">{{ trans('matrizs.factor_id') }}</label>
                    <!--<div class="col-md-10">-->
                    <select class="form-control chosen" id="factor_id" name="factor_id" >
                        <option value="" style="display: none;" {{ old('factor_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('matrizs.factor_id__placeholder') }}</option>
                        @foreach ($factors as $key => $factor)
                        <option value="{{ $key }}" {{ old('factor_id') == $key ? 'selected' : '' }}>
                                {{ $factor }}
                    </option>
                    @endforeach
                </select>

                {!! $errors->first('factor_id', '<p class="help-block">:message</p>') !!}
                <!--</div>-->
            </div>

            <div class="form-group col-md-4 {{ $errors->has('rubro_id') ? 'has-error' : '' }}">
                <label for="rubro_id" class="control-label">{{ trans('matrizs.rubro_id') }}</label>
                <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="rubro_id" name="rubro_id">
                    <option value="" style="display: none;" {{ old('rubro_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('matrizs.rubro_id__placeholder') }}</option>
                    @foreach ($rubros as $key => $rubro)
                    <option value="{{ $key }}" {{ old('rubro_id') == $key ? 'selected' : '' }}>
                            {{ $rubro }}
                </option>
                @endforeach
            </select>

            {!! $errors->first('rubro_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>

        <div class="form-group col-md-4 {{ $errors->has('especifico_id') ? 'has-error' : '' }}">
            <label for="especifico_id" class="control-label">{{ trans('matrizs.especifico_id') }}</label>
            <!--<div class="col-md-10">-->
            <select class="form-control chosen" id="especifico_id" name="especifico_id">
                <option value="" style="display: none;" {{ old('especifico_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('matrizs.especifico_id__placeholder') }}</option>
                @foreach ($especificos as $key => $especifico)
                <option value="{{ $key }}" {{ old('especifico_id') == $key ? 'selected' : '' }}>
                        {{ $especifico }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('especifico_id', '<p class="help-block">:message</p>') !!}
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
                <th>{{ trans('matrizs.tipo_impacto_id') }}</th>
                <th>{{ trans('matrizs.factor_id') }}</th>
                <th>{{ trans('matrizs.rubro_id') }}</th>
                <th>{{ trans('matrizs.especifico_id') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($matrizs as $matriz)
            <tr>
                <td>{{ $matriz->id }}</td>
                <td>{{ optional($matriz->tipoImpacto)->tipo_impacto }}</td>
                <td>{{ optional($matriz->factor)->factor }}</td>
                <td>{{ optional($matriz->rubro)->rubro }}</td>
                <td>{{ optional($matriz->especifico)->especifico }}</td>

                <td>

                    <form method="POST" action="{!! route('matrizs.matriz.destroy', $matriz->id) !!}" accept-charset="UTF-8">
                        <input name="_method" value="DELETE" type="hidden">
                        {{ csrf_field() }}

                        <div class="btn-group btn-group-xs pull-right" role="group">
                            @ifUserCan('matrizs.matriz.show')
                            <a href="{{ route('matrizs.matriz.show', $matriz->id ) }}" class="btn btn-info btn-xs" title="{{ trans('matrizs.show') }}">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>
                            @endif
                            @ifUserCan('matrizs.matriz.edit')
                            <a href="{{ route('matrizs.matriz.edit', $matriz->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('matrizs.edit') }}">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                            @endif
                            @ifUserCan('matrizs.matriz.destroy')
                            <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('matrizs.delete') }}" onclick="return confirm(&quot;{{ trans('matrizs.confirm_delete') }}& quot; )">
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
    {!! $matrizs->render() !!}
</div>

@endif

</div>
@endsection