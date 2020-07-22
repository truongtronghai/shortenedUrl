<div id="planTable" class="table-responsive">
<p class="h1 text-center text-primary">{{__('messages.textChoosePlanTitle')}}</p>
<p class="lead text-center">{{__('messages.textChoosePlanDesc')}}</p>
<table class="table table-striped table-bordered mt-2 mb-2">
    <thead class="thead-dark">
        <tr>
            <th scope="col">{{__('messages.textAccount')}}</th>
            <th class="text-center" scope="col">{{__('messages.roleGuest')}}</th>
            <th class="text-center" scope="col">{{__('messages.roleSignedInGuest')}}</th>
            {{--<th class="text-center" scope="col">{{__('messages.rolePremium')}}</th>--}}
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{__('messages.textExpiration')}}</td>
            <td class="text-center">3 {{__('messages.textMonths')}}</td>
            <td class="text-center">
                6 {{__('messages.textMonths')}} ( + 3 {{__('messages.textMonths')}} {{__('messages.textForAnalyzing')}} ) 
            </td>
            {{--<td class="text-center">12 {{__('messages.textMonths')}}</td>--}}
        </tr>
        <tr>
            <td>{{__('messages.textEmailSending')}}</td>
            <td class="text-center">X</td>
            <td class="text-center">
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-check2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                </svg>
            </td>
            {{--<td class="text-center">
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-check2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                </svg>
            </td>--}}
        </tr>
        <tr>
            <td>{{__('messages.textShowQr')}}</td>
            <td class="text-center">X</td>
            <td class="text-center">
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-check2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                </svg>
            </td>
            {{--<td class="text-center">
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-check2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                </svg>
            </td>--}}
        </tr>
        <tr>
            <td>{{__('messages.textLinkStatistic')}}</td>
            <td class="text-center">X</td>
            <td class="text-center">
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-check2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                </svg>
            </td>
            {{--<td class="text-center">
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-check2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                </svg>
            </td>--}}
        </tr>
        <tr>
            <td>{{__('messages.textUrlClick')}}</td>
            <td class="text-center">
                {{__('messages.textUnlimited')}}
            </td>
            <td class="text-center">
                {{__('messages.textUnlimited')}}
            </td>
            {{--<td class="text-center">
                {{__('messages.textUnlimited')}}
            </td>--}}
        </tr>
        <tr>
            <td>{{__('messages.textBrandUrls')}}</td>
            <td class="text-center">
                X
            </td>
            <td class="text-center">
                500 {{__('messages.textTimes')}}
            </td>
            {{--<td class="text-center">
                1 000 {{__('messages.textTimes')}}
            </td>--}}
        </tr>
        <tr>
            <td>{{__('messages.textFree')}}</td>
            <td class="text-center">
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-check2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                </svg>
            </td>
            <td class="text-center">
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-check2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                </svg>
            </td>
            {{--<td class="text-center">
                X
            </td>--}}
        </tr>
        @guest
        <tr>
            <td>&nbsp;</td>
            <td class="text-center">
                &nbsp;
            </td>
            <td class="text-center">
                <a href="{{url('/register')}}">{{__('messages.textRegister')}}</a>
                &nbsp; {{__('messages.textOr')}} &nbsp;
                <a href="{{url('/login')}}">{{__('messages.textLogin')}}</a>
            </td>
            {{--<td class="text-center">
                <a href="{{url('#')}}">{{__('messages.textUpgrade')}}</a>
            </td>--}}
        </tr>
        @endguest
    </tbody>
</table>
</div>