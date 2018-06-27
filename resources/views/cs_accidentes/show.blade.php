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
				<a href="{{ route('cs_accidentes.cs_accidente.index') }}">{{ trans('cs_accidentes.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('cs_accidentes.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('cs_accidentes.cs_accidente.destroy', $csAccidente->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('cs_accidentes.cs_accidente.index')
                    <a href="{{ route('cs_accidentes.cs_accidente.index') }}" class="btn btn-primary" title="{{ trans('cs_accidentes.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_accidentes.cs_accidente.create')
                    <a href="{{ route('cs_accidentes.cs_accidente.create') }}" class="btn btn-success" title="{{ trans('cs_accidentes.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_accidentes.cs_accidente.edit')
                    <a href="{{ route('cs_accidentes.cs_accidente.edit', $csAccidente->id ) }}" class="btn btn-primary" title="{{ trans('cs_accidentes.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_accidentes.cs_accidente.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('cs_accidentes.delete') }}" onclick="return confirm(&quot;{{ trans('cs_accidentes.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('cs_accidentes.accidente') }}</dt>
            <dd>{{ $csAccidente->accidente }}</dd>
            <dt>{{ trans('cs_accidentes.usu_alta_id') }}</dt>
            <dd>{{ optional($csAccidente->user)->name }}</dd>
            <dt>{{ trans('cs_accidentes.usu_mod_id') }}</dt>
            <dd>{{ optional($csAccidente->user)->name }}</dd>
            <dt>{{ trans('cs_accidentes.created_at') }}</dt>
            <dd>{{ $csAccidente->created_at }}</dd>
            <dt>{{ trans('cs_accidentes.updated_at') }}</dt>
            <dd>{{ $csAccidente->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection