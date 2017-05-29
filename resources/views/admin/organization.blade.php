@extends('admin.dashboard_layout')
@section('title', 'Organization')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Organization
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/dashboard">Dashboard</a></li>
        <li class="active">Organization</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              
              <li class="active"><a href="#settings" data-toggle="tab">Organization</a></li>
            </ul>
            <div class="tab-content">
              <div class="alert alert-info" id="result77" style="display:none;"></div>
              @if (Session::has('message'))
                  <div class="alert alert-info" id="result7">{{ Session::get('message') }}</div>
              @endif
               @if (Session::has('error_message'))
                  <div class="alert alert-danger" id="result8">{{ Session::get('error_message') }}</div>
              @endif
              <div class="tab-pane active" id="settings">
                <form name="frmProfile" method="post" action="/admin/update-organization" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" value="{{$organization_details->name}}">
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email"  value="{{$organization_details->email}}">
                      <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('alternate_email') ? 'has-error' : '' }}">
                    <label for="inputAltEmail" class="col-sm-2 control-label">Alternate Email</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputAltEmail" name="alternate_email" placeholder="Alternate Email"  value="{{$organization_details->alternate_email}}">
                      <span class="text-danger">{{ $errors->first('alternate_email') }}</span>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                    <label for="inputAddress" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                      <textarea id="inputAddress" name="address" class="form-control">{{$organization_details->address}}</textarea>
                      <span class="text-danger"></span>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label for="inputPhone" class="col-sm-2 control-label">Phone</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputPhone" placeholder="Phone" name="phone" value="{{$organization_details->phone}}">
                      <span class="text-danger">{{ $errors->first('phone') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('facebook_link') ? 'has-error' : '' }}">
                    <label for="inputFB" class="col-sm-2 control-label">Facebook Link</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputFB" placeholder="Facebook Link" name="facebook_link" value="{{$organization_details->facebook_link}}">
                      <span class="text-danger">{{ $errors->first('facebook_link') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('twitter_link') ? 'has-error' : '' }}">
                    <label for="inputTwitter" class="col-sm-2 control-label">Twitter Link</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputTwitter" placeholder="Twitter Link" name="twitter_link" value="{{$organization_details->twitter_link}}">
                      <span class="text-danger">{{ $errors->first('twitter_link') }}</span>
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