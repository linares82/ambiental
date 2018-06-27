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
				<a href="{{ route('rubros.rubro.index') }}">{{ trans('rubros.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Rubro' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('rubros.rubro.destroy', $rubro->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('rubros.rubro.index')
                    <a href="{{ route('rubros.rubro.index') }}" class="btn btn-primary" title="{{ trans('rubros.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('rubros.rubro.create')
                    <a href="{{ route('rubros.rubro.create') }}" class="btn btn-success" title="{{ trans('rubros.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('rubros.rubro.edit')
                    <a href="{{ route('rubros.rubro.edit', $rubro->id ) }}" class="btn btn-primary" title="{{ trans('rubros.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('rubros.rubro.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('rubros.delete') }}" onclick="return confirm(&quot;{{ trans('rubros.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('rubros.rubro') }}</dt>
            <dd>{{ $rubro->rubro }}</dd>
            <dt>{{ trans('rubros.usu_alta_id') }}</dt>
            <dd>{{ optional($rubro->user)->name }}</dd>
            <dt>{{ trans('rubros.usu_mod_id') }}</dt>
            <dd>{{ optional($rubro->user)->name }}</dd>
            <dt>{{ trans('rubros.created_at') }}</dt>
            <dd>{{ $rubro->created_at }}</dd>
            <dt>{{ trans('rubros.updated_at') }}</dt>
            <dd>{{ $rubro->updated_at }}</dd>
          
        </dl>

    </div>
</div>

@endsection