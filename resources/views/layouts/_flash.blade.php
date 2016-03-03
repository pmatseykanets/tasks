<div>
    @foreach(flash() as $message)
        <div class="alert alert-{{ $message->type }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ $message->message }}
        </div>
    @endforeach
</div>
