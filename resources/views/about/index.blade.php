
@extends('layouts.app')
@section('stylesheet')
<link href="{{url('assets/css/select-project.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/css/confirm.css')}}" rel="stylesheet" type="text/css" />
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
</style>
<div class="container" >
    <div class="row">
        <div class="col-md-12 " >
          <h3>เกี่ยวกับเรา ครูพี่โฮม</h3>
          <h4 class="text-green">ผู้ก่อตั้งสถาบันสอนถาษาญี่ปุ่น "เสาหลักแห่งศิลป์ญี่ปุ่น"</h4>
          <hr>
          <div class="body-project">

                    <div class="row">

                      <div class="col-md-6">
                        <img src="{{url('assets/image/IMG_2647-1-2.png')}}" class="img-responsive">
                      </div>

                      <div class="col-md-6">
                        <h3>พรหมเทพ ชัยกิตติวณิชย์ <span>(ครูพี่โฮม ZA-SHI)</span></h3>
                        <p style="margin: 0 0 20px;">สถาบันติว PAT ญี่ปุ่นและภาษาญี่ปุ่น ZA-SHI ภาษาญี่ปุ่น (ครูพี่โฮม) คนแรกและคนเดียวที่ได้ PAT ญี่ปุ่น 300 คะแนนเต็ม เกียรตินิยมอันดับ 1 (เหรียญทอง) อักษรศาสตร์ จุฬาฯ</p>

                        <ul class="list_order">
                        <li><span>1</span>อักษรศาสตร์บัณฑิต จุฬาลงกรณ์มหาวิทยาลัย เกียรตินิยมอันดับ 1 (เหรียญทอง) เอกภาษาญี่ปุ่น</li>
                        <li><span>2</span>Purchase tickets and options</li>
                        <li><span>3</span>Pick them directly from your office</li>
                        </ul>
                      </div>

                    </div>



          </div>
        <!--    <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.
                </div>
            </div> -->



        </div>
    </div>
</div>
@endsection
