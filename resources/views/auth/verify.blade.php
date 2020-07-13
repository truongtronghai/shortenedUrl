@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.textVerifyEmail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('messages.textVerifyEmailResent') }}
                        </div>
                    @endif

                    {{ __('messages.textVerifyEmailLink') }}
                    {{ __('messages.textVerifyEmailNotReceive') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('messages.textVerifyEmailAnother') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
