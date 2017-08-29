@extends('admin.dashboard_layout')
@section('title', 'Banner - Edit')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Banner
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/banner">Banner</a></li>
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
              
              <li class="active"><a href="#settings" data-toggle="tab">Banner - Edit</a></li>
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
                <form name="frmBanner" method="post" action="/admin/banner/update/{{$banner_list->id}}" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Banner Name" name="name" value="{{ $banner_list->name }}">
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('short_description') ? 'has-error' : '' }}">
                    <label for="short_description" class="col-sm-2 control-label">Short Description</label>

                    <div class="col-sm-10">
                      <textarea id="short_description" name="short_description" class="form-control">{{ $banner_list->short_description }}</textarea>
                      <span class="text-danger">{{ $errors->first('short_description') }}</span>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('full_description') ? 'has-error' : '' }}">
                    <label for="full_description" class="col-sm-2 control-label">Full Description</label>

                    <div class="col-sm-10">
                      <textarea id="full_description" name="full_description" class="form-control">{{ $banner_list->full_description }}</textarea>
                      <span class="text-danger">{{ $errors->first('full_description') }}</span>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('banner_image') ? 'has-error' : '' }}">
                    <label for="banner_image" class="col-sm-2 control-label">Image</label>

                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="banner_image" name="banner_image" >
                      <span class="text-danger"  id="hid_err">{{ $errors->first('banner_image') }}</span>
                      
                    </div>
                  </div>

                  <font id="shw_img" >
                     <div class="form-group" class="col-md-2 control-label">
                     <div class="col-sm-10 col-md-offset-2">
                         <img src="{{ url('uploads/banner/thumb/'.$banner_list->banner_image)}}" alt="{{$banner_list->banner_image}}" height="70" width="70">
                     </div>
                     </div>
                   </font>
                   <font id="pre_img" style="display:none">
                     <div class="form-group" class="col-md-2 control-label">
                     <div class="col-md-10 col-md-offset-2"><img src="" id="profile-img-tag" width="100px" /></div>
                     </div>
                   </font>
                  
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

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script type="text/javascript">
    function readURL(input) {
          var mimeType=input.files[0]['type'];
          document.getElementById('hid_err').style.visibility='hidden';
          document.getElementById('shw_img').style.display='none';
          document.getElementById('pre_img').style.display='block';
        if (input.files && input.files[0] && mimeType.split('/')[0]=="image") {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
        else
        {
          document.getElementById('pre_img').style.display='none';
          alert("Not A image file");
        }
    }
    $("#banner_image").change(function(){
        readURL(this);
    });
</script>
@stop