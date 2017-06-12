@extends('admin.dashboard_layout')
@section('title', 'Doctor-View')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Doctor
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/doctor">Doctor</a></li>
        <li class="active">View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
         <div class="alert alert-info" id="result77" style="display:none;"></div>
              @if (Session::has('message'))
                  <div class="alert alert-info" id="result7">{{ Session::get('message') }}</div>
              @endif
               @if (Session::has('error_message'))
                  <div class="alert alert-danger" id="result8">{{ Session::get('error_message') }}</div>
              @endif
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              
              <li class="active"><a href="#settings" data-toggle="tab">Doctor-View</a></li>
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
                <form name="frm" method="post" action="/admin/doctor/active" class="form-horizontal">
                  {{csrf_field()}}

                  <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <label for="inputFirstName" class="col-sm-2 control-label">First Name</label>

                    <div class="col-sm-10">
                       {{$viewdoctor[0]['first_name']}}
                    </div>
                      <input type="hidden" name="id" value="{{$viewdoctor[0]['id']}}">
                      <input type="hidden" name="status" value="{{$viewdoctor[0]['status']}}">
                  </div>
                  <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    <label for="inputLastName" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-10">
                       {{$viewdoctor[0]['last_name']}}
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                     {{$viewdoctor[0]['email']}}
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                    <label for="inputMobile" class="col-sm-2 control-label">Mobile No</label>

                    <div class="col-sm-10">
                     {{$viewdoctor[0]['mobile']}}
                    </div>
                  </div>

                  

                  <div class="form-group {{ $errors->has('serving_period') ? 'has-error' : '' }}">
                    <label for="inputServingPeriod" class="col-sm-2 control-label">Date of birth</label>

                    <div class="col-sm-10">
                     {{$viewdoctor[0]['dob']}}
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('serving_period') ? 'has-error' : '' }}">
                    <label for="inputServingPeriod" class="col-sm-2 control-label">License</label>

                    <div class="col-sm-10">
                     {{$viewdoctor[0]['license']}}
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('avators') ? 'has-error' : '' }}">
                    <label for="inputAvators" class="col-sm-2 control-label">Image</label>

                    <div class="col-sm-10">
                     @if(!empty($viewdoctor[0]['avators']) && file_exists(url('uploads/doctors/'.$viewdoctor[0]['avators'])))
                      <img src="{{ url('uploads/doctors/'.$viewdoctor[0]['avators'])}}" alt="{{$viewdoctor[0]['avators']}}" height="100" width="100">
                     @else(empty($viewdoctor[0]['avators']))
                      <img src="{{ url('uploads/doctors/'.'noimage_user.jpg')}}" alt="{{$viewdoctor[0]['avators']}}" height="100" width="100">@endif
                     
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      @if($viewdoctor[0]['status']=='0')<input type="submit" value="Active">@endif
                      @if($viewdoctor[0]['status']=='1')<input type="submit" value="Inative">@endif
                    </div>
                  </div>

                  </form>
                  </br></br>

                   <h3><font color="">Journal</font></h3>
                 <!--Journal table start--> 
                
               <div class="box-body">
                <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Title</th>
                  <th>Publised Date</th>
                  <th>Journal File</th>
                  <th>Category Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($viewdoctor)
                  @foreach($viewdoctor[0]['journal'] as  $value)
                    <tr>
                      <td>{{$value['title']}}</td>
                      <td>{{$value['published_date']}}</td>
                      <td><a href="{{ url('uploads/doctors/journal/' .$value['journal_file'])}}" alt="{{$value['journal_file']}}" target="_blank">{{$value['journal_file']}}</a></td>
                      <td>{{$value['categories']['name']}}</td>
                      <td><a href="/admin/doctor/Publised/{{$value['id']}}/{{$value['status']}}" onclick="return confirm('Are you want to change?')">
                        @if($value['status']=='0')
                        <input type="button" value="Publised">
                        @endif
                         @if($value['status']=='1')
                        <input type="button" value="Unpublised">
                        @endif
                        </a></td>
                    </tr>
                  @endforeach
                @endif
                
                </tbody>
                
              </table>
            </div>
            <!--Journal table end-->


                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                     
                    </div>
                  </div>
                
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
@stop