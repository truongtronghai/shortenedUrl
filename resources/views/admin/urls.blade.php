@extends('layouts.admin')

@section('main')
<main>
    <div class="container-fluid table-responsive">  
        <h1 class="mt-4">{{ __('messages.dashboardUsers') }}</h1>
        <div class="bg-info my-1"><span class="text-white p-1">{{__('messages.totalofurls')}}: {{ count($urls) }}</span></div>
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
            <td>{{ $url->created_at }}</td>
            <td>{{ $url->expired_at }}</td>
            <td>{{ $url->kept_to }}</td>
            </tr>
            @endforeach
        </tbody>
        </table>

        {{ $urls->links() }}
    </div> 
</main>
@endsection