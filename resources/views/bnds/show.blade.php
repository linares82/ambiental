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
				<a href="{{ route('bnds.bnd.index') }}">{{ trans('bnds.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Bnd' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('bnds.bnd.destroy', $bnd->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('bnds.bnd.index')
                    <a href="{{ route('bnds.bnd.index') }}" class="btn btn-primary" title="{{ trans('bnds.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bnds.bnd.create')
                    <a href="{{ route('bnds.bnd.create') }}" class="btn btn-success" title="{{ trans('bnds.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bnds.bnd.edit')
                    <a href="{{ route('bnds.bnd.edit', $bnd->id ) }}" class="btn btn-primary" title="{{ trans('bnds.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bnds.bnd.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('bnds.delete') }}" onclick="return confirm(&quot;{{ trans('bnds.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('bnds.bnd') }}</dt>
            <dd>{{ $bnd->bnd }}</dd>
            <dt>{{ trans('bnds.created_at') }}</dt>
            <dd>{{ $bnd->created_at }}</dd>
            <dt>{{ trans('bnds.updated_at') }}</dt>
            <dd>{{ $bnd->updated_at }}</dd>
            <dt>{{ trans('bnds.deleted_at') }}</dt>
            <dd>{{ $bnd->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection