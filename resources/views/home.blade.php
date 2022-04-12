@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4 style="text-align: center">Hotel Di Bandung</h4></div>
                <div class="card-body">
                    @foreach ($hotel as $x)  
                    <div class="card" style="width: auto;">
                        <img class="card-img-top" src="/images/{{ $x->image }}" alt="Card image cap">
                        <div class="card-body">
                          <p class="card-text"><strong>{{ $x->name }}</strong></p>
                          <p style="text-align:justify"> {{ $x->description }}</p>
                          <p><strong>Rating : {{ $x->rating }}</strong></p>
                          <a href="/hotel/{{$x->id}}" class="btn btn-primary">Go Check Review</a>
                        </div>
                    </div>
                    <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
