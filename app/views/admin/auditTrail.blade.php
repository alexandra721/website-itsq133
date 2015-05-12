@extends('admin.layouts.master')

@section('master-head')
<style>
    .audit-item:hover {
        box-shadow: 0 0 20px 1px #95A5A6;
        background-color: white;
        /*border: 1px solid #ECF0F1;*/
        color: #000000;
    }

    .audit-item {
        background-color: #ECF0F1;
        padding: 0.4em;
        margin: 1em;
        cursor: pointer;
        transition : 0.3s;
        color: #7F8C8D;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    .elipContent {
        text-align: justify;
        display: block; /* Fallback for non-webkit */
        display: -webkit-box;
        /*max-width: 400px;*/
        height: $font-size*$line-height*$lines-to-show; /* Fallback for non-webkit */
        max-height: 6em;
        /*margin: 0 auto;*/
        font-size: $font-size;
        line-height: $line-height;
        -webkit-line-clamp: 4;
        /*-webkit-line-clamp: $lines-to-show;*/
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<script>
    $(document).ready(function(){ scripts_Article(); })
</script>
@stop
@section('master-body')
<h1><i class="fa fa-user"></i> Audit Trail : User List</h1>
<hr/>
@if(Session::has('successMsg'))
<div class="updatemsgDiv">
    <button type="button" class="close" aria-label="Close" onclick="$('.updatemsgDiv').fadeToggle()"><span aria-hidden="true">&times;</span></button>
    <i class="fa fa-check"></i> {{ Session::get('successMsg') }}
</div>
@endif

@if(Session::has('errorMsg'))
<div class="updatemsgDiv" style="background-color: #FFC7BD; color: red; border-color: red;">
    <button type="button" class="close" aria-label="Close" onclick="$('.updatemsgDiv').fadeToggle()"><span aria-hidden="true">&times;</span></button>
    <i class="fa fa-warning"></i> {{ Session::get('errorMsg') }}
</div>
@endif

<div class="row form-group">
    <form method="POST" action="/admin/auditTrailSearch">
        <div class="col-md-3">
            <select class="form-control" name="searchBy">
                <option value="0">Search by..</option>
                <option value="firstname">Firstname</option>
                <option value="lastname">Lastname</option>
                <option value="username">Username</option>
            </select>
        </div>
        <div class="col-md-7" style="padding: 0;" >
            <input type="text" placeholder="Enter search keyword here" name="searchWord" class="form-control"/>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
        </div>
    </form>
</div>
@foreach($users as $user)
    <div class="audit-item" onclick="location.href='/viewAudit={{$user->id}}'">
        <span style="font-size: 1.1em;">{{ $user->lastname }}, {{ $user->firstname }}</span><br/>
        Username : <span style="color: #2980B9; font-weight: bold;">{{ $user->username }}</span>
    </div>
@endforeach

<center>{{ $users->links() }}</center>

@stop