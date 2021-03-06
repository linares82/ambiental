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
            <a href="{{ route('m_mantenimientos.m_mantenimiento.index') }}">{{ trans('m_mantenimientos.model_plural') }}</a>
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
            <h4 class="mt-5 mb-5">{{ trans('m_mantenimientos.model_plural') }}</h4>
        </div>

        @ifUserCan('m_mantenimientos.m_mantenimiento.create')
        <div class="btn-group btn-group-sm pull-right" role="group">
            <a href="{{ route('m_mantenimientos.m_mantenimiento.create') }}" class="btn btn-success btn-xs" title="{{ trans('m_mantenimientos.create') }}">
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
            <a href="{{ route('m_mantenimientos.m_mantenimiento.index') }}" class="btn btn-xs" title="Refrescar">
                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
            </a>
        </div>
    </div>

    @if(count($mMantenimientos) == 0)
    <div class="panel-body text-center">
        <h4>{{ trans('m_mantenimientos.none_available') }}</h4>
    </div>
    @else
    <div class="panel-body panel-body-with-table">
        <div class="row" >
            <div class="col-md-12">
                <form method="GET" action="{{ route('m_mantenimientos.m_mantenimiento.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="GET">
                    <div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
                        <label for="id" class="control-label">Id</label>
                        <input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
                    </div>
                    <div class="form-group col-md-4 {{ $errors->has('m_tpo_manto_id') ? 'has-error' : '' }}">
                        <label for="m_tpo_manto_id" class="control-label">{{ trans('m_mantenimientos.m_tpo_manto_id') }}</label>
                        <!--<div class="col-md-10">-->
                        <select class="form-control chosen" id="m_tpo_manto_id" name="m_tpo_manto_id">
                            <option value="" style="display: none;" {{ old('m_tpo_manto_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.m_tpo_manto_id__placeholder') }}</option>
                            @foreach ($mTpoMantos as $key => $mTpoManto)
                            <option value="{{ $key }}" {{ old('m_tpo_manto_id') == $key ? 'selected' : '' }}>
                                    {{ $mTpoManto }}
                        </option>
                        @endforeach
                    </select>

                    {!! $errors->first('m_tpo_manto_id', '<p class="help-block">:message</p>') !!}
                    <!--</div>-->
                </div>

                <div class="form-group col-md-4 {{ $errors->has('objetivo_id') ? 'has-error' : '' }}">
                    <label for="objetivo_id" class="control-label">{{ trans('m_mantenimientos.objetivo_id') }}</label>
                    <!--<div class="col-md-10">-->
                    <select class="form-control chosen" id="objetivo_id" name="objetivo_id">
                        <option value="" style="display: none;" {{ old('objetivo_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.objetivo_id__placeholder') }}</option>
                        @foreach ($mObjetivos as $key => $mObjetivo)
                        <option value="{{ $key }}" {{ old('objetivo_id') == $key ? 'selected' : '' }}>
                                {{ $mObjetivo }}
                    </option>
                    @endforeach
                </select>

                {!! $errors->first('objetivo_id', '<p class="help-block">:message</p>') !!}
                <!--</div>-->
            </div>

            <div class="form-group col-md-4 {{ $errors->has('subequipo_id') ? 'has-error' : '' }}" style="clear:left;">
                <label for="subequipo_id" class="control-label">{{ trans('m_mantenimientos.subequipo_id') }}</label>
                <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="subequipo_id" name="subequipo_id">
                    <option value="" style="display: none;" {{ old('subequipo_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.subequipo_id__placeholder') }}</option>
                    @foreach ($subequipos as $key => $subequipo)
                    <option value="{{ $key }}" {{ old('subequipo_id') == $key ? 'selected' : '' }}>
                            {{ $subequipo }}
                </option>
                @endforeach
            </select>
            <div class="row_1"><div id='loading1' style='display: none'><img src="{{ asset('img/ajax-loader.gif') }}" title="Loading" /></div> </div>
            {!! $errors->first('subequipo_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>
        <div class="form-group col-md-4 {{ $errors->has('estatus_id') ? 'has-error' : '' }}">
            <label for="estatus_id" class="control-label">{{ trans('m_mantenimientos.estatus_id') }}</label>
            <!--<div class="col-md-10">-->
            <select class="form-control chosen" id="estatus_id" name="estatus_id">
                <option value="" style="display: none;" {{ old('estatus_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.estatus_id__placeholder') }}</option>
                @foreach ($mEstatuses as $key => $mEstatus)
                <option value="{{ $key }}" {{ old('estatus_id') == $key ? 'selected' : '' }}>
                        {{ $mEstatus }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('estatus_id', '<p class="help-block">:message</p>') !!}
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
                <th>{{ trans('m_mantenimientos.no_orden') }}</th>
                <th>{{ trans('m_mantenimientos.entity_id') }}</th>
                <th>{{ trans('m_mantenimientos.m_tpo_manto_id') }}</th>
                <th>{{ trans('m_mantenimientos.objetivo_id') }}</th>
                <th>{{ trans('m_mantenimientos.subequipo_id') }}</th>
                <th>{{ trans('m_mantenimientos.descripcion') }}</th>
                <th>{{ trans('m_mantenimientos.estatus_id') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($mMantenimientos as $mMantenimiento)
            <tr>
                <td>{{ $mMantenimiento->no_orden }}</td>
                <td>{{ $mMantenimiento->entity->abreviatura }}</td>
                <td>{{ optional($mMantenimiento->mTpoManto)->tpo_manto }}</td>
                <td>{{ optional($mMantenimiento->mObjetivo)->objetivo }}</td>
                <td>{{ optional($mMantenimiento->subequipo)->subequipo }}</td>
                <td>{{ $mMantenimiento->descripcion }}</td>
                <td>{{ optional($mMantenimiento->mEstatus)->estatus }}</td>

                <td>

                    <form method="POST" action="{!! route('m_mantenimientos.m_mantenimiento.destroy', $mMantenimiento->id) !!}" accept-charset="UTF-8">
                        <input name="_method" value="DELETE" type="hidden">
                        {{ csrf_field() }}

                        <div class="btn-group btn-group-xs pull-right" role="group">
                            <a href="{{ route('m_mantenimientos.m_mantenimiento.reporte', $mMantenimiento->id ) }}" class="btn btn-warning btn-xs" title="Reporte">
                                <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                            </a>
                            @ifUserCan('m_mantenimientos.m_mantenimiento.show')
                            <a href="{{ route('m_mantenimientos.m_mantenimiento.show', $mMantenimiento->id ) }}" class="btn btn-info btn-xs" title="{{ trans('m_mantenimientos.show') }}">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>
                            @endif
                            @ifUserCan('m_mantenimientos.m_mantenimiento.edit')
                            <a href="{{ route('m_mantenimientos.m_mantenimiento.edit', $mMantenimiento->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('m_mantenimientos.edit') }}">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                            @endif
                            @ifUserCan('m_mantenimientos.m_mantenimiento.destroy')
                            <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('m_mantenimientos.delete') }}" onclick="return confirm(&quot;{{ trans('m_mantenimientos.confirm_delete') }}& quot; )">
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
    {!! $mMantenimientos->render() !!}
</div>

@endif

</div>
@endsection