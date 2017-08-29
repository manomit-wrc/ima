@extends('admin.dashboard_layout')
@section('title', 'Notice - Add')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Notice
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/notice">Notice</a></li>
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
              
              <li class="active"><a href="#settings" data-toggle="tab">Notice - Add</a></li>
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
                <form name="frmTeam" method="post" action="/admin/notice/store" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
                    <label for="subject" class="col-sm-2 control-label">Subject</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="subject" placeholder="Enter Subject" name="subject" value="{{ old('subject')}}">
                      <span class="text-danger">{{ $errors->first('subject') }}</span>
                    </div>
                  </div>
                  
                  <div class="form-group {{ $errors->has('published_date') ? 'has-error' : '' }}">
                    <label for="published_date" class="col-sm-2 control-label">Published Date</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="published_date" placeholder="Published Date" name="published_date" value="{{ old('published_date')}}" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                      <span class="text-danger">{{ $errors->first('published_date') }}</span>
                    </div>
                  </div>
                  
                  <div class="form-group {{ $errors->has('file_name') ? 'has-error' : '' }}">
                    <label for="file_name" class="col-sm-2 control-label">Upload File</label>

                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="file_name"  name="file_name" >
                      <span class="text-danger" >{{ $errors->first('file_name') }}</span>
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