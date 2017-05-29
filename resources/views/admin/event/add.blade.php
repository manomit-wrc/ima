@extends('admin.dashboard_layout')
@section('title', 'Event - Add')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Event
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/event">Event</a></li>
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
              
              <li class="active"><a href="#settings" data-toggle="tab">Event - Add</a></li>
            </ul>
            <div class="tab-content">
              
              <div class="tab-pane active" id="settings">
                <form name="frmTeam" method="post" action="/admin/event/store" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" value="{{ old('name')}}">
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                  </div>
                  <div class="form-group {{ $errors->has('event_venue') ? 'has-error' : '' }}">
                    <label for="inputVenue" class="col-sm-2 control-label">Venue</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputVenue" placeholder="Venue" name="event_venue" value="{{ old('event_venue')}}">
                      <span class="text-danger">{{ $errors->first('event_venue') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('event_date') ? 'has-error' : '' }}">
                    <label for="inputEventDate" class="col-sm-2 control-label">Event Date</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEventDate" placeholder="Event Date" name="event_date" value="{{ old('event_date')}}" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                      <span class="text-danger">{{ $errors->first('event_date') }}</span>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="inputDescrition" class="col-sm-2 control-label">Description</label>

                    <div class="col-sm-10">
                      <textarea id="inputDescription" name="description" class="form-control">{{ old('description')}}</textarea>
                      <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                  </div>

                  
                  <div class="form-group {{ $errors->has('event_category_id') ? 'has-error' : '' }}">
                    <label for="inputEventCategory" class="col-sm-2 control-label">Category</label>

                    <div class="col-sm-10">
                      
                      <select name="event_category_id" id="inputEventCategory" class="form-control" >
                      <option value="">Select Any</option>
                      @foreach($event_categories as $key=>$desg)
                        <option value="{{$key}}" {{old('event_category_id') == $key ? 'selected' : '' }}>{{$desg}}</option>
                      @endforeach
                      </select>
                      <span class="text-danger">{{ $errors->first('event_category_id') }}</span>
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
@stop