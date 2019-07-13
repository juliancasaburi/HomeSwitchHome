@foreach($comments as $comment)
<div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
    @if($comment->user != null)
    <strong>{{ $comment->user->nombre.' '.$comment->user->apellido }}</strong>
    @else
        <strong style="color:firebrick">ADMINISTRADOR</strong>
    @endif
    <p class="text-muted">{{ $comment->created_at }}</p>
    <p>{{ $comment->texto }}</p>
    <a href="" id="reply"></a>
    <form method="post" action="{{ route('comments.store') }}">
        @csrf
        <div class="form-group">
            <label class="textareaContainer">
                <textarea name="texto" placeholder="Contesta algo..."> </textarea>
            </label>
            <input type="hidden" name="propiedad_id" value="{{ $propiedad_id }}" />
            <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-b" value="Responder" />
        </div>
    </form>
        <hr>
    @include('partials.commentsDisplay', ['comments' => $comment->replies])
</div>
@endforeach