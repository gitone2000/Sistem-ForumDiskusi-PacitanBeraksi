@extends('layouts.dashboard', ['noLoader' => true])

@section('content')
    @php use Illuminate\Support\Str; @endphp

    <!-- Header -->
    <header class="header position-fixed">
        <div class="row">
            <div class="col-auto">
                <button class="btn btn-light btn-44 back-btn" onclick="window.location.href='{{ route('forum.index') }}';">
                    <i class="bi bi-arrow-left"></i>
                </button>
            </div>
            <div class="col align-self-center ps-0">
                <div class="row">
                    <div class="col-auto">
                        <div class="avatar avatar-44 coverimg rounded-10">
                            <img src="{{ $channel->image ? asset('storage/' . $channel->image) : asset('assets/img/decaa.png') }}"
                                alt="{{ $channel->nama }}">
                        </div>
                    </div>
                    <div class="col align-self-center px-0">
                        <p class="mb-0">{{ $channel->nama }}</p>
                        <p class="text-muted size-12">{{ $channel->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    </div>
                </div>
            </div>
            {{-- <div class="col-auto">
                <a href="notifications.html" target="_self" class="btn btn-light btn-44">
                    <i class="bi bi-bell"></i>
                    <span class="count-indicator"></span>
                </a>
            </div> --}}
        </div>
    </header>
    <!-- Header ends -->

    <!-- main page content -->
    <div class="main-container container pt-0">
        @if ($channel->messages->count() >= 50)
            <div class="text-center my-3">
                <button id="load-more-btn" class="btn btn-sm btn-outline-secondary"
                    data-last-id="{{ $messages->first()->id ?? '' }}">
                    Muat Pesan Sebelumnya
                </button>
            </div>
        @endif
        <div class="container chat-list overflow-y-auto" id="chat-message-container"
            style="max-height: calc(100vh - 60px); overflow-y: auto; scroll-behavior: smooth;">
            {{-- @include('forum.partials.messages', ['messages' => $channel->messages]) --}}
            @include('forum.partials.messages', ['messages' => $messages])
        </div>
        <div id="new-message-alert"
            class="bg-primary text-white px-3 py-1 d-none position-fixed rounded-pill text-center shadow"
            style="font-size: 14px; bottom: 80px; right: 0; margin-right: 0; z-index: 9999; cursor: pointer;">
            ↓ Pesan
        </div>

        <div class="clearfix"></div>
    </div>
    <!-- main page content ends -->

    <!-- File Preview -->
    <div id="file-preview-box" class="bg-light border-top p-3 d-none" style="z-index: 1079;">
        <div class="d-flex align-items-center">
            <div id="file-preview-thumb" class="me-3"></div>
            <div class="flex-grow-1 text-truncate">
                <span id="file-preview-name" class="fw-semibold"></span><br>
                <small id="file-preview-type" class="text-muted"></small>
            </div>
            <button type="button" id="cancel-preview-btn" class="btn btn-sm btn-outline-danger ms-2">
                <i class="bi bi-x"></i>
            </button>
        </div>
    </div>

    <!-- Form Kirim Pesan -->
    <form id="message-form" action="{{ route('forum.send', $channel->id) }}" method="POST" enctype="multipart/form-data"
        class="position-fixed bottom-0 start-0 chat-post footer py-3 w-100" style="z-index:
        1080;">
        @csrf
        <div class="row mx-0">
            <div class="col-auto">
                <!-- Tombol yang memicu input file -->
                <label for="file-upload" class="btn btn-primary rounded-15 mb-0">
                    <i class="bi bi-plus"></i>
                </label>
                <input type="file" id="file-upload" name="file" class="d-none">
            </div>
            <div class="col ps-0">
                <!-- Input teks -->
                <div class="input-group">
                    <input id="message" type="text" name="message" class="form-control" placeholder="Tulis pesan...">
                    <button class="btn btn-outline-primary" type="submit"><i class="bi bi-cursor-fill"></i></button>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Preview File -->
    <div class="modal fade" id="fileFullscreenModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Pratinjau</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <div id="fullscreenModalContent" class="text-center w-100"
                        style="max-height: calc(100vh - 80px); overflow-y: auto; padding-bottom: 100px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Submit Kirim Pesan -->
    <script src="{{ asset('assets/js/chat/send.js') }}"></script>

    <!-- JS Auto Scroll Down -->
    <script src="{{ asset('assets/js/chat/autoscroll.js') }}"></script>

    <!-- JS Lazyload -->
    <script src="{{ asset('assets/js/chat/lazyload.js') }}"></script>

    <!-- JS bublechat -->
    <script src="{{ asset('assets/js/chat/bubble-template.js') }}"></script>

    <!-- JS Laravel Echo Listener -->
    <script>
        window.authUserId = {{ auth()->id() }};
        window.channelId = {{ $channel->id }};
    </script>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/chat/listener.js') }}"></script>

    <!-- JS File Preview -->
    <script src="{{ asset('assets/js/chat/preview.js') }}"></script>
@endsection
