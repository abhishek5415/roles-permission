<x-app-web-layout>
  @include('layouts.custom-nav');
    <div class="container">
      <div class="card mt-5">
        <div class="card-header">
            <h4>Create User<a class="btn btn-danger float-end" href="{{url('users')}}">Back</a></h4>  
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('users')}}"> 
                @csrf

                <div class="mb-3">
                  <label  class="form-label">User Name</label>
                  <input type="text" class="form-control" name="name" value="{{old('name')}}">
                  @error('name')<span class="text-danger">{{$message}}</span>@enderror
                </div>

                <div class="mb-3">
                    <label  class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" value="{{old('email')}}">
                    @error('email')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                
                <div class="mb-3">
                    <label  class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" value="{{old('password')}}">
                    @error('password')<span class="text-danger">{{$message}}</span>@enderror
                </div>

                <div class="mb-3">
                    <label  class="form-label">Roles</label>
                   <select name="roles[]" class="form-control" multiple>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                        <option value="{{$role}}">{{$role}}</option>
                        @endforeach
                   </select>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
      </div>
    </div>
</x-app-web-layout>