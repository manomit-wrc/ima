@extends('admin.dashboard_layout')
@section('title', 'Speciality-add')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Speciality
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/qualification">Speciality</a></li>
        <li class="active">Speciality Add</li>
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
              
              <li class="active"><a href="#settings" data-toggle="tab">Speciality - Speciality Add</a></li>
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
                <form name="frmspecialist" method="post" action="/admin/specialist/store" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('qualification_name') ? 'has-error' : '' }}">
                    <label for="qualification_name" class="col-sm-2 control-label">Speciality Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="specialist_name" placeholder="Enter Your Speciality Name" name="specialist_name" value="{{ old('specialist_name')}}">
                      <span class="text-danger">{{ $errors->first('specialist_name') }}</span>
                    </div>
                  </div>
                  
                   <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">Status</label>

                    <div class="col-sm-10">
                      
                      <select name="inputStatus" id="inputStatus" class="form-control" >
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