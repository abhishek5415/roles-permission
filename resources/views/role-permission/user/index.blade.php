<x-app-web-layout>
    @include('layouts.custom-nav');
    @include('role-permission.nav-links');

    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if (session('status'))
                        <div class="alert alert-success">{{session('status')}}</div>
                    @endif
                    <div class="card-header">
                        <h4>Users <a href="{{url('users/create')}}" class="btn btn-primary float-end">Add Users</a></h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">    
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($users as $user)
                             <tr>
                                <td>{{$user['id']}}</td>
                                <td>{{$user['name']}}</td>
                                <td>{{$user['email']}}</td>
                                <td>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $rolename)
                                            <label class="badge bg-primary mx-1">{{$rolename}}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>@can('update user')
                                        <a class="btn btn-sm btn-warning mx-2" href="{{ url('users/'.$user['id'].'/edit')}}">Edit</a>
                                    @endcan
                                    @can('delete user')
                                        <a class="btn btn-sm btn-danger mx-2" href="{{ url('users/'.$user['id'].'/delete')}}" onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
                                    @endcan
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-web-layout>