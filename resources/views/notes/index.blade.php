@extends('layouts.app')

@section('content')
    <h1>Your Notes</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="mb-3">
        <a href="{{ route('notes.create') }}" class="btn btn-primary">Create New Note</a>
    </div>
    @if(!$notes)
        <p>No notes available. Create your first note!</p>
    @else
        <ul class="list-group">
            @foreach ($notes as $note)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $note->content }}
                    <form action="{{ route('notes.destroy', $note) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
