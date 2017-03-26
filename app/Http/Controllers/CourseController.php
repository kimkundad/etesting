<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\course;
use App\typecourses;
use App\Http\Requests;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use Excel;
use File;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = DB::table('courses')
            ->select(
            'courses.*'
            )
            ->get();

        $course = typecourses::all();
        $data['course'] = $course;
        $data['objs'] = $objs;
        $data['datahead'] = "คอร์สเรียนทั้งหมด";
        return view('admin.course.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = typecourses::all();
        $data['course'] = $course;
        $data['method'] = "post";
        $data['url'] = url('admin/course');
        $data['header'] = "เพิ่มคอร์ส";
        return view('admin.course.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $image = $request->file('image');
      $file = $request->file('file');
      $this->validate($request, [
           'image' => 'required|mimes:jpg,jpeg,png,gif|max:10048',
           'file' => 'required',
           'name' => 'required',
           'typecourses' => 'required',
           'price' => 'required',
           'time_course' => 'required',
           'day_course' => 'required',
           'detail' => 'required',
           'start_course' => 'required',
           'end_course' => 'required',
       ]);


       $destinationPath = 'assets/excel';
       $input['file'] = time().'.'.$file->getClientOriginalExtension();
       $request->file('file')->move($destinationPath, $input['file']);
       $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = asset('assets/uploads/');
        $img = Image::make($image->getRealPath());
        $img->resize(500, 500, function ($constraint) {
        $constraint->aspectRatio();
      })->save('assets/uploads/'.$input['imagename']);

      $obj = new course();
      $obj->user_id = Auth::user()->id;
      $obj->type_course = $request['typecourses'];
      $obj->title_course = $request['name'];
      $obj->detail_course = $request['detail'];
      $obj->url_course = $input['file'];
      $obj->price_course = $request['price'];
      $obj->start_course = $request['start_course'];
      $obj->end_course = $request['end_course'];
      $obj->time_course = $request['time_course'];
      $obj->day_course = $request['day_course'];
      $obj->image_course = $input['imagename'];
      $obj->save();

      return redirect(url('admin/course/'))->with('success_course','เพิ่มข้อมูล '.$request['name'].' สำเร็จ');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $course = typecourses::all();

      $courseinfo = course::find($id);

      $data['course'] = $course;
      $data['courseinfo'] = $courseinfo;
      $data['method'] = "put";
      $data['url'] = url('admin/course/'.$id);
      $data['header'] = "แก้ไขคอร์ส";
      return view('admin.course.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image = $request->file('image');
        $file = $request->file('file');

        if($file != NULL && $image != NULL){

          $this->validate($request, [
               'image' => 'required|mimes:jpg,jpeg,png,gif|max:10048',
               'file' => 'required',
               'name' => 'required',
               'typecourses' => 'required',
               'price' => 'required',
               'time_course' => 'required',
               'day_course' => 'required',
               'detail' => 'required',
               'start_course' => 'required',
               'end_course' => 'required',
           ]);


           $destinationPath = 'assets/excel';
           $input['file'] = time().'.'.$file->getClientOriginalExtension();
           $request->file('file')->move($destinationPath, $input['file']);
           $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = asset('assets/uploads/');
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
          })->save('assets/uploads/'.$input['imagename']);


           $obj = course::find($id);
           $obj->type_course = $request['typecourses'];
           $obj->title_course = $request['name'];
           $obj->detail_course = $request['detail'];
           $obj->url_course = $input['file'];
           $obj->price_course = $request['price'];
           $obj->start_course = $request['start_course'];
           $obj->end_course = $request['end_course'];
           $obj->time_course = $request['time_course'];
           $obj->day_course = $request['day_course'];
           $obj->image_course = $input['imagename'];
           $obj->save();

           return redirect(url('admin/course/'.$id.'/edit'))->with('success_course','แก้ไขข้อมูล '.$request['name'].' สำเร็จ');


        }else if($file != NULL && $image == NULL){


          $this->validate($request, [
               'file' => 'required',
               'name' => 'required',
               'typecourses' => 'required',
               'price' => 'required',
               'time_course' => 'required',
               'day_course' => 'required',
               'detail' => 'required',
               'start_course' => 'required',
               'end_course' => 'required',
           ]);


           $destinationPath = 'assets/excel';
           $input['file'] = time().'.'.$file->getClientOriginalExtension();
           $request->file('file')->move($destinationPath, $input['file']);



           $obj = course::find($id);
           $obj->type_course = $request['typecourses'];
           $obj->title_course = $request['name'];
           $obj->detail_course = $request['detail'];
           $obj->url_course = $input['file'];
           $obj->price_course = $request['price'];
           $obj->start_course = $request['start_course'];
           $obj->end_course = $request['end_course'];
           $obj->time_course = $request['time_course'];
           $obj->day_course = $request['day_course'];
           $obj->save();

           return redirect(url('admin/course/'.$id.'/edit'))->with('success_course','แก้ไขข้อมูล '.$request['name'].' สำเร็จ');

        }else if($file == NULL && $image != NULL){


          $this->validate($request, [
               'image' => 'required|mimes:jpg,jpeg,png,gif|max:10048',
               'name' => 'required',
               'typecourses' => 'required',
               'price' => 'required',
               'time_course' => 'required',
               'day_course' => 'required',
               'detail' => 'required',
               'start_course' => 'required',
               'end_course' => 'required',
           ]);

           $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = asset('assets/uploads/');
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
          })->save('assets/uploads/'.$input['imagename']);


           $obj = course::find($id);
           $obj->type_course = $request['typecourses'];
           $obj->title_course = $request['name'];
           $obj->detail_course = $request['detail'];
           $obj->price_course = $request['price'];
           $obj->start_course = $request['start_course'];
           $obj->end_course = $request['end_course'];
           $obj->time_course = $request['time_course'];
           $obj->day_course = $request['day_course'];
           $obj->image_course = $input['imagename'];
           $obj->save();

           return redirect(url('admin/course/'.$id.'/edit'))->with('success_course','แก้ไขข้อมูล '.$request['name'].' สำเร็จ');



        }else{


          $this->validate($request, [
               'name' => 'required',
               'typecourses' => 'required',
               'price' => 'required',
               'time_course' => 'required',
               'day_course' => 'required',
               'detail' => 'required',
               'start_course' => 'required',
               'end_course' => 'required',
           ]);

           $obj = course::find($id);
           $obj->type_course = $request['typecourses'];
           $obj->title_course = $request['name'];
           $obj->detail_course = $request['detail'];
           $obj->price_course = $request['price'];
           $obj->start_course = $request['start_course'];
           $obj->end_course = $request['end_course'];
           $obj->time_course = $request['time_course'];
           $obj->day_course = $request['day_course'];
           $obj->save();

           return redirect(url('admin/course/'.$id.'/edit'))->with('success_course','แก้ไขข้อมูล '.$request['name'].' สำเร็จ');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $objs = DB::table('courses')
      ->where('courses.id', $id)
      ->first();

      $destinationPath = 'assets/uploads/'.$objs->image_course;
      File::delete($destinationPath);

      $url_course = 'assets/excel/'.$objs->url_course;
      File::delete($url_course);

      $obj = DB::table('courses')
      ->where('courses.id', $id)
      ->delete();

      return redirect(url('admin/course/'))->with('delete','ลบข้อมูล สำเร็จ');
    }
}
