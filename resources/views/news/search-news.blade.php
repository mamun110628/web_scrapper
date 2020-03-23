@extends('master')
@section('page-content')    
<div class="panel panel-transparent">
    <div class="panel-heading">
        <div class="panel-title">
            Search News
        </div>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 col-md-offset-3">
            <form action="" class="search-form">
                <div class="form-group has-feedback">
            		<label for="search" class="sr-only">Search</label>
            		<input type="text" class="form-control" name="search" id="search_tag" placeholder="search">
              		<span class="glyphicon glyphicon-search form-control-feedback"></span>
            	</div>
            </form>
        </div>
        </div>
         <div class="panel-body">
       
             <table class="table table-striped data-table" style="display: none;">
            <thead>
            <tr>
                
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
          $('.data-table').show();
        $('.data-table').DataTable({
             order: [],
             bDestroy: true,
            processing: true,
            serverSide: true,
            ajax: '{{url('newsSerchList')}}?id='+ui.item.id,
            columns: [
                
                { data: 'newspaper_name', name: 'newspaper_name' },
                { data: 'headline', name: 'headline' },
                { data: 'news_date', name: 'news_date' },
                { data: 'pdf_file', name: 'pdf_file' },
            ]
           
        });
      }
    } );
      
     }); 
     }); 
</script>
@endsection
