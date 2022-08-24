@extends('layouts.backend.app')
@push('css')
    <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
@section('content')
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Roles</h4>
                        <a href="{{ route('app.roles.index') }}" class="btn btn-dark float-right"><i
                                class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ isset($role) ? route('app.roles.update', $role->id) : route('app.roles.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $role->name ?? old('name') }}" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="text-center">
                                <h4 class="pb-2"><b>Manage Permission for Role</b></h4>
                                @error('permissions')
                                    <p class="p-2">
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror
                            </div>

                            @forelse($modules->chunk(2) as $key => $chunks)
                                <div class="form-row">
                                    @foreach($chunks as  $group_key => $group_value)
                                        <div class="col" style="border: 1px solid #efefef;padding: 10px">
                                            <h5 class="module">Module: <span onclick="checkModule('{{$group_key}}')" style="color: #3F6AD8">{{ucfirst($group_key).' Management'}}</span></h5>

                                            @foreach($group_value as $key => $permission)
                                                <div class="mb-3 ml-4">
                                                    <div class="custom-control custom-checkbox mr-sm-2">
                                                        <input type="checkbox" class="custom-control-input {{ $group_key }}"
                                                            id="permission-{{$group_key.'-'.$permission }}"
                                                            name="permissions[]"
                                                            value="{{$group_key.'.'.$permission}}"
                                                            @if(@$role?->permissions) {{ in_array($group_key.'.'.$permission, $role->permissions) ? 'checked' : '' }} @endif>
                                                        <label class="custom-control-label" for="permission-{{$group_key.'-'.$permission }}">{{$permission}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col text-center">
                                        <strong>No Module Found</strong>
                                    </div>
                                </div>
                            @endforelse
                            <div class="col-md-12">
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary text-center" style="margin-top: 10px">
                                        @isset($role)
                                            <i class="fa fa-arrow-circle-up"></i>
                                            Update
                                        @else
                                            <i class="fa fa-save"></i>
                                            Create
                                        @endisset
                                    </button>
                                </div>
                            </div>
                        

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')

@endpush
