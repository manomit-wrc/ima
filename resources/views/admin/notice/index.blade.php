@extends('admin.dashboard_layout')
@section('title', 'Notice List')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Notice List
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Notice List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="alert alert-info" id="result77" style="display:none;"></div>
              @if (Session::has('message'))
                  <div class="alert alert-info" id="result7">{{ Session::get('message') }}</div>
              @endif
               @if (Session::has('error_message'))
                  <div class="alert alert-danger" id="result8">{{ Session::get('error_message') }}</div>
              @endif

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Notice List</h3>
            </div>
            <!-- /.box-header -->
            <div class="topbtn"><a href="/admin/notice/add"><button type="button" class="btn bg-purple btn-rightad">ADD</button></a></div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Subject</th>
                  <th>Content</th>
                  <th>Date</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                @if($notices)
                  @foreach($notices as $value)
                    <tr>
                      <td>{{$value->subject}}</td>
                      <td><a href="{{ url('uploads/notice/' .$value->file_name)}}" target="_blank">{{$value->file_name}}</a></td>
                      <td>{{date('d-m-Y',strtotime($value->published_date))}}</td>
                      
                      <td><a href="/admin/notice/edit/{{$value->id}}" >Edit</a>&nbsp;|&nbsp;<a href="/admin/notice/delete/{{$value->id}}" onclick="return confirm('Are you sure?')">Delete</a></td>
                    </tr>
                  @endforeach
                @endif
                
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 @stop