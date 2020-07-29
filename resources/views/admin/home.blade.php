@extends('layouts.admin')

@section('main')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">{{ __('messages.dashboard') }}</h1>
        @if(auth()->user()->role<=1)
        <div class="card text-white bg-primary float-left m-1" style="max-width: 18rem;">
            <div class="card-header"><i class="fas fa-user"></i></div>
            <div class="card-body">
                <h5 class="card-title">{{ __('messages.totalofregisteredusers') }}</h5>
                <p class="card-text font-weight-bolder text-right display-4">{{ $totalUsers }}</p>
            </div>
        </div>
        
        <div class="card text-white bg-success float-left m-1" style="max-width: 18rem;">
            <div class="card-header"><i class="fas fa-link"></i></div>
            <div class="card-body">
                <h5 class="card-title">{{ __('messages.totalofurls') }}</h5>
                <p class="card-text font-weight-bolder text-right display-4">{{ $totalUrls }}</p>
            </div>
        </div>

        <div class="card text-white bg-secondary float-left m-1" style="max-width: 18rem;">
            <div class="card-header"><i class="fas fa-link"></i></div>
            <div class="card-body">
                <h5 class="card-title">{{ __('messages.totalofinactiveurls') }}</h5>
                <p class="card-text font-weight-bolder text-right display-4">{{ $totalInactiveUrls }}</p>
            </div>
        </div>
        <div class="card text-white bg-warning float-left m-1" style="max-width: 18rem;">
            <div class="card-header"><i class="fas fa-link"></i></div>
            <div class="card-body">
                <h5 class="card-title">{{ __('messages.totalofpendingurls') }}</h5>
                <p class="card-text font-weight-bolder text-right display-4">{{ $totalPendingUrls }}</p>
            </div>
        </div>
        @else
        <div class="card text-white bg-success float-left m-1" style="max-width: 18rem;">
            <div class="card-header"><i class="fas fa-link"></i></div>
            <div class="card-body">
                <h5 class="card-title">{{ __('messages.totalcustomurls') }}</h5>
                <p class="card-text font-weight-bolder text-right display-4">{{ $nCustomUrls }}</p>
            </div>
        </div>
        @endif
        <div class="card text-white bg-info float-left m-1" style="max-width: 18rem;">
            <div class="card-header"><i class="fas fa-link"></i></div>
            <div class="card-body">
                <h5 class="card-title">{{ __('messages.totalofactiveurls') }}</h5>
                <p class="card-text font-weight-bolder text-right display-4">{{ $totalActiveUrls }}</p>
            </div>
        </div>
        <div class="card text-white bg-info float-left m-1" style="max-width: 18rem;">
            <div class="card-header"><i class="fas fa-link"></i></div>
            <div class="card-body">
                <h5 class="card-title">{{ __('messages.totalcustomurls') }}</h5>
                <p class="card-text font-weight-bolder text-right display-4">{{ $totalCustomUrls }}</p>
            </div>
        </div>
        <div class="card text-white bg-info float-left m-1" style="max-width: 18rem;">
            <div class="card-header"><i class="fas fa-link"></i></div>
            <div class="card-body">
                <h5 class="card-title">{{ __('messages.totalrandomurls') }}</h5>
                <p class="card-text font-weight-bolder text-right display-4">{{ $totalRandomUrls }}</p>
            </div>
        </div>

    </div> 
</main>
@endsection