@extends('base')
@section('title','Home')
@section('body')
    <br/>
    <div class="container">
        <div class="jumbotron">
            <h1>@lang('system.name')</h1>
            <form action="{{ route('url-create') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
                    <label class="control-label" for="url">@lang('app.url'):</label>                    
                    <input class="form-control" id="url" name="url" type="text" value="{{old('url')}}"></input>
                    @if($errors->has('url'))
                    <span class="error text-danger">{{ $errors->first('url') }}</span>
                    @endif
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">@lang('app.shorten')</button>
                </div>
            </form>
        </div>
    </div>
@endsection