@extends('admin.layouts.master')

@section('master-head')
<script>
    $(document).ready(function(){ scripts_Users(); })
</script>
@stop

@section('master-body')
<h1><i class="fa fa-users"></i> Search Users</h1>
<hr/>
<div class="row" style="margin-bottom: 1em;">
    <form method="POST" action="/admin/searchUsers"">

    <div class="col-md-2">

        <select class="form-control" name="selectBy">
            <option value="username">Username</option>
            <option value="firstname">Firstname</option>
            <option value="lastname">Lastname</option>
            <option value="email">Email</option>
        </select>
    </div>
    <div class="col-md-8">
        <input type="text" class="form-control" name="keyword"/>
    </div>
    <div class="col-md-2">

        <button class="btn btn-primary">Search for user</button>
    </div>
    </form>
</div>
@if(@$users)

<div class="panel panel-primary">
    <div class="panel-heading">
        List of users found
    </div>
    <div class="panel-body">
        <table class="table table-responsive table-striped table-hover" style="font-size: 1em;">
            <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Role</th>
                <th>Status</th>
                <th>Date Joined</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            @if($user->id != Auth::user()->id)
            <tr>
                <td class="username_{{$user->id}}"> {{ $user->username }} </td>
                <td> {{ $user->email }} </td>
                <td class="first_{{$user->id}}"> {{ $user->firstname }} </td>
                <td class="last_{{$user->id}}"> {{ $user->lastname }} </td>
                <td> {{ $user->role }} </td>
                <td>
                    @if($user->status == 'DEACTIVATED')
                    <b><font color="red">{{ $user->status }}</font></b>
                    @else
                    <b><font color="green">{{ $user->status }}</font></b>
                    @endif
                </td>
                <td> {{ $user->created_at }} </td>
                <td>
                    <a href="/admin/profile/{{$user->id}}" style="color: orange"><i class="fa fa-edit"></i></a>
                    @if($user->status == 'ACTIVATED')
                    <a class="a-deac" href="#" data-href="/admin/deactivate/{{$user->id}}" style="color: red;" id="{{$user->id}}" data-info="{{ $user->id }}"><i class="fa fa-times"></i></a>
                    @else
                    <a class="a-acti" href="#" data-href="/admin/activate/{{$user->id}}" style="color: green;" id="{{$user->id}}" data-info="{{ $user->id }}"><i class="fa fa-check"></i></a>
                    @endif
                </td>
            </tr>
            @endif
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="panel-footer" style="text-align: center; padding: 0px;">
        {{ $users->links() }}
    </div>
</div>
@endif
@stop