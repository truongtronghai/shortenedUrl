@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div id="topBanner" class="col">
            <a href='' target="_blank"><img src="" class="img-fluid mx-auto d-block" alt='' title='' /></a>
        </div>
    </div>
    <div class="row">
        <div class="col mb-1">
            <h1 class="text-center text-primary font-weight-bold">{{ __('messages.title') }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col text-center mb-1 text-secondary">
            <cite>
                {{ __('messages.slogan') }}
            </cite>
        </div>
    </div>
    
    <form method="POST" action="{{ url('/') }}" onsubmit="
        return checkUrlValid(document.getElementById('originalUrl').value) 
        && checkCustomStringValid(document.getElementById('customString').value);" novalidate>
        @csrf

    <div class="row">
        <div class="col-md-11 col-9">
            <input id="originalUrl" type="text" class="form-control" name="originalUrl" placeholder="https://" required autofocus oninput="if(checkUrlValid(this.value)) document.getElementById('btnGo').disabled=false;else document.getElementById('btnGo').disabled=true;">
            @if(isset(auth()->user()->id))
                <input type="hidden" id="userId" name="userId" value="{{auth()->user()->id}}">
            @else
                <input type="hidden" id="userId" name="userId" value="2"> {{--id cua guest--}}
            @endif

        </div>
        <div class="col-md-1 col-3">
            <button id="btnGo" type="submit" class="btn btn-primary" disabled >
                {{ __('messages.buttonGo') }}
            </button>
        </div>
    </div>
   @auth
    <div class="row">
        <div class="col">
            <label for="customString">{{__('messages.textPutYourCustomString')}}</label>
            <input id="customString" type="text" class="form-control" name="customString" placeholder="" oninput="watchCustomString(this.value);">
        </div>
        <div class="col">
            <span>{{__('messages.textCustomStringAlert')}}</span>
            <br/>
            <span id="customStringResult" class="text-success"></span>
            <br/>
            <span>{{__('messages.textUrlLengthAlert')}}</span><span id="customStringLength" class="text-primary"></span>
        </div>
    </div>
    @endauth
    </form>
    
    <div class="row mt-1">
        <div class="col">
            <span id="txtMessageWarningEmpty" class="d-none">* {{ __('messages.textEmpty') }}</span>
            <span id="txtMessageWarningWrong" class="d-none">* {{ __('messages.textWrongPattern') }}</span>
            <span id="txtMessageWarningWrongCustomStringPattern" class="d-none">* {{ __('messages.txtWrongCustomStringPattern') }}</span>
        </div>
    </div>
    @if(session('sessionNotification'))
    <div class="row mt-1">
        <div class="col alert alert-danger text-center">
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
            <a href='' target="_blank"><img src="" class="img-fluid mx-auto d-block" alt='' title='' /></a>
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
                    <a href="#" class="btn btn-primary" onclick="copyToClipboard('resultUrl');">{{ __('messages.buttonCopy') }}</a>
                    @guest
                    <p class="card-text">{{ __('messages.textNotificationLinkExpired') }} 3 {{ __('messages.textMonths') }}</p>
                    @else
                    <p class="card-text">{{ __('messages.textNotificationLinkExpired') }} 6 {{ __('messages.textMonths') }}</p>
                    @endguest
                    <p class="card-text">{{ __('messages.textWantLonger') }}</p>
                    <p class="card-text">
                        {{ __('messages.textFindOutMore') }}
                        <a href="#planTable">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 5a.5.5 0 0 0-1 0v4.793L5.354 7.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 9.793V5z"/>
                            </svg>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card align-self-center text-center">
                @guest
                <div class="card-body">
                    <p class="card-text">{{ __('messages.textQrRecommend') }}</p>
                    <p class="card-text">
                        {{ __('messages.textFindOutMore') }}
                        <a href="#planTable">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 5a.5.5 0 0 0-1 0v4.793L5.354 7.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 9.793V5z"/>
                            </svg>
                        </a>
                    </p>
                </div>
                @else
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
                @endguest
            </div>
        </div>
    </div>
    @endisset

    <div class="row">
        <div id="contentBanner0" class="col-lg mt-1 mb-1">
            <a href='' target="_blank"><img src="" class="img-fluid mx-auto" alt='' title='' /></a>
        </div>
        <div id="contentBanner1" class="col-lg mt-1 mb-1">
            <a href='' target="_blank"><img src="" class="img-fluid mx-auto" alt='' title='' /></a>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col border border-dark rounded m-1">
            <div class="text-center">
                <img class="mt-1 mb-1" width="40" height="40" src="/images/link.svg" alt="{{ __('messages.textLink') }}">
                <div>
                    <p class="font-weight-bold text-primary h2">{{__($urls)}}</p>
                    <h5>{{ __('messages.textLink') }}</h5>
                    <p>{{ __('messages.textLinkDesc') }}</p>
                </div>
            </div>
        </div>
        
        <div class="col border border-dark rounded m-1">
            <div class="text-center">
                <img class="mt-1 mb-1" width="40" height="40" src="/images/passing.svg" alt="{{ __('messages.textClick') }}">
                <div>
                    <p class="font-weight-bold text-primary h2">{{__($countingUsage)}}</p>
                    <h5>{{ __('messages.textClick') }}</h5>
                    <p>{{ __('messages.textClickDesc') }}</p>
                </div>
            </div>
        </div>
        <div class="col border border-dark rounded m-1">
            <div class="text-center">
                <img class="mt-1 mb-1" width="40" height="40" src="/images/users.svg" alt="{{ __('messages.textUser') }}">
                <div>
                    <p class="font-weight-bold text-primary h2">{{__($users)}}</p>
                    <h5>{{ __('messages.textUser') }}</h5>
                    <p>{{ __('messages.textUserDesc') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="contentBanner2" class="col-lg mt-1 mb-1">
            <a href='' target="_blank"><img src="" class="img-fluid mx-auto" alt='' title='' /></a>
        </div>
        <div id="contentBanner3" class="col-lg mt-1 mb-1">
            <a href='' target="_blank"><img src="" class="img-fluid mx-auto" alt='' title='' /></a>
        </div>
    </div>
    @include('comparison-table') {{-- chen 1 doan code ben ngoai vao --}}
    <div class="row">
        <div id="contentBanner4" class="col-lg mt-1 mb-1">
            <a href='' target="_blank"><img src="" class="img-fluid mx-auto" alt='' title='' /></a>
        </div>
        <div id="contentBanner5" class="col-lg mt-1 mb-1">
            <a href='' target="_blank"><img src="" class="img-fluid mx-auto" alt='' title='' /></a>
        </div>
    </div>
    
</div>    
@endsection

@section('sticky_banner')
{{-- sticky banner --}}
<div id="dropupBox" class="dropup container-fluid">
    <div id="stickyBanner" class="dropup-content mx-auto">
        <div>
            <a href="" type="button" onclick="document.getElementById('dropupBox').style.bottom='-120px';">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                </svg>
            </a>
        </div>
        <div>
            <a href='' target="_blank"><img src="" class="img-fluid rounded-top mx-auto d-block" alt='' title='' /></a>
        </div>
    </div>
</div> 
@endsection