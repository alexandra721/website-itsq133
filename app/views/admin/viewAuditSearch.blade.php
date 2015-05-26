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
    $(document).ready(function(){
        $('.datepicker').datepicker({
            format : 'yyyy-mm-dd'
        });
        scripts_Article();

        if($('#searchBy').val() == '1DATE'){
            $('#twoDate').hide();
            $('#oneDate').fadeIn();
        }else{
            $('#oneDate').hide();
            $('#twoDate').fadeIn();
        }

        $('#searchBy').change(function(){
            if($(this).val() == '1DATE'){
                $('#twoDate').hide();
                $('#oneDate').fadeIn();
            }else{
                $('#oneDate').hide();
                $('#twoDate').fadeIn();
            }
        });

        $('#search1').click(function(){
            var date = 0;
            if($('#opt1Date1').val() != ''){
                date = $('#opt1Date1').val();
            }
            location.href = '/admin/searchAudit/1DATE/'+date+'/'+$('#userId').val();
        });

        $('#search2').click(function(){
            var date1 = 0, date2 = 0;
            if($('#opt2Date1').val() != ''){
                date1 = $('#opt2Date1').val();
            }

            if($('#opt2Date2').val() != ''){
                date2 = $('#opt2Date2').val();
            }

            location.href = '/admin/searchAudit/2DATE/'+date1+'/'+date2+'/'+$('#userId').val();
        })
    })
</script>
@stop
@section('master-body')
<h1><i class="fa fa-user"></i> Audit Trail for {{ $user->firstname }} {{ $user->lastname }}</h1>
<hr/>
<div class="col-md-12">
    <div class="col-md-3">
        <select id="searchBy" name="searchBy" class="form-control" style="margin-bottom: 0.8em;">
            <option value="1DATE" <?php if(Input::old('searchBy') == '1DATE'){ echo('selected'); } ?>>Search by Date</option>
            <option value="2DATE" <?php if(Input::old('searchBy') == '2DATE'){ echo('selected'); } ?>>Search between two Dates</option>
        </select>
    </div>
    <div class="col-md-9" id="oneDate" style="margin-bottom: 0.8em;">
        <!--        <form method="POST" action="/admin/searchAudit=1DATE">-->
        <input type="hidden" value="{{$user->id}}" name="userId" id="userId"/>
        <div class="col-md-10" style="padding: 0; margin: 0; margin-bottom: 0.8em;">
            <input type="text" class="form-control datepicker" name="DATE1" id="opt1Date1" placeholder="Click here to search by date" readonly/>
        </div>
        <div class="col-md-2" style="padding: 0; margin: 0;">
            <button type="button" class="btn btn-success" id="search1">Search</button>
        </div>
        <!--        </form>-->
    </div>
    <div class="col-md-9" style="display: none; padding: 0;" id="twoDate">
        <!--        <form method="POST" action="/admin/searchAudit=2DATE">-->
        <input type="hidden" value="{{$user->id}}" name="userId" />
        <div class="col-md-5" style="margin: 0; margin-bottom: 0.8em;">
            <input type="text" class="form-control datepicker" name="DATE1" id="opt2Date1" placeholder="Click here to search by date" readonly/>
        </div>
        <div class="col-md-5" style="padding: 0; margin: 0; margin-bottom: 0.8em;">
            <input type="text" class="form-control datepicker" name="DATE2" id="opt2Date2" placeholder="Click here to search by date" readonly/>
        </div>
        <div class="col-md-2" style="padding: 0; margin: 0; margin-bottom: 0.8em;">
            <button type="button" class="btn btn-success" id="search2">Search</button>
        </div>
        <!--        </form>-->
    </div>
</div>
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


@if($trails->count() == 0)
<center><span style="color: red;"><i>No audit trail data for this user</i></span></center>
@endif

<div class="col-md-12">
    @foreach($trails as $trail)
    <div class="audit-item">
        {{ $trail->content }}
        <hr style="margin: 0;"/>
        <span style="font-size: 0.8em; color: #3498DB;"><i class="fa fa-clock-o"></i> {{ $trail->created_at }}</span>
    </div>
    @endforeach
</div>
<center>{{ $trails->links() }}</center>

@stop