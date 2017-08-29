@extends('admin.dashboard_layout')
@section('title', 'Bulletin - Edit')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bulletin
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/bulletin">Bulletin</a></li>
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
              
              <li class="active"><a href="#settings" data-toggle="tab">Bulletin - Edit</a></li>
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
                <form name="frmBanner" method="post" action="/admin/bulletin/update/{{$bulletin_list->id}}" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Bulletin Name" name="name" value="{{ $bulletin_list->name }}">
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                  </div>
                  
                  <div class="form-group {{ $errors->has('bulletin_image') ? 'has-error' : '' }}">
                    <label for="bulletin_image" class="col-sm-2 control-label">Image</label>

                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="bulletin_image" name="bulletin_image" >
                      <span class="text-danger" id="hid_err">{{ $errors->first('bulletin_image') }}</span>
                     
                    </div>
                  </div>

                   <font id="shw_img" >
                     <div class="form-group" class="col-md-2 control-label">
                     <div class="col-sm-10 col-md-offset-2">
                         <img src="{{ url('uploads/bulletin/thumb/'.$bulletin_list->bulletin_image)}}" alt="{{$bulletin_list->bulletin_image}}" height="70" width="70">
                     </div>
                     </div>
                   </font>
                   <font id="pre_img" style="display:none">
                     <div class="form-group" class="col-md-2 control-label">
                     <div class="col-md-10 col-md-offset-2"><img src="" id="profile-img-tag" width="100px" /></div>
                     </div>
                   </font>

                  <div class="form-group {{ $errors->has('bulletin_file') ? 'has-error' : '' }}">
                    <label for="bulletin_file" class="col-sm-2 control-label">File</label>

                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="bulletin_file" name="bulletin_file" >
                      <span class="text-danger">{{ $errors->first('bulletin_file') }}</span>
                      <a href="{{ url('uploads/bulletin/' .$bulletin_list->bulletin_file)}}" target="_blank">{{$bulletin_list->bulletin_file}}</a>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">Status</label>

                    <div class="col-sm-10">
                      
                      <select name="status" id="inputStatus" class="form-control" >
                      <option value="1" {{$bulletin_list->status == "1" ? 'selected' :'' }}>Active</option>
                      <option value="0" {{$bulletin_list->status == "0" ? 'selected' :'' }}>In-Active</option>
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
    $("#bulletin_image").change(function(){
        readURL(this);
    });
</script>
@stop