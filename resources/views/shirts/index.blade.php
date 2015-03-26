@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Shirts</div>

                    <div class="panel-body">
                        <form action="{{ route('shirt.store', []) }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="file" name="shirt">
                            <input type="submit">
                        </form>

                        @foreach($shirts as $shirt)
                            <div class="col-md-2">
                                <div class="thumbnail">
                                    <img src="{{route('shirt.show', $shirt->name)}}" alt="ALT NAME" class="img-responsive" />
                                    <div class="caption">
                                        <li>{{$shirt->name}}</li>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
