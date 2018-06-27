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
				<a href="{{ route('cs_enfermedades.cs_enfermedade.index') }}">{{ trans('cs_enfermedades.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('cs_enfermedades.model_plural')  }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('cs_enfermedades.cs_enfermedade.destroy', $csEnfermedade->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('cs_enfermedades.cs_enfermedade.index')
                    <a href="{{ route('cs_enfermedades.cs_enfermedade.index') }}" class="btn btn-primary" title="{{ trans('cs_enfermedades.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_enfermedades.cs_enfermedade.create')
                    <a href="{{ route('cs_enfermedades.cs_enfermedade.create') }}" class="btn btn-success" title="{{ trans('cs_enfermedades.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_enfermedades.cs_enfermedade.edit')
                    <a href="{{ route('cs_enfermedades.cs_enfermedade.edit', $csEnfermedade->id ) }}" class="btn btn-primary" title="{{ trans('cs_enfermedades.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_enfermedades.cs_enfermedade.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('cs_enfermedades.delete') }}" onclick="return confirm(&quot;{{ trans('cs_enfermedades.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('cs_enfermedades.enfermedad') }}</dt>
            <dd>{{ $csEnfermedade->enfermedad }}</dd>
            <dt>{{ trans('cs_enfermedades.usu_alta_id') }}</dt>
            <dd>{{ optional($csEnfermedade->user)->name }}</dd>
            <dt>{{ trans('cs_enfermedades.usu_mod_id') }}</dt>
            <dd>{{ optional($csEnfermedade->user)->name }}</dd>
            <dt>{{ trans('cs_enfermedades.created_at') }}</dt>
            <dd>{{ $csEnfermedade->created_at }}</dd>
            <dt>{{ trans('cs_enfermedades.updated_at') }}</dt>
            <dd>{{ $csEnfermedade->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection