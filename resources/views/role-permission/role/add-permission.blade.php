<x-app-web-layout>
    <div class="container">
      <div class="card mt-5">
        @if (session('status'))
            <div class="alert alert-success">{{session('status')}}</div>
        @endif
        <div class="card-header">
            <h4>Role:{{$role->name}}<a class="btn btn-danger float-end" href="{{url('roles')}}">Back</a></h4>  
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('roles/'.$role->id.'/give-permission')}}"> 
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                  <label  class="form-label">Permission</label>
                  <div class="row">
                    @foreach ($permissions as $permission)
                    <div class="col-2">
                        <label>
                            <input type="checkbox" name="permission[]" value="{{$permission->name}}" {{in_array($permission->id, $rolePermissions) ? 'checked' : ''}}>
                            {{$permission->name}}   
                        </label>
                    </div>
                    @endforeach
                  </div>
                  @error('permission')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
      </div>
    </div>
  </x-app-web-layout>