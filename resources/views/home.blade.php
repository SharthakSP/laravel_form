@extends ('layouts.master')
@section('content')
    <div class="row">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-4">
            <form action="{{route('add')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control">
                    <a href="" style="color:red">{{$errors->first('username')}}</a>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                    <a href="" style="color:red">{{$errors->first('email')}}</a>
                </div>
                <div class="form-group" >
                    <label for="image">Profile Picture</label>
                    <input type="file" name="image" id="imageid" class="btn btn-default">
                    <a href="" style="color:red">{{$errors->first('image')}}</a>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <a href="" style="color:red">{{$errors->first('password')}}</a>
                </div>
                <div class="form-group">
                    <label for="confirmed_password">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    <a href="" style="color:red">{{$errors->first('password')}}</a>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Add Record</button>
                </div>
            </form>
        </div>

        <div class="col-md-8" >
            <table class="table table-bordered table-striped" >
                <tr>
                    <td>S.N.</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>Image</td>
                    <td>Action</td>
                    <td>Created</td>
                </tr>
                @foreach($userData as $key=>$datum)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$datum->username}}</td>
                            <td>{{$datum->email}}</td>
                            <td>
                                <img src="{{url('public/lib/images/'.$datum->image)}}" style="height:30px;width:50px;" alt="">
                            </td>
                            <td>
                                <a href="{{route('edit').'/'.$datum->id}}" class="btn btn-primary btn-xs">Edit</a>
                                <a href="{{route('delete').'/'.$datum->id}}" class="btn btn-danger btn-xs">Delete</a>
                            </td>
                            <td>{{$datum->created_at}}</td>
                        </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop
