{{-- @foreach ($channel->messages as $msg) --}}
    @foreach ($messages as $msg)
    @php
        $isMe = $msg->user_id === auth()->id();
        $isImage = Str::startsWith($msg->file_type, 'image/');
        $isVideo = Str::startsWith($msg->file_type, 'video/');
        $isPdf = $msg->file_type === 'application/pdf';
        $fileUrl = route('forum.file.preview', basename($msg->file_path));
    @endphp

    @if ($isMe)
        {{-- Bubble dari user yang sedang login (kanan, tanpa nama/avatar) --}}
        <div class="row no-margin right-chat">
            <div class="col-12">
                <div class="chat-block">
                    <div class="row">
                        <div class="col">
                            {{ $msg->message }}
                            @if ($msg->file_path)
                                <div class="mt-2">
                                    @if (Str::startsWith($msg->file_type, 'image/'))
                                        {{-- Image --}}
                                        <img src="{{ $fileUrl }}" alt="gambar"
                                            class="img-fluid rounded mb-2 previewable-file"
                                            data-file-url="{{ $fileUrl }}" data-file-type="{{ $msg->file_type }}"
                                            data-file-name="{{ $msg->file_name }}" style="max-height: 200px;">
                                    @elseif (Str::startsWith($msg->file_type, 'video/'))
                                        {{-- Video --}}
                                        <video controls style="max-width: 100%; max-height: 300px;">
                                            <source src="{{ $fileUrl }}" type="{{ $msg->file_type }}">
                                            Browser tidak mendukung video.
                                        </video>
                                    @elseif ($msg->file_type === 'application/pdf')
                                        {{-- Pdf --}}
                                        <div class="text-center">
                                            <i class="bi bi-file-earmark-pdf-fill text-danger"
                                                style="font-size: 3rem;"></i>
                                            <p class="small text-muted">{{ basename($msg->file_path) }}</p>
                                            <a href="{{ $fileUrl }}" target="_blank"
                                                class="btn btn-sm btn-outline-danger">
                                                Buka PDF
                                            </a>
                                        </div>
                                    @elseif (in_array($msg->file_type, [
                                            'application/msword',
                                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                        ]))
                                        {{-- Word --}}
                                        <div class="text-center">
                                            <i class="bi bi-file-earmark-word-fill text-primary"
                                                style="font-size: 3rem;"></i>
                                            <p class="small text-muted">{{ basename($msg->file_path) }}</p>
                                            <a href="{{ $fileUrl }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">Buka Word</a>
                                        </div>
                                    @elseif (in_array($msg->file_type, [
                                            'application/vnd.ms-excel',
                                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                        ]))
                                        {{-- Excel --}}
                                        <div class="text-center">
                                            <i class="bi bi-file-earmark-excel-fill text-success"
                                                style="font-size: 3rem;"></i>
                                            <p class="small text-muted">{{ basename($msg->file_path) }}</p>
                                            <a href="{{ $fileUrl }}" target="_blank"
                                                class="btn btn-sm btn-outline-success">Buka Excel</a>
                                        </div>
                                    @elseif (in_array($msg->file_type, [
                                            'application/vnd.ms-powerpoint',
                                            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                                        ]))
                                        {{-- PowerPoint --}}
                                        <div class="text-center">
                                            <i class="bi bi-file-earmark-ppt-fill text-warning"
                                                style="font-size: 3rem;"></i>
                                            <p class="small text-muted">{{ basename($msg->file_path) }}</p>
                                            <a href="{{ $fileUrl }}" target="_blank"
                                                class="btn btn-sm btn-outline-warning">Buka PPT</a>
                                        </div>
                                    @elseif (in_array($msg->file_type, ['application/zip', 'application/x-rar-compressed', 'application/x-zip-compressed']))
                                        {{-- ZIP / RAR --}}
                                        <div class="text-center">
                                            <i class="bi bi-file-zip-fill text-secondary" style="font-size: 3rem;"></i>
                                            <p class="small text-muted">{{ basename($msg->file_path) }}</p>
                                            <a href="{{ $fileUrl }}" target="_blank"
                                                class="btn btn-sm btn-outline-secondary">Download File</a>
                                        </div>
                                    @else
                                        <a href="{{ $fileUrl }}" target="_blank"
                                            class="text-decoration-underline">
                                            📎 {{ basename($msg->file_path) }}
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-end">
                <p class="text-muted small time">
                    <i class="text-primary"></i> {{ $msg->created_at->format('H:i') }}
                </p>
            </div>
        </div>
    @else
        {{-- Bubble dari user lain (kiri, tampilkan nama dan avatar) --}}
        <div class="row no-margin left-chat">
            <div class="col-12 d-flex align-items-center gap-2 mb-1">
                <div class="avatar avatar-36 rounded-circle">
                    <img src="{{ $msg->user->foto_diri ? asset('storage/' . $msg->user->foto_diri) : asset('assets/img/decaa.png') }}"
                        alt="avatar" class="rounded-circle" style="width: 32px; height: 32px;">
                </div>
                <strong class="small">{{ $msg->user->nama ?? 'User' }}</strong>
            </div>
            <div class="col-12">
                <div class="chat-block">
                    <div class="row">
                        <div class="col">
                            {{ $msg->message }}
                            @if ($msg->file_path)
                                <div class="mt-2">
                                    @if (Str::startsWith($msg->file_type, 'image/'))
                                        <img src="{{ $fileUrl }}" alt="gambar"
                                            class="img-fluid rounded mb-2 previewable-file"
                                            data-file-url="{{ $fileUrl }}" data-file-type="{{ $msg->file_type }}"
                                            data-file-name="{{ $msg->file_name }}" style="max-height: 200px;">
                                    @elseif (Str::startsWith($msg->file_type, 'video/'))
                                        <video controls style="max-width: 100%; max-height: 300px;">
                                            <source src="{{ $fileUrl }}" type="{{ $msg->file_type }}">
                                            Browser tidak mendukung video.
                                        </video>
                                    @elseif ($msg->file_type === 'application/pdf')
                                        {{-- PDF --}}
                                        <div class="text-center">
                                            <i class="bi bi-file-earmark-pdf-fill text-danger"
                                                style="font-size: 3rem;"></i>
                                            <p class="small text-muted">{{ basename($msg->file_path) }}</p>
                                            <a href="{{ $fileUrl }}" target="_blank"
                                                class="btn btn-sm btn-outline-danger">
                                                Buka PDF
                                            </a>
                                        </div>
                                    @elseif (in_array($msg->file_type, [
                                            'application/msword',
                                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                        ]))
                                        {{-- Word --}}
                                        <div class="text-center">
                                            <i class="bi bi-file-earmark-word-fill text-primary"
                                                style="font-size: 3rem;"></i>
                                            <p class="small text-muted">{{ basename($msg->file_path) }}</p>
                                            <a href="{{ $fileUrl }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">Buka Word</a>
                                        </div>
                                    @elseif (in_array($msg->file_type, [
                                            'application/vnd.ms-excel',
                                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                        ]))
                                        {{-- Excel --}}
                                        <div class="text-center">
                                            <i class="bi bi-file-earmark-excel-fill text-success"
                                                style="font-size: 3rem;"></i>
                                            <p class="small text-muted">{{ basename($msg->file_path) }}</p>
                                            <a href="{{ $fileUrl }}" target="_blank"
                                                class="btn btn-sm btn-outline-success">Buka Excel</a>
                                        </div>
                                    @elseif (in_array($msg->file_type, [
                                            'application/vnd.ms-powerpoint',
                                            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                                        ]))
                                        {{-- PowerPoint --}}
                                        <div class="text-center">
                                            <i class="bi bi-file-earmark-ppt-fill text-warning"
                                                style="font-size: 3rem;"></i>
                                            <p class="small text-muted">{{ basename($msg->file_path) }}</p>
                                            <a href="{{ $fileUrl }}" target="_blank"
                                                class="btn btn-sm btn-outline-warning">Buka PPT</a>
                                        </div>
                                    @elseif (in_array($msg->file_type, ['application/zip', 'application/x-rar-compressed', 'application/x-zip-compressed']))
                                        {{-- ZIP / RAR --}}
                                        <div class="text-center">
                                            <i class="bi bi-file-zip-fill text-secondary"
                                                style="font-size: 3rem;"></i>
                                            <p class="small text-muted">{{ basename($msg->file_path) }}</p>
                                            <a href="{{ $fileUrl }}" target="_blank"
                                                class="btn btn-sm btn-outline-secondary">Download File</a>
                                        </div>
                                    @else
                                        <a href="{{ $fileUrl }}" target="_blank"
                                            class="text-decoration-underline">
                                            📎 {{ basename($msg->file_path) }}
                                        </a>
                                    @endif
                                    {{-- Only text message --}}
                                    {{-- @if ($msg->message)
                                                    <div>
                                                        {{ $msg->message }}
                                                    </div>
                                                @endif --}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <p class="text-muted small time">
                    <i class=""></i> {{ $msg->created_at->format('H:i') }}
                </p>
            </div>
        </div>
    @endif
@endforeach
