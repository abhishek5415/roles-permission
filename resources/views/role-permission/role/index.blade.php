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
                        <h4>Roles <a href="{{url('roles/create')}}" class="btn btn-primary float-end">Add Roles</a></h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">    
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Roles Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($roles as $role)
                             <tr>
                                <td>{{$role['id']}}</td>
                                <td>{{$role['name']}}</td>
                                <td><a class="btn btn-sm btn-warning mx-2" href="{{ url('roles/'.$role['id'].'/give-permission')}}">Add / Edit permission</a>
                                    @can('update role')
                                        <a class="btn btn-sm btn-warning mx-2" href="{{ url('roles/'.$role['id'].'/edit')}}">Edit</a>
                                    @endcan

                                    @can('delete role')
                                        <a class="btn btn-sm btn-danger mx-2" href="{{ url('roles/'.$role['id'].'/delete')}}" onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
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