@extends('admin.dashboard_layout')
@section('title', 'CMS - Edit')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        CMS
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/cms">CMS</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              
              <li class="active"><a href="#settings" data-toggle="tab">CMS - Edit</a></li>
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
                <form name="frmTeam" method="post" action="/admin/cms/update/{{$cms_list->id}}" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title" class="col-sm-2 control-label">Title</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ $cms_list->title }}">
                      <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                  </div>
                  
                  <div class="form-group {{ $errors->has('short_description') ? 'has-error' : '' }}">
                    <label for="short_description" class="col-sm-2 control-label">Short - Description</label>

                    <div class="col-sm-10">
                      <textarea id="short_description" name="short_description" class="form-control">{{ $cms_list->short_description}}</textarea>
                      <span class="text-danger">{{ $errors->first('short_description') }}</span>
                    </div>
                  </div>
                  

                  <div class="form-group {{ $errors->has('full_description') ? 'has-error' : '' }}">
                    <label for="textarea_id" class="col-sm-2 control-label">Full - Description</label>

                    <div class="col-sm-10">
                      <textarea id="textarea_id" name="full_description" class="form-control">{{ $cms_list->full_description }}</textarea>
                      <span class="text-danger">{{ $errors->first('full_description') }}</span>
                    </div>
                  </div>

                  
                  
                  <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">Status</label>

                    <div class="col-sm-10">
                      
                      <select name="status" id="inputStatus" class="form-control" >
                      <option value="1" {{$cms_list->status == "1" ? 'selected' :'' }}>Active</option>
                      <option value="0" {{$cms_list->status == "0" ? 'selected' :'' }}>In-Active</option>
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