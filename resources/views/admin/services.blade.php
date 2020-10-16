
<!DOCTYPE html>
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        @include('admin.include.header')
    </head>

    -->
    <body class="page-loading">
        <!-- Preloader -->
          @include('admin.include.preloader')
        <!-- END Preloader -->

        <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
                <!-- Alternative Sidebar -->
                @include('admin.include.leftsidebar')
                    <!-- END Alternative Sidebar -->

                    <!-- Main Sidebar -->
                    @include('admin.include.sidebar')
                    <!-- END Main Sidebar -->
            <!-- Main Container -->
            <div id="main-container">
                <!-- Header -->

                <header class="navbar navbar-default">
                    <!-- Left Header Navigation -->
                    <ul class="nav navbar-nav-custom">
                        <!-- Main Sidebar Toggle Button -->
                        <li>
                            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');">
                                <i class="fa fa-bars fa-fw"></i>
                            </a>
                        </li>

                    </ul>
                    <!-- END Left Header Navigation -->

                    <!-- Search Form -->
                    <form action="page_ready_search_results.html" method="post" class="navbar-form-custom" role="search">
                        <div class="form-group">
                            <input type="text" id="top-search" name="top-search" class="form-control" placeholder="Search..">
                        </div>
                    </form>
                    <!-- END Search Form -->

                    <!-- Right Header Navigation -->
                    
                    <!-- END Right Header Navigation -->
                </header>
                <!-- END Header -->

                <!-- Page content -->
                <div id="page-content">
                    <!-- Datatables Header -->
                    
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href=""> Products</a></li>
                    </ul>
                    <!-- END Datatables Header -->

                    <!-- Datatables Content -->
                    <div class="block full">
                        <div class="block-title">
                            <h2><strong>Our</strong> Products</h2>
                        </div>
                        <div  style="direction:rtl; margin-bottom: 15px;">
                        
                        <button type="button" name="add" id="add_data" class="btn btn-success btn-md">
                       
                        Add Product
                        <i class="fa fa-plus fa-x"></i>
                        </button>
                        <div style="margin-top: 15px;" id="UpdateMSGAlter" class=" text-center"></div>
                        </div>
                        <div class="table-responsive">
                            <table id="student_table" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th> Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th> Image</th>
                                            <th>Media</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                        </div>
                    </div>
                    <!-- END Datatables Content -->
                </div>
                <!-- END Page Content -->

                <!-- Footer -->
                <footer class="clearfix">
                  @include('admin.include.footer')
                </footer>
                <!-- END Footer -->
            </div>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
        <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

            <!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
            @include('admin.include.usersetting')
            <!-- END User Settings -->

            <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
                @include('admin.include.appjs')

        <!-- Load and execute javascript code used only in this page -->
        <script src="{{asset('admin/js/pages/tablesDatatables.js')}}"></script>
        <script>$(function(){ TablesDatatables.init(); });</script>

      <div id="studentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="student_form"  enctype="multipart/form-data">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Add Product</h4>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <span id="form_output"></span>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="Name" class="form-control" />

                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="Desc" class="form-control textarea-editor"></textarea> 
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" id="Price" class="form-control" />

                    </div>
            
            <div class="form-group">
                        <label>Image </label>
                        <input type="file" name="imagee" id="imagee" class="form-control" />
                        <img src=""  height="42" width="42" id="Image" style="display: none;">

                    </div>  

                </div>
                <div class="modal-footer">
                    <!-- input Hidden to Select ID Student -->
                    <input type="hidden" name="student_id" id="student_id" value="" />

                    <input type="hidden" name="button_action" id="button_action" value="insert" />
                    <input type="submit" name="submit" id="action" value="Add" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- delete from confirm -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
            
                <div class="modal-body">
                   Are You Sure Deleted?
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok delete" >Delete</a>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
$(document).ready(function() {
     $('#student_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('services.getdata') }}",
        "columns":[
            { "data": "name" },
            { "data": "description" },
            { "data": "price" },
            { "data": "image" ,
             "render": function (data) {
                                         return '<img src="' + data + '" width="50px"  height="50px" />';
                                       }  
            },
            { "data": "medias" ,
            "render": function (data) {
                                         return '<a href="media/' + data + '" > <i class="fa fa-upload fa-2x text-success" ></i></a>';
                                       } 
            },
            { "data": "action", orderable:false, searchable: false}
        ]
     });

    $('#add_data').click(function(){
        $('#studentModal').modal('show');
        $('#student_form')[0].reset();
        $('#form_output').html('');
        $('#button_action').val('insert');
        $('#action').val('Add');
    });

    $('#student_form').on('submit', function(event){
        
        event.preventDefault();
       // var form_data = $(this).serialize();
       var form_data = new FormData($(this)[0]);
        $.ajax({
            url:"{{ route('services.postdata') }}",
            method:"POST",
            data:form_data,
            dataType:"json",
            processData: false,  // Important!
            contentType: false,
            cache: false,
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
                    
                    if($('#button_action').val()=='update')
                        {

                            $('#studentModal').modal('hide');
                            $('#UpdateMSGAlter').html(data.success);
                            $('#action').val('Add');
                            $('#button_action').val('insert');
                            $('#student_table').DataTable().ajax.reload();
                        }
                    else
                        {
                            $('#form_output').html(data.success);
                            $('#student_form')[0].reset();
                            $('#action').val('Add');
                            $('.modal-title').text('Add Data');
                            $('#button_action').val('insert');
                            $('#student_table').DataTable().ajax.reload();
                        }

                }
            }
        })
    });

    // Edit Data Code By Ajax
     $(document).on('click', '.edit', function(){
        var id = $(this).attr("id");
        $('#form_output').html('');
        $.ajax({
            url:"{{route('services.fetchdata')}}",
            method:'get',
            data:{id:id},
            dataType:'json',
            success:function(data)
            {

             // var vv= JSON.parse(data);
             for (var key in data) {
               if(key.indexOf('Desc') > -1)
               {
                $('#'+key+'').data("wysihtml5").editor.setValue(data[key]);    
               }
               if(key.indexOf('Image')>-1)
               {
                        $('#'+key+'').show(); 
                        $('#imagee').val("");
                        $('#'+key+'').attr("src", +data[key]);
               }
               else
               {
                $('#'+key+'').val(data[key]);
               }
               // all elements without special cases $('#'+key+'').val(data[key]);
               } 
              
              $('#Name').val(data.name);
              $('#Desc').data("wysihtml5").editor.setValue(data.description);
              $('#Price').val(data.price);
              $('#Image').show(); 
              $('#imagee').val("");
              $('#Image').attr("src", data.image);
              $('#student_id').val(id); // input hidden
              $('#studentModal').modal('show');
              $('#action').val('Edit');
              $('.modal-title').text('Edit Data');
              $('#button_action').val('update');
               
            }
        })
    });

    //enable edit button when empty or not changed
 
         
        // Delete Data 
        $(document).on('click', '.deleteModal', function(){
               $('#confirm-delete').modal('show');
               $('.delete').attr("id",$(this).attr('id'));
         });

    // Delete Data Code By Ajax 
        $(document).on('click', '.delete', function(){
        var id = $(this).attr('id');
       
            $.ajax({
                url:"{{route('services.removedata')}}",
                mehtod:"get",
                data:{id:id},
                success:function(data)
                {
                    $('#confirm-delete').modal('hide');
                    $('#UpdateMSGAlter').html(data);
                    $('#student_table').DataTable().ajax.reload(); // to remove from table
                }
            })
        
       
    });


 
        
});
</script>
    </body>
</html>