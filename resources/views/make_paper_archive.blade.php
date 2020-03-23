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
            h1, h2, h3 {
                font-size: 18px;
            }
</style>
    </head>
    <body>
        <div class="container">
            @foreach($data as $value)
            {!!$value->headline!!}
            <div class="image">
                {!!$value->image_link!!}
            </div>
            @if(isset($value->spechial_news))
            <div class="spechial_news">
                <strong>{!!$value->spechial_news!!}</strong>
            </div>
             <div class="spechial_news">
                <p>{!!$value->news_description!!}</p>
            </div>
            @endif
            @endforeach
        </div>
    </body>
</html>

