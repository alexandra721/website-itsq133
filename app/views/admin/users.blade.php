@extends('admin.layouts.master')

@section('master-head')
<script>
    $(document).ready(function(){ scripts_Users(); })
</script>
@stop

@section('master-body')
    <h1><i class="fa fa-users"></i> User Management</h1>
    <hr/>
    @foreach($users as $user)
        <div style="background-color: #ECF0F1; padding: 0.8em; margin: 0.8em; border: 1px solid #7F8C8D; border-radius: 0.3em;" class="col-md-12">
            <div class="col-md-8">
                <span style="font-size: 1.2em;">{{$user->firstname}} {{$user->lastname}}</span> (<span style="font-size: 0.8em; color: #7F8C8D;">{{$user->username}}</span>)<br/>
                <span style="font-size: 0.8em; color: #7F8C8D;">{{ $user->email }}</span><br/>
                <span style="font-size: 0.8em; color: #7F8C8D;">{{ $user->role }}</span><br/>
                @if($user->status == 'DEACTIVATED')
                <b><font color="red">{{ $user->status }}</font></b>
                @else
                <b><font color="green">{{ $user->status }}</font></b>
                @endif
                <br/>
                <span style="font-size: 0.8em; color: #7F8C8D;">{{ $user->created_at }}</span><br/>
            </div>
            <div class="col-md-4" style="opacity: 0.9;">
                    <a href="/admin/profile/{{$user->id}}" class="btn btn-default btn-block"><i class="fa fa-edit"></i> Edit</a>
                @if($user->status == 'ACTIVATED')
                    <a class="a-deac btn-block btn btn-danger" href="#" data-href="/admin/deactivate/{{$user->id}}" id="{{$user->id}}" data-info="{{ $user->id }}"><i class="fa fa-times"></i> Deactivate</a>
                @else
                    <a class="a-acti btn-block btn btn-success" href="#" data-href="/admin/activate/{{$user->id}}" id="{{$user->id}}" data-info="{{ $user->id }}"><i style="color: green;" class="fa fa-check"></i> Activate</a>
                @endif
            </div>
        </div>
    @endforeach
<!--    CODES FOR MODAL-->
<div class="modal fade" id="deacModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-warning" style="color: red;"></i> Confirm account deactivation</h4>
            </div>
            <div class="modal-body modal-body-deac">
                Please confirm deactivation of account
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger confirm-deac-modal">Deactivate</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="actiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-check-circle" style="color: green"></i> Confirm account activation</h4>
            </div>
            <div class="modal-body modal-body-acti">
                Please confirm activation of account
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a class="btn btn-success confirm-acti-modal">Activate</a>
            </div>
        </div>
    </div>
</div>
@stop