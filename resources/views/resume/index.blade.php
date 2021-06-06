@extends('layouts.app')
@section('content')


    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                @foreach($paginator as $item)
                    <div class="card mb-3" style="width: 700px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                @if($item->image)
                                    <img width="120" height="120" src="{{asset('/storage/'.$item->image)}}" class="card-img img-fluid rounded" alt="">
                                @else
                                    <img width="120" height="120" src="{{asset('/storage/uploads/default.png')}}" class="card-img img-fluid rounded" alt="">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title">{{$item->name}}</h4>
                                    <p class="card-text">{!! $item->content_raw !!}</p>
                                    <p class="card-text"><small class="text-muted">{{$item->created_at}}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach

                    @if($paginator->total() > $paginator->count())
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        {{$paginator}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <form action="{{ route('resume.searchName') }}">
                <div class="card mb-4">
                    <div class="card-header">Search by Name</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input class="form-control" required="" type="text" name="searchName" id="searchName" placeholder="Enter search name..." aria-label="Enter search name..." aria-describedby="button-search" />
                            <button class="btn btn-primary" id="button-search" type="submit">Search</button>
                        </div>
                    </div>
                </div>
                </form>
                <div class="card mb-4">
                    <div class="card-header">Search by Date</div>
                    <div class="card-body">
                        <form action="{{ route('resume.searchDate') }}" method="get">
                            <input required="" type="date" class="form-control" name="searchDate" id="searchDate">
                            <button class="btn btn-primary" id="button-search" type="submit">Search</button>
                        </form>

                    </div>
                </div>
                <!-- Side widget-->
                <div class="card mb-4">
                    <div class="card-header">Create</div>
                    <div class="card-body">
                        <a href="{{ route('resume.create') }}" class="btn btn-primary">Create new resume</a>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Sort by date</div>
                    <div class="card-body">
                        <a href="{{ route('resume.orderNew') }}" class="btn btn-primary">Sort by date DESC</a>
                        <a href="{{ route('resume.orderOld') }}" class="btn btn-primary">Sort by date</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

