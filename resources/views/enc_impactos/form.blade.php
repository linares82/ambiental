<div class="form-group col-md-4 {{ $errors->has('proyecto') ? 'has-error' : '' }}">
    <label for="proyecto" class="control-label">{{ trans('enc_impactos.proyecto') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="proyecto" type="text" id="proyecto" value="{{ old('proyecto', optional($encImpacto)->proyecto) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.proyecto__placeholder') }}">
        {!! $errors->first('proyecto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('tipo_impacto_id') ? 'has-error' : '' }}">
    <label for="tipo_impacto_id" class="control-label">{{ trans('enc_impactos.tipo_impacto_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tipo_impacto_id" name="tipo_impacto_id" required="true">
        	    <option value="" style="display: none;" {{ old('tipo_impacto_id', optional($encImpacto)->tipo_impacto_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('enc_impactos.tipo_impacto_id__placeholder') }}</option>
        	@foreach ($tipoImpactos as $key => $tipoImpacto)
			    <option value="{{ $key }}" {{ old('tipo_impacto_id', optional($encImpacto)->tipo_impacto_id) == $key ? 'selected' : '' }}>
			    	{{ $tipoImpacto }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tipo_impacto_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fecha_inicio') ? 'has-error' : '' }}">
    <label for="fecha_inicio" class="control-label">{{ trans('enc_impactos.fecha_inicio') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="fecha_inicio" type="text" id="fecha_inicio" value="{{ old('fecha_inicio', optional($encImpacto)->fecha_inicio) }}" required="true" placeholder="{{ trans('enc_impactos.fecha_inicio__placeholder') }}">
        {!! $errors->first('fecha_inicio', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fecha_fin') ? 'has-error' : '' }}">
    <label for="fecha_fin" class="control-label">{{ trans('enc_impactos.fecha_fin') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="fecha_fin" type="text" id="fecha_fin" value="{{ old('fecha_fin', optional($encImpacto)->fecha_fin) }}" placeholder="{{ trans('enc_impactos.fecha_fin__placeholder') }}">
        {!! $errors->first('fecha_fin', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('up_calle') ? 'has-error' : '' }}">
    <label for="up_calle" class="control-label">{{ trans('enc_impactos.up_calle') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="up_calle" type="text" id="up_calle" value="{{ old('up_calle', optional($encImpacto)->up_calle) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.up_calle__placeholder') }}">
        {!! $errors->first('up_calle', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('up_no') ? 'has-error' : '' }}">
    <label for="up_no" class="control-label">{{ trans('enc_impactos.up_no') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="up_no" type="text" id="up_no" value="{{ old('up_no', optional($encImpacto)->up_no) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.up_no__placeholder') }}">
        {!! $errors->first('up_no', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('up_colonia') ? 'has-error' : '' }}">
    <label for="up_colonia" class="control-label">{{ trans('enc_impactos.up_colonia') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="up_colonia" type="text" id="up_colonia" value="{{ old('up_colonia', optional($encImpacto)->up_colonia) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.up_colonia__placeholder') }}">
        {!! $errors->first('up_colonia', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('up_cp') ? 'has-error' : '' }}">
    <label for="up_cp" class="control-label">{{ trans('enc_impactos.up_cp') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="up_cp" type="text" id="up_cp" value="{{ old('up_cp', optional($encImpacto)->up_cp) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.up_cp__placeholder') }}">
        {!! $errors->first('up_cp', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('up_delegacion') ? 'has-error' : '' }}">
    <label for="up_delegacion" class="control-label">{{ trans('enc_impactos.up_delegacion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="up_delegacion" type="text" id="up_delegacion" value="{{ old('up_delegacion', optional($encImpacto)->up_delegacion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.up_delegacion__placeholder') }}">
        {!! $errors->first('up_delegacion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('up_sup_predio') ? 'has-error' : '' }}">
    <label for="up_sup_predio" class="control-label">{{ trans('enc_impactos.up_sup_predio') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="up_sup_predio" type="text" id="up_sup_predio" value="{{ old('up_sup_predio', optional($encImpacto)->up_sup_predio) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.up_sup_predio__placeholder') }}">
        {!! $errors->first('up_sup_predio', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('longitud') ? 'has-error' : '' }}">
    <label for="longitud" class="control-label">{{ trans('enc_impactos.longitud') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="longitud" type="text" id="longitud" value="{{ old('longitud', optional($encImpacto)->longitud) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.longitud__placeholder') }}">
        {!! $errors->first('longitud', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('latitud') ? 'has-error' : '' }}">
    <label for="latitud" class="control-label">{{ trans('enc_impactos.latitud') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="latitud" type="text" id="latitud" value="{{ old('latitud', optional($encImpacto)->latitud) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.latitud__placeholder') }}">
        {!! $errors->first('latitud', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('altitud') ? 'has-error' : '' }}">
    <label for="altitud" class="control-label">{{ trans('enc_impactos.altitud') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="altitud" type="text" id="altitud" value="{{ old('altitud', optional($encImpacto)->altitud) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.altitud__placeholder') }}">
        {!! $errors->first('altitud', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('utm_x') ? 'has-error' : '' }}">
    <label for="utm_x" class="control-label">{{ trans('enc_impactos.utm_x') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="utm_x" type="text" id="utm_x" value="{{ old('utm_x', optional($encImpacto)->utm_x) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.utm_x__placeholder') }}">
        {!! $errors->first('utm_x', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('utm_y') ? 'has-error' : '' }}">
    <label for="utm_y" class="control-label">{{ trans('enc_impactos.utm_y') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="utm_y" type="text" id="utm_y" value="{{ old('utm_y', optional($encImpacto)->utm_y) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.utm_y__placeholder') }}">
        {!! $errors->first('utm_y', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


<div class="form-group col-md-12 {{ $errors->has('notas') ? 'has-error' : '' }}">
    <label for="notas" class="control-label">{{ trans('enc_impactos.notas') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " name="notas" rows='2' type="text" id="notas" value="{{ old('notas', optional($encImpacto)->notas) }}">
        {{ trans('enc_impactos.notas__placeholder') }}
    </textarea>
        {!! $errors->first('notas', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class='row'></div>
<div class='page-header'>
<h3>Datos del promoviente</h3>
</div>

<div class="form-group col-md-4 {{ $errors->has('cliente_id') ? 'has-error' : '' }}">
    <label for="cliente_id" class="control-label">{{ trans('enc_impactos.cliente_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="cliente_id" name="cliente_id" required="true">
        	    <option value="" style="display: none;" {{ old('cliente_id', optional($encImpacto)->cliente_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('enc_impactos.cliente_id__placeholder') }}</option>
        	@foreach ($clientes as $key => $cliente)
			    <option value="{{ $key }}" {{ old('cliente_id', optional($encImpacto)->cliente_id) == $key ? 'selected' : '' }}>
			    	{{ $cliente }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('cliente_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('od_calle') ? 'has-error' : '' }}">
    <label for="od_calle" class="control-label">{{ trans('enc_impactos.od_calle') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="od_calle" type="text" id="od_calle" value="{{ old('od_calle', optional($encImpacto)->od_calle) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.od_calle__placeholder') }}">
        {!! $errors->first('od_calle', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('od_no') ? 'has-error' : '' }}">
    <label for="od_no" class="control-label">{{ trans('enc_impactos.od_no') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="od_no" type="text" id="od_no" value="{{ old('od_no', optional($encImpacto)->od_no) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.od_no__placeholder') }}">
        {!! $errors->first('od_no', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('od_colonia') ? 'has-error' : '' }}">
    <label for="od_colonia" class="control-label">{{ trans('enc_impactos.od_colonia') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="od_colonia" type="text" id="od_colonia" value="{{ old('od_colonia', optional($encImpacto)->od_colonia) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.od_colonia__placeholder') }}">
        {!! $errors->first('od_colonia', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('od_cp') ? 'has-error' : '' }}">
    <label for="od_cp" class="control-label">{{ trans('enc_impactos.od_cp') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="od_cp" type="text" id="od_cp" value="{{ old('od_cp', optional($encImpacto)->od_cp) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.od_cp__placeholder') }}">
        {!! $errors->first('od_cp', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('od_delegacion') ? 'has-error' : '' }}">
    <label for="od_delegacion" class="control-label">{{ trans('enc_impactos.od_delegacion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="od_delegacion" type="text" id="od_delegacion" value="{{ old('od_delegacion', optional($encImpacto)->od_delegacion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.od_delegacion__placeholder') }}">
        {!! $errors->first('od_delegacion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('od_rfc') ? 'has-error' : '' }}">
    <label for="od_rfc" class="control-label">{{ trans('enc_impactos.od_rfc') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="od_rfc" type="text" id="od_rfc" value="{{ old('od_rfc', optional($encImpacto)->od_rfc) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.od_rfc__placeholder') }}">
        {!! $errors->first('od_rfc', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('od_telefono') ? 'has-error' : '' }}">
    <label for="od_telefono" class="control-label">{{ trans('enc_impactos.od_telefono') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="od_telefono" type="text" id="od_telefono" value="{{ old('od_telefono', optional($encImpacto)->od_telefono) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.od_telefono__placeholder') }}">
        {!! $errors->first('od_telefono', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('od_correo') ? 'has-error' : '' }}">
    <label for="od_correo" class="control-label">{{ trans('enc_impactos.od_correo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="od_correo" type="text" id="od_correo" value="{{ old('od_correo', optional($encImpacto)->od_correo) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('enc_impactos.od_correo__placeholder') }}">
        {!! $errors->first('od_correo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class='row'></div>
<div class='page-header'>
<h3>Datos del Representante legal</h3><small>(En su caso)</small>
</div>
<div class="form-group col-md-4 {{ $errors->has('rl_ape_pat') ? 'has-error' : '' }}">
    <label for="rl_ape_pat" class="control-label">{{ trans('enc_impactos.rl_ape_pat') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="rl_ape_pat" type="text" id="rl_ape_pat" value="{{ old('rl_ape_pat', optional($encImpacto)->rl_ape_pat) }}" minlength="1" maxlength="255"  placeholder="{{ trans('enc_impactos.rl_ape_pat__placeholder') }}">
        {!! $errors->first('rl_ape_pat', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('rl_ape_mat') ? 'has-error' : '' }}">
    <label for="rl_ape_mat" class="control-label">{{ trans('enc_impactos.rl_ape_mat') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="rl_ape_mat" type="text" id="rl_ape_mat" value="{{ old('rl_ape_mat', optional($encImpacto)->rl_ape_mat) }}" minlength="1" maxlength="255"  placeholder="{{ trans('enc_impactos.rl_ape_mat__placeholder') }}">
        {!! $errors->first('rl_ape_mat', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('rl_nombre') ? 'has-error' : '' }}">
    <label for="rl_nombre" class="control-label">{{ trans('enc_impactos.rl_nombre') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="rl_nombre" type="text" id="rl_nombre" value="{{ old('rl_nombre', optional($encImpacto)->rl_nombre) }}" minlength="1" maxlength="255"  placeholder="{{ trans('enc_impactos.rl_nombre__placeholder') }}">
        {!! $errors->first('rl_nombre', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('rl_id_vigente') ? 'has-error' : '' }}">
    <label for="rl_id_vigente" class="control-label">{{ trans('enc_impactos.rl_id_vigente') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="rl_id_vigente" type="text" id="rl_id_vigente" value="{{ old('rl_id_vigente', optional($encImpacto)->rl_id_vigente) }}" minlength="1" maxlength="255" placeholder="{{ trans('enc_impactos.rl_id_vigente__placeholder') }}">
        {!! $errors->first('rl_id_vigente', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('rl_id_no') ? 'has-error' : '' }}">
    <label for="rl_id_no" class="control-label">{{ trans('enc_impactos.rl_id_no') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="rl_id_no" type="text" id="rl_id_no" value="{{ old('rl_id_no', optional($encImpacto)->rl_id_no) }}" minlength="1" maxlength="255"  placeholder="{{ trans('enc_impactos.rl_id_no__placeholder') }}">
        {!! $errors->first('rl_id_no', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('rl_no_intrumento') ? 'has-error' : '' }}">
    <label for="rl_no_intrumento" class="control-label">{{ trans('enc_impactos.rl_no_intrumento') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="rl_no_intrumento" type="text" id="rl_no_intrumento" value="{{ old('rl_no_intrumento', optional($encImpacto)->rl_no_intrumento) }}" minlength="1" maxlength="255"  placeholder="{{ trans('enc_impactos.rl_no_intrumento__placeholder') }}">
        {!! $errors->first('rl_no_intrumento', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('rl_autorizados') ? 'has-error' : '' }}">
    <label for="rl_autorizados" class="control-label">{{ trans('enc_impactos.rl_autorizados') }}</label>
    <!--<div class="col-md-10">-->
        <textarea class="form-control input-sm " rows='2' name="rl_autorizados" type="text" id="rl_autorizados">
            {{ old('rl_autorizados', optional($encImpacto)->rl_autorizados) }}
        </textarea>
        {!! $errors->first('rl_autorizados', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>



@push('scripts')
<script>

$('#fecha_inicio').datetimepicker({
    //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
    //locale: 'es',
    icons: {
           time: 'fa fa-clock-o',
           date: 'fa fa-calendar',
           up: 'fa fa-chevron-up',
           down: 'fa fa-chevron-down',
           previous: 'fa fa-chevron-left',
           next: 'fa fa-chevron-right',
           today: 'fa fa-arrows ',
           clear: 'fa fa-trash',
           close: 'fa fa-times'
    }
   }).next().on(ace.click_event, function(){
           $(this).prev().focus();
   });

$('#fecha_fin').datetimepicker({
    //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
    //locale: 'es',
    icons: {
           time: 'fa fa-clock-o',
           date: 'fa fa-calendar',
           up: 'fa fa-chevron-up',
           down: 'fa fa-chevron-down',
           previous: 'fa fa-chevron-left',
           next: 'fa fa-chevron-right',
           today: 'fa fa-arrows ',
           clear: 'fa fa-trash',
           close: 'fa fa-times'
    }
   }).next().on(ace.click_event, function(){
           $(this).prev().focus();
   });

$('.show-details-btn').on('click', function(e) {
        e.preventDefault();
        $(this).closest('tr').next().toggleClass('open');
        $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
});
</script>
@endpush