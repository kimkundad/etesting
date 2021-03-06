@extends('admin.layouts.template')

@section('admin.stylesheet')
<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
@stop('admin.stylesheet')
<style>
.form-group {
    margin-bottom: 10px;
}
</style>
@section('admin.content')



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


				<section role="main" class="content-body">

					<header class="page-header">
						<h2>{{$datahead}}</h2>

						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.html">
										<i class="fa fa-home"></i>
									</a>
								</li>

								<li><span>{{$datahead}}</span></li>
							</ol>

							<a class="sidebar-right-toggle" data-open="sidebar-right" ><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>


					<!-- start: page -->




							<div class="row">
							<div class="col-md-2 col-lg-2">
							</div>







              <div class="col-md-8 col-lg-8">

							<div class="tabs">

								<div class="tab-content">

									<div id="edit" class="tab-pane active">




											<h4 class="mb-xlg">{{$courseinfo->title_course}}</h4>

											<div class="table-responsive">
                      <table class="table table-striped" style="font-size: 14px;">
                        <tr>
                          <td>นักเรียน</td>
                          <td>{{$courseinfo->name}}</td>
                        </tr>
                        <tr>
                          <td>สถานะ</td>
                          <td>@if($courseinfo->status == 1)
                                <b class="text-danger">ยังไม่อนุมัต</b>ิ
                              @else
                              <b class="text-success">อนุมัติแล้ว</b>
                              @endif
                          </td>
                        </tr>
                        <tr>
                          <td>ยอดเงินที่โอน</td>
                          <td>{{$courseinfo->money_tran}}</td>
                        </tr>
                        <tr>
                          <td>โอนมายังธนาคาร</td>
                          <td>{{$courseinfo->bank_name}}</td>
                        </tr>
                        <tr>
                          <td>โอนมาวันที่</td>
                          <td>{{$courseinfo->date_tran}} {{$courseinfo->time_tran}}</td>
                        </tr>
                        <tr>
                          <td>ราคาคอร์ส</td>
                          <td>{{$courseinfo->price_course}}</td>
                        </tr>
                        <tr>
                          <td>ช่วงเวลา</td>
                          <td>{{$courseinfo->time_course}}</td>
                        </tr>
                        <tr>
                          <td>วันที่สอน</td>
                          <td>{{$courseinfo->day_course}}</td>
                        </tr>
                        <tr>
                          <td>ช่วงเวลาที่เรียน</td>
                          <td><?php echo DateThaif($courseinfo->start_course); ?> - <?php echo DateThai($courseinfo->end_course); ?></td>
                        </tr>

                      </table>
                      </div>

                      <br><br>






                      <form id="newsForm" class="form-horizontal" action="{{$url}}" method="post" enctype="multipart/form-data">
                            {{ method_field($method) }}
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control" name="id"  value="{{$courseinfo->Oid}}" >

                            <div class="form-group">
                              <label class="col-md-3 control-label" for="profileFirstName">จำนวนชั่วโมง*</label>
                                  <div class="col-md-8">
                                      <input type="text" class="form-control" name="hrcourse" value="{{$courseinfo->hrcourse}}" placeholder="1500">
                                </div>
                            </div>

                            <div class="form-group">
    													<label class="col-md-3 control-label" for="profileAddress">สถานะ*</label>
    													<div class="col-md-8">
    														<select name="status" class="form-control mb-md" required>

    								                      <option value="">-- เลือกสถานะ --</option>
                                          <option value="1" @if( $courseinfo->status == 1)
                                            selected='selected'
                                            @endif>ยังไม่อนุมัต</option>
                                          <option value="2" @if( $courseinfo->status == 2)
                                            selected='selected'
                                            @endif>อนุมัติแล้ว</option>
    								                    </select>
    																					</div>
    																				</div>
                            <div class="panel-footer">
      												<div class="row">
      													<div class="col-md-9 col-md-offset-3">
      														<button type="submit" class="btn btn-primary">เพิ่มคอร์ส</button>
      														<button type="reset" class="btn btn-default">Reset</button>
      													</div>
      												</div>
      											</div>
                        </form>









                      <br><br>

                  <!--    <form id="newsForm" class="form-horizontal" action="{{$url}}" method="post" enctype="multipart/form-data">
                        {{ method_field($method) }}
  											{{ csrf_field() }}
                        <input type="hidden" class="form-control" name="id"  value="{{$courseinfo->Oid}}" >
										</form>  -->

									</div>
								</div>
							</div>
						</div>











						</div>










</section>
@stop


@section('scripts')
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
$.fn.datepicker.defaults.format = "yyyy-mm-dd";
</script>

@if ($message = Session::get('edit_order'))
<script type="text/javascript">
var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
var notice = new PNotify({
      title: 'ยินดีด้วยค่ะ',
      text: '{{$message}}',
      type: 'success',
      addclass: 'stack-bar-top',
      stack: stack_bar_top,
      width: "100%"
    });
</script>
@endif

@stop('admin.scripts')
