@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="text-center text-primary font-weight-bold">{{ __('info.tosTitle') }}</h1>
            <div>
                {!! __('info.tos') !!}
            </div>
        </div>
    </div>
</div>
@endsection