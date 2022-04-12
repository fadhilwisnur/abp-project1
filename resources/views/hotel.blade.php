@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hotel Review</div>
                <div class="card-body">  
                    <div class="card" style="width: auto;">
                        <img class="card-img-top" src="/images/{{ $hotel->image }}" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text"><strong>{{ $hotel->name }}</strong></p>
                            <p style="text-align: justify">{{ $hotel->description }}</p>
                            <p><strong>Rating : {{ $hotel->rating }}</strong></p>
                            <a href="/hotel/delete/{{ $hotel->id }}" class="btn btn-danger">Delete Hotel</a>
                            <a href="/hotel/{{ $hotel->id }}/edit" class="btn btn-warning">Edit Hotel</a>

                            <div class="comment-area mt-4">

                                <div class="card card-body">
                                    <h6 class="card-title">Leave A review</h6>
                                    <form action="{{ url('comments') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="post_slug" value="{{ $hotel->id }}">
                                        <textarea name="comment_body" class="form-control" rows="3" required></textarea>
                                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                    </form>
                                </div>

                                @forelse ($hotel->comments as $comment)
                                    
                                <div class="comment-container card card-body shadow-sm mt-3">
                                    <div class="detail-area">
                                        <h6 class="user-name mb-1">
                                            @if ($comment->user)
                                                {{ $comment->user->name }}
                                            @endif
                                            <small class="ms-3 text-primary">Commented on : {{ $comment->created_at->format('d-m-Y') }}</small>
                                        </h6>
                                        <p class="user-comment mb-1">
                                            {{ $comment->comment_body }}
                                        </p>
                                    </div>
                                    <div>
                                        <button type="submit" value="{{ $comment->id }}" class="deleteComment btn btn-danger btn-sm me-2">Delete</button>

                                    </div>
                                </div>
                                @empty
                                    <h6>No Comments Yet.</h6>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

    <script>
        $(document).ready(function (){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click','.deleteComment', function (){
                if(confirm('Are you sure you want to delete this comment?'))
                {
                    var thisClicked = $(this);
                    var comment_id = thisClicked.val();

                    $.ajax({
                        type: "POST",
                        url: "/delete-comment",
                        data: {
                            'comment_id': comment_id
                        },
                        success: function (res){
                            if(res.status == 200){
                                thisClicked.closest('.comment-container').remove();
                                alert(res.message);
                            }else {
                                alert(res.message);
                            }
                        }
                    })
                }
            });
        });
    </script>
    
@endsection