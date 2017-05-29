<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin - @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  {!! Html::style('storage/admin/css/bootstrap.min.css') !!}
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
   <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
   <!-- DataTables -->
  {!! Html::style('storage/admin/css/dataTables.bootstrap.css') !!}
  
  <!-- jvectormap -->
  {!! Html::style('storage/admin/css/jquery-jvectormap-1.2.2.css') !!}
  <!-- Select2 -->
  {!! Html::style('storage/admin/css/select2.min.css') !!}
  <!-- Theme style -->
  {!! Html::style('storage/admin/css/AdminLTE.min.css') !!}
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  {!! Html::style('storage/admin/css/_all-skins.min.css') !!}
  <!-- custom css add here. -->
  {!! Html::style('storage/admin/css/custom.css') !!}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script type="text/javascript">
          var base_url = "{!! URL::to('/')!!}";
  </script>
  <link rel="icon" href="{!!URL::to('storage/admin/images/favicon.ico')!!}" type="image/gif" >
</head>

