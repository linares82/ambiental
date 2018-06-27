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
				<a href="{{ route('mchecks.mcheck.index') }}">{{ trans('mchecks.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Mcheck' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('mchecks.mcheck.destroy', $mcheck->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('mchecks.mcheck.index')
                    <a href="{{ route('mchecks.mcheck.index') }}" class="btn btn-primary" title="{{ trans('mchecks.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('mchecks.mcheck.create')
                    <a href="{{ route('mchecks.mcheck.create') }}" class="btn btn-success" title="{{ trans('mchecks.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('mchecks.mcheck.edit')
                    <a href="{{ route('mchecks.mcheck.edit', $mcheck->id ) }}" class="btn btn-primary" title="{{ trans('mchecks.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('mchecks.mcheck.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('mchecks.delete') }}" onclick="return confirm(&quot;{{ trans('mchecks.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('mchecks.a_chequeo') }}</dt>
            <dd>{{ optional($mcheck->acheck)->area }}</dd>
            <dt>{{ trans('mchecks.norma_id') }}</dt>
            <dd>{{ optional($mcheck->norma)->norma }}</dd>
            <dt>{{ trans('mchecks.no_conformidad') }}</dt>
            <dd>{{ $mcheck->no_conformidad }}</dd>
            <dt>{{ trans('mchecks.correccion') }}</dt>
            <dd>{{ $mcheck->correccion }}</dd>
            <dt>{{ trans('mchecks.requisito') }}</dt>
            <dd>{{ $mcheck->requisito }}</dd>
            <dt>{{ trans('mchecks.rnc') }}</dt>
            <dd>{{ $mcheck->rnc }}</dd>
            <dt>{{ trans('mchecks.minimo_vsm') }}</dt>
            <dd>{{ $mcheck->minimo_vsm }}</dd>
            <dt>{{ trans('mchecks.maximo_vsm') }}</dt>
            <dd>{{ $mcheck->maximo_vsm }}</dd>
            <dt>{{ trans('mchecks.orden') }}</dt>
            <dd>{{ $mcheck->orden }}</dd>
            <dt>{{ trans('mchecks.usu_alta_id') }}</dt>
            <dd>{{ optional($mcheck->user)->name }}</dd>
            <dt>{{ trans('mchecks.usu_mod_id') }}</dt>
            <dd>{{ optional($mcheck->user)->name }}</dd>
            <dt>{{ trans('mchecks.created_at') }}</dt>
            <dd>{{ $mcheck->created_at }}</dd>
            <dt>{{ trans('mchecks.updated_at') }}</dt>
            <dd>{{ $mcheck->updated_at }}</dd>
        </dl>

    </div>
</div>

@endsection