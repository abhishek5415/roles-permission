<x-app-web-layout>
  @include('layouts.custom-nav');
    <div class="container">
      <div class="card mt-5">
        <div class="card-header">
            <h4>Edit Permission<a class="btn btn-danger float-end" href="{{url('permissions')}}">Back</a></h4>  
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('permissions/'.$permission->id)}}"> 
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                  <label  class="form-label">Permission Name</label>
                  <input type="text" class="form-control" name="name" value="{{$permission->name}}">
                  @error('name')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
      </div>
    </div>
</x-app-web-layout>