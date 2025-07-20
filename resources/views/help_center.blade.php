<!-- @extends('dashboard')

@section('content')
<div class="container">
    <h3>Help Center - Support</h3>

    {{-- Show messages --}}
    @if($conversation)
        <div class="card mb-3">
            <div class="card-body">
                @foreach($conversation->messages as $message)
                    <div class="mb-2 {{ $message->sender->id == auth()->id() ? 'text-end' : 'text-start' }}">
                        <strong>{{ $message->sender->name }}</strong><br>
                        {{ $message->body }}<br>
                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    @else
        <p>You have no messages yet. Start a conversation below.</p>
    @endif

    {{-- Send message form --}}
    <form action="{{ route('help-center.message.send') }}" method="POST">
        @csrf
        <input type="hidden" name="conversation_id" value="{{ $conversation->id ?? '' }}">
        <div class="mb-3">
            <label for="body" class="form-label">Your Message</label>
            <textarea name="body" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>
@endsection -->
