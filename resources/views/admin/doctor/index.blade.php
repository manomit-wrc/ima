@extends('admin.dashboard_layout')
@section('title', 'Team List')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Doctor List
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Doctor List</li>
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
              <h3 class="box-title">Doctor List</h3>
            </div>
            <!-- /.box-header -->
            <!--<div class="topbtn"><a href="/admin/team/add"><button type="button" class="btn bg-purple btn-rightad">ADD</button></a></div>-->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                @if($doctor)
                  @foreach($doctor as $value)
                    <tr>
                      <td>{{$value->first_name}}</td>
                      <td>{{$value->last_name}}</td>
                      <td>{{$value->email}}</td>
                      <td>{{$value->mobile}}</td>
                      <td>{{$value->status == '1'?'Active':'In-Active'}}
                      </td>
                      <td><a href="/admin/doctor/view/{{$value->id}}" >View</a></td>
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