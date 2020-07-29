@extends('layouts.admin')

@section('main')
<main>
    <div class="container-fluid table-responsive">  
        <h1 class="mt-4">{{ __('messages.dashboardUsers') }}</h1>
        <form action="{{url('/admin/users')}}" method="POST">
        @csrf
        <div class="form-row">
            <div class="col">
            <input type="text" name="name" class="form-control" placeholder="{{__('messages.dashboardUsersName')}}">
            </div>
            <div class="col">
            <input type="text" name="email" class="form-control" placeholder="{{__('messages.dashboardUsersEmail')}}">
            </div>
            <div class="col">
            <select class="custom-select mr-sm-2" name="role">
                <option disabled selected>{{__('messages.dashboardUsersRole')}}...</option> {{--tao placeholder cho select box--}}
                <option value="0">{{__('messages.roleSystemAdmin')}}</option>
                <option value="1">{{__('messages.roleGuest')}}</option>
                <option value="2">{{__('messages.roleSignedInGuest')}}</option>
                <option value="3">{{__('messages.rolePremium')}}</option>
                <option value="4">{{__('messages.roleApi1')}}</option>
                <option value="5">{{__('messages.roleApi2')}}</option>
            </select>
            </div>
            <button type="submit" class="btn btn-primary">{{__('messages.textFilter')}}</button>
        </div>
        </form>
        <div class="bg-info my-1"><span class="text-white pl-1">
        {{__('messages.dashboardUsersRole')}}: 
            0 - {{__('messages.roleSystemAdmin')}} | 
            1 - {{__('messages.roleGuest')}} | 
            2 - {{__('messages.roleSignedInGuest')}} | 
            3 - {{__('messages.rolePremium')}} | 
            4 - {{__('messages.roleApi1')}} | 
            5 - {{__('messages.roleApi2')}}
        </span>
        </div>
        @if(!count($users->items()))
            <div class="alert alert-warning">{{__('messages.textNoFilterResult')}}</div>
        @endisset
        <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('messages.dashboardUsersId')}}</th>
            <th scope="col">{{__('messages.dashboardUsersName')}}</th>
            <th scope="col">{{__('messages.dashboardUsersEmail')}}</th>
            <th scope="col">{{__('messages.dashboardUsersRole')}}</th>
            <th scope="col">{{__('messages.dashboardUsersCustomUrl')}}</th>
            <th scope="col">{{__('messages.dashboardUsersDate')}}</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach ($users as $user)
            <tr>
            <th scope="row"><?php echo $i++; ?></th>
            <td class="text-right">{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td class="text-center">{{ $user->role }}</td>
            <td class="text-right">{{ $user->branded }}</td>
            <td>{{ $user->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
        </table>

        {{ $users->links() }}
    </div> 
</main>
@endsection