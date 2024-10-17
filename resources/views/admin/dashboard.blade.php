@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Manage Users</div>
                <div class="card-body">
                    <p><a href="{{ route('admin.users.index') }}">View all users</a></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Settings</div>
                <div class="card-body">
                    <p>Admin settings go here...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
