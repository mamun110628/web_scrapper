@extends('master')
@section('page-content')
    <div class="panel panel-transparent">
    <div class="panel-heading">
        <div class="panel-title">
            Newspaper
        </div>
        <div class="pull-right m-t-15">
            <div class="col-md-6">
                <div id="show-modal" class="btn btn-success custom-btn2">
                    <i class="fa fa-plus pr1"></i>
                    <a href="{{url('collect_news')}}">Collect News</a>

                </div>
            </div>
            <div class="col-md-6">
                <div class="btn btn-success custom-btn2">
                    <i class="fa fa-plus pr1"></i>
                    <a href="javascript:void(0);" class="make_pdf">Make Pdf</a>

                </div>
            </div>


        </div>
        <div class="clearfix"></div>
    </div>

    <div class="panel-body">
        <div class="col-md-4 col-md-offset-3">
            <div class="form-group has-feedback">
            		<label for="search" class="sr-only">Search</label>
            		<input type="text" class="form-control" name="search" id="search_tag" placeholder="search">
              		<span class="glyphicon glyphicon-search form-control-feedback"></span>
                        
            	</div>
        </div>
         <div class="col-md-2">
             <a id ="clear_datatable" class="clear btn btn-primary" href="javascript:void(0);">Clear</a>
         </div>
       
        <table class="table table-striped data-table">
            <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"/></th>
                <th>Newspaper Name</th>
                <th>News Title</th>
               <th>News Date</th>
               <th width="10%" style="text-align: center">Details</th>
            </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>


    </div>
</div>
<script>
    dev_js.push(function () {
    $(document).ready(function() {
        <?php
        if ($message = Session::get('success')){
            ?>
         randomToast('success','Success','<?=$message?>');
         <?php
        }
        ?>
        $('#clear_datatable').on('click',function(){
            $('#search_tag').val('');
           $('.data-table').DataTable({
             order: [],
              bDestroy: true,
            processing: true,
            serverSide: true,
            ajax: '{{url('newsAjaxList')}}',
            columns: [
                { data: 'checkbox', name: 'checkbox', orderable: false},
                { data: 'newspaper_name', name: 'newspaper_name' },
                { data: 'headline', name: 'headline' },
                { data: 'news_date', name: 'news_date' },
                { data: 'pdf_file', name: 'pdf_file' },
            ]
           
        }); 
        });
        $('.data-table').DataTable({
             order: [],
              bDestroy: true,
            processing: true,
            serverSide: true,
            ajax: '{{url('newsAjaxList')}}',
            columns: [
                { data: 'checkbox', name: 'checkbox', orderable: false},
                { data: 'newspaper_name', name: 'newspaper_name' },
                { data: 'headline', name: 'headline' },
                { data: 'news_date', name: 'news_date' },
                { data: 'pdf_file', name: 'pdf_file' },
            ]
           
        });
        
        $( "#search_tag" ).autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "{{url('search_tag')}}",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function( data ) {
            response( data );
          }
        } );
      },
      minLength: 2,
      select: function( event, ui ) {
          
         $('.data-table').DataTable({
             order: [],
              bDestroy: true,
            processing: true,
            serverSide: true,
            ajax: '{{url('newsAjaxList')}}?id='+ui.item.id,
            columns: [
                { data: 'checkbox', name: 'checkbox', orderable: false},
                { data: 'newspaper_name', name: 'newspaper_name' },
                { data: 'headline', name: 'headline' },
                { data: 'news_date', name: 'news_date' },
                { data: 'pdf_file', name: 'pdf_file' },
            ]
           
        });
      }
    } );
        
        $(document).on('click','.approval',function() {
               var request_id = $(this).attr('data-id');
               var request_response = $(this).attr('data-bind');
              var url = '{{url('newspaper_status')}}';
                change_status(url,request_response,request_id)
               
            });
            
            $("#checkAll").change(function () {
                $("input:checkbox").prop('checked', $(this).prop("checked"));
            });

         $('.make_pdf').click(function GetID() {
             
            var checkedVals = $('.check_id:checkbox:checked').map(function() {
                return this.value;
            }).get();
            var check_all = checkedVals.join("_");
 
            var url = '{{url('make_pdf')}}';
            $.post(url,
            {
                check_all: check_all,
                '_token': "{{ csrf_token() }}"
            },
            function (data) {
                var json_data = JSON.parse(data);
                if(json_data.status == 200){
                    
                    var url_data = '{{url('storage')}}' + '/' + json_data.download_url;
                   window.open(url_data,'_blank');
                }
            });
        })
     }); 
     }); 
</script>
@endsection
 
