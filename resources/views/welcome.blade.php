<!DOCTYPE html>
<html lang="en" ng-app="imaApp">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Indian Medical Associations</title>
    <base href="/">
    <!-- css -->
     {!! Html::script('storage/frontend/js/jquery.min.js') !!}
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular-route.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ngStorage/0.3.11/ngStorage.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-cookies.js"></script>
    
    
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1YnEDntvpLx4UiOrpoFS6dEfNfkkqFsE&v=3.0&sensor=true"></script>

    {!! Html::script('storage/frontend/angular/ng-sweet-alert.js') !!}

    {!! Html::script('storage/frontend/angular/SweetAlert.min.js') !!}

    {!! Html::style('storage/frontend/angular/sweet-alert.css') !!}
    
    {!! Html::script('storage/frontend/angular/services/authService.js') !!}
    
    {!! Html::script('storage/frontend/angular/AuthCtrl.js') !!}
    
    {!! Html::script('storage/frontend/angular/appRoutes.js') !!}
   
    {!! Html::script('storage/frontend/angular/app.js') !!}

    {!! Html::style('storage/frontend/css/bootstrap.min.css') !!}
    
    {!! Html::style('storage/frontend/font-awesome/css/font-awesome.min.css') !!}
    
    {!! Html::style('storage/frontend/plugins/cubeportfolio/css/cubeportfolio.min.css') !!}
    
    {!! Html::style('storage/frontend/css/nivo-lightbox.css') !!}
    
    {!! Html::style('storage/frontend/css/nivo-lightbox-theme/default/default.css') !!}
    
    {!! Html::style('storage/frontend/css/owl.carousel.css') !!}
    
    {!! Html::style('storage/frontend/css/owl.theme.css') !!}
    
    {!! Html::style('storage/frontend/css/animate.css') !!}
    
    {!! Html::style('storage/frontend/css/style.css') !!}
    <!-- boxed bg -->
    <link id="bodybg" href="/storage/frontend/bodybg/bg1.css" rel="stylesheet" type="text/css" />
    <!-- template skin -->
    <link id="t-colors" href="/storage/frontend/color/default.css" rel="stylesheet">
    
   
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
    <div id="wrapper" ng-controller="AuthController">
    
        <my-navbar></my-navbar>
        <!-- Section: intro -->
        <div ng-view></div>
        
<footer>
    <div class="container" ng-init="getFootercontent();">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>About IMA</h5>
                        <p>
                            @{{footer_description[0].short_description}}
                        </p>
                    </div>
                </div>
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>Information</h5>
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="javascript:void(0)">Laboratory</a></li>
                            <li><a href="javascript:void(0)">Medical treatment</a></li>
                            <li><a href="javascript:void(0)">Terms & conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>IMA center</h5>
                        <p>
                            Nam leo lorem, tincidunt id risus ut, ornare tincidunt naqunc sit amet.
                        </p>
                        <ul>
                            <li>
                                <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-calendar-o fa-stack-1x fa-inverse"></i>
                        </span> Monday - Saturday, 8am to 10pm
                            </li>
                            <li>
                                <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                        </span>@{{footer_data[0].phone}}
                            </li>
                            <li>
                                <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
                        </span> @{{footer_data[0].email}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>Our location</h5>
                        <p>@{{footer_data[0].address}}</p>
                    </div>
                </div>
                <div class="wow fadeInDown" data-wow-delay="0.1s">
                    <div class="widget">
                        <h5>Follow us</h5>
                        <ul class="company-social">
                            <li class="social-facebook"><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                            <li class="social-twitter"><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                            <li class="social-google"><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                            <li class="social-vimeo"><a href="javascript:void(0)"><i class="fa fa-vimeo-square"></i></a></li>
                            <li class="social-dribble"><a href="javascript:void(0)"><i class="fa fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="text-left">
                            <p>&copy;Copyright - IMA. All rights reserved.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="wow fadeInRight" data-wow-delay="0.1s">
                        <div class="text-right">
                            <div class="credits">
                                
                                Design by <a href="http://www.wrctechnologies.com/" target="_blank">WRC Technologies Pvt. Ltd</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- login Modal -->
            <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" ng-controller="AuthController" login-modal>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user" aria-hidden="true"></i> DOCTOR LOGIN</h4>
                            <div class="login registration-error" ng-show="code==1">@{{message}}</div>
                        </div>
                        <form name="frmLogin" id="frmLogin" ng-submit="doLogin(frmLogin.$valid)" method="post" novalidate="novalidate">
                            <div class="modal-body">
                                <div class="infbox" ng-class="{
                                            'has-error':!frmLogin.login_email_id.$valid && (!frmLogin.$pristine || frmLogin.$submitted), 
                                            'has-success': frmLogin.login_email_id.$valid && (!frmLogin.$pristine || frmLogin.$submitted)
                                            }">
                                    <div class="userid"><i class="fa fa-user" aria-hidden="true"></i></div>
                                    <input name="login_email_id" id="login_email_id" type="text" class="loginuser" placeholder="Enter Email ID" ng-model="login.login_email_id" required="required" />
                                    <span class="help-block" ng-show="frmLogin.login_email_id.$error.required && (!frmLogin.$pristine || frmLogin.$submitted)">Please Enter Email ID</span>
                                </div>
                                <br clear="all">
                                <div class="infbox" ng-class="{
                                            'has-error':!frmLogin.login_password.$valid && (!frmLogin.$pristine || frmLogin.$submitted), 
                                            'has-success': frmLogin.login_password.$valid && (!frmLogin.$pristine || frmLogin.$submitted)
                                            }">
                                    <div class="userid"><i class="fa fa-unlock-alt" aria-hidden="true"></i></div>
                                    <input name="login_password" id="login_password" type="password" class="loginuser" placeholder="Enter Password" ng-model="login.login_password" required="required" />
                                    <span class="help-block" ng-show="frmLogin.login_password.$error.required && (!frmLogin.$pristine || frmLogin.$submitted)">Please Enter Password</span>
                                </div>
                                <br clear="all">
                                <div class="remindbox">
                                    <input name="remember_me" type="checkbox" value="1" ng-model="login.remember_me" /> &nbsp; Remember Me
                                    <span><a href="#" ng-click="closeLogin();" data-toggle="modal" data-target="#ForgetModal">Forgot Password?</a></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="viewmoreBTN" id="btnLogin" ng-disabled="isDisabled">SIGNIN</button>
                        </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            <!-- Register Modal -->
            <div class="modal fade" id="RegModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" ng-controller="AuthController">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-lock" aria-hidden="true"></i> DOCTOR Registration</h4>
                            
                            <div class="login registration-error" ng-show="code==1">@{{message}}</div>
                        </div>
                        <form name="frmRegistration" id="frmRegistration" ng-submit="doRegistration(frmRegistration.$valid)" method="post" novalidate="novalidate">
                            <div class="modal-body">

                                <div class="infbox" ng-class="{
                                            'has-error':!frmRegistration.first_name.$valid && (!frmRegistration.$pristine || frmRegistration.$submitted), 
                                            'has-success': frmRegistration.first_name.$valid && (!frmRegistration.$pristine || frmRegistration.$submitted)
                                            }">
                                    <div class="userid"><i class="fa fa-user" aria-hidden="true"></i></div>
                                    <input name="first_name" id="first_name" type="text" ng-model="registration.first_name" class="loginuser" placeholder="Enter First Name" required="required" />
                                    <span class="help-block" ng-show="frmRegistration.first_name.$error.required && (!frmRegistration.$pristine || frmRegistration.$submitted)">Please Enter First Name</span>
                                </div>
                                <br clear="all">
                                <div class="infbox" ng-class="{
                                            'has-error':!frmRegistration.last_name.$valid && (!frmRegistration.$pristine || frmRegistration.$submitted), 
                                            'has-success': frmRegistration.last_name.$valid && (!frmRegistration.$pristine || frmRegistration.$submitted)
                                            }">
                                    <div class="userid"><i class="fa fa-user" aria-hidden="true"></i></div>
                                    <input name="last_name" id="last_name" type="text" class="loginuser" ng-model="registration.last_name" placeholder="Enter Last Name" required="required" />
                                    <span class="help-block" ng-show="frmRegistration.last_name.$error.required && (!frmRegistration.$pristine || frmRegistration.$submitted)">Please Enter Last Name</span>
                                </div>
                                <br clear="all">
                                <div class="infbox" ng-class="{
                                            'has-error':!frmRegistration.email_id.$valid && (!frmRegistration.$pristine || frmRegistration.$submitted), 
                                            'has-success': frmRegistration.email_id.$valid && (!frmRegistration.$pristine || frmRegistration.$submitted)
                                            }">
                                    <div class="userid">@</div>
                                    <input name="email_id" id="email_id" type="email" ng-model="registration.email_id" class="loginuser" placeholder="Enter Email ID" required="required" />
                                    <span class="help-block" ng-show="frmRegistration.email_id.$error.required && (!frmRegistration.$pristine || frmRegistration.$submitted)">Please Enter Email ID</span>
                                    <span class="help-block" ng-show="frmRegistration.email_id.$error.email && (!frmRegistration.$pristine || frmRegistration.$submitted)">Please Enter Valid Email ID</span>
                                </div>
                                <br clear="all">
                                <div class="infbox" ng-class="{
                                            'has-error':!frmRegistration.mobile_no.$valid && (!frmRegistration.$pristine || frmRegistration.$submitted), 
                                            'has-success': frmRegistration.mobile_no.$valid && (!frmRegistration.$pristine || frmRegistration.$submitted)
                                            }">
                                    <div class="userid"><i class="fa fa-phone-square" aria-hidden="true"></i></div>
                                    <input name="mobile_no" id="mobile_no" type="text" class="loginuser" ng-model="registration.mobile_no" maxlength="10" placeholder="Enter Mobile No" ng-maxlength="10" ng-minlength="10" required="required" />
                                    <span class="help-block" ng-show="frmRegistration.mobile_no.$error.required && (!frmRegistration.$pristine || frmRegistration.$submitted)">Please Enter Mobile No</span>
                                    <span class="help-block" ng-show="frmRegistration.mobile_no.$error.maxlength  && (!frmRegistration.$pristine || frmRegistration.$submitted)">Mobile No Must Have 10 Digits</span>
                                    <span class="help-block" ng-show="frmRegistration.mobile_no.$error.minlength  && (!frmRegistration.$pristine || frmRegistration.$submitted)">Mobile No Must Have 10 Digits</span>
                                    <span class="help-block" ng-show="frmRegistration.mobile_no.$error.number  && (!frmRegistration.$pristine || frmRegistration.$submitted)">Mobile No Must Be Numeric</span>
                                </div>
                                <br clear="all">
                                <div class="infbox" ng-class="{
                                            'has-error':!frmRegistration.password.$valid && (!frmRegistration.$pristine || frmRegistration.$submitted), 
                                            'has-success': frmRegistration.password.$valid && (!frmRegistration.$pristine || frmRegistration.$submitted)
                                            }">
                                    <div class="userid"><i class="fa fa-key" aria-hidden="true"></i></div>
                                    <input name="password" id="password" type="password" ng-model="registration.password" class="loginuser" placeholder="Enter Password" ng-maxlength="32" ng-minlength="6" required="required" />
                                    <span class="help-block" ng-show="frmRegistration.password.$error.required  && (!frmRegistration.$pristine || frmRegistration.$submitted)">Please Enter Password</span>
                                    <span class="help-block" ng-show="frmRegistration.password.$error.minlength  && (!frmRegistration.$pristine || frmRegistration.$submitted)">Password Have Atleast 6 Characters</span>
                                    <span class="help-block" ng-show="frmRegistration.password.$error.maxlength  && (!frmRegistration.$pristine || frmRegistration.$submitted)">Password Have Atmost 32 Characters</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="viewmoreBTN" id="btnRegistration" ng-disabled="isDisabled">SIGN UP</button>
                        </div>
                        </form>
                        
                    </div>
                </div>
            </div>

            <!-- forget password Modal -->
            <div class="modal fade" id="ForgetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" ng-controller="AuthController" forgot-modal>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user" aria-hidden="true"></i> FORGOT PASSWORD</h4>
                            <div class="login registration-error" ng-show="code==1">@{{message}}</div>
                        </div>
                        <form name="frmForgotPassword" id="frmForgotPassword" ng-submit="doForgotPassword(frmForgotPassword.$valid)" method="post" novalidate="novalidate">
                            <div class="modal-body">
                                <div class="infbox" ng-class="{
                                            'has-error':!frmForgotPassword.email_id.$valid && (!frmForgotPassword.$pristine || frmForgotPassword.$submitted), 
                                            'has-success': frmForgotPassword.email_id.$valid && (!frmForgotPassword.$pristine || frmForgotPassword.$submitted)
                                            }">
                                    <div class="userid"><i class="fa fa-user" aria-hidden="true"></i></div>
                                    <input name="email_id" id="email_id" type="email" class="loginuser" placeholder="Enter Email ID" ng-model="email_id" required="required" />
                                    <span class="help-block" ng-show="frmForgotPassword.email_id.$error.required && (!frmForgotPassword.$pristine || frmForgotPassword.$submitted)">Please Enter Email ID</span>

                                    <span class="help-block" ng-show="frmForgotPassword.email_id.$error.email && (frmForgotPassword.$pristine || frmForgotPassword.$submitted)">Please Enter Valid Email ID</span>
                                </div>
                                
                                <br clear="all">
                                <div class="remindbox">
                                    
                                    <a href="#" ng-click="closeForgot();" data-toggle="modal" data-target="#LoginModal">Back To Login</a>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="viewmoreBTN" id="btnLogin">SUBMIT</button>
                        </div>
                        </form>
                        
                    </div>
                </div>
            </div>
    </div>
    <a href="javascript:void(0)" class="scrollup"><i class="fa fa-angle-up active"></i></a>
    <!-- Core JavaScript Files -->
    
    {!! Html::script('storage/frontend/js/jquery.min.js') !!}
    
    {!! Html::script('storage/frontend/js/bootstrap.min.js') !!}
    
    {!! Html::script('storage/frontend/js/jquery.easing.min.js') !!}
    
    {!! Html::script('storage/frontend/js/wow.min.js') !!}
    
    {!! Html::script('storage/frontend/js/jquery.scrollTo.js') !!}
    
    {!! Html::script('storage/frontend/js/jquery.appear.js') !!}
    
    {!! Html::script('storage/frontend/js/stellar.js') !!}
    
    {!! Html::script('storage/frontend/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js') !!}
    
    {!! Html::script('storage/frontend/js/owl.carousel.min.js') !!}
    
    {!! Html::script('storage/frontend/js/nivo-lightbox.min.js') !!}
    
    {!! Html::script('storage/frontend/js/custom.js') !!}

    
    
    
</body>
</html>