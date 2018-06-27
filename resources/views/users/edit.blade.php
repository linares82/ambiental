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
				<a href="{{ route('users.user.index') }}">{{ trans('users.model_plural') }}</a>
			</li>
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($user->name) ? $user->name : 'User' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('users.user.index') }}" class="btn btn-primary" title="{{ trans('users.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('users.user.create') }}" class="btn btn-success" title="{{ trans('users.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>

            </div>
        </div>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('users.user.update', $user->id) }}" id="edit_user_form" name="edit_user_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="POST">
            @include ('users.form', [
                                        'user' => $user,
                                      ])

            <div class="row"></div>
            <div class="row"> <strong>Roles relacionados</strong> </div>
            <div class="row_roles_relacionados">

            <div class="col-xs-5">
                {!! Form::select("select-role_id", $roles, null, array("class" => "form-control select-multiple", "id" => "select-role_from", "name"=>"from[]", 'multiple'=>'multiple', 'style'=>'height:200px;')) !!}
            </div>

            <div class="col-xs-2">
                <!--<button type="button" id="right_All_1" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>-->
                <button type="button" id="right_Selected_2" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <button type="button" id="left_Selected_2" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <!--<button type="button" id="left_All_1" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>-->
            </div>

            <div class="col-xs-5">
                {!! Form::select("select-role_id", $rolesRelacionados, null, array("class" => "form-control select-multiple", "id" => "select-role_to", "name"=>"to[]", 'multiple'=>'multiple', 'style'=>'height:200px;')) !!}
            </div>
            </div>
    
                
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('users.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
@push('scripts')
<script src="{{ asset('ace-master/assets/js/multiselect.js') }}"></script>
<script src="{{ asset('ace-master/assets/js/jquery.loading.js') }}"></script>

<script type="text/javascript">
    
    
    jQuery(document).ready(function($) {
        $('#select-role_from').multiselect({
            right: '#select-role_to',
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
                var rol=$( "select#select-role_to option:selected" ).val();
                $.ajax({
                    url: '{{ route("users.user.lessRol") }}',
                    type: 'GET',
                    data: "user={{$user->id}}&rol=" + rol + "",
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
                var rol=$( "select#select-role_from option:selected" ).val();
                $.ajax({
                    url: '{{ route("users.user.addRol") }}',
                    type: 'GET',
                    data: "user={{$user->id}}&rol=" + rol + "",
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
