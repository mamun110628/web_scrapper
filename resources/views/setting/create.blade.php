
@extends('master')
@section('page-content')
           <div class="panel panel-transparent">
    <div class="panel-heading">
        <div class="panel-title">
            Create Newspaper
        </div>
    </div>

    <div class="panel-body">
        <div class="row xl-mlr10">
            <form id="form-personal" action="{{route('newspaper.store')}}" method="post" enctype="multipart/form-data">
                 @csrf
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 xl-mb30">
                    <input type="text" class="form-control hidden" readonly />

                    <div class="form-group form-group-default">
                        <label>Newspaper Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Paper Name" required>
                           
                    </div>
                    <div class="form-group form-group-default">
                        <label>Newspaper Url</label>
                        <input type="url" class="form-control" name="url" placeholder="https:// website url" required>
                    </div>
                    <div class="form-group form-group-default">
                        <label>Newspaper Logo</label>
                        <input type="file" class="form-control" name="logo" style="margin-top: 5px;">
                    </div>
                    <div class="form-group form-group-default">
                        <label>Newspaper Scrapper Dom Element</label>
                        <input type="text" class="form-control" name="dom_element" style="margin-top: 5px;">
                    </div>
                    <div class="form-group form-group-default">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="">Select Status</option>
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>

                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <div class="form-inner12">
                        <label for="fname" class="left-col control-label"></label>
                        <div class="right-col mt-org1" style="text-align:right">
                            <button type="submit" class="btn btn-success custom-btn1" name="Submit">Submit</button>
                            <button type="button" class="btn btn-default custom-btn1" name="Clear" onclick="clearData()"><i class="pg-close"></i> Clear</button>
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
@endsection
 


