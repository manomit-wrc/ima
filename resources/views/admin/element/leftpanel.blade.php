 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <ul class="sidebar-menu">
       <!--  <li class="header">MAIN NAVIGATION</li> -->
        <li><a href="{!!URL::to('/admin/dashboard')!!}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

        <li class="treeview {{ Request::segment(2) === 'organization' || Request::segment(2) === 'designation' || Request::segment(2) === 'team' || Request::segment(2) === 'banner' || Request::segment(2) === 'bulletin' || Request::segment(2) === 'local-branch' || Request::segment(2) === 'cms' || Request::segment(2) === 'accomodation' || Request::segment(2) === 'cuisine' || Request::segment(2) === 'paymenttype' || Request::segment(2) === 'connectivity' || Request::segment(2) === 'connectivityservices' || Request::segment(2) === 'accrediation' || Request::segment(2) === 'specificservice' || Request::segment(2) === 'medicalfacility' || Request::segment(2) === 'banner' || Request::segment(2) === 'doctor' || Request::segment(2) === 'company' || Request::segment(2) === 'qualification' ? 'active' : null }}">
          <a href="javascript:void(0)">
            <i class="fa fa-cog"></i> <span>Settings management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="{{ Request::segment(2) === 'organization' ? 'active' : null }}"><a href="{!!URL::to('/admin/organization')!!}"><i class="fa fa-language"></i>Organization</a></li>

            <li class="{{ Request::segment(2) === 'designation' ? 'active' : null }}"><a href="{!!URL::to('/admin/designation')!!}"><i class="fa fa-language"></i>Designation</a></li>

            <li class="{{ Request::segment(2) === 'team' ? 'active' : null }}"><a href="{!!URL::to('/admin/team')!!}"><i class="fa fa-language"></i>Team</a></li>

            <li class="{{ Request::segment(2) === 'banner' ? 'active' : null }}"><a href="{!!URL::to('/admin/banner')!!}"><i class="fa fa-language"></i>Banner</a></li>

            <li class="{{ Request::segment(2) === 'bulletin' ? 'active' : null }}"><a href="{!!URL::to('/admin/bulletin')!!}"><i class="fa fa-language"></i>Bulletin</a></li>

            <li class="{{ Request::segment(2) === 'local-branch' ? 'active' : null }}"><a href="{!!URL::to('/admin/local-branch')!!}"><i class="fa fa-language"></i>Local Branch</a></li>

            <li class="{{ Request::segment(2) === 'cms' ? 'active' : null }}"><a href="{!!URL::to('/admin/cms')!!}"><i class="fa fa-language"></i>CMS</a></li>
           
            <li class="{{ Request::segment(2) === 'doctor' ? 'active' : null }}"><a href="{!!URL::to('/admin/doctor')!!}"><i class="fa fa-language"></i>Doctors</a></li>

            <li class="{{ Request::segment(2) === 'company' ? 'active' : null }}"><a href="{!!URL::to('/admin/company')!!}"><i class="fa fa-language"></i>Medical Company</a></li>

            <li class="{{ Request::segment(2) === 'qualification' ? 'active' : null }}"><a href="{!!URL::to('/admin/qualification')!!}"><i class="fa fa-language"></i>Qualification Master</a></li>
            
                                
          </ul>
        </li>

        <li class="treeview {{ Request::segment(2) === 'event-category' || Request::segment(2) === 'event' || Request::segment(2) === 'tag' || Request::segment(2) === 'news'  || Request::segment(2) === 'notice' ? 'active' : null }}">
          <a href="javascript:void(0)">
            <i class="fa fa-cog"></i> <span>Events management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="{{ Request::segment(2) === 'event-category' ? 'active' : null }}"><a href="{!!URL::to('/admin/event-category')!!}"><i class="fa fa-language"></i>Event Category</a></li>
            <li class="{{ Request::segment(2) === 'event' ? 'active' : null }}"><a href="{!!URL::to('/admin/event')!!}"><i class="fa fa-language"></i>Events</a></li>

            <li class="{{ Request::segment(2) === 'tag' ? 'active' : null }}"><a href="{!!URL::to('/admin/tag')!!}"><i class="fa fa-language"></i>Tag</a></li>

            <li class="{{ Request::segment(2) === 'news' ? 'active' : null }}"><a href="{!!URL::to('/admin/news')!!}"><i class="fa fa-language"></i>News</a></li>

            <li class="{{ Request::segment(2) === 'notice' ? 'active' : null }}"><a href="{!!URL::to('/admin/notice')!!}"><i class="fa fa-language"></i>Notice</a></li>
                                
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
