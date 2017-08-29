@extends('admin.dashboard_layout')
@section('title', 'Team - Add')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Team
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/team">Team</a></li>
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
              
              <li class="active"><a href="#settings" data-toggle="tab">Team - Add</a></li>
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
                <form name="frmTeam" method="post" action="/admin/team/store" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <label for="inputFirstName" class="col-sm-2 control-label">First Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputFirstName" placeholder="First Name" name="first_name" value="{{ old('first_name')}}">
                      <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    <label for="inputLastName" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputLastName" placeholder="Last Name" name="last_name" value="{{ old('last_name')}}">
                      <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail" placeholder="Email ID" name="email" value="{{ old('email')}}">
                      <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                    <label for="inputMobile" class="col-sm-2 control-label">Mobile No</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputMobile" placeholder="Mobile No" name="mobile_no" value="{{ old('mobile_no')}}">
                      <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                    <label for="inputAddress" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                      <textarea id="inputAddress" name="address" class="form-control">{{ old('address')}}</textarea>
                      <span class="text-danger">{{ $errors->first('address') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('serving_period') ? 'has-error' : '' }}">
                    <label for="inputServingPeriod" class="col-sm-2 control-label">Serving Period</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputServingPeriod" placeholder="Serving Period" name="serving_period" value="{{ old('serving_period')}}">
                      <span class="text-danger">{{ $errors->first('serving_period') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('avators') ? 'has-error' : '' }}">
                    <label for="inputAvators" class="col-sm-2 control-label">Image</label>

                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="inputAvators" name="avators" >
                      <span class="text-danger" id="hid_err">{{ $errors->first('avators') }}</span>
                    </div>

                     <font id="pre_img" style="display:none">
                      <div class="col-md-10 col-md-offset-2"><img src="" id="profile-img-tag" width="100px" style="margin-top:1%" /></div>
                     </font>
                  </div>

                  <div class="form-group {{ $errors->has('designation_id') ? 'has-error' : '' }}">
                    <label for="inputDesignation" class="col-sm-2 control-label">Designation</label>

                    <div class="col-sm-10">
                      
                      <select name="designation_id" id="inputDesignation" class="form-control" >
                      <option value="">Select Any</option>
                      @foreach($designations as $key=>$desg)
                        <option value="{{$key}}" {{old('designation_id') == $key ? 'selected' : '' }}>{{$desg}}</option>
                      @endforeach
                      </select>
                      <span class="text-danger">{{ $errors->first('designation_id') }}</span>
                    </div>
                  </div>
                  
                  <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">Status</label>

                    <div class="col-sm-10">
                      
                      <select name="status" id="inputStatus" class="form-control" >
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

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script type="text/javascript">
    function readURL(input) {
         document.getElementById('hid_err').style.visibility='hidden';
         var mimeType=input.files[0]['type'];

         if (input.files && input.files[0] && mimeType.split('/')[0]=="image") {

            document.getElementById('pre_img').style.display='block';
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
    $("#inputAvators").change(function(){
        readURL(this);
    });
</script>
@stop