@extends('layouts.app')

@section('content')
    @livewire('chat.chat-component', [$users, $receiver_id ?? null])
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const url = new URL(window.location);
            url.pathname = '/chat';
            window.history.replaceState({}, '', url);
        });
    </script>
@endsection

