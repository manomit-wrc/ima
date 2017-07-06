@extends('admin.dashboard_layout')
@section('title', 'Department-edit')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Department
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/department">Department</a></li>
        <li class="active">Edit</li>
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
              
              <li class="active"><a href="#settings" data-toggle="tab">Edit</a></li>
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
                <form name="frmDeprtament" method="post" action="/admin/department/update/{{$department->id}}" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="name" placeholder="Enter Department Name" name="name" value="{{ $department->name }}">
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="description" class="col-sm-2 control-label">Description</label>

                    <div class="col-sm-10">
                      
                      <textarea name="description" class="form-control" placeholder="Enter Description">{{ $department->description }}</textarea>
                      <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                  </div>
                  
                   <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="status" class="col-sm-2 control-label">Status</label>

                    <div class="col-sm-10">
                      
                      <select name="status" id="status" class="form-control" >
                      <option value="1" {{ $department->status == "1" ? 'selected' :'' }}>Active</option>
                      <option value="0" {{ $department->status == "0" ? 'selected' :'' }}>In-Active</option>
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