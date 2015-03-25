@extends('admin.layouts.master')

@section('master-head')
<style>
    small {
        display: block;
        line-height: 1.428571429;
        color: #999;
    }
    td {
        padding: 0.2em;
    }
</style>
@stop

@section('master-body')
<h1><i class="fa fa-user"></i> Profile Management</h1>
<hr/>
<div class="well" style="margin-top: 3em;">
    <div class="row">
        <div class="col-md-3">
            <img src="{{ $user->profile_photo }}" class="img-rounded img-responsive"/>
        </div>
        <div class="col-md-5" style="padding: 0.5em;">
            <table border="0" style="width: 100%; font-size: 1em;">
                <tr>
                    <td style="width: 20%; text-align: right">Name</td>
                    <td style="text-align: left; padding-left: 2em; font-weight: bold">{{ $user->firstname }} {{ $user->lastname }}</td>
                </tr>
                <tr>
                    <td style="width: 20%; text-align: right">Email</td>
                    <td style="text-align: left; padding-left: 2em; font-weight: bold">{{ $user->email}}</td>
                </tr>
                <tr>
                    <td style="width: 20%; text-align: right">Role</td>
                    <td style="text-align: left; padding-left: 2em; font-weight: bold">{{ $user->role }}</td>
                </tr>
                <tr>
                    <td style="width: 28%; text-align: right">Acct Status</td>
                    <td style="text-align: left; padding-left: 2em;">
                        @if($user->status == 'DEACTIVATED')
                            <b><font color="red">{{ $user->status }}</font></b>
                        @else
                            <b><font color="green">{{ $user->status }}</font></b>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%; text-align: right">Acct Creation</td>
                    <td style="text-align: left; padding-left: 2em; font-weight: bold">{{ $user->created_at }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-4">
            @if($user->status == 'DEACTIVATED')
                <button style="width: 100%; margin-bottom: 0.5em;" class="btn btn-success"><i class="fa fa-check"></i> Activate</button>
            @else
                <button style="width: 100%; margin-bottom: 0.5em;" class="btn btn-danger"><i class="fa fa-times"></i> Deactivate</button>
            @endif
            <button style="width: 100%; margin-bottom: 0.5em;" class="btn btn-primary"><i class="glyphicon glyphicon-asterisk"></i> Change password</button>
        </div>
    </div>
</div>
<hr/>
<div class="panel panel-primary">
    <div class="panel-heading">
        Posts of {{ $user->firstname }} {{ $user->lastname }} : Total of {{ $posts->count() }}
    </div>
    <div class="panel-body">
        @if($posts->count() == 0)
        <center><i>No posts found.</i></center>
        @endif
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        Comments of {{ $user->firstname }} {{ $user->lastname }} : Total of {{ $posts->count() }}
    </div>
    <div class="panel-body">
        @if($comments->count() == 0)
        <center><i>No comments found.</i></center>
        @endif
    </div>
</div>
@stop