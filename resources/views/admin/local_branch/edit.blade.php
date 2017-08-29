@extends('admin.dashboard_layout')
@section('title', 'Branch - Edit')
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
              
              <li class="active"><a href="#settings" data-toggle="tab">Branch - Edit</a></li>
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
                <form name="frmTeam" method="post" action="/admin/local-branch/update/{{$local_branch_list->id}}" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('branch_name') ? 'has-error' : '' }}">
                    <label for="branch_name" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="branch_name" placeholder="Branch Name" name="branch_name" value="{{ $local_branch_list->branch_name }}">
                      <span class="text-danger">{{ $errors->first('branch_name') }}</span>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('branch_head') ? 'has-error' : '' }}">
                    <label for="branch_head" class="col-sm-2 control-label">Branch Head</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="branch_head" placeholder="Branch Head" name="branch_head" value="{{ $local_branch_list->branch_head }}">
                      <span class="text-danger">{{ $errors->first('branch_head') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('email_id') ? 'has-error' : '' }}">
                    <label for="email_id" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="email_id" placeholder="Email ID" name="email_id" value="{{ $local_branch_list->email_id}}">
                      <span class="text-danger">{{ $errors->first('email_id') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                    <label for="mobile_no" class="col-sm-2 control-label">Mobile No</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="mobile_no" placeholder="Mobile No" name="mobile_no" value="{{ $local_branch_list->mobile_no}}">
                      <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('phone_no') ? 'has-error' : '' }}">
                    <label for="phone_no" class="col-sm-2 control-label">Phone No</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="phone_no" placeholder="Phone No" name="phone_no" value="{{ $local_branch_list->phone_no}}">
                      <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('branch_address') ? 'has-error' : '' }}">
                    <label for="branch_address" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                      <textarea id="branch_address" name="branch_address" class="form-control">{{ $local_branch_list->branch_address}}</textarea>
                      <span class="text-danger">{{ $errors->first('branch_address') }}</span>
                    </div>
                  </div>

                  
                  <div class="form-group {{ $errors->has('branch_image') ? 'has-error' : '' }}">
                    <label for="branch_image" class="col-sm-2 control-label">Image</label>

                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="branch_image" name="branch_image" >
                      <span class="text-danger" id="hid_err">{{ $errors->first('branch_image') }}</span>
                      
                    </div>
                  </div>

                   <font id="shw_img" >
                     <div class="form-group" class="col-md-2 control-label">
                     <div class="col-sm-10 col-md-offset-2">
                       @if(file_exists(public_path().'/uploads/local_branch/thumb/'.$local_branch_list->branch_image) && $local_branch_list->branch_image !== "")
                         <img src="{{ url('uploads/local_branch/thumb/'.$local_branch_list->branch_image)}}" alt="{{$local_branch_list->branch_image}}" height="100" width="100">
                      @endif
                     </div>
                     </div>
                   </font>
                   <font id="pre_img" style="display:none">
                     <div class="form-group" class="col-md-2 control-label">
                     <div class="col-md-10 col-md-offset-2"><img src="" id="profile-img-tag" width="100px" /></div>
                     </div>
                   </font>

                  <div class="form-group {{ $errors->has('designation_id') ? 'has-error' : '' }}">
                    <label for="designation_id" class="col-sm-2 control-label">Designation</label>

                    <div class="col-sm-10">
                      
                      <select name="designation_id" id="designation_id" class="form-control" >
                      <option value="">Select Any</option>
                      @foreach($designations as $key=>$desg)
                        <option value="{{$key}}" {{$local_branch_list->designation_id == $key ? 'selected' : '' }}>{{$desg}}</option>
                      @endforeach
                      </select>
                      <span class="text-danger">{{ $errors->first('designation_id') }}</span>
                    </div>
                  </div>
                  
                  <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="status" class="col-sm-2 control-label">Status</label>

                    <div class="col-sm-10">
                      
                      <select name="status" id="status" class="form-control" >
                      <option value="1" {{$local_branch_list->status == "1" ? 'selected' :'' }}>Active</option>
                      <option value="0" {{$local_branch_list->status == "0" ? 'selected' :'' }}>In-Active</option>
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
    $("#branch_image").change(function(){
        readURL(this);
    });
</script>
@stop