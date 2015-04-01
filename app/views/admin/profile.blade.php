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
<script>
    $(document).ready(function(){
        profileButtons($('.activate-btn'), $('.deactivate-btn'), $('.changepass-btn'), $('#user_id'));
        changepassValidation($('.changepass-1'), $('.changepass-2'), $('.confirm-changepass-modal'), $('.changepass-errorMsg'));
        submitChangepass($('#changepass-form'), $('.confirm-changepass-modal'), $('.changepass-errorMsg'));
    })
</script>
@stop

@section('master-body')
<input type="hidden" id="user_id" value="{{ $user->id }}" />
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
                    <td style="width: 20%; text-align: right">Username</td>
                    <td style="text-align: left; padding-left: 2em; font-weight: bold">{{ $user->username}}</td>
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
                <button data-name="{{$user->firstname}} {{$user->lastname}}" data-href="/admin/activate/{{$user->id}}" style="width: 100%; margin-bottom: 0.5em;" class="btn btn-success activate-btn"><i class="fa fa-check"></i> Activate</button>
            @else
                <button data-name="{{$user->firstname}} {{$user->lastname}}" data-href="/admin/deactivate/{{$user->id}}" style="width: 100%; margin-bottom: 0.5em;" class="btn btn-danger deactivate-btn"><i class="fa fa-times"></i> Deactivate</button>
            @endif
            <button data-name="{{$user->firstname}} {{$user->lastname}}" style="width: 100%; margin-bottom: 0.5em;" class="btn btn-primary changepass-btn"><i class="glyphicon glyphicon-asterisk"></i> Change password</button>
        </div>
    </div>
</div>
<hr/>
<div class="panel panel-primary">
    <div class="panel-heading">
        Comments of {{ $user->firstname }} {{ $user->lastname }} : Total of {{ $comments->count() }}
    </div>
    <div class="panel-body">
        @if($comments->count() == 0)
        <center><i>No comments found.</i></center>
        @endif
    </div>
</div>

<!--MODAL CODES -- START-->
<div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<div class="modal fade" id="changepassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-header-changepass" id="myModalLabel"><i class="glyphicon glyphicon-asterisk" style="color: #F1C40F"></i> Change password for </h4>
            </div>
            <div class="modal-body modal-body-changepass">
                <form action="/admin/changepass/{{$user->id}}" method="POST" id="changepass-form">
                    {{ Form::password('changepass-1', array('class' => 'form-control margin-bottom-10 changepass-1', 'placeholder' => 'Enter new password')) }}
                    {{ Form::password('changepass-2', array('class' => 'form-control margin-bottom-10 changepass-2', 'placeholder' => 'Confirm new password')) }}
                </form>
                <div class="changepass-errorMsg" style="text-align: center;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a class="btn btn-primary confirm-changepass-modal disabled">Change Password</a>
            </div>
        </div>
    </div>
</div>
<!--MODAL CODES -- END-->
@stop