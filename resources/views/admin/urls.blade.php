@extends('layouts.admin')

@section('main')
<main>
    <div class="container-fluid table-responsive">  
        <h1 class="mt-4">{{ __('messages.shortenedlinks') }}</h1>
        <form action="{{url('/admin/urls')}}" method="POST" class="my-1">
        @csrf
        <div class="form-row">
            <div class="col">
            <input type="text" name="original" class="form-control" placeholder="{{__('messages.dashboardUrl')}}">
            </div>
            <div class="col">
            <input type="text" name="short" class="form-control" placeholder="{{__('messages.dashboardUrlShort')}}">
            </div>
            <div class="col">
            <select class="custom-select mr-sm-2" name="sort">
                <option disabled selected>{{__('messages.dashboardUrlSorting')}}...</option> {{--tao placeholder cho select box--}}
                <option value="desc">{{__('messages.dashboardUrlCountDesc')}}</option>
                <option value="asc">{{__('messages.dashboardUrlCountAsc')}}</option>         
            </select>
            </div>
            <button type="submit" class="btn btn-primary">{{__('messages.textFilter')}}</button>
        </div>
        </form>
        @if(!count($urls->items()))
            <div class="alert alert-warning">{{__('messages.textNoFilterResult')}}</div>
        @endisset
        <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            @guest <th scope="col">{{__('messages.textUser')}}</th> @endguest
            <th scope="col">{{__('messages.dashboardUrl')}}</th>
            <th scope="col">{{__('messages.dashboardUrlShort')}}</th>
            <th scope="col">{{__('messages.dashboardUrlIsCustom')}}</th>
            <th scope="col">{{__('messages.dashboardUrlCount')}}</th>
            <th scope="col">{{__('messages.dashboardUrlCreated')}}</th>
            <th scope="col">{{__('messages.dashboardUrlExpired')}}</th>
            <th scope="col">{{__('messages.dashboardUrlKeptTo')}}</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach ($urls as $url)
            <tr>
            <th scope="row"><?php echo $i++; ?></th>
            @guest <td class="text-right">{{ $url->user_id }}</td> @endguest
            <td>{{ $url->url }}</td>
            <td>{{ $url->shortened }}</td>
            <td class="text-center">{{ $url->is_custom }}</td>
            <td class="text-right">{{ $url->count }}</td>
            <td>{{ date_format(date_create($url->created_at), 'd-m-Y H:i:s') }}</td>
            <?php 
                // Neu gan den ngay het han khoang 30 ngay thi hien thi chu mau do
                $textColor = (intdiv((strtotime($url->expired_at) - strtotime(now())),86400) <= 30)?'text-danger':'';

            ?>
            <td class="<?php echo $textColor; ?>">{{ date_format(date_create($url->expired_at), 'd-m-Y H:i:s')}}</td>
            <td>{{ date_format(date_create($url->kept_to), 'd-m-Y H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
        </table>

        {{ $urls->links() }}
    </div> 
</main>
@endsection