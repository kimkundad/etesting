
@extends('admin.layouts.template')
@section('admin.stylesheet')
   <style type="text/css">

.mar-top{
	margin-top: 20px;
}

.b-w{
	width: 150px;
	margin-top: 10px;
}
hr{
	margin: 16px 0 16px 0;
}
.dd-handle {
    display: block;
    height: auto;
    margin: 5px 0;
    padding: 6px 10px;
    color: #333;
    text-decoration: none;
    font-weight: 600;
    border: 1px solid #CCC;
    background: #F6F6F6;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}
.p-20{
   	margin-top: 10px;
   }
   </style>

@stop('admin.stylesheet')
@section('admin.content')






				<section role="main" class="content-body">

					<header class="page-header">
						<h2>จัดการแบบฝึกหัด</h2>

						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
                <li><span>{{$objss->code_course}}</span></li>
								<li><span>{{$objss->examples_name}}</span></li>
							</ol>

							<a class="sidebar-right-toggle" data-open="sidebar-right" ><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>


					<!-- start: page -->



<div class="row">
							<div class="row">
							<div class="col-xs-12">

						<div class="col-md-8">

							<section class="panel">

							<div class="panel-body">
								<h2 class="panel-title">{{$objss->examples_name}} ( {{$objss->name_category}} )</h2>
								<hr>






<form id="dd-form" action="{{url('admin/updatesort/'.$objss->e_id)}}" method="post">

								{{ csrf_field() }}
								<div class="dd" id="nestable">
								<ol class="dd-list">

								@if($objs)
               						 @foreach($objs as $u)

               						<?php $order[] = $u->id_questions ?>
               						 <li class="dd-item" data-id="{{ $u->id_questions }}">
               					<div class="dd-handle row mar-top">
								<div class="col-md-11">
								<fieldset>
                        			<div class="form-group">


										<label class="control-label">{{$u->name_questions}}*</label>

										@foreach($u->options as $uu)

											@if($uu->type_option == 1)
         <input type="text" class="form-control" name="{{$uu->id_option}}"  value="{{ old('$uu->id_option') }}" >
         <br>
         									@elseif($uu->type_option == 3)

        								<input type="file" name="{{$uu->id_option}}">
        								<br>

                        @elseif($uu->type_option == 4)

                        <textarea class="form-control" rows="3"></textarea>
                        <br>

											@else






        @if($uu->name_option != NULL)

                      <div class="radio">
                      <label>
                          <input type="radio"  value="{{$uu->name_option}}" id="{{$uu->id_option}}" >

                            {{$uu->name_option}}
                      </label>
                    </div>

                      @else

                      <div class="radio">
                      <label>
                          <input type="radio"  value="Other" id="{{$uu->id_option}}" >

                            <input type="text" class="form-control"  placeholder="Other"  >
                      </label>
                  </div>

                      @endif







         									@endif
                        				@endforeach

									</div>
								<fieldset>

								</div>


								</div>

							</li>

									 @endforeach
              					@endif

              				</ol>
              			</div>

        <div style="margin-top:60px;">
        <input type="hidden" name="sort_order" id="nestable-output"  />
				<button class="btn btn-default pull-right" type="submit">บันทึกข้อมูล</button>
        <div>

</form>








							</div>
						</section>

						</div>


						<div class="col-md-4">

							<section class="panel">

							<div class="panel-body">
								<h2 class="panel-title">เมนูคำถาม</h2>
								<hr>

                <a type="button" data-toggle="modal"
data-target=".input_box" class=" b-w btn btn-danger"><i class="fa fa-terminal"></i> อัตนัย</a>
                <br>
								<a type="button" data-toggle="modal"
data-target=".radio_add" class="b-w btn btn-info"><i class="fa fa-dot-circle-o"></i> ปรนัย</a>


							</div>








<div class="modal fade input_box" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog " role="document">
    <form  action="{{url('admin/store2')}}" method="post" id="myform" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
      <h3 style="margin-top: 0px; margin-bottom: 0px;">เพิ่มแบบสอบถาม </h3>
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="hidden" name="type_option" value="1">
         <input type="hidden" name="category_id" value="{{$objss->e_id}}">
         <input type="hidden" name="_method" value="post">
         <input type="hidden" class="form-control" name="status" value="1">
         </div>
         <div class="modal-body">
          <div class="form-body">
            <div class="form-group form-md-line-input">
                <label class="col-md-3 control-label" for="form_control_1">หัวข้อแบบสอบถาม*</label>
                  <div class="col-md-9">

                     <textarea class="form-control" name="name_question" rows="4"></textarea>
                     <input type="hidden" class="form-control" name="name_option[]" >
                      <div class="form-control-focus"> </div>
                  </div>
             </div>
             <div class="form-group form-md-line-input">
                 <label class="col-md-3 control-label" for="form_control_1">คะแนน*</label>
                   <div class="col-md-9">
                      <input class="form-control" name="point" required>

                       <div class="form-control-focus"> </div>
                   </div>
              </div>

             <br>

           </div>
        </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
             <button type="submit"  class="btn btn-success">
               <i class="fa fa-plus"></i> เพิ่มคำถาม</button>
           </div>
    </div>

      </form>
  </div>
</div>








<div class="modal fade radio_add" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog " role="document">
    <form  action="{{url('admin/store2')}}" method="post" id="myform" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
      <h3 style="margin-top: 0px; margin-bottom: 0px;">เพิ่มแบบสอบถาม </h3>
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="hidden" name="type_option" value="2">
         <input type="hidden" name="category_id" value="{{$objss->e_id}}">
         <input type="hidden" name="_method" value="post">
         </div>
         <div class="modal-body">
          <div class="form-body">
            <div class="form-group form-md-line-input">
                <label class="col-md-3 control-label" for="form_control_1">หัวข้อแบบสอบถาม*</label>
                  <div class="col-md-9">
                     <input class="form-control" name="name_question" required>

                      <div class="form-control-focus"> </div>
                  </div>
             </div>
             <div class="form-group form-md-line-input">
                 <label class="col-md-3 control-label" for="form_control_1">คะแนน*</label>
                   <div class="col-md-9">
                      <input class="form-control" name="point" required>

                       <div class="form-control-focus"> </div>
                   </div>
              </div>
              <div class="form-group form-md-line-input">
                  <label class="col-md-3 control-label" for="form_control_1">ข้อที่ถูกต้อง*</label>
                    <div class="col-md-9">
                       <input class="form-control" name="status" required>

                        <div class="form-control-focus"> </div>
                    </div>
               </div>
             <br>
             <div class="form-group">
						<label class="col-md-3 control-label" for="profileFirstName">option</label>
								<div class="col-md-8">

									<input type="text" class="form-control" name="name_option[]" >
									<span class="help-block text-danger">*กรณีเลือก ประเภท radio ให้ใส่ข้อมูลด้วย</span>

										<span id="product_image">

										</span>

							             <br>
									</div>
								</div>
			<br>
             <div class="form-group " id="texhave" >
					<label class="col-md-3 control-label" for="profileFirstName">เพิ่ม option</label>
						<div class="col-md-8">
                <button type="button" class="btn btn-primary"
                onClick="JavaScript:product_imageCreateElement();">
					 <i class="fa fa-plus-circle"></i> เพิ่ม option</button>

					 <button type="reset" class="btn btn-danger" onclick="removeDummy()">ลบ</button>
									</div>
								</div>

           </div>
        </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
             <button type="submit"  class="btn btn-success">
               <i class="fa fa-plus"></i> เพิ่มคำถาม</button>
           </div>
    </div>

      </form>
  </div>
</div>












							</section>

						</div>



            <div class="col-md-8">

							<section class="panel">

							<div class="panel-body">

                <h3>ลบข้อสอบ</h3>


                <div class="table-responsive">
										<table class="table table-striped mb-none">

											<tbody>
                        @foreach($get_q as $get_qs)
												<tr>
													<td>{{$get_qs->order_sort}}</td>
													<td style="text-align: left">{{$get_qs->name_questions}}</td>
													<td>
                            <form  action="{{url('admin/deleteq/'.$get_qs->id_questions)}}" method="post" onsubmit="return(confirm('Do you want Delete'))">
                              <input type="hidden" name="_method" value="post">
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <button type="submit" style="float:left; margin:3px;" class="btn btn-danger btn-xs"><i class="fa fa-times "></i></button>
                            </form>
                          </td>

												</tr>
                        @endforeach
											</tbody>
										</table>
									</div>


                </div>
                </section>



                </div>






							</div>
						</div>


				</div>
</section>
@stop

@section('scripts')
<script src="{{url('./assets/vendor/jquery-nestable/jquery.nestable.js')}}"></script>
<script type="text/javascript">

/*
Name: 			UI Elements / Nestable - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.4.1
*/

(function( $ ) {

	'use strict';

	/*
	Update Output
	*/
	var updateOutput = function (e) {
		var list = e.length ? e : $(e.target),
			output = list.data('output');

		if (window.JSON) {
			output.val(window.JSON.stringify(list.nestable('serialize')));
		} else {
			output.val('JSON browser support required for this demo.');
		}
	};

	/*
	Nestable 1
	*/
	$('#nestable').nestable({
		group: 1
	}).on('change', updateOutput);

	/*
	Output Initial Serialised Data
	*/
	$(function() {
		updateOutput($('#nestable').data('output', $('#nestable-output')));
	});

}).apply(this, [ jQuery ]);
</script>




@if ($message = Session::get('success_questions'))
<script type="text/javascript">
var stack_topleft = {"dir1": "down", "dir2": "right", "push": "top"};
var notice = new PNotify({
      title: 'ยินดีด้วยค่ะ',
      text: '{{$message}}',
      type: 'success',
      addclass: 'stack-topleft'
    });
</script>
@endif



@if ($message = Session::get('edit'))
<script type="text/javascript">
var stack_topleft = {"dir1": "down", "dir2": "right", "push": "top"};
var notice = new PNotify({
      title: 'ยินดีด้วยค่ะ',
      text: '{{$message}}',
      type: 'success',
      addclass: 'stack-topleft'
    });
</script>
@endif


@if ($message = Session::get('delete_q'))
<script type="text/javascript">
var stack_topleft = {"dir1": "down", "dir2": "right", "push": "top"};
var notice = new PNotify({
      title: 'ยินดีด้วยค่ะ',
      text: '{{$message}}',
      type: 'success',
      addclass: 'stack-topleft'
    });
</script>
@endif



<script type="text/javascript">


function product_imageCreateElement(){
  var product_image=document.getElementById('product_image');
  var product_imageElement=document.createElement('input');
      product_imageElement.setAttribute('type',"text");
      product_imageElement.setAttribute('name',"name_option[]");
      product_imageElement.setAttribute('class',"form-control p-20");
      product_imageElement.setAttribute('id',"radio_c");
      product_image.appendChild(product_imageElement);
}


function removeDummy() {
    var elem = document.getElementById('radio_c');
    elem.parentNode.removeChild(elem);
    return false;
}

</script>

@stop('scripts')
