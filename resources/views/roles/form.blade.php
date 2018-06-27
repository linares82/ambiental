
<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
    <label for="slug" class="col-md-2 control-label">{{ trans('roles.slug') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="slug" type="text" id="slug" value="{{ old('slug', optional($role)->slug) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('roles.slug__placeholder') }}">
        {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('roles.name') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="name" type="text" id="name" value="{{ old('name', optional($role)->name) }}" maxlength="255" placeholder="{{ trans('roles.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="row">
</div>
@if(isset($role))
<div class="row"> <strong>Permisos relacionados</strong> </div>
<div class="row_permisos_relacionados">
    
<div class="col-xs-5">
    {!! Form::select("select-permiso_id", $permisos, null, array("class" => "form-control select-multiple", "id" => "select-permisos_from", "name"=>"from[]", 'multiple'=>'multiple', 'style'=>'height:200px;')) !!}
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


<div class="row"> <strong>Usuarios relacionados</strong> </div>
<div class="row_roles_relacionados">
    
<div class="col-xs-5">
    {!! Form::select("select-user_id", $users, null, array("class" => "form-control select-multiple", "id" => "select-users_from", "name"=>"from[]", 'multiple'=>'multiple', 'style'=>'height:200px;')) !!}
</div>

<div class="col-xs-2">
    <!--<button type="button" id="right_All_1" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>-->
    <button type="button" id="right_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
    <button type="button" id="left_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
    <!--<button type="button" id="left_All_1" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>-->
</div>

<div class="col-xs-5">
    {!! Form::select("select-users_id", $usersRelacionados, null, array("class" => "form-control select-multiple", "id" => "select-users_to", "name"=>"to[]", 'multiple'=>'multiple', 'style'=>'height:200px;')) !!}
</div>
</div>
<div class="row"> <strong>Grupos relacionados</strong> </div>
<div class="row_grupos_relacionados">
    
<div class="col-xs-5">
    {!! Form::select("select-permission_group_id", $grupos, null, array("class" => "form-control select-multiple", "id" => "select-permission_group_from", "name"=>"from[]", 'multiple'=>'multiple', 'style'=>'height:200px;')) !!}
</div>

<div class="col-xs-2">
    <!--<button type="button" id="right_All_1" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>-->
    <button type="button" id="right_Selected_2" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
    <button type="button" id="left_Selected_2" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
    <!--<button type="button" id="left_All_1" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>-->
</div>

<div class="col-xs-5">
    {!! Form::select("select-permission_group_id", $gruposRelacionados, null, array("class" => "form-control select-multiple", "id" => "select-permission_group_to", "name"=>"to[]", 'multiple'=>'multiple', 'style'=>'height:200px;')) !!}
</div>
</div>


@push('scripts')
<link href="{{ asset('ace-master/assets/css/jquery.loading.css') }}" rel="stylesheet">
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
                var permission=$( "select#select-permisos_to option:selected" ).val();
                $.ajax({
                    url: '{{ route("roles.role.lessPermission") }}',
                    type: 'GET',
                    data: "rol={{$role->id}}&permission=" + permission + "",
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
                    url: '{{ route("roles.role.addPermission") }}',
                    type: 'GET',
                    data: "rol={{$role->id}}&permission=" + permiso + "",
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
        $('#select-users_from').multiselect({
            right: '#select-users_to',
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
                var user=$( "select#select-users_to option:selected" ).val();
                $.ajax({
                    url: '{{ route("roles.role.lessUser") }}',
                    type: 'GET',
                    data: "rol={{$role->id}}&user=" + user + "",
                    dataType: 'json',
                    beforeSend : function(){ $('.row_users_relacionados').loading({
                                                theme: 'dark',
                                                message: 'Procesando..',
                                                }); 
                                            },
                    complete : function(){ $('.row_users_relacionados').loading('stop'); },
                    success: function(data){
                        
                    }
                });
                return true;
            },
            beforeMoveToRight: function($left, $right, $options) { 
                var user=$( "select#select-users_from option:selected" ).val();
                $.ajax({
                    url: '{{ route("roles.role.addUser") }}',
                    type: 'GET',
                    data: "rol={{$role->id}}&user=" + user + "",
                    dataType: 'json',
                    beforeSend : function(){ $('.row_users_relacionados').loading({
                                                theme: 'dark',
                                                message: 'Procesando..',
                                                }); 
                                            },
                    complete : function(){ $('.row_users_relacionados').loading('stop'); },
                    success: function(data){
                        
                    }
                });
                return true;
                
            },
        });
        $('#select-permission_group_from').multiselect({
            right: '#select-permission_group_to',
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
                var grupo=$( "select#select-permission_group_to option:selected" ).val();
                $.ajax({
                    url: '{{ route("roles.role.lessGroup") }}',
                    type: 'GET',
                    data: "rol={{$role->id}}&grupo=" + grupo + "",
                    dataType: 'json',
                    beforeSend : function(){ $('.row_grupos_relacionados').loading({
                                                theme: 'dark',
                                                message: 'Procesando..',
                                                }); 
                                            },
                    complete : function(){ $('.row_grupos_relacionados').loading('stop'); },
                    success: function(data){
                        
                    }
                });
                return true;
            },
            beforeMoveToRight: function($left, $right, $options) { 
                var grupo=$( "select#select-permission_group_from option:selected" ).val();
                $.ajax({
                    url: '{{ route("roles.role.addGroup") }}',
                    type: 'GET',
                    data: "rol={{$role->id}}&grupo=" + grupo + "",
                    dataType: 'json',
                    beforeSend : function(){ $('.row_grupos_relacionados').loading({
                                                theme: 'dark',
                                                message: 'Procesando..',
                                                }); 
                                            },
                    complete : function(){ $('.row_grupos_relacionados').loading('stop'); },
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