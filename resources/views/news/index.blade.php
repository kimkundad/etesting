
@extends('layouts.app')
@section('stylesheet')
<link href="{{url('assets/css/select-project.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/css/confirm.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/bootstrap-sweetalert-master/dist/sweetalert.css')}}" rel="stylesheet" type="text/css" />
@stop('stylesheet')
@section('content')

<style>
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
    list-style: inside;
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
          <div class="col-md-9" >


<div class="block-box-1 block-recent-1">
        <ul>


        @foreach($objs as $u)
        <li>
         <div class="views-row">
            <div class="col-md-4" >
              <div>
                <a href="{{url('news/'.$u->id)}}">
                <img class="img-responsive" src="assets/blog/{{$u->image}}">
              </a>
              </div>
            </div>
            <div class="col-md-8" >
              <div class="block-box-content">
              <a href="{{url('news/'.$u->id)}}">{{$u->title_blog}}</a>
              <span><i class="fa fa-user"></i> by : admin</span>
              <span><i class="fa fa-clock-o"></i> <?php echo DateThai($u->created_at); ?></span>
              <div class="clearfix"></div>
              <p><?=mb_substr(strip_tags($u->detail_blog),0,350,'UTF-8')?> ...
                 <a href="{{url('news/'.$u->id)}}" class="more-link">อ่านเพิ่มเติม</a></p>
              </div>
            </div>
          </div>
        </li>
        @endforeach



      </ul>
    </div>

    {{ $objs->links() }}
          </div>
          <div class="col-md-3" style="    margin-top: 0px;">
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

<script>

  //  swal("ส่งข้อความสำเร็จ!", "ข้อความถูกส่งไปยังครูพี่โฮมเรียบร้อยแล้ว!", "success")

  </script>
@stop('scripts')
