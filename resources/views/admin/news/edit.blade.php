@extends('admin.dashboard_layout')
@section('title', 'News - Edit')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        News
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/news">News</a></li>
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
              
              <li class="active"><a href="#settings" data-toggle="tab">News - Edit</a></li>
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
                <form name="frmTeam" method="post" action="/admin/news/update/{{$news->id}}" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title" class="col-sm-2 control-label">Title</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ $news->title}}">
                      <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('published_date') ? 'has-error' : '' }}">
                    <label for="published_date" class="col-sm-2 control-label">Published Date</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="published_date" placeholder="Published Date" name="published_date" value="{{ date('d-m-Y',strtotime($news->published_date)) }}" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                      <span class="text-danger">{{ $errors->first('published_date') }}</span>
                    </div>
                  </div>

                  

                  <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="textarea_id" class="col-sm-2 control-label">Description</label>

                    <div class="col-sm-10">
                      <textarea id="textarea_id" name="description" class="form-control">{{ $news->description}}</textarea>
                      <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('tag_id') ? 'has-error' : '' }}">
                    <label for="tag_id" class="col-sm-2 control-label">Tags</label>

                    <div class="col-sm-10">
                      
                      <select name="tag_id[]" id="tag_id" class="form-control js-example-basic-multiple" multiple="multiple" >
                      <option value="">Select Any</option>
                      @foreach($tags as $key=>$desg)
                        <option value="{{$key}}" {{ in_array($key, $tags_array) ? 'selected' : '' }}>{{$desg}}</option>
                      @endforeach
                      </select>
                      <span class="text-danger">{{ $errors->first('tag_id') }}</span>
                    </div>
                  </div>
                  
                  <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">Status</label>

                    <div class="col-sm-10">
                      
                      <select name="status" id="inputStatus" class="form-control" >
                      <option value="1" {{$news->status == "1" ? 'selected' :'' }}>Active</option>
                      <option value="0" {{$news->status == "0" ? 'selected' :'' }}>In-Active</option>
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