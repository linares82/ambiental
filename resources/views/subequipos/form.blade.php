
<div class="form-group col-md-4 {{ $errors->has('equipo_id') ? 'has-error' : '' }}">
    <label for="equipo_id" class="control-label">{{ trans('subequipos.equipo_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="equipo_id" name="equipo_id" required="true">
        	    <option value="" style="display: none;" {{ old('equipo_id', optional($subequipo)->equipo_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('subequipos.equipo_id__placeholder') }}</option>
        	@foreach ($mObjetivos as $key => $mObjetivo)
			    <option value="{{ $key }}" {{ old('equipo_id', optional($subequipo)->equipo_id) == $key ? 'selected' : '' }}>
			    	{{ $mObjetivo }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('equipo_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('subequipo') ? 'has-error' : '' }}">
    <label for="subequipo" class="control-label">{{ trans('subequipos.subequipo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="subequipo" type="text" id="subequipo" value="{{ old('subequipo', optional($subequipo)->subequipo) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('subequipos.subequipo__placeholder') }}">
        {!! $errors->first('subequipo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('clase') ? 'has-error' : '' }}">
    <label for="clase" class="control-label">{{ trans('subequipos.clase') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="clase" type="text" id="clase" value="{{ old('clase', optional($subequipo)->clase) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('subequipos.clase__placeholder') }}">
        {!! $errors->first('clase', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('marca') ? 'has-error' : '' }}">
    <label for="marca" class="control-label">{{ trans('subequipos.marca') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="marca" type="text" id="marca" value="{{ old('marca', optional($subequipo)->marca) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('subequipos.marca__placeholder') }}">
        {!! $errors->first('marca', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('modelo') ? 'has-error' : '' }}">
    <label for="modelo" class="control-label">{{ trans('subequipos.modelo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="modelo" type="text" id="modelo" value="{{ old('modelo', optional($subequipo)->modelo) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('subequipos.modelo__placeholder') }}">
        {!! $errors->first('modelo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('no_serie') ? 'has-error' : '' }}">
    <label for="no_serie" class="control-label">{{ trans('subequipos.no_serie') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="no_serie" type="text" id="no_serie" value="{{ old('no_serie', optional($subequipo)->no_serie) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('subequipos.no_serie__placeholder') }}">
        {!! $errors->first('no_serie', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fecha_carga') ? 'has-error' : '' }}">
    <label for="fecha_carga" class="control-label">{{ trans('subequipos.fecha_carga') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="fecha_carga" type="text" id="fecha_carga" value="{{ old('fecha_carga', optional($subequipo)->fecha_carga) }}" required="true" placeholder="{{ trans('subequipos.fecha_carga__placeholder') }}">
        {!! $errors->first('fecha_carga', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('area_id') ? 'has-error' : '' }}">
    <label for="area_id" class="control-label">{{ trans('subequipos.area_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="area_id" name="area_id" required="true">
        	    <option value="" style="display: none;" {{ old('area_id', optional($subequipo)->area_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('subequipos.area_id__placeholder') }}</option>
        	@foreach ($areas as $key => $area)
			    <option value="{{ $key }}" {{ old('area_id', optional($subequipo)->area_id) == $key ? 'selected' : '' }}>
			    	{{ $area }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('area_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('ubicacion') ? 'has-error' : '' }}">
    <label for="ubicacion" class="control-label">{{ trans('subequipos.ubicacion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="ubicacion" type="text" id="ubicacion" value="{{ old('ubicacion', optional($subequipo)->ubicacion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('subequipos.ubicacion__placeholder') }}">
        {!! $errors->first('ubicacion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


