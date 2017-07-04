@extends('admin.dashboard_layout')
@section('title', 'Qualification List')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Qualification List
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Qualification List</li>
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
              <h3 class="box-title">Qualification List</h3>
            </div>
            <!-- /.box-header -->
            <div class="topbtn"><a href="/admin/qualification/add"><button type="button" class="btn bg-purple btn-rightad">ADD</button></a></div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Qualification Name</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                
                 <tbody>
                @if($qualification)
                  @foreach($qualification as $value)
                    <tr>
                      <td>{{$value->qualification_name}}</td>
                      <td>{{$value->status == '1'?'Active':'In-Active'}}</td>
                      <td><a href="/admin/qualification/edit/{{$value->id}}" return confirm('Are you sure you want to delete?')>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/admin/qualification/delete/{{$value->id}}" >Delete</a></td>
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