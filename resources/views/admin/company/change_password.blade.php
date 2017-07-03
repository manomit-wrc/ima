@extends('admin.dashboard_layout')
@section('title', 'Company - Change Password')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Company
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/company">Company</a></li>
        <li class="active">Change Password</li>
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
              
              <li class="active"><a href="#settings" data-toggle="tab">Company - Change Password</a></li>
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
                <form name="frmCompany" method="post" action="/admin/company/updatepassword" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('old_password') ? 'has-error' : '' }}">
                    <label for="old_password" class="col-sm-2 control-label">Old Password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="old_password" placeholder="Old Password" name="old_password" value="{{ old('old_password')}}">
                      <span class="text-danger">{{ $errors->first('old_password') }}</span>
                    </div>
                  </div>

                   <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
                    <label for="new_password" class="col-sm-2 control-label">New Password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="new_password" placeholder="New Password" name="new_password" value="{{ old('new_password')}}">
                      <span class="text-danger">{{ $errors->first('new_password') }}</span>
                    </div>
                  </div>

                   <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
                    <label for="confirm_password" class="col-sm-2 control-label">Confirm Password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" name="confirm_password" value="{{ old('confirm_password')}}">
                      <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                         <input type="hidden" value="{{$data->id}}" name="id">
                    </div>
                  </div>
             
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
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