<link href="{{ asset('ace-master/assets/css/jquery.loading.css') }}" rel="stylesheet">
<div class="form-group col-md-4 {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('permission_groups.name') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="name" type="text" id="name" value="{{ old('name', optional($permissionGroup)->name) }}" maxlength="255" placeholder="{{ trans('permission_groups.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('module') ? 'has-error' : '' }}">
    <label for="module" class="col-md-2 control-label">{{ trans('permission_groups.module') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="module" type="text" id="module" value="{{ old('module', optional($permissionGroup)->module) }}" maxlength="255" placeholder="{{ trans('permission_groups.module__placeholder') }}">
        {!! $errors->first('module', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="row"></div>
@if(isset($permissionGroup))
<div class="row"><strong>Permisos relacionados</strong></div>
<div class="row_permisos_relacionados">
    
    <div class="col-xs-5">
        {!! Form::select("select-permisos_id", $permissions, null, array("class" => "form-control select-multiple", "id" => "select-permisos_from", "name"=>"from[]", 'multiple'=>'multiple', 'style'=>'height:200px;')) !!}
    </div>

    <div class="col-xs-2">
        <!--<button type="button" id="right_All_1" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>-->
        <button type="button" id="right_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
        <button type="button" id="left_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
        <!--<button type="button" id="left_All_1" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>-->
    </div>

    <div class="col-xs-5">
        {!! Form::select("select-permisos_id", $permisosRelacionados, null, array("class" => "form-control select-multiple", "id" => "select-permisos_to", "name"=>"to[]", 'multiple'=>'multiple', 'style'=>'height:200px;')) !!}
    </div>
</div>
<div class="row"> <strong>Roles relacionados</strong> </div>
<div class="row_roles_relacionados">
    
    <div class="col-xs-5">
        {!! Form::select("select-roles_id", $roles, null, array("class" => "form-control select-multiple", "id" => "select-roles_from", "name"=>"from[]", 'multiple'=>'multiple', 'style'=>'height:200px;')) !!}
    </div>

    <div class="col-xs-2">
        <!--<button type="button" id="right_All_1" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>-->
        <button type="button" id="right_Selected_2" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
        <button type="button" id="left_Selected_2" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
        <!--<button type="button" id="left_All_1" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>-->
    </div>

    <div class="col-xs-5">
        {!! Form::select("select-roles_id", $rolesRelacionados, null, array("class" => "form-control select-multiple", "id" => "select-roles_to", "name"=>"to[]", 'multiple'=>'multiple', 'style'=>'height:200px;')) !!}
    </div>
</div>


@push('scripts')
<script src="{{ asset('ace-master/assets/js/multiselect.js') }}"></script>
<script src="{{ asset('ace-master/assets/js/jquery.loading.js') }}"></script>

<script type="text/javascript">
    
    
    jQuery(document).ready(function($) {
        $('#select-permisos_from').multiselect({
            right: '#select-permisos_to',
            search: {
                left: '<input type="text" name="q" class="form-control" placeholder="Buscar..." />',
                right: '<input type="text" name="q" class="form-control" placeholder="Buscar..." />',
            },
            fireSearch: function(value) {
                return value.length > 3;
            },
            rightAll: '#right_All_1',
            rightSelected: '#right_Selected_1',
            leftSelected: '#left_Selected_1',
            leftAll: '#left_All_1',
            beforeMoveToLeft: function($left, $right, $options) { 
                var permiso=$( "select#select-permisos_to option:selected" ).val();
                $.ajax({
                    url: '{{ route("permission_groups.permission_group.lessPermission") }}',
                    type: 'GET',
                    data: "permission_group={{$permissionGroup->id}}&permission=" + permiso + "",
                    dataType: 'json',
                    beforeSend : function(){ $('.row_permisos_relacionados').loading({
                                                theme: 'dark',
                                                message: 'Procesando..',
                                                }); 
                                            },
                    complete : function(){ $('.row_permisos_relacionados').loading('stop'); },
                    success: function(data){
                        
                    }
                });
                return true;
            },
            beforeMoveToRight: function($left, $right, $options) { 
                var permiso=$( "select#select-permisos_from option:selected" ).val();
                $.ajax({
                    url: '{{ route("permission_groups.permission_group.addPermission") }}',
                    type: 'GET',
                    data: "permission_group={{$permissionGroup->id}}&permission=" + permiso + "",
                    dataType: 'json',
                    beforeSend : function(){ $('.row_permisos_relacionados').loading({
                                                theme: 'dark',
                                                message: 'Procesando..',
                                                }); 
                                            },
                    complete : function(){ $('.row_permisos_relacionados').loading('stop'); },
                    success: function(data){
                        
                    }
                });
                return true;
                
            },
        });
        
        $('#select-roles_from').multiselect({
            right: '#select-roles_to',
            search: {
                left: '<input type="text" name="q" class="form-control" placeholder="Buscar..." />',
                right: '<input type="text" name="q" class="form-control" placeholder="Buscar..." />',
            },
            fireSearch: function(value) {
                return value.length > 3;
            },
            rightAll: '#right_All_2',
            rightSelected: '#right_Selected_2',
            leftSelected: '#left_Selected_2',
            leftAll: '#left_All_2',
            beforeMoveToLeft: function($left, $right, $options) { 
                var rol=$( "select#select-roles_to option:selected" ).val();
                $.ajax({
                    url: '{{ route("permission_groups.permission_group.lessRole") }}',
                    type: 'GET',
                    data: "permission_group={{$permissionGroup->id}}&rol=" + rol + "",
                    dataType: 'json',
                    beforeSend : function(){ $('.row_roles_relacionados').loading({
                                                theme: 'dark',
                                                message: 'Procesando..',
                                                }); 
                                            },
                    complete : function(){ $('.row_roles_relacionados').loading('stop'); },
                    success: function(data){
                        
                    }
                });
                return true;
            },
            beforeMoveToRight: function($left, $right, $options) { 
                var rol=$( "select#select-roles_from option:selected" ).val();
                $.ajax({
                    url: '{{ route("permission_groups.permission_group.addRole") }}',
                    type: 'GET',
                    data: "permission_group={{$permissionGroup->id}}&rol=" + rol + "",
                    dataType: 'json',
                    beforeSend : function(){ $('.row_roles_relacionados').loading({
                                                theme: 'dark',
                                                message: 'Procesando..',
                                                }); 
                                            },
                    complete : function(){ $('.row_roles_relacionados').loading('stop'); },
                    success: function(data){
                        
                    }
                });
                return true;
            },
        });
    });  
</script>
@endpush
@endif