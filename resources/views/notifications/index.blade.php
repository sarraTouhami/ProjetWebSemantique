@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 mb-5 wow fadeIn" style="margin-top: 100px;">
    <h1>Notifications</h1>
    
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('notifications.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Notification
        </a>
    </div>

    <div class="row">
        @forelse ($notifications as $notification)
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-{{ $notification->est_vu ? 'secondary' : 'primary' }}">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ $notification->titre }}</h5>
                    
                    <span class="text-{{ $notification->est_vu ? 'muted' : 'primary' }}">
                        <i class="fas {{ $notification->est_vu ? 'fa-check-circle' : 'fa-bell' }}"></i>
                        {{ $notification->est_vu ? 'Vu' : 'Nouveau' }}
                    </span>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $notification->message }}</p>
                    <p class="text-muted">Type: <strong>{{ ucfirst($notification->type) }}</strong></p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <div class="float-right">
                        <a href="{{ route('notifications.edit', $notification->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette notification ?');">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                No notifications available.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
