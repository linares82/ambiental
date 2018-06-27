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
				<a href="{{ route('ca_tpo_inconformidads.ca_tpo_inconformidad.index') }}">{{ trans('ca_tpo_inconformidads.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('ca_tpo_inconformidads.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('ca_tpo_inconformidads.ca_tpo_inconformidad.destroy', $caTpoInconformidad->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('ca_tpo_inconformidads.ca_tpo_inconformidad.index')
                    <a href="{{ route('ca_tpo_inconformidads.ca_tpo_inconformidad.index') }}" class="btn btn-primary" title="{{ trans('ca_tpo_inconformidads.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_tpo_inconformidads.ca_tpo_inconformidad.create')
                    <a href="{{ route('ca_tpo_inconformidads.ca_tpo_inconformidad.create') }}" class="btn btn-success" title="{{ trans('ca_tpo_inconformidads.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_tpo_inconformidads.ca_tpo_inconformidad.edit')
                    <a href="{{ route('ca_tpo_inconformidads.ca_tpo_inconformidad.edit', $caTpoInconformidad->id ) }}" class="btn btn-primary" title="{{ trans('ca_tpo_inconformidads.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_tpo_inconformidads.ca_tpo_inconformidad.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('ca_tpo_inconformidads.delete') }}" onclick="return confirm(&quot;{{ trans('ca_tpo_inconformidads.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('ca_tpo_inconformidads.tpo_inconformidad') }}</dt>
            <dd>{{ $caTpoInconformidad->tpo_inconformidad }}</dd>
            <dt>{{ trans('ca_tpo_inconformidads.usu_alta_id') }}</dt>
            <dd>{{ optional($caTpoInconformidad->user)->name }}</dd>
            <dt>{{ trans('ca_tpo_inconformidads.usu_mod_id') }}</dt>
            <dd>{{ optional($caTpoInconformidad->user)->name }}</dd>
            <dt>{{ trans('ca_tpo_inconformidads.created_at') }}</dt>
            <dd>{{ $caTpoInconformidad->created_at }}</dd>
            <dt>{{ trans('ca_tpo_inconformidads.updated_at') }}</dt>
            <dd>{{ $caTpoInconformidad->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection