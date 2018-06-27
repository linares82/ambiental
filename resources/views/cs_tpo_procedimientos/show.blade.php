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
				<a href="{{ route('cs_tpo_procedimientos.cs_tpo_procedimiento.index') }}">{{ trans('cs_tpo_procedimientos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('cs_tpo_procedimientos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('cs_tpo_procedimientos.cs_tpo_procedimiento.destroy', $csTpoProcedimiento->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('cs_tpo_procedimientos.cs_tpo_procedimiento.index')
                    <a href="{{ route('cs_tpo_procedimientos.cs_tpo_procedimiento.index') }}" class="btn btn-primary" title="{{ trans('cs_tpo_procedimientos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_tpo_procedimientos.cs_tpo_procedimiento.create')
                    <a href="{{ route('cs_tpo_procedimientos.cs_tpo_procedimiento.create') }}" class="btn btn-success" title="{{ trans('cs_tpo_procedimientos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_tpo_procedimientos.cs_tpo_procedimiento.edit')
                    <a href="{{ route('cs_tpo_procedimientos.cs_tpo_procedimiento.edit', $csTpoProcedimiento->id ) }}" class="btn btn-primary" title="{{ trans('cs_tpo_procedimientos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_tpo_procedimientos.cs_tpo_procedimiento.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('cs_tpo_procedimientos.delete') }}" onclick="return confirm(&quot;{{ trans('cs_tpo_procedimientos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('cs_tpo_procedimientos.tpo_procedimiento') }}</dt>
            <dd>{{ $csTpoProcedimiento->tpo_procedimiento }}</dd>
            <dt>{{ trans('cs_tpo_procedimientos.usu_alta_id') }}</dt>
            <dd>{{ optional($csTpoProcedimiento->user)->name }}</dd>
            <dt>{{ trans('cs_tpo_procedimientos.usu_mod_id') }}</dt>
            <dd>{{ optional($csTpoProcedimiento->user)->name }}</dd>
            <dt>{{ trans('cs_tpo_procedimientos.created_at') }}</dt>
            <dd>{{ $csTpoProcedimiento->created_at }}</dd>
            <dt>{{ trans('cs_tpo_procedimientos.updated_at') }}</dt>
            <dd>{{ $csTpoProcedimiento->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection