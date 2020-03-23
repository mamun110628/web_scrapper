<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <title>{{isset($meta['title'])?$meta['title'] :'MOFA'}}</title>
    <!-- favicon -->
    <link href="{{url('public/built_in/assets/plugins/boostrapv3/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{url('public/built_in/assets/plugins/bootstrap-select2/select2.css')}}" rel="stylesheet" />
    <link href="{{url('public/built_in/assets/plugins/bootstrap-datepicker/css/datepicker3.css')}}" rel="stylesheet" />
    <link href="{{url('public/built_in/assets/plugins/jquery-scrollbar/jquery.scrollbar.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link href="{{url('public/built_in/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" media="screen">
    <link href="{{url('public/built_in/pages/css/pages.css')}}" rel="stylesheet" />
    <link href="{{url('public/built_in/assets/plugins/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link href="{{url('public/built_in/pages/css/style.css')}}" rel="stylesheet" />
    <link href="{{url('public/built_in/pages/css/pages-icons.css')}}" rel="stylesheet" />


    <link href="{{url('public/user_define/form-style/main.css')}}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{url('public/user_define/form-style/form-style.css')}}" rel="stylesheet" />
    <link href="{{url('public/user_define/form-style/form-control.css')}}" rel="stylesheet" />
    <link href="{{url('public/user_define/form-style/form-manage.css')}}" rel="stylesheet" />
    <link href="{{url('public/angucomplete-alt.css')}}" rel="stylesheet" />
     <link href="{{url('public/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css')}}" rel="stylesheet" />
    <link href="{{url('public/treeGrid.css')}}" rel="stylesheet" />
    <link href="{{url('public/toastr.css')}}" rel="stylesheet" />
    <link href="{{url('public/custom.css')}}" rel="stylesheet" />
    <script src="{{url('public/built_in/assets/plugins/modernizr.custom.js')}}"></script>
    <script src="{{url('public/built_in/jquery.min.js')}}"></script>
    <script src="{{url('public/built_in/assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{url('public/user_define/tab/jquery-ui-1.10.4.custom.js')}}"></script>
    <script src="{{url('public/built_in/assets/plugins/boostrapv3/js/bootstrap.min.js')}}"></script>
    <script src="{{url('public/user_define/js/custom.js')}}"></script>
    <style>
        img.loading_icon {
    position: absolute;
    z-index: 99;
    top: 20%;
    left: 0;
    right: 0;
    margin: 0 auto;
    width: 80px;
    height: auto;
    display: none;
}
    </style>
     <script type="text/javascript">
        var dev_js = new Array();
    </script>
    <style>
        .panel-heading a:not(.btn) {
            color: #ffffff !important;
            opacity: 1;
        }

        .table-responsive {
            width: 100% !important;
        }

        .page-sidebar .sidebar-menu .menu-items > li > a {
            padding-left: 10px;
        }
        .page-sidebar .sidebar-header {
            padding-left: 0px;
        }
        .pull-right span {
            text-transform: uppercase;
        }
    </style>
</head>

<body class="fixed-header windows desktop sidebar-visible menu-pin">
<div id="app">
                <nav class="page-sidebar" data-pages="sidebar">
                    <div class="sidebar-header">
                        <a href="{{url('/')}}">
                            <img src="{{url('public/img/TECHNO.png')}}" alt="logo" class="brand" data-src="{{url('public/img/TECHNO.png')}}" data-src-retina="{{url('public/img/TECHNO.png')}}" style="max-width:160px; height:50px;padding-left:10px">
                        </a>

                        <div class="sidebar-header-controls">
                            <button type="button" class="btn btn-link visible-lg-inline" data-toggle-pin="sidebar" id="togglePin">
                                <i class="fa fs-12"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Left Side top Menu -->
                    <!--- Menu -->
                    <div class="sidebar-menu" ng-controller="menuController">
                        <ul class="menu-items">
                            <li class="m-t-30 open active">
                                <a href="{{url('/')}}">Dashboard</a>
                                <span class="bg-success icon-thumbnail"><i class="fa fa-desktop" aria-hidden="true"></i></span>
                            </li>

                            
                            <li class="<?php echo (isset($meta['active_page']) and in_array($meta['active_page'], array('collect_news','news_list','search-news')))?'active':null?>">
                                <a href="javascript:void(0);">
                                    <span class="">News Clipping</span>
                                    <span class="arrow"></span>
                                </a>
                                <span class="icon-thumbnail"><i class="pg-menu_lv"></i></span>
                                <ul class="sub-menu">
                                    <li><a href="{{url('collect_news')}}">Collect News</a></li>
                                    <li ><a href="{{url('news-list')}}">Newspaper Archive</a></li>
                                    <li ><a href="{{url('search-news')}}">Search News</a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </li>
                            <li class="<?php echo (isset($meta['active_page']) and in_array($meta['active_page'], array('create_newspaper','newspaper_list')))?'active':null?>">
                                <a href="javascript:void(0);">
                                    <span class="">Newspaper Setting</span>
                                    <span class="arrow"></span>
                                </a>
                                <span class="icon-thumbnail"><i class="pg-menu_lv"></i></span>
                                <ul class="sub-menu">
                                    <li><a href="{{route('newspaper.create')}}">Create NewsPaper</a></li>
                                    <li><a href="{{route('newspaper.index')}}">Newspaper List</a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </li> 
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                  
                </nav>

                <div class="page-container ">
                    <div class="header">
                        <!--Logo Section -->
                        <div class="container-fluid relative">
                            <div class="pull-left full-height visible-sm visible-xs">
                                <div class="header-inner">
                                    <a href="#" class="btn-link toggle-sidebar visible-sm-inline-block visible-xs-inline-block padding-5" data-toggle="sidebar">
                                        <span class="icon-set1 menu-hambuger">|||</span>
                                    </a>
                                </div>
                            </div>
                            <div class="pull-center hidden-md hidden-lg">
                                <div class="header-inner">
                                </div>
                            </div>

                            <div class="pull-right full-height visible-sm visible-xs">
                                <div class="header-inner">
                                    <a href="#" class="btn-link visible-sm-inline-block visible-xs-inline-block" data-toggle="quickview" data-toggle-element="#quickview">
                                        <span class="icon-set1 menu-hambuger-plus">|||</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class=" pull-left sm-table hidden-xs hidden-sm">
                            <div class="header-inner" style="text-align:left;padding-left:12px;">
                                <div class="brand inline" style="text-align:left;padding-left:12px;">
                                    <a href="/#!/">
                                        <img src="" data-src-retina="" width="35" height="40">
                                    </a>

                                </div>
                            </div>
                        </div>

                        <!-- Logo Section -->
                        <!-- Right Login Menu -->
                        <div class=" pull-right">
                        </div>                       

                        <div class=" pull-right">
                            <div class="visible-lg visible-md m-t-10">
                                <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
                                    <span class="semi-bold">
                                        John Doe
                                    </span>

                                </div>
                                <div class="dropdown pull-right">
                                    <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="thumbnail-wrapper d32 circular inline m-t-5">
                                            <img src="" width="50" height="50">
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu profile-dropdown" role="menu">
                                        <li class="bg-master-lighter" id="logout">
                                            <a class="clearfix">
                                                <span class="pull-left">Logout</span>
                                                <span class="pull-right"><i class="pg-power"></i></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Right Login Menu -->
                    </div>
                    <div class="page-content-wrapper ">
                        <div class="content">
                            <div class="container-fluid container-fixed-lg custom-container">
                                   @yield('page-content')
                                   <div class="loader">
                                       <img class="loading_icon" src="{{url('public/img/loading.gif')}}">
                                   </div>
                            </div>

                            <div class="container-fluid footer">
                                    <div class="copyright sm-text-center">
                                        <p class="small no-margin pull-left sm-pull-reset" style="width: 100%;">
                                            <span class="hint-text">Copyright &copy; @DateTime.Now.Year </span>
                                            <span class="font-montserrat">Invogue Software Limited</span>.
                                            <span class="hint-text">All rights reserved. </span>
                                            <span class="sm-block" style="float: right;"><a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                        </div>
                        <!-- Start Body -->
                    </div>

                </div>

            </div>


    <script type="text/javascript">
        $(document).ready(function ($) {
            // Hide Loader
            $("#loading").hide();
            // menu
            var device_width = $(window).width();
            if (device_width < 1000) {
                $("body").removeClass('windows');
                $("body").removeClass('desktop');
                $("body").removeClass('sidebar-visible');
                $("body").removeClass('menu-pin');
            }

            //menu selected
            $(".menu-items a").each(function () {
                var curURL = window.location.href; // Current full URL
                curURL = curURL.replace(/\/$/, "");
                curURL = decodeURIComponent(curURL);

                var originUrl = window.location.origin; // Domain Part from curURL
                var newUrl = curURL.replace(originUrl, ''); // Remove Domain Part

                var href = $(this).attr('href');

                if (newUrl === href) {
                    $(this).closest('li').addClass('open active');
                    $(this).closest('li').parents("li").addClass('open active');
                    $(this).closest('li').parents("ul").css({ "display": "block" });
                } else {
                    var secondurl = $("ul.breadcrumb a:eq(1)").attr("href");
                    if (secondurl === href) {
                        $(this).closest('li').addClass('open active');
                        $(this).closest('li').parents("li").addClass('open active');
                        $(this).closest('li').parents("ul").css({ "display": "block" });
                    }
                }
            });
        });

    </script>


    
    <script src="{{url('public/built_in/assets/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    
    <script src="{{url('public/built_in/assets/js/form_elements.js')}}"></script>
    <script src="{{url('public/built_in/assets/plugins/bootstrap-select2/select2.min.js')}}"></script>
    <script src="{{url('public/built_in/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{url('public/built_in/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{url('public/built_in/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('public/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('public/assets/js/jquery.toaster.js')}}"></script>
    <script src="{{url('public/built_in/pages/js/pages.min.js')}}"></script>
    <script src="{{url('public/js/custom.js')}}"></script>
    <script src="{{url('public/built_in/assets/js/form_layouts.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $('.select2').select2();
</script>
<script type="text/javascript">
         for(var i in dev_js){
          dev_js[i]();
        }
        $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
var interval;
			var codetmpl = "<code>%codeobj%</code><br><code>%codestr%</code>";

			function start ()
			{
				if (!interval)
				{
					interval = setInterval(function ()
					{
						randomToast();
					}, 3000);
				}
				this.blur();
			}

			function stop ()
			{
				if (interval)
				{
					clearInterval(interval);
					interval = false;
				}
				this.blur();
			}

			function randomToast (priority = null, title = null, message = null)
			{
				

				$.toaster({ priority : priority, title : title, message : message });
			}

function change_status(url, response, id){
                            
                            $.post(url,
                        {
                            request_id: id,
                            request_response: response,
                            '_token': "{{ csrf_token() }}"
                        },
                        function (data) {
                            var json_data = JSON.parse(data);
                            
                            if(json_data.status == 200){
                                $(".data-table,.data-table1").DataTable().ajax.reload();
                                
                                randomToast('success','Success','Successfully Changed');
                               
                            }
                        });
                        
                        }
                        $(document)
  .ajaxStart(function () {
    $('.loading_icon').show();
  })
  .ajaxStop(function () {
    $('.loading_icon').hide();
  });
    </script>
</body>
</html>

