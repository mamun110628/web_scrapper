<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        
        <title>News Scrap</title>
        <style> 
  

</style>
    </head>
    <body>
        <div class="container">
            <?php
             $i= 0;
             $h = 0;
          if(isset($data) or !empty($data)){
            foreach ($data as $key => $datam) {
                
                foreach ($datam as $value) {
                   
                    if(isset($value['image'])){
                        ?>
            <div class="image">
                {!!$value['image']!!}
            </div>
            
                        <?php
                    }elseif (isset($value['headline'])) {
                        if($h==0){
                               ?>
            <div class="headline">
                {!!$value['headline']!!}
            </div>
            
                        <?php     
                        $h++;
                        }
                                }elseif (isset($value['headline1'])) {
                        
                               ?>
            <div class="headline">
                {!!$value['headline1']!!}
            </div>
            
                        <?php     
                        
                                }else{
                        ?>
            <p>{{strip_tags($value['text'])}}</p>
            <?php
                 
                    }
                     $i++;
                }
          }
          ?>
            <h5>Collected from <strong>{{$paper_name}}</strong></h5>
            <?php
            }else{
                echo '<h1>No Data Found</h1>';
            }
            if($i == 0){
                 echo '<h1>No Data Found</h1>';
            }
            ?>
        </div>
    </body>
</html>
