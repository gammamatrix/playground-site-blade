@extends($package_config_site_blade['layout'])
@php
$page_title = ! empty($data['title']) && is_string($data['title']) ? $data['title'] : '';
@endphp
@section('title', $page_title)
@section('breadcrumbs')
<nav aria-label="breadcrumb" class="m-3">
    <ol class="breadcrumb">
        @if (Route::has('home'))
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
        @endif
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    @if ($page_title)
    <h1>{{$page_title}}</h1>
    @endif
    @if (! empty($data['content']) && is_string($data['content']))
    <div class="page-content">
        {!! $data['content'] !!}
    </div>
    @endif
</div>
@endsection
