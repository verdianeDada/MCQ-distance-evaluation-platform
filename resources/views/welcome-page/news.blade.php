<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="color bold center">Latest departmental news</h1>
    </div>
    <div class="panel-body">
       @foreach($news as $news)
        <div class="row" style="padding-top: 15px">
            <div class="col-lg-1">
                    <i class="fa fa-crosshairs bold color"></i>
            </div>
            <div class=" col-lg-11 padding-0">
                <div class="news-title">
                    <span class="bold capitalize">{{$news->title}}</span>
                </div>
                <div class="news-text">
                    <span>{{$news->text}}</span>    
                </div> 
            </div>
        </div>
        @endforeach
    </div>
</div>
