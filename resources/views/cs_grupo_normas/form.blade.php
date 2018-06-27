
<div class="form-group col-md-4 {{ $errors->has('grupo_norma') ? 'has-error' : '' }}">
    <label for="grupo_norma" class="control-label">{{ trans('cs_grupo_normas.grupo_norma') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="grupo_norma" type="text" id="grupo_norma" value="{{ old('grupo_norma', optional($csGrupoNorma)->grupo_norma) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('cs_grupo_normas.grupo_norma__placeholder') }}">
        {!! $errors->first('grupo_norma', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

