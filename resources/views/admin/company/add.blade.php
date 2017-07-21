@extends('admin.dashboard_layout')
@section('title', 'Company - Add')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Company
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/company">Company</a></li>
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
              
              <li class="active"><a href="#settings" data-toggle="tab">Company - Add</a></li>
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
                <form name="frmCompany" method="post" action="/admin/company/store" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">
                    <label for="company_name" class="col-sm-2 control-label">Company Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="company_name" placeholder="Company Name" name="company_name" value="{{ old('company_name')}}">
                      <span class="text-danger">{{ $errors->first('company_name') }}</span>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('company_address') ? 'has-error' : '' }}">
                    <label for="company_address" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                      <textarea id="company_address" name="company_address" class="form-control">{{ old('company_address')}}</textarea>
                      <span class="text-danger">{{ $errors->first('company_address') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="email" placeholder="Email ID" name="email" value="{{ old('email')}}">
                      <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                  </div>

                     <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password" class="col-sm-2 control-label">Password</label>


                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="{{ old('password')}}">
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                  </div>



                  <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                    <label for="inputMobile" class="col-sm-2 control-label">Mobile No</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputMobile" placeholder="Mobile No" name="mobile_no" value="{{ old('mobile_no')}}" onkeypress="if(event.keyCode>=48 && event.keyCode>=58) { return false ;}" maxlength="12">
                      <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('company_regsitration_no') ? 'has-error' : '' }}">
                    <label for="company_regsitration_no" class="col-sm-2 control-label">Company Registration</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="company_regsitration_no" placeholder="Company Registration" name="company_regsitration_no" minlength="15" maxlength="15" value="{{ old('company_regsitration_no')}}">
                      <span class="text-danger">{{ $errors->first('company_regsitration_no') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('date_of_establishment') ? 'has-error' : '' }}">
                    <label for="date_of_establishment" class="col-sm-2 control-label">Establishment Date</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="date_of_establishment" placeholder="Establishment Date" name="date_of_establishment" value="{{ old('date_of_establishment')}}" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                      <span class="text-danger">{{ $errors->first('date_of_establishment') }}</span>
                    </div>
                  </div>

                  

                  <div class="form-group {{ $errors->has('state_list') ? 'has-error' : '' }}">
                    <label for="state_id" class="col-sm-2 control-label">State</label>

                    <div class="col-sm-10">
                      
                      <select name="state_id" id="state_id" class="form-control" >
                      <option value="">Select Any</option>
                      @foreach($state_list as $key=>$state)
                        <option value="{{$key}}" {{old('state_id') == $key ? 'selected' : '' }}>{{$state}}</option>
                      @endforeach
                      </select>
                      <span class="text-danger">{{ $errors->first('state_id') }}</span>
                    </div>
                  </div>

                   <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                    <label for="city" class="col-sm-2 control-label">City</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="city" placeholder="City" name="city" value="{{ old('city')}}">
                      <span class="text-danger">{{ $errors->first('city') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('pincode') ? 'has-error' : '' }}">
                    <label for="pincode" class="col-sm-2 control-label">Pincode</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pincode" placeholder="Pincode" name="pincode" value="{{ old('pincode')}}">
                      <span class="text-danger">{{ $errors->first('pincode') }}</span>
                    </div>
                  </div>



                  <div class="form-group {{ $errors->has('avators') ? 'has-error' : '' }}">
                    <label for="inputAvators" class="col-sm-2 control-label">Image</label>

                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="profile-img" name="avators" >
                      <span class="text-danger" id="hid_err">{{ $errors->first('avators') }}</span>
                    </div>
                    <font id="pre_img" style="display:none">
                      
                      <div class="col-md-10 col-md-offset-2"><img src="" id="profile-img-tag" width="100px" style="margin-top:1%" /></div>
                      
                    </font>
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
    $("#profile-img").change(function(){
        readURL(this);
    });
</script>
@stop