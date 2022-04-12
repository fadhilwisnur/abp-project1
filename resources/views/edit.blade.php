@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Hotel
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="/edit/{{ $hotel->id }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ $hotel->name }}"><br>
                        </div>
                        <div class="form-group">
                            <label for="decription">Description:</label>
                            <input class="form-control" type="text" id="description" name="description" value="{{ $hotel->description }}"><br>
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating:</label>
                            <input type="number" step="0.1" id="rating" name="rating" value="{{ $hotel->rating }}"><br><br>
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" id="image" name="image"><br><br>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Hotel</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection