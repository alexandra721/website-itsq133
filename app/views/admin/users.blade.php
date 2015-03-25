@extends('admin.layouts.master')

@section('master-head')
<script>
    $(document).ready(function(){
        $('.a-acti').click(function(){
            $('.confirm-acti-modal').attr('href', $(this).attr('data-href'));
            var info = 'Confirm account activation for <font color="red">'+$('.first_'+$(this).attr('id')).text()+' '+$('.last_'+$(this).attr('id')).text()+'</font>';
            $('.modal-body-acti').empty().append(info);
            $('#actiModal').modal().show();
        });

        $('.a-deac').click(function(){
            $('.confirm-deac-modal').attr('href', $(this).attr('data-href'));
            var info = 'Confirm account deactivation for <font color="red">'+$('.first_'+$(this).attr('id')).text()+' '+$('.last_'+$(this).attr('id')).text()+'</font>';
            $('.modal-body-deac').empty().append(info);
            $('#deacModal').modal().show();
        });
    })
</script>
@stop

@section('master-body')
    <h1><i class="fa fa-users"></i> User Management</h1>
    <hr/>
    <table class="table table-responsive" style="font-size: 1em;">
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