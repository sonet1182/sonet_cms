@extends('backend.layouts.master')

@section('title', 'Edit Role')

@section('content')
    <div class="card card-default">

        <div class="card-header">
            <div class="d-flex">
                <a class="btn btn-primary ml-auto" href="{{ route('roles.index') }}"> Back </a>
            </div>
        </div>

        <div class="card-body">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Something went wrong.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Name"
                        value="{{ $role->name }}">
                </div>

                <div class="form-group">
                    <label for="permission">Permission:</label>
                    <br />
                    @foreach ($permission as $value)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $value->name }}"
                                {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $value->name }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>

    @endsection
