<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link" href="{{ url('/') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                {{__('messages.home')}}
            </a>
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
            <a class="nav-link" href="{{ url('/admin/urls') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-link"></i></div>
                {{__('messages.shortenedlinks')}}
            </a>
            
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">
            {{__('messages.textLoggedInAs')}} :
        </div>
        <span id="showUsername">{{ auth()->user()->name }}</span>
        <a type="button" data-toggle="modal" data-target="#modalChangeUsername" href="#" onclick="passValuesToChangeUsernameModal('{{ auth()->user()->id }}',document.getElementById('showUsername').innerText)">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
        </a>

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
        <a class="nav-link" href="{{ url('/password/reset') }}">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-key" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
            </svg>
            {{__('messages.textResetPassword')}}
        </a>
        
    </div>
</nav>