@extends('layouts.admin')

<!-- @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection -->

@section('topNavBar')
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ url('/') }}">Rut.xyz</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#" onclick="toggleSidebar('sb-sidenav-toggled');return false;"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="{{__('messages.textSearch')}}" aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                @if(App::isLocale('en')) 
                <a class="dropdown-item" href="/lang/vi">tiếng Việt</a>
                @else
                <a class="dropdown-item" href="/lang/en">English</a>
                @endif

                <div class="dropdown-divider"></div>
                {{-- ben duoi la nut logout --}}
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('messages.textLogout') }} 
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
        </li>
    </ul>
</nav>
@endsection

@section('sideNavMenu')
<div class="sb-sidenav-menu">
    <div class="nav">
        <a class="nav-link" href="{{ url('/admin/home') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            {{__('messages.dashboard')}}
        </a>

        @if(auth()->user()->role==0)
        <a class="nav-link" href="{{ url('/admin/users') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
            {{__('messages.textUser')}}
        </a>
        @endif
        
    </div>
</div>
@endsection

@section('sideNavFooter')
<div class="sb-sidenav-footer">
    <div class="small">{{__('messages.textLoggedInAs')}} :</div>
    {{ auth()->user()->name }}
    <div class="small">{{__('messages.textRole')}} :</div>
    @switch(auth()->user()->role)
        @case(0)
            {{__('messages.roleSystemAdmin')}}
            @break
        @case(2)
            {{__('messages.roleSignedInGuest')}}
            @break
        @case(3)
            {{__('messages.rolePremium')}}
            @break
        @case(4)
            {{__('messages.roleApi1')}}
            @break
        @case(5)
            {{__('messages.roleApi2')}}
            @break
        @default
            {{__('messages.roleGuest')}}
    @endswitch
</div>
@endsection

@section('main')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">{{ __('messages.dashboard') }}</h1>

        <div class="card mb-4">
            <div class="card-body">
                <p class="mb-0">
                    This page is an example of using static navigation. By removing the
                    <code>.sb-nav-fixed</code>
                    class from the
                    <code>body</code>
                    , the top navigation and side navigation will become static on scroll. Scroll down this page to see an example.
                </p>
            </div>
        </div>
        <div style="height: 100vh;"></div>
        <div class="card mb-4"><div class="card-body">When scrolling, the navigation stays at the top of the page. This is the end of the static navigation demo.</div></div>
    </div>
</main>
@endsection

@section('footer')
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">{!!__('messages.copyright')!!}</div>
            <div>
                <a href="#">{!! __('messages.privacyPolicy') !!}</a>
                &middot;
                <a href="#">{!! __('messages.termCondition') !!}</a>
            </div>
        </div>
    </div>
</footer>
@endsection