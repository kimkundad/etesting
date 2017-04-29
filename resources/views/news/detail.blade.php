
@extends('layouts.app')
@section('stylesheet')

<!-- Facebook-->
<meta property="fb:app_id"          content="1512869072370249" />
<meta property="og:type"            content="article" />
<meta property="og:url"             content="{{url('news/'.$objs->id)}}" />
<meta property="og:title"           content="{{$objs->title_blog}}" />
<meta property="og:image"           content="{{url('assets/blog/'.$objs->image)}}" />
<meta property="og:description"    content="<?=mb_substr(strip_tags($objs->detail_blog),0,200,'UTF-8')?>" />


<link href="{{url('assets/css/select-project.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/css/confirm.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/bootstrap-sweetalert-master/dist/sweetalert.css')}}" rel="stylesheet" type="text/css" />
@stop('stylesheet')
@section('content')

<style>
body{
      background: #e9e9e9;
}
.text-green{
      color: #038206;
}
h2 span, h3 span, h4 span, h5 span, h6 span {
    color: #038206;
}
ul.list_order {
    margin: 0 0 30px;
    padding: 0;
    line-height: 30px;
    font-size: 14px;
}
ul.list_order li {
    position: relative;
    padding-left: 40px;
    margin-bottom: 10px;
}
ul.list_order li span {
    background-color: #038206;
    color: #fff;
    position: absolute;
    left: 0;
    top: 0;
    text-align: center;
    font-size: 18px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    line-height: 30px;
}
 ul.list_order {
    list-style: none;
}
.conn{

  color: #888;
}
i{
  color: #038206;
}
.text-muted {
    color: #3c763d;
}
.block-box-content {
    overflow: hidden;
    height: 100%;
}
.block-box-content>a:first-child {
    font-size: 15px;
    font-weight: bold;
    display: block;
    margin-bottom: 10px;
    color: #2f3c4e;
}
.block-box-content>a:hover {
    font-size: 15px;
    font-weight: bold;
    display: block;
    margin-bottom: 10px;
    color: #038206;
}
.block-box-content span {

    float: left;
    margin-right: 30px;
    display: inline-block;
    margin-bottom: 8px;
    font-size: 12px;
    text-transform: uppercase;
}
.block-box-content p{
  margin-bottom: 0;
  margin: 0 0 20px 0;
line-height: 22px;
font-size: 13px;
color: #6d7683;
}
ol, ul, li {

        -webkit-padding-start: 0px;
}
.block-recent-1 li {
    float: left;
    width: 100%;
}
.block-box-1 li {
    list-style: none;
    float: right;

    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #ecedee;
    clear: right;
}
@media only screen and (min-width: 768px)
{
   .newss{
      padding-right: 5px;
      padding-left: 15px;
  }

}
hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #ce781f;
}
.s-det {
    font-size: 12px;
    border: 1px solid #D1D1D1;
    padding: 2px 4px;
    margin-right: 5px;
    border-radius: 5px;
    color:#000;
        background: #FFECBA;
}
.box-detail{
  background: #ffffff;
    border: 1px solid #ce781f;
    margin-bottom: 10px;

        padding: 0px;
        border-radius: 5px;
}
.content-title-box {
  background-color: #FED943;
    color: #993100;
    position: relative;
    padding: 5px 15px;
    font-weight: bold;

    margin: 0px;
    margin-bottom: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}
.node-content{
  margin-top: 15px;
  margin-left: 10px;
margin-right: 10px;
margin-bottom: 10px;
}
.sticky-badge {
    position: absolute;
    background: url('{{url('assets/image/border-featured.png')}}') no-repeat;
    top: -3px;
    right: -3px;
    width: 64px;
    height: 64px;
}
.fb_iframe_widget {
    margin-right: 5px;
    float: left;
    margin-top: 2px;
    display: block;
    /* position: relative; */
}
</style>

<?php
function DateThai($strDate)
{
$strYear = date("Y",strtotime($strDate))+543;
$strMonth= date("n",strtotime($strDate));
$strDay= date("j",strtotime($strDate));
$strHour= date("H",strtotime($strDate));
$strMinute= date("i",strtotime($strDate));
$strSeconds= date("s",strtotime($strDate));
$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
$strMonthThai=$strMonthCut[$strMonth];
return "$strDay $strMonthThai $strYear";
}
 ?>

<div class="container" >
    <div class="row">




        <div class="col-md-12" >

          <h3>ข่าวสารทาง ครูพี่โฮม</h3>
          <hr>

          <div class="row">
          <div class="col-md-8 newss" style="">

            <div class="box-detail">
              <div class="content-title-box">
              <h4 style="margin-bottom: 5px; margin-top: 5px; background-color: #FED943; color: #993100;">{{$objs->title_blog}}</h4>
              <div class="sticky-badge"></div>
            </div>

              <div class="node-content">

                <span class="s-det"><i class="fa fa-user"></i> by : admin</span>
                <span class="s-det"><i class="fa fa-clock-o"></i> <?php echo DateThai($objs->created_at); ?></span>
                <span class="s-det"><i class="fa fa-child"></i> view : {{$objs->view}}</span>
                <br><br><img class="img-responsive" src="{{url('assets/blog/'.$objs->image)}}">
                <br>
                {!! $objs->detail_blog !!}
                <br>

                <div class="fb-like" data-href="{{url('news/'.$objs->id)}}" style=" margin-bottom:-10px;" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                <!-- วางแท็กนี้ในตำแหน่งที่คุณต้องการให้ ปุ่ม +1 ปรากฏ -->
                <div class="g-plusone" data-annotation="inline" data-width="300" ></div>

                <div style="float:left; margin-right: 10px;" class="line-it"><a href="#"><img src="{{url('assets/image/linebutton.png')}}" width="76px" height="20px" alt="LINE it!"></a></div>
                <br>
              </div>


            </div>


          </div>

          <style>
          .widget {
              background-color: #FFF;
              border-bottom: 1px solid #d3d5d7;
              -webkit-box-shadow: 0 0 5px 0 #e2e3e4;
              -moz-box-shadow: 0 0 5px 0 #e2e3e4;
              box-shadow: 0 0 5px 0 #e2e3e4;
              position: relative;
              margin-bottom: 30px;
              padding: 15px 12px 12px;
          }
          .widget-title {
              padding-bottom: 0px;
                  color: #2f3c4e;
          }
          .widget-title {
              font-size: 16px;
              font-weight: bold;
              padding-bottom: 10px;
              border-bottom: 2px solid #ecedee;
              margin-bottom: 20px;
              line-height: 28px;
              position: relative;
          }
          .tabs li {
    float: left;
    margin: 0 20px 10px 0;
    padding-bottom: 0;
    border-bottom: 0;
}
.widget li {
    display: block;
    list-style: none;
    color: #4b525c;
    border-bottom: 1px solid #ecedee;
    padding-bottom: 10px;
    margin-bottom: 10px;
    overflow: hidden;
    width: 100%;
}
.tabs li a {
    display: block;
    color: #fff;
    text-decoration: none;
    background-color: #0b58b1;
    padding: 0 10px;
    font-size: 14px;
}
.widget-posts-img, .widget-comments-img {
    float: left;
    position: relative;
    margin-right: 10px;
    overflow: hidden;
    text-align: center;
    height: 60px;
    width: 60px;
}
.widget-posts-content, .widget-comments-content {
    overflow: hidden;
    height: 100%;
}
.widget .widget-posts-content>a {
    line-height: 0.5em;
    color: #2f3c4e;
    text-decoration: none;
}
.widget .widget-posts-content>a:hover {
    line-height: 0.5em;
    color: #337ab7;
    text-decoration: none;
}
.widget-posts-content span {
    display: block;
    margin-bottom: 1px;
    font-size: 12px;
    text-transform: uppercase;
    color: #9ba1a8;
}
          </style>
          <div class="col-md-4" style="    margin-top: 0px;">

            <div class="widget">
              <div class="widget-title">
                <ul class="tabs" style="margin-bottom: 0px;">
                  <li class="tab"><a href="#" class="current">Popular</a></li>
                  </ul>
                </div>


                <div class="widget-posts">
                  <ul>

                    @if(isset($popu))

                    @foreach($popu as $order)
                    <li class="">
                    <div class="widget-posts-img">
                    <a href="#">

                    <img alt="{{$order->title_blog}}" src="{{url('assets/blog/'.$order->image)}}" class="img-responsive" style="height:65px; width:65px; overflow: hidden;">
                    </a>
                    </div>
                    <div class="widget-posts-content">
                    <a href="#">{{$order->title_blog}}</a>
                    <span><i class="fa fa-user"></i> BY : admin</span>
                    <span><i class="fa fa-clock-o"></i> <?php echo DateThai($order->created_at); ?></span>
                    </div>
                    </li>
                    @endforeach
                    @endif

                    </ul>
                    </div>
            </div>





            <div>
              <img class="img-responsive" src="http://localhost/enihongo/public/assets/image/14610482951461048307l.jpg">
            </div>
          </div>
          </div>

        </div>


    </div>
</div>
@endsection

@section('scripts')
<script src="{{url('assets/bootstrap-sweetalert-master/dist/sweetalert.js')}}"></script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.9&appId=206036876527614";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- วางแท็กนี้ในส่วนหัวหรือก่อนแท็กปิดของเนื้อความ -->
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'th'}
</script>

@stop('scripts')
