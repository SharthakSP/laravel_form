@extends ('layouts.master')
@section('content')

    <div class="row">
        <div class="col-md-4">
            <form action="{{route('edit_action')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="user_id" value="{{$editRecord->id}}">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" value="{{$editRecord->username}}" id="username" class="form-control">
                    <a href="" style="color:red">{{$errors->first('username')}}</a>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{$editRecord->email}}" id="email" class="form-control">
                    <a href="" style="color:red">{{$errors->first('email')}}</a>
                </div>
                <div class="form-group" >
                    <label for="image">Profile Picture</label>
                    <input type="file" name="image" id="imageid" class="btn btn-default">
                    <a href="" style="color:red">{{$errors->first('image')}}</a>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Edit Record</button>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <img src="{{url('public/lib/images/'.$editRecord->image)}}" alt="" class="img-responsive thumbnail" style="margin-top:20px">
        </div>
    </div>
@stop
