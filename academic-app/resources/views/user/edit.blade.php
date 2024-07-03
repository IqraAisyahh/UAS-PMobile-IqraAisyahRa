@extends('layouts.app', ['title' => isset($user) ? 'Edit User' : 'Add User'])

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

<div class="container-fluid mt--7">
    <div class="row justify-content-center">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="card-header border-0">
                        <h3 class="mb-0">{{ isset($user) ? 'Edit User' : 'Add User' }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($user) ? route('admin.user.update', $user->id) : route('admin.user.store') }}" method="POST">
                            @csrf
                            @if(isset($user))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                            </div>
                            <div class="form-group">
                                <label for="roles">Roles</label>
                                <select name="roles[]" id="roles" class="form-control" aria-placeholder="Masukkan Role">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ isset($user) && $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">{{ isset($user) ? 'Update' : 'Save' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
