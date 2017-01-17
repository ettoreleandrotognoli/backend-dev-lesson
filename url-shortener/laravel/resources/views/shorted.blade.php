@extends('base')
@section('title','Home')
@section('body')
    <br/>
    <div class="container">
        <div class="jumbotron">
            <h1>@lang('system.name')</h1>
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <a href="{{ $baseUrl }}/{{ $shortUrl->code }}">
                        <h2>
                            {{ $baseUrl }}/{{ $shortUrl->code }}
                            <br/>
                            <small>{{ $url }}</small>
                        </h2>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <a href="/" class="btn btn-primary">@lang('app.shortenAnother')</a>
                </div>
            </div>
        </div>
    </div>
@endsection