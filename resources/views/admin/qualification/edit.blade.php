@extends('admin.dashboard_layout')
@section('title', 'Qualification-Edit')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Qualification
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/qualification">Qualification</a></li>
        <li class="active">Qualification Edit</li>
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
              
              <li class="active"><a href="#settings" data-toggle="tab">Qualification - Qualification Edit</a></li>
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
                <form name="frmCompany" method="post" action="/admin/qualification/update" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('qualification_name') ? 'has-error' : '' }}">
                    <label for="qualification_name" class="col-sm-2 control-label">Qualification Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="qualification_name" placeholder="Enter Your Qualification" name="qualification_name" value="{{ $qualificationedit->qualification_name  }}">
                      <span class="text-danger">{{ $errors->first('qualification_name') }}</span>
                    </div>
                  </div>
                  
                   <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">Status</label>

                    <div class="col-sm-10">
                      
                      <select name="inputStatus" id="inputStatus" class="form-control" >
                      <option value="1" {{$qualificationedit->status == "1" ? 'selected' :'' }}>Active</option>
                      <option value="0" {{$qualificationedit->status == "0" ? 'selected' :'' }}>In-Active</option>
                      </select>
                      <span class="text-danger">{{ $errors->first('status') }}</span>
                        <input type="hidden" name="uid" value="{{$qualificationedit->id}}">
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