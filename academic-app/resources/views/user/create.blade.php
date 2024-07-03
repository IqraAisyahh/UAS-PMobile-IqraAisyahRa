@extends('layouts.app', ['title' => $user ? 'Edit User' : 'Add User'])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">{{ $user ? 'Edit User' : 'Add User' }}</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ $user ? route('admin.user.update', $user->id) : route('admin.user.store') }}">
                            @csrf
                            @if($user) @method('PUT') @endif

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name ?? old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email ?? old('email') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" {{ $user ? '' : 'required' }}>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" {{ $user ? '' : 'required' }}>
                            </div>

                            <div class="form-group">
                                <label for="roles">Roles</label>
                                <select name="roles[]" id="roles" class="form-control" aria-placeholder="Masukkan Role">
                                    @foreach($roles as $role)
                                        <option value="" selected disabled>--Pilih Role--</option>
                                        <option value="{{ $role->name }}" {{ isset($user) && $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">{{ $user ? 'Update' : 'Save' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
