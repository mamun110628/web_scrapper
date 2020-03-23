@extends('master')
@section('page-content')    
<div class="panel panel-transparent">
    <div class="panel-heading">
        <div class="panel-title">
            Collect News
        </div>
    </div>

    <div class="panel-body">
        <div class="row xl-mlr10">
            <form name="categoryForm" action="{{url('get_news')}}" method="post">
                @csrf
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 xl-mb30">
                    <div class="form-group form-group-default form-group-default-select2">
                        <label>Select Newspaper</label>
                        <select class="form-control select2" name="newspaper">
                            <option>--Select Newspaper--</option>
                            @foreach($newspaper as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
<!--                    <div class="form-group form-group-default">
                        <label>News Title</label>
                        <input type="text" class="form-control" name="title" placeholder="News Title" required>
                    </div>-->
                    <div class="form-group form-group-default">
                        <label>News Url</label>
                        <input type="url" class="form-control" name="url" placeholder="https:// website url" required>
                    </div>

                    <div class="form-group form-group-default">
                        <label>Related Tag</label>
                        <input type="text" name="related_keyword" class="form-control tag" data-role="tagsinput" />
                        <span>(,) comma separate</span>
                    </div> 
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <div class="form-inner12">
                        <label for="fname" class="left-col control-label"></label>
                        <div class="right-col mt-org1" style="text-align:right">
                            <button type="submit" class="btn btn-success custom-btn1" name="Submit">Submit</button>
                            <button type="button" class="btn btn-default custom-btn1" name="Clear"><i class="pg-close"></i> Clear</button>
                        </div>
                        <div class="clr"></div>
                    </div>
                </div>
            </div>
                </div>
            </form>
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
       $('input.tag').tagsinput({
});
     }); 
     }); 
</script>
@endsection