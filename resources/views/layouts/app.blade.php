<!DOCTYPE html>
<html>
<head>
   <!-- Basic Page Needs =====================================-->
   <meta charset="utf-8">

   <!-- Mobile Specific Metas ================================-->
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="{{$settings->Desc}}">

   <!-- Site Title- -->
   <title>{{trans('navbar.title')}}</title>

   <!-- CSS
   ==================================================== -->
   <!--Font Awesome -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

   <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
   <link rel="stylesheet" href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
   <link rel="stylesheet" href="{{asset('assets/css/jssocials.css')}}" />

<link rel="stylesheet" href="{{asset('assets/css/jssocials-theme-flat.css')}}" />
        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
      
        <!-- END Icons -->
   <!-- Animate CSS -->
   <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">

   <!-- Iconic Fonts -->
   <link rel="stylesheet" href="{{asset('assets/css/icofonts.css')}}" />

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="{{asset('assets/css')}}/bootstrap_<?php if(App::getLocale()=='ar') {echo "ar";}elseif(App::getLocale()=='en'){echo "en";} else{echo "ar";}?>.min.css">

   <!-- Owl Carousel -->
   <link rel="stylesheet" href="{{asset('assets/css/owlcarousel.min.css')}}" />

   <!-- Video Popup -->
   <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}" />




   <!--Style CSS -->
   <link rel="stylesheet" href="{{asset('assets/css')}}/style_<?php if(App::getLocale()=='ar') {echo "ar";}elseif(App::getLocale()=='en'){echo "en";}else {echo "ar";}?>.css">

   <!--Responsive CSS -->
   <link rel="stylesheet" href="{{asset('assets/css')}}/responsive_<?php if(App::getLocale()=='ar') {echo "ar";}elseif(App::getLocale()=='en'){echo "en";} else{echo "ar";}?>.css">


   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->


</head>
            

<body>
 	



    <!-- Preloader -->
     @include('includes.nevbars')
     @yield('contents')
     @include('includes.footer')
<!--End pagewrapper-->
<!--Scroll to top-->


 <!--Required JS files-->
 <script src="{{asset('assets/js/jquery-2.0.0.min.js')}}"></script>
 <script src="{{asset('assets/js/jssocials.min.js')}}"></script>

   <!-- Popper JS -->
   <script src="{{asset('assets/js/popper.min.js')}}"></script>
   <!-- Bootstrap jQuery -->
   <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
   <!-- Owl Carousel -->
   <script src="{{asset('assets/js/owl-carousel.2.3.0.min.js')}}"></script>
   <!-- Waypoint -->
   <script src="{{asset('assets/js/waypoints.min.js')}}"></script>
   <!-- Counter Up -->
   <script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
   <!-- Video Popup -->
   <script src="{{asset('assets/js/jquery.magnific.popup.js')}}"></script>
   <!-- Smooth scroll -->
   <script src="{{asset('assets/js/smoothscroll.js')}}"></script>
   <!-- WoW js -->
   <script src="{{asset('assets/js/wow.min.js')}}"></script>

   
   <script src="{{asset('assets/js/jquery.validate.js')}}"></script>


   <!-- Template Custom -->
   <script src="{{asset('assets/js/main.js')}}"></script>
   
<script>
                $(document).ready(function() {
                    $('#html5-watermark').hide();
                    $('#contact_form').on('submit', function(event){
                            
                            event.preventDefault();
                            var form_data = $(this).serialize();
                            $.ajax({
                                url:"{{ route('sendMessage') }}",
                                method:"POST",
                                data:form_data,
                                dataType:"json",
                                success:function(data)
                                {
                                    
                                    if(data.error.length > 0)
                                    {
                                        var error_html = '';
                                        for(var count = 0; count < data.error.length; count++)
                                        {
                                            error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                                        }
                                        $('#form_output').html(error_html);
                                    }
                                    else
                                    {
                                      
                                     $('#form_output').html(data.success);
                                               
                                    }
                                }
                            })
                        });
                    });         
                </script>



<script>
                $(document).ready(function() {
                    $('#html5-watermark').hide();
                    $('#quick_contact').on('submit', function(event){
                            
                            event.preventDefault();
                            var form_data = $(this).serialize();
                            $.ajax({
                                url:"{{ route('quickContact') }}",
                                method:"POST",
                                data:form_data,
                                dataType:"json",
                                success:function(data)
                                {
                                    
                                    if(data.error.length > 0)
                                    {
                                        var error_html = '';
                                        for(var count = 0; count < data.error.length; count++)
                                        {
                                            error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                                        }
                                        $('#form_output').html(error_html);
                                    }
                                    else
                                    {
                                      
                                     $('#form_output').html(data.success);
                                               
                                    }
                                }
                            })
                        });
                    });         
                </script>

<script>
                $(document).ready(function() {
                    $('#html5-watermark').hide();
                    $('#request_form').on('submit', function(event){
                            event.preventDefault();
                            var form_data = $(this).serialize();
                            $.ajax({
                                url:"{{ route('serviceRequest') }}",
                                method:"POST",
                                data:form_data,
                                dataType:"json",
                                success:function(data)
                                {
                                    
                                    if(data.error.length > 0)
                                    {
                                        var error_html = '';
                                        for(var count = 0; count < data.error.length; count++)
                                        {
                                            error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                                        }
                                        $('#form_output').html(error_html);
                                    }
                                    else
                                    {
                                      
                                     $('#form_output').html(data.success);
                                               
                                    }
                                }
                            })
                        });
                    });         
                </script>
                <script>
                    $('#contact_form').validate();
                    $('#request_form').validate();
                </script>

<script>
    var url = window.location.href; // or window.location.href for current url
    var captured = /blog=([^&]+)/.exec(url)[1]; // Value is in [1] ('384' in our case)
    var result = captured ? captured : 'http://127.0.0.1:8000';
        $("#share").jsSocials({
                url: "http://127.0.0.1:8000/blog="+ result,
                text: "Esh'har Blogs",
                showLabel: false,
                showCount: false,
                shares: ["twitter", "facebook", "pinterest", "linkedin"]
            });

    


    </script>
</body>
</html>
    
