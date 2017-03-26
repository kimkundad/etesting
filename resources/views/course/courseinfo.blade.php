
@extends('layouts.app')
@section('stylesheet')
<link href="{{url('assets/css/select-project.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/css/confirm.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.row {
    margin-left: initial;
    margin-right: initial;
}
.btn-fb {
    border: 1px solid #3b5998;
    color: white;
    background-color: #5A73AA;
    border-radius: 2px;
    float: left;
}
.btn-mini.border-btn {
    padding: 2px 12px;
    font-size: 13px;
}
.btn-wishlist {
    padding: 2px 7px !important;
    font-size: 14px;
    padding: 5px;
    -moz-transition: 0.8s;
    -webkit-transition: 0.8s;
    -o-transition: 0.8s;
    transition: 0.8s;
    opacity: 0.85;
    margin-top: 15px;
    margin-left: 4px;
    font-size: 12px

}
.head-lines {
    position: absolute;
    /* bottom: 0; */
    /* left: 0; */
    display: block;
    width: 50px;
    height: 3px;
    background-color: #00c402;
    margin: 0;
}
hr {
    margin-top: 10px;
    margin-bottom: 10px;
    }

    @media screen and (max-width: 500px) /* Mobile */ {
  .extra-paddingright {
    padding-right: 0px;
    padding-left: 0px;
}
.course-overall {
    border: none;
}
.wigt-content{
  margin-top: 20px;
  padding-right: 0px;
    padding-left: 0px;
}

}


</style>

@stop('stylesheet')
@section('content')

<?php
function DateThaif($strDate)
{
$strYear = date("Y",strtotime($strDate))+543;
$strMonth= date("n",strtotime($strDate));
$strDay= date("j",strtotime($strDate));
$strHour= date("H",strtotime($strDate));
$strMinute= date("i",strtotime($strDate));
$strSeconds= date("s",strtotime($strDate));
$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
$strMonthThai=$strMonthCut[$strMonth];
return "$strDay $strMonthThai";
}
 ?>
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

<div class="content-section-a">
<div class="container" >


    <div class="row">
        <div class="col-md-12 " >

          <div class="col-xs-12  col-md-4 extra-paddingright">
            <img src="{{url('assets/uploads/'.$objs->image_course)}}" class="img-responsive">

            <div class="course-teacher">
              <strong>รายละเอียดคอร์ส</strong>
              <br>
              <table class="table table-striped table-responsive">
                <tr>
                  <td>ช่วงเวลาที่เรียน</td>
                  <td class="text-right"><?php echo DateThaif($objs->start_course); ?> - <?php echo DateThai($objs->end_course); ?></td>
                </tr>
                <tr>
                  <td>วันที่เรียน</td>
                  <td class="text-right">{{$objs->day_course}}</td>
                </tr>
                <tr>
                  <td>เวลาที่เรียน</td>
                  <td class="text-right">{{$objs->time_course}}</td>
                </tr>
                <tr>
                  <td><i class="fa fa-cloud-download"></i> เอกสารการเรียน</td>
                  <td class="text-right"> มีให้ดาวน์โหลด</td>
                </tr>
                <tr>
                  <td><i class="fa fa-video-camera"></i> วีดีโอย้อนหลัง</td>
                  <td class="text-right"> มีให้</td>
                </tr>
              </table>

            </div>

            <div class="course-teacher">
              <strong>เกี่ยวกับผู้สอน</strong>
              <br>
              <div class="teachet-info">
                <img src="{{url('assets/image/15965494_10206213152167039_5353071833653529827_n.jpg')}}" class="img-circle">
                  <div class="teacher-name">
                    ครูพี่โฮม ภาษาญี่ปุ่น<br>
                    <span>ติว PAT ญี่ปุ่น อันดับ 1 ของไทย</span>
                  </div>
              </div>
            </div>

          </div>

          <div class="col-xs-12  col-md-8 wigt-content">
            <div class="row course-overall-wrapper">
              <div class="col-md-12">

              <div class="col-md-8 course-overall">
                  <h4><b>{{$objs->title_course}}<span class="head-lines"></span></b></h4>
                  <p>{{$objs->detail_course}}</p>
              </div>

              <div class="col-md-4 course-exit">
                @if (Auth::guest())
                <a type="button" href="{{url('confirm_course/'.$objs->id)}}" class="btn btn-success1 btn-lg btn-block"
                style="padding: 6px 18px;">จองคอร์สเรียน</a>
                @else
                <div class="hidden">{{$i = 1}}</div>
                      @foreach($courseinfos as $courseinfo)



                      @if ($courseinfo->Uid == Auth::user()->id && $courseinfo->status == 2)
                      <a type="button" class="btn btn-success1 btn-lg btn-block"
                      style="padding: 6px 18px;">สมัครคอร์สนี้แล้ว</a>
                      @elseif($courseinfo->Uid == Auth::user()->id && $courseinfo->status == 1)
                      <a type="button" class="btn btn-warning btn-lg btn-block"
                      style="padding: 6px 18px;">รอตรวจสอบ</a>
                      @elseif($courseinfo->Uid == Auth::user()->id && $courseinfo->status == 0)
                      <a type="button" href="{{url('confirm_course/'.$objs->id)}}" class="btn btn-success1 btn-lg btn-block"
                      style="padding: 6px 18px;">จองคอร์สเรียน</a>
                      @elseif($courseinfo->Uid != Auth::user()->id && $courseinfo->course_id == $objs->id && $i == 1)
                      <div class="hidden">{{$i++}}</div>
                      <a type="button" href="{{url('confirm_course/'.$objs->id)}}" class="btn btn-success1 btn-lg btn-block"
                      style="padding: 6px 18px;">จองคอร์สเรียน</a>
                      @else
                      @endif



                      @endforeach

                @endif

                <button class="btn-mini border-btn btn-fb" style="display:inline-block; text-transform:none; margin-top: 15px;">
                    <i class="fa fa-facebook"></i> แบ่งปันคอร์สนี้                </button>

                <a class="btn btn-wishlist btn-notwished btn-info btn-mini url-redirection" style="display:inline-block;  text-transform:none; " >
                  <i class="fa fa-star-o"></i> เก็บไว้นะ
                </a>
                <hr>
                <span class="readingPrice">
                                ฿ {{$objs->price_course}} บาท (ลดราคา 50%)
                                  </span>
                <hr>
                <strong>จำนวนผู้จองคอร์สเรียน</strong>
                <h4 style="color:red"><i class="fa fa-user"></i> 23</h4>
              </div>



                </div>



            </div>

            <div class="row course-overall-wrapper" style="margin-top:20px;">
            <div class="col-md-12">
              <br>
                  <h5 style="font-size: 17px;"><b>  เนื้อหาคอร์ส <span class="head-lines"></span></b></h5>
                  <br>

                  <div class="table-scrollable table-scrollable-borderless">
                                         <table class="table table-hover table-light">
                                          <thead class="uppercase">
                                              <tr>
                                                  <th>รายละเอียดเนื้อหา</th>
                                                  <th>ลำดับ</th>
                                              </tr>
                                          </thead>

                                          <tbody>
                                            <?php

                                   $urlpath = 'assets/excel/'.$objs->url_course;

                                 //  $urlpath = file_get_contents($urlpath);
                            // header('Content-Type: text/html; charset=utf-8');
                              $urlpath =  utf8_encode($urlpath);
                            $urlpath = iconv("TIS-620", "utf-8", $urlpath);

                           //$urlpath = trim($urlpath);
                              $f = fopen($urlpath, "r");
                              while (($line = fgetcsv($f)) !== false) {
                                      echo "<tr>";

                                      foreach ($line as $cell) {
                                              echo "<td>" . htmlspecialchars($cell) . "</td>";
                                      }
                                      echo "</tr>\n";
                              }
                              fclose($f);
                                  ?>
                                          </tbody>
                                          </table>
                                        </div>

            </div>
              </div>




              <div id="kimkundad" >
              <div id="ap-comment-area">

                            <div class="ap-comments comment-container have-comments" style="margin-left:0px; margin-right:0px;">
                              <ul class="ap-commentlist clearfix">


                                <li id="comment-1" class="kimkundad byuser comment-author-tarrence even thread-even depth-1 clearfix">
                                  <!-- comment #10426 -->
                                  <div class="clearfix">
                                    <div class="ap-avatar ap-pull-left">
                                      <a href="user_profile-2.html" title="">
                                      <!-- TODO: OPTION - Avatar size -->
                                      <img style="max-height:50px;" class="img-responsive avatar avatar-30 photo ap-dynamic-avatar"
                                      src="{{url('assets/images/avatar/1483537975.png')}}"></a>
                                    </div><!-- close .ap-avatar -->
                                    <div class="ap-comment-content no-overflow">
                                      <div class="ap-comment-header">
                                        <a href="user_profile-2.html" class="ap-comment-author"> Shuvit Funsok</a>

                                         - <a href="user_profile-2.html" class="ap-comment-time"><time>November 15, 2016</time></a>



                                       </div><!-- close .ap-comment-header -->
                                      <div class="ap-comment-texts">
                                        <p>อธิบายเข้าใจง่ายครับ ขอบคุณมากครับ++</p>
                                      </div>
                                                </div><!-- close .ap-comment-content -->
                                  </div><!-- close #comment-* -->
                                </li>








                                <li id="comment-1" class="kimkundad byuser comment-author-tarrence even thread-even depth-1 clearfix">
                                  <!-- comment #10426 -->
                                  <div class="clearfix">
                                    <div class="ap-avatar ap-pull-left">
                                      <a href="user_profile-2.html" title="">
                                      <!-- TODO: OPTION - Avatar size -->
                                      <img style="max-height:50px;" class="img-responsive avatar avatar-30 photo ap-dynamic-avatar"
                                      src="{{url('assets/images/avatar/1484149648.jpeg')}}"></a>
                                    </div><!-- close .ap-avatar -->
                                    <div class="ap-comment-content no-overflow">
                                      <div class="ap-comment-header">
                                        <a href="user_profile-2.html" class="ap-comment-author"> Shuvit Funsok</a>

                                         - <a href="user_profile-2.html" class="ap-comment-time"><time>November 15, 2016</time></a>



                                       </div><!-- close .ap-comment-header -->
                                      <div class="ap-comment-texts">
                                        <p>คอร์สดีแบบนี้เอาไป 5 ดาวเลย</p>
                                      </div>
                                                </div><!-- close .ap-comment-content -->
                                  </div><!-- close #comment-* -->
                                </li>




                                <li id="comment-1" class="kimkundad byuser comment-author-tarrence even thread-even depth-1 clearfix">
                                  <!-- comment #10426 -->
                                  <div class="clearfix">
                                    <div class="ap-avatar ap-pull-left">
                                      <a href="user_profile-2.html" title="">
                                      <!-- TODO: OPTION - Avatar size -->
                                      <img style="max-height:50px;" class="img-responsive avatar avatar-30 photo ap-dynamic-avatar"
                                       src="{{url('assets/images/avatar/1484042563.png')}}"></a>
                                    </div><!-- close .ap-avatar -->
                                    <div class="ap-comment-content no-overflow">
                                      <div class="ap-comment-header">
                                        <a href="user_profile-2.html" class="ap-comment-author"> Shuvit Funsok</a>

                                         - <a href="user_profile-2.html" class="ap-comment-time"><time>November 15, 2016</time></a>



                                       </div><!-- close .ap-comment-header -->
                                      <div class="ap-comment-texts">
                                        <p>อธิบายเข้าใจง่ายครับ ขอบคุณมากครับ++</p>
                                      </div>
                                                </div><!-- close .ap-comment-content -->
                                  </div><!-- close #comment-* -->
                                </li>








                                <li id="comment-1" class="kimkundad byuser comment-author-tarrence even thread-even depth-1 clearfix">
                                  <!-- comment #10426 -->
                                  <div class="clearfix">
                                    <div class="ap-avatar ap-pull-left">
                                      <a href="user_profile-2.html" title="">
                                      <!-- TODO: OPTION - Avatar size -->
                                      <img style="max-height:50px;" class="img-responsive avatar avatar-30 photo ap-dynamic-avatar"
                                       src="{{url('assets/images/avatar/1483537975.png')}}"></a>
                                    </div><!-- close .ap-avatar -->
                                    <div class="ap-comment-content no-overflow">
                                      <div class="ap-comment-header">
                                        <a href="user_profile-2.html" class="ap-comment-author"> Shuvit Funsok</a>

                                         - <a href="user_profile-2.html" class="ap-comment-time"><time>November 15, 2016</time></a>



                                       </div><!-- close .ap-comment-header -->
                                      <div class="ap-comment-texts">
                                        <p>คอร์สดีแบบนี้เอาไป 5 ดาวเลย</p>
                                      </div>
                                                </div><!-- close .ap-comment-content -->
                                  </div><!-- close #comment-* -->
                                </li>








                              </ul>
                            </div>

                          </div>
                          </div>




          </div>





        </div>
    </div>



</div>
</div>
@endsection


@section('scripts')
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" type="text/javascript"></script>



@stop('scripts')
