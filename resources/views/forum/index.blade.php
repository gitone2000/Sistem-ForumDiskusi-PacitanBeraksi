@extends('layouts.dashboard')

@section('content')
    <!-- Header -->
    <header class="header position-fixed">
        <div class="row">
            <div class="col-auto">
                <button class="btn btn-light btn-44 back-btn"
                    onclick="window.location.href='{{ route('dashboard.index') }}';">
                    <i class="bi bi-arrow-left"></i>
                </button>
            </div>
            <div class="col align-self-center text-center">
                <h5>Forum</h5>
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

        <!-- Search -->
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control " id="search" placeholder="Search">
            <label class="form-control-label" for="search">Search</label>
            <button type="button" class="text-color-theme tooltip-btn">
                <i class="bi bi-search"></i>
            </button>
        </div>

        <!-- chat Forum list -->
        <div class="row">
            <div class="col-12 px-0">
                <div class="list-group rounded-0 bg-none">
                    @foreach ($channels as $channel)
                        <a href="{{ route('forum.show', $channel->id) }}" class="list-group-item">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-50 coverimg rounded-10">
                                        <img src="{{ $channel->image ? asset('storage/' . $channel->image) : asset('assets/img/decaa.png') }}"
                                            alt="{{ $channel->nama }}">
                                    </div>
                                </div>
                                <div class="col align-self-center ps-0">
                                    <p class="mb-1">{{ $channel->nama }}
                                        {{-- <span class="float-end small text-muted">baru</span> --}}
                                    </p>
                                    <p class="small text-muted">{{ $channel->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-12 px-0">
                <div class="list-group rounded-0 bg-none">
                    <a href="chat-message.html" class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <div class="avatar avatar-50 coverimg rounded-10">
                                    <img src="assets/img/user1.jpg" alt="">
                                </div>
                            </div>
                            <div class="col align-self-center ps-0">
                                <p class="mb-1">John Domnic <span class="float-end small text-muted">2 min</span>
                                </p>
                                <p class="small text-muted"><i class="bi bi-check-all text-primary"></i> Thank you
                                    for your purchase</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div> --}}
        <!-- main page content ends -->
    @endsection
