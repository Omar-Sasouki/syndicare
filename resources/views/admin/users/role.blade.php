@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Name : {{ $user->residence_id}} </h4>
                            <hr>
                            <h4 class="card-title">Name : {{ $user->name }} </h4>
                            <hr>
                            <h4 class="card-title">Email : {{ $user->email }} </h4>
                        </div>
                    </div>
                </div>
            </div>
            <h2>Assign Roles</h2>
            <center>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Assign Roles to the : {{ $user->name }} </h4>
                        <hr>
                        <div>
                            @if ($user->roles)
                                @foreach ($user->roles as $user_role)
                                    <form method="POST"
                                        action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group mt-1" role="group" aria-label="First group">
                                        <button class="btn btn-danger " type="submit">{{ $user_role->name }}</button>
                                        </div>
                                        </div>

                                    </form>
                                @endforeach
                            @endif
                        </div>
                        <div>
                            <form method="POST" action="{{ route('admin.users.roles', $user->id) }}">
                                @csrf
                                <div>
                                    <label for="role"></label>
                                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="role" name="role" autocomplete="role-name">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('role')
                                    <span>{{ $message }}</span>
                                @enderror
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Assign</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
            </center>
        </div>
        {{--  <div >
                <div>User Name: {{ $user->name }}</div>
                <div>User Email: {{ $user->email }}</div>
            </div>
            <div >
                <h2 >Roles</h2>
                <div >
                    @if ($user->roles)
                        @foreach ($user->roles as $user_role)
                            <form  method="POST"
                                action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">{{ $user_role->name }}</button>
                            </form>
                        @endforeach
                    @endif
                </div>
                <div >
                    <form method="POST" action="{{ route('admin.users.roles', $user->id) }}">
                        @csrf
                        <div >
                            <label for="role" >Roles</label>
                            <select id="role" name="role" autocomplete="role-name" >
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('role')
                            <span >{{ $message }}</span>
                        @enderror
                     </div>
                        <div >
                        <button type="submit">Assign</button>
                            </div>
                     </form>
            </div> --}}
    </div>
    </div>
@endsection
