

@extends('master')
@section('page-content')
           <div class="panel panel-transparent">
    <div class="panel-heading">
        <div class="panel-title">
            Newspaper
        </div>

        <div class="pull-right m-t-15">
            <div id="show-modal" class="btn btn-success custom-btn2">
                <i class="fa fa-plus pr1"></i>
                <a href="{{route('newspaper.create')}}">Add New</a>

            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="panel-body">
       
        <table class="table table-striped data-table">
            <thead>
            <tr>
                <th>Newspaper Name</th>
                <th>Newspaper Url</th>
                <th>Status</th>
                <th width="10%" style="text-align: center">Action</th>
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
        
        $('.data-table').DataTable({
             order: [],
            processing: true,
            serverSide: true,
            ajax: '{{url('newspaperlist')}}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'url', name: 'url' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' },
            ]
           
        });
        
        $(document).on('click','.approval',function() {
               var request_id = $(this).attr('data-id');
               var request_response = $(this).attr('data-bind');
              var url = '{{url('newspaper_status')}}';
                change_status(url,request_response,request_id)
               
            });
        
     }); 
     }); 
</script>
@endsection
 