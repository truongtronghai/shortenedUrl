<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>
        
        <link href="/css/admin/styles.css" rel="stylesheet" />

    </head>
    <body onload="addActiveStageNavLink();" class="sb-nav-fixed">{{--cai class nay de fix hoac static cai header và sidebar--}}
        <div id="app">
            @include('admin.admin-top-nav')
            <div id="layoutSidenav">
                <div id="layoutSidenav_nav">
                    @include('admin.admin-side-nav')
                </div>
                <div id="layoutSidenav_content">
                    @yield('main')
                    @include('admin.admin-footer')
                </div>
            </div>
            
        </div>
        
        <script src="/js/admin/scripts.js"></script>
        
        <!-- Modal -->
        <div class="modal fade" id="modalChangeUsername" tabindex="-1" role="dialog" aria-labelledby="modalChangeUsernameLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('messages.changeUsername')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="fname">{{__('messages.textName')}}</label>
                    <input type="text" id="username" name="username">
                    <input type="hidden" id="userid" name="userid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.close')}}</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="changeUsername(document.getElementById('userid').value,document.getElementById('username').value);">{{__('messages.savechange')}}</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </body>
</html>
