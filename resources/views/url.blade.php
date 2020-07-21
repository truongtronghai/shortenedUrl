@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div id="topBanner" class="col">
            <a href=''><img src="" class="img-fluid mx-auto d-block" alt='' title='' /></a>
        </div>
    </div>
    <div class="row">
        <div class="col mb-1">
            <h1 class="text-center text-info font-weight-bold">{{ __('messages.title') }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col text-center mb-1 text-secondary">
            <cite>
                {{ __('messages.slogan') }}
            </cite>
        </div>
    </div>
    
    <form method="POST" action="{{ url('/') }}" onsubmit="return checkUrlValid(document.getElementById('originalUrl').value)" novalidate>
        @csrf

    <div class="row">
        <div class="col-md-11 col-9">
            <input id="originalUrl" type="text" class="form-control" name="originalUrl" placeholder="https://" required autofocus>
        </div>
        <div class="col-md-1 col-3">
            <button id="btnGo" type="submit" class="btn btn-primary">
                {{ __('messages.buttonGo') }}
            </button>
        </div>
    </div>

    </form>
    
    <div class="row mt-1">
        <div class="col">
            <span id="txtMessageWarningEmpty" class="d-none">* {{ __('messages.textEmpty') }}</span>
            <span id="txtMessageWarningWrong" class="d-none">* {{ __('messages.textWrongPattern') }}</span>
        </div>
    </div>
    @if(session('sessionNotification'))
    <div class="row mt-1">
        <div class="col alert alert-danger">
            <span>{!! session('sessionNotification') !!}</span>
        </div>
    </div>
    @endif
    
    @isset($resultUrls)

    <div class="row mt-1">
        <div class="col">
            <em><strong>{{ $resultUrls['original'] }}</strong></em> &nbsp;<span class="text-muted">{{ __('messages.textResult') }}</span>
        </div>
    </div>
    <div class="row mt-1 mb-1">
        <div id="resultBanner" class="col">
            <a href=''><img src="" class="img-fluid mx-auto d-block" alt='' title='' /></a>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-lg-6 text-center">
            <div class="card h-100">
                <div class="card-body">
                    <div class="alert alert-success">
                        <span id="resultUrl">{{ config('app.url').'/'.$resultUrls['result'] }}</span>
                    </div>
                    <p class="card-text">{{ __('messages.textClipboardGuide') }}</p>
                    <button class="btn btn-primary" onclick="copyToClipboard('resultUrl');">{{ __('messages.buttonCopy') }}</button>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card align-self-center text-center">
                {{--
                    Phan nay dung de tao img co the download bang cach nhan nut
                    Chu y trong img co crossOrigin=''
                    Va nut can co download='ten-file' 
                    URL dung de tao QR Code: https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=data
                --}}
                <img crossOrigin="" id="qrResultImage" width="200" height="200" class="mx-auto" src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl={{ config('app.url').'/'.$resultUrls['result'] }}" alt="{{ __('messages.title') }}">
                <div class="card-body">
                    <p class="card-text">{{ __('messages.textQrGuide') }}</p>
                    <a id='qrResultSave' href="#" download="my-qr-{{ $resultUrls['result'] }}.png" class="btn btn-primary" onclick="saveQrImage();">{{ __('messages.buttonSave') }}</a>
                </div>
            </div>
        </div>
    </div>
    @endisset

    <div class="row">
        <div id="contentBanner0" class="col-lg mt-1 mb-1">
            <a href=''><img src="" class="img-fluid mx-auto" alt='' title='' /></a>
        </div>
        <div id="contentBanner1" class="col-lg mt-1 mb-1">
            <a href=''><img src="" class="img-fluid mx-auto" alt='' title='' /></a>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col border border-dark rounded m-1">
            <div class="text-center">
                <img class="mt-1 mb-1" width="40" height="40" src="/images/link.svg" alt="{{ __('messages.textLink') }}">
                <div>
                    <h5>{{ __('messages.textLink') }}</h5>
                    <p>{{ __('messages.textLinkDesc') }}</p>
                </div>
            </div>
        </div>
        
        <div class="col border border-dark rounded m-1">
            <div class="text-center">
                <img class="mt-1 mb-1" width="40" height="40" src="/images/passing.svg" alt="{{ __('messages.textClick') }}">
                <div>
                    <h5>{{ __('messages.textClick') }}</h5>
                    <p>{{ __('messages.textClickDesc') }}</p>
                </div>
            </div>
        </div>
        <div class="col border border-dark rounded m-1">
            <div class="text-center">
                <img class="mt-1 mb-1" width="40" height="40" src="/images/users.svg" alt="{{ __('messages.textUser') }}">
                <div>
                    <h5>{{ __('messages.textUser') }}</h5>
                    <p>{{ __('messages.textUserDesc') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="contentBanner2" class="col-lg mt-1 mb-1">
            <a href=''><img src="" class="img-fluid mx-auto" alt='' title='' /></a>
        </div>
        <div id="contentBanner3" class="col-lg mt-1 mb-1">
            <a href=''><img src="" class="img-fluid mx-auto" alt='' title='' /></a>
        </div>
    </div>
    <div class="row">
        <div id="contentBanner4" class="col-lg mt-1 mb-1">
            <a href=''><img src="" class="img-fluid mx-auto" alt='' title='' /></a>
        </div>
        <div id="contentBanner5" class="col-lg mt-1 mb-1">
            <a href=''><img src="" class="img-fluid mx-auto" alt='' title='' /></a>
        </div>
    </div>
    
</div>    
@endsection

@section('sticky_banner')
{{-- sticky banner --}}
<div id="dropupBox" class="row dropup container-fluid">
  <div id="stickyBanner" class="col-lg dropup-content ">
    <a href=''><img src="" class="img-fluid rounded-top mx-auto d-block" alt='' title='' /></a>
  </div>
</div> 
@endsection