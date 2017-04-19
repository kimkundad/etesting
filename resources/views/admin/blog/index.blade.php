
@extends('admin.layouts.template')
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
							<div class="row">
							<div class="col-xs-12">

						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#"  class="panel-action panel-action-toggle" data-panel-toggle></a>
								</div>

								<h2 class="panel-title">{{$header}}</h2>
							</header>
							 <div class="panel-body">

                <div class="row">
                  <div class="col-md-12">
                    <a class="btn btn-default " href="{{url('admin/blog/create')}}" role="button"><i class="fa fa-plus"></i> เพิ่ม บทความ</a>
                  </div>

                </div>

                <br>
                <table class="table table-bordered table-striped mb-none dataTable " id="datatable-default">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>บทความ</th>
                      <th>ประเภท</th>
                      <th></th>
                      <th>วันที่เพิ่ม</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($objs)
                @foreach($objs as $u)
                    <tr {{$i++}}>
                      <td>{{$i}}</td>
                      <td>{{$u->title_blog}}</td>
                      <td>{{$u->type_blog}}</td>
                      <td>

                      </td>
                      <td>{{$u->created_at}}</td>

                      <td>
                        <a style="float:left; margin-right:8px;" class="btn btn-primary btn-xs" href="{{url('admin/blog/'.$u->id.'/edit')}}" role="button"><i class="fa fa-wrench"></i> </a>
                          <form  action="{{url('admin/blog/'.$u->id)}}" method="post" onsubmit="return(confirm('Do you want Delete'))">
                            <input type="hidden" name="_method" value="DELETE">
                             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-times "></i></button>
                          </form>

                          </td>
                      </tr>
                       @endforeach
              @endif

                  </tbody>
                </table>
              </div>
						</section>

							</div>
						</div>
				</div>
</section>
@stop

@section('scripts')

@if ($message = Session::get('success_blog'))
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

@stop('scripts')
