@extends('layouts.app')

@section('content')
    @livewire('chat', ['receiverId' => $receiverId])
@endsection