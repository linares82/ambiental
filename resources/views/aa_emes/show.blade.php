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
				<a href="{{ route('aa_emes.aa_eme.index') }}">{{ trans('aa_emes.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('aa_emes.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('aa_emes.aa_eme.destroy', $aaEme->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('aa_emes.aa_eme.index')
                    <a href="{{ route('aa_emes.aa_eme.index') }}" class="btn btn-primary" title="{{ trans('aa_emes.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aa_emes.aa_eme.create')
                    <a href="{{ route('aa_emes.aa_eme.create') }}" class="btn btn-success" title="{{ trans('aa_emes.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aa_emes.aa_eme.edit')
                    <a href="{{ route('aa_emes.aa_eme.edit', $aaEme->id ) }}" class="btn btn-primary" title="{{ trans('aa_emes.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aa_emes.aa_eme.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('aa_emes.delete') }}" onclick="return confirm(&quot;{{ trans('aa_emes.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('aa_emes.eme') }}</dt>
            <dd>{{ $aaEme->eme }}</dd>
            <dt>{{ trans('aa_emes.detalle') }}</dt>
            <dd>{{ $aaEme->detalle }}</dd>
            <dt>{{ trans('aa_emes.usu_alta_id') }}</dt>
            <dd>{{ optional($aaEme->user)->name }}</dd>
            <dt>{{ trans('aa_emes.usu_mod_id') }}</dt>
            <dd>{{ optional($aaEme->user)->name }}</dd>
            <dt>{{ trans('aa_emes.created_at') }}</dt>
            <dd>{{ $aaEme->created_at }}</dd>
            <dt>{{ trans('aa_emes.updated_at') }}</dt>
            <dd>{{ $aaEme->updated_at }}</dd>
            <dt>{{ trans('aa_emes.deleted_at') }}</dt>
            <dd>{{ $aaEme->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection