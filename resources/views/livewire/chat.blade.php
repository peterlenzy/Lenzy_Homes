<!-- @vite(['resources/js/app.js']) -->

    <div id="app-content">
    <div class="col-12">
    <div class="container-md border py-0">
    <div class="card">
        <div class="">
            <h1>Chat Online</h1>
        </div>
<!--
    <div class="d-flex border rounded-3 shadow overflow-hidden bg-white w-100" style="height: 550px;width: 100vw;">
        <div class="col-3 border-end bg-light">
    <div class="p-3 fw-bold text-secondary border-bottom text-bold"><i data-feather="users" class=" me-2 icon-xs"></i>users</div>
        <div class="overflow-auto" style="height: 500px;">
    <div class="border-top"> -->
            <div class="d-flex border rounded-3 shadow overflow-hidden bg-white w-100" style="height: 550px;width: 100vw;">
                <div class="col-3 border-end bg-light d-flex flex-column" style="height: 100%;">
                <div class="p-3 fw-bold text-secondary border-bottom text-bold">
                    <i data-feather="users" class="me-2 icon-xs"></i>Users </div>
                <div class="flex-grow-1 overflow-auto">


        @foreach ($users as $user)
            <div

                wire:click="selectUser({{ $user->id }})"
                class="p-3 cursor-pointer text-dark border-bottom transition {{ $selectedUser_id === $user->id ? 'bg-primary text-white' : 'hover:bg-primary-subtle' }}"
                style="user-select: none;"
            >
                <div class="d-flex align-items-center mb-2">
                    <img class="rounded-circle me-2"
                        id="profile-image-{{ $user->id }}"
                        src="{{ asset($user->img_path) }}"
                        alt="Profile Image"
                        data-user-id="{{ $user->id }}"
                        style="width: 32px; height: 32px; object-fit: cover;">
                    <div>
                        <div class="fw-bold">{{ $user->name }}</div>
                        <div class="fs-6 fw-semibold text-muted">{{ $user->email }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

            </div>

            <div class="col-9 d-flex flex-column">
                <div class="p-3 border-bottom bg-light">
                    <div class="d-flex align-items-center mb-2">
                        <img class="rounded-circle me-2"
                            id="profile-image-{{ $selectedUser->id }}"
                            src="{{ asset($selectedUser->img_path) }}"
                            alt="Profile Image"
                            data-user-id="{{ $selectedUser->id }}"
                            style="width: 32px; height: 32px; object-fit: cover;">

                        <div>
                            <div class="fw-bold">{{ $selectedUser->name }}</div>
                            <div class="fs-6 fw-semibold text-muted">{{ $selectedUser->email }}</div>
                        </div>
                    </div>
                </div>

            <div class="flex-grow-1 p-3 overflow-y-auto d-flex flex-column gap-2 bg-light">
                @foreach ($messages as $message)
                <div class="d-flex {{ $message->sender_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">

                   <div class="p-3 rounded-3 shadow-sm text-white {{ $message->sender_id === auth()->id() ? 'bg-primary' : 'bg-secondary' }}" style="max-width: 300px;">

                       {{$message->message}}
                    </div>
                </div>
                 @endforeach
            </div>

            <div id ="typing-indicator" class="p-2 text-muted fs-6 text-xs text-gray-500 italic"></div>
            <form wire:submit="submit" class="p-3 border-top bg-white d-flex align-items-center gap-2">
                <input wire:model.live ="newMessage" type="text" class="form-control flex-grow-1 border rounded-pill px-3 py-2 fs-6" placeholder="Type your message...">
                <button type="submit" class="btn btn-primary text-white fs-6 px-4 py-2 rounded-pill">send</button>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>

