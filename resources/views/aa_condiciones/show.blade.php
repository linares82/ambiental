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
				<a href="{{ route('aa_condiciones.aa_condicione.index') }}">{{ trans('aa_condiciones.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('aa_condiciones.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('aa_condiciones.aa_condicione.destroy', $aaCondicione->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('aa_condiciones.aa_condicione.index')
                    <a href="{{ route('aa_condiciones.aa_condicione.index') }}" class="btn btn-primary" title="{{ trans('aa_condiciones.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aa_condiciones.aa_condicione.create')
                    <a href="{{ route('aa_condiciones.aa_condicione.create') }}" class="btn btn-success" title="{{ trans('aa_condiciones.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aa_condiciones.aa_condicione.edit')
                    <a href="{{ route('aa_condiciones.aa_condicione.edit', $aaCondicione->id ) }}" class="btn btn-primary" title="{{ trans('aa_condiciones.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aa_condiciones.aa_condicione.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('aa_condiciones.delete') }}" onclick="return confirm(&quot;{{ trans('aa_condiciones.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('aa_condiciones.condicion') }}</dt>
            <dd>{{ $aaCondicione->condicion }}</dd>
            <dt>{{ trans('aa_condiciones.detalle') }}</dt>
            <dd>{{ $aaCondicione->detalle }}</dd>
            <dt>{{ trans('aa_condiciones.usu_alta_id') }}</dt>
            <dd>{{ optional($aaCondicione->user)->name }}</dd>
            <dt>{{ trans('aa_condiciones.usu_mod_id') }}</dt>
            <dd>{{ optional($aaCondicione->user)->name }}</dd>
            <dt>{{ trans('aa_condiciones.created_at') }}</dt>
            <dd>{{ $aaCondicione->created_at }}</dd>
            <dt>{{ trans('aa_condiciones.updated_at') }}</dt>
            <dd>{{ $aaCondicione->updated_at }}</dd>
            <dt>{{ trans('aa_condiciones.deleted_at') }}</dt>
            <dd>{{ $aaCondicione->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection