@extends('admin.layouts.template')

@section('admin.stylesheet')

@stop('admin.stylesheet')

@section('admin.content')

				<section role="main" class="content-body">

					<header class="page-header">
						<h2>{{$header}}</h2>

						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.html">
										<i class="fa fa-home"></i>
									</a>
								</li>

								<li><span>{{$header}}</span></li>
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

                    @if (count($errors) > 0)
                    <br>
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

										<form id="newsForm" class="form-horizontal" action="{{$url}}" method="post" enctype="multipart/form-data">
                      {{ method_field($method) }}
											{{ csrf_field() }}

											<h4 class="mb-xlg">ใส่ข้อมูลคอร์ส</h4>

											<fieldset>

                        <div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">ชื่อแบบฝึกหัด*</label>
													<div class="col-md-8">
														<input type="text" class="form-control" name="example_name" value="{{$courseinfo->examples_name}}" placeholder="มินนะ โนะ นิฮงโกะ みんなの日本語 かんじ N5+N4">
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-3 control-label" for="profileAddress">หมวดหมู่แบบฝึกหัด*</label>
													<div class="col-md-8">
														<select name="categorys" class="form-control mb-md" required>

								                      <option value="">-- เลือกหมวดหมู่แบบฝึกหัด --</option>
								                      @foreach($category as $categorys)
													  <option value="{{$categorys->id}}" @if( $courseinfo->category_id == $categorys->id)
                              selected='selected'
                              @endif >{{$categorys->name_category}}</option>
													  @endforeach
								                    </select>
														</div>
													</div>


                          <div class="form-group">
  													<label class="col-md-3 control-label" for="profileAddress">เลือกรหัสคอร์ส*</label>
  													<div class="col-md-8">
  														<select name="course" class="form-control mb-md" required>

  								                      <option value="">-- เลือกคอร์ส --</option>
  								                      @foreach($course as $courses)
  													  <option value="{{$courses->id}}" @if( $courseinfo->course_id == $courses->id)
                                selected='selected'
                                @endif>{{$courses->code_course}}</option>
  													  @endforeach
  								                    </select>
  														</div>
  													</div>





                        <div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">รายละเอียดคอร์ส*</label>
													<div class="col-md-8">
                            <textarea class="form-control" name="example_detail" rows="4">{{$courseinfo->examples_detail}}</textarea>
													</div>
												</div>





											</fieldset>







											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<button type="submit" class="btn btn-primary">เพิ่มคอร์ส</button>
														<button type="reset" class="btn btn-default">Reset</button>
													</div>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
						</div>











						</div>

</section>
@stop


@section('scripts')
<script>
$.fn.datepicker.defaults.format = "yyyy-mm-dd";
</script>
@if ($message = Session::get('success_course'))
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
