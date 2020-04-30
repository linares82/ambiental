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
				<a href="{{ route('condiciones.condicione.index') }}">{{ trans('condiciones.model_plural') }}</a>
			</li>
			<li class="active">Crear</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('condiciones.create') }}</h4>
            </span>
            @ifUserCan('condiciones.condicione.index')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('condiciones.condicione.index') }}" class="btn btn-primary" title="{{ trans('condiciones.show_all') }}">
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

{{ Form::open(array('route' => 'consultas.consulta.postManto', 'class' => 'form', 'method' => 'POST')) }}
    <div class="easyui-tabs" style="width:auto;height:auto;">
        <div title="Crear" style="padding:10px;">  

            <div class="row">
                <div class="col-md-10 col-md-offset-2">

                    @if ($errors->any())
                        <div class="errorSumary">
                            Por favor corregir los siguientes errores de captura: 
                            <ul >
                                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                            </ul>
                        </div>
                        
                    @endif

                </div>
            </div>

        <div class="form-group col-md-6 {{ $errors->has('area_t') ? 'has-error' : '' }}">
            {{ Form::label('cia_f', 'Entidad de:') }}
	       <select class="form-control chosen" id="cia_f" name="cia_f" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($cias_ls as $key => $cia)
                                    <option value="{{ $key }}">
                                        {{ $cia }}
                                    </option>
                                @endforeach
                </select>

            {{ $errors->first('cia_f', '<div class="errorMessage">:message</div>') }}
        </div>
        <div class="form-group col-md-6 {{ $errors->has('area_t') ? 'has-error' : '' }}">
            {{ Form::label('cia_t', 'Entidad a:') }}
	    <select class="form-control chosen" id="cia_t" name="cia_t" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($cias_ls as $key => $cia)
                                    <option value="{{ $key }}">
                                        {{ $cia }}
                                    </option>
                                @endforeach
                </select>

            {{ $errors->first('cia_t', '<div class="errorMessage">:message</div>') }}
        </div>
        <div class="form-group col-md-6 {{ $errors->has('area_t') ? 'has-error' : '' }}">
            {{ Form::label('area_f', 'Area de:') }}
            <select class="form-control chosen" id="area_f" name="area_f" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($areas_ls as $key => $cia)
                                    <option value="{{ $key }}">
                                        {{ $cia }}
                                    </option>
                                @endforeach
                </select>
            {{ $errors->first('area_f', '<div class="errorMessage">:message</div>') }}
        </div>
        <div class="form-group col-md-6 {{ $errors->has('area_t') ? 'has-error' : '' }}">
            {{ Form::label('area_t', 'Area a:') }}
            <select class="form-control chosen" id="area_t" name="area_t" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($areas_ls as $key => $cia)
                                    <option value="{{ $key }}">
                                        {{ $cia }}
                                    </option>
                                @endforeach
                </select>
            {{ $errors->first('area_t', '<div class="errorMessage">:message</div>') }}
        </div>

        <div class="form-group col-md-6 {{ $errors->has('area_t') ? 'has-error' : '' }}">
	     {{ Form::label('objetivo_t', 'Objetivo de:') }}
              <select class="form-control chosen" id="objetivo_f" name="objetivo_f" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($objetivos_ls as $key => $objetivo)
                                    <option value="{{ $key }}">
                                        {{ $objetivo }}
                                    </option>
                                @endforeach
                </select>
            {{ $errors->first('objetivo_f', '<div class="errorMessage">:message</div>') }}
        </div>

        <div class="form-group col-md-6 {{ $errors->has('area_t') ? 'has-error' : '' }}">
            {{ Form::label('objetivo_t', 'Objetivo a:') }}
              <select class="form-control chosen" id="objetivo_t" name="objetivo_t" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($objetivos_ls as $key => $objetivo)
                                    <option value="{{ $key }}">
                                        {{ $objetivo }}
                                    </option>
                                @endforeach
                </select>
            {{ $errors->first('objetivo_t', '<div class="errorMessage">:message</div>') }}
        </div>
        <div class="form-group col-md-6 {{ $errors->has('area_t') ? 'has-error' : '' }}">
            {{ Form::label('estatus_f', 'Estatus de:') }}
              <select class="form-control chosen" id="estatus_f" name="estatus_f" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($estatus_ls as $key => $estatus)
                                    <option value="{{ $key }}">
                                        {{ $estatus }}
                                    </option>
                                @endforeach
                </select>
            {{ $errors->first('estatus_f', '<div class="errorMessage">:message</div>') }}
        </div>
        <div class="form-group col-md-6 {{ $errors->has('area_t') ? 'has-error' : '' }}">
            {{ Form::label('estatus_t', 'Estatus a:') }}
              <select class="form-control chosen" id="estatus_t" name="estatus_t" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($estatus_ls as $key => $estatus)
                                    <option value="{{ $key }}">
                                        {{ $estatus }}
                                    </option>
                                @endforeach
                </select>
            {{ $errors->first('estatus_t', '<div class="errorMessage">:message</div>') }}
        </div>
        <div class="form-group col-md-6 {{ $errors->has('area_t') ? 'has-error' : '' }}">
            {{ Form::label('tpo_manto_f', 'Tipo Manto. de:') }}
              <select class="form-control chosen" id="tpo_manto_f" name="tpo_manto_f" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($tpo_mantos_ls as $key => $tpo_manto)
                                    <option value="{{ $key }}">
                                        {{ $tpo_manto }}
                                    </option>
                                @endforeach
                </select>
            {{ $errors->first('tpo_manto_f', '<div class="errorMessage">:message</div>') }}
        </div>
        <div class="form-group col-md-6 {{ $errors->has('area_t') ? 'has-error' : '' }}">
            {{ Form::label('tpo_manto_t', 'Tipo Manto a:') }}
              <select class="form-control chosen" id="tpo_manto_t" name="tpo_manto_t" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($tpo_mantos_ls as $key => $tpo_manto)
                                    <option value="{{ $key }}">
                                        {{ $tpo_manto }}
                                    </option>
                                @endforeach
                </select>
            {{ $errors->first('tpo_manto_t', '<div class="errorMessage">:message</div>') }}
        </div>
        
		<div class="row_buttons">
			  {{ Form::submit('Crear', array('class' => 'easyui-linkbutton', 'style'=>'height:30px;width:100px;')) }}
		</div>
	</div>
</div>

{{ Form::close() }}

@endsection

@push('scripts')
<script type="text/javascript">
    $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
    })
    //show datepicker when clicking on the icon
    .next().on(ace.click_event, function(){
            $(this).prev().focus();
    });
</script>
@endpush    

