@extends('layouts.app')

@section('content')
    @livewire('chat.chat-component', [$users])
@endsection

