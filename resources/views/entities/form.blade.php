
<div class="form-group col-md-4 {{ $errors->has('rzon_social') ? 'has-error' : '' }}">
    <label for="rzon_social" class="control-label">{{ trans('entities.rzon_social') }}</label>
    
        <input class="form-control input-sm " name="rzon_social" type="text" id="rzon_social" value="{{ old('rzon_social', optional($entity)->rzon_social) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('entities.rzon_social__placeholder') }}">
        {!! $errors->first('rzon_social', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('responsable') ? 'has-error' : '' }}">
    <label for="responsable" class="control-label">{{ trans('entities.responsable') }}</label>
    
        <input class="form-control input-sm " name="responsable" type="text" id="responsable" value="{{ old('responsable', optional($entity)->responsable) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('entities.responsable__placeholder') }}">
        {!! $errors->first('responsable', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('dir1') ? 'has-error' : '' }}">
    <label for="dir1" class="control-label">{{ trans('entities.dir1') }}</label>
    
        <input class="form-control input-sm " name="dir1" type="text" id="dir1" value="{{ old('dir1', optional($entity)->dir1) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('entities.dir1__placeholder') }}">
        {!! $errors->first('dir1', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('dir2') ? 'has-error' : '' }}">
    <label for="dir2" class="control-label">{{ trans('entities.dir2') }}</label>
    
        <input class="form-control input-sm " name="dir2" type="text" id="dir2" value="{{ old('dir2', optional($entity)->dir2) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('entities.dir2__placeholder') }}">
        {!! $errors->first('dir2', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('rfc') ? 'has-error' : '' }}">
    <label for="rfc" class="control-label">{{ trans('entities.rfc') }}</label>
    
        <input class="form-control input-sm " name="rfc" type="text" id="rfc" value="{{ old('rfc', optional($entity)->rfc) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('entities.rfc__placeholder') }}">
        {!! $errors->first('rfc', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('abreviatura') ? 'has-error' : '' }}">
    <label for="abreviatura" class="control-label">{{ trans('entities.abreviatura') }}</label>
    
        <input class="form-control input-sm " name="abreviatura" type="text" id="abreviatura" value="{{ old('abreviatura', optional($entity)->abreviatura) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('entities.abreviatura__placeholder') }}">
        {!! $errors->first('abreviatura', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-2 {{ $errors->has('multi_entidad') ? 'has-error' : '' }}">
    <label for="multi_entidad" class="control-label">{{ trans('entities.multi_entidad') }}</label>
    
        <div class="checkbox">
            <label for="multi_entidad_1">
            	<input id="multi_entidad_1" class="" name="multi_entidad" type="checkbox" value="1" {{ old('multi_entidad', optional($entity)->multi_entidad) == '1' ? 'checked' : '' }}>
                Si
            </label>
        </div>

        {!! $errors->first('multi_entidad', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-3 {{ $errors->has('filtred_by_entity') ? 'has-error' : '' }}">
    <label for="filtred_by_entity" class="control-label">{{ trans('entities.filtred_by_entity') }}</label>
    
        <div class="checkbox">
            <label for="filtred_by_entity">
            	<input id="filtred_by_entity" class="" name="filtred_by_entity" type="checkbox" value="1" {{ old('filtred_by_entity', optional($entity)->filtred_by_entity) == '1' ? 'checked' : '' }}>
                Si
            </label>
        </div>

        {!! $errors->first('multi_entidad', '<p class="help-block">:message</p>') !!}
    
</div>

<!--<div class="form-group col-md-4 {{ $errors->has('logo') ? 'has-error' : '' }}">
    <label for="logo" class="control-label">{{ trans('entities.logo') }}</label>
    
        <input class="form-control input-sm " name="logo" type="text" id="logo" value="{{ old('logo', optional($entity)->logo) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('entities.logo__placeholder') }}">
        {!! $errors->first('logo', '<p class="help-block">:message</p>') !!}
    
</div>-->
@if(isset($entity))
<div class="row"></div>
<div class="form-group">
    <div class="btn btn-default btn-file">
        <i class="fa fa-paperclip"></i> Adjuntar Archivo
        <input type="file"  id="logo" name="logo" class="archivo" >
        <input type="hidden"  id="file_hidden" name="file_hidden" >
    </div>
    <p class="help-block"  >Max. 20MB</p>
    <div id="texto_notificacion">

    </div>
</div>
@endif
@push('scripts')
<script>
$(document).on("change", ".archivo", function (e) {

        var miurl = "{{route('entities.entity.cargaArchivo')}}";
        
        var divresul = "texto_notificacion";

        var data = new FormData();
        data.append('file', $('#logo')[0].files[0]);
        
        @if(isset($entity))
        data.append('id', {{$entity->id}});
        @endif
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#_token').val()
            }
        });
        $.ajax({
            url: miurl,
            type: 'POST',

            // Form data
            //datos del formulario
            data: data,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function () {
                $("#" + divresul + "").html($("#cargador_empresa").html());
            },
            //una vez finalizado correctamente
            success: function (data) {
                var codigo = '<div class="mailbox-attachment-info"><a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>' + data + '</a><span class="mailbox-attachment-size"> </span></div>';
                $("#" + divresul + "").html(codigo);
                $('#file_hidden').val(data);    
            },
            //si ha ocurrido un error
            error: function (data) {
                $("#" + divresul + "").html(data);

            }
        });

    })
</script>
@endpush