@extends('admin.dashboard_layout')
@section('title', 'Branch - Add')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Branch
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/local-branch">Branch</a></li>
        <li class="active">Add</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              
              <li class="active"><a href="#settings" data-toggle="tab">Branch - Add</a></li>
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
                <form name="frmTeam" method="post" action="/admin/local-branch/store" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('branch_name') ? 'has-error' : '' }}">
                    <label for="branch_name" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="branch_name" placeholder="Branch Name" name="branch_name" value="{{ old('branch_name')}}">
                      <span class="text-danger">{{ $errors->first('branch_name') }}</span>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('branch_head') ? 'has-error' : '' }}">
                    <label for="branch_head" class="col-sm-2 control-label">Branch Head</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="branch_head" placeholder="Branch Head" name="branch_head" value="{{ old('branch_head')}}">
                      <span class="text-danger">{{ $errors->first('branch_head') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('email_id') ? 'has-error' : '' }}">
                    <label for="email_id" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="email_id" placeholder="Email ID" name="email_id" value="{{ old('email_id')}}">
                      <span class="text-danger">{{ $errors->first('email_id') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                    <label for="mobile_no" class="col-sm-2 control-label">Mobile No</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="mobile_no" placeholder="Mobile No" name="mobile_no" value="{{ old('mobile_no')}}">
                      <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('phone_no') ? 'has-error' : '' }}">
                    <label for="phone_no" class="col-sm-2 control-label">Phone No</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="phone_no" placeholder="Phone No" name="phone_no" value="{{ old('phone_no')}}">
                      <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('branch_address') ? 'has-error' : '' }}">
                    <label for="branch_address" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                      <textarea id="branch_address" name="branch_address" class="form-control">{{ old('branch_address')}}</textarea>
                      <span class="text-danger">{{ $errors->first('branch_address') }}</span>
                    </div>
                  </div>

                  
                  <div class="form-group {{ $errors->has('branch_image') ? 'has-error' : '' }}">
                    <label for="branch_image" class="col-sm-2 control-label">Image</label>

                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="branch_image" name="branch_image" >
                      <span class="text-danger">{{ $errors->first('branch_image') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('designation_id') ? 'has-error' : '' }}">
                    <label for="designation_id" class="col-sm-2 control-label">Designation</label>

                    <div class="col-sm-10">
                      
                      <select name="designation_id" id="designation_id" class="form-control" >
                      <option value="">Select Any</option>
                      @foreach($designations as $key=>$desg)
                        <option value="{{$key}}" {{old('designation_id') == $key ? 'selected' : '' }}>{{$desg}}</option>
                      @endforeach
                      </select>
                      <span class="text-danger">{{ $errors->first('designation_id') }}</span>
                    </div>
                  </div>
                  
                  <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="status" class="col-sm-2 control-label">Status</label>

                    <div class="col-sm-10">
                      
                      <select name="status" id="status" class="form-control" >
                      <option value="1" {{old('status') == "1" ? 'selected' :'' }}>Active</option>
                      <option value="0" {{old('status') == "0" ? 'selected' :'' }}>In-Active</option>
                      </select>
                      <span class="text-danger">{{ $errors->first('status') }}</span>
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