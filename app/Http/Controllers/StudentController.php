<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Users;
use App\Http\Requests;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objs = DB::table('users')
            ->select(
            'users.*'
            )
            ->where('users.position', 'student')
            ->get();

        $data['objs'] = $objs;
        $data['datahead'] = "รายชื่อนักเรียนทั้งหมด";
        return view('admin.student.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['method'] = "post";
        $data['url'] = url('admin/student');
        $data['header'] = "เพิ่มครูผู้สอน";
        return view('admin.student.create', $data);
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


     if($image == NULL){

      $this->validate($request, [
       'name' => 'required|unique:users|max:255',
       'email' => 'required|email|max:255|unique:users',
       'password' => 'required|min:6|confirmed',
       'position' => 'required',
       'hbd' => 'required',
       'phone' => 'required',
     ]);
        //
        $package = new Users();
        $package->name = $request['name'];
        $package->email = $request['email'];
        $package->position = $request['position'];
        $package->address = $request['address'];
        $package->phone = $request['phone'];
        $package->bio = $request['bio'];
        $package->hbd = $request['hbd'];
        $package->line_id = $request['line_id'];
        $package->provider = 'email';
        $package->password = bcrypt($request['password']);
        $package->save();
        return redirect(url('admin/student'))->with('success','เพิ่มบัญชีผู้ใช้งาน '.$request['name'].' เสร็จเรียบร้อยแล้ว');


  }else{


    $this->validate($request, [
     'image' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
     'name' => 'required|unique:users|max:255',
     'email' => 'required|email|max:255|unique:users',
     'password' => 'required|min:6|confirmed',
     'position' => 'required',
     'hbd' => 'required',
     'phone' => 'required',

   ]);


   $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

    $destinationPath = asset('assets/images/avatar');
    $img = Image::make($image->getRealPath());
    $img->resize(300, 300, function ($constraint) {
    $constraint->aspectRatio();
  })->save('assets/images/avatar/'.$input['imagename']);

    $package = new Users();
   $package->avatar = $input['imagename'];
   $package->name = $request['name'];
   $package->email = $request['email'];
   $package->position = $request['position'];
   $package->address = $request['address'];
   $package->phone = $request['phone'];
   $package->bio = $request['bio'];
   $package->hbd = $request['hbd'];
   $package->line_id = $request['line_id'];
   $package->provider = 'email';
   $package->password = bcrypt($request['password']);
   $package->save();

   return redirect(url('admin/student'))->with('success','เพิ่มบัญชีผู้ใช้งาน '.$request['name'].' เสร็จเรียบร้อยแล้ว');

  }
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
        //
        $obj = DB::table('users')
          ->select(
             'users.*'
             )
          ->where('users.id', $id)
          ->first();

        $score = 0;

      if($obj->name != NULL){
        $score += 20;
      }
      if($obj->address != NULL){
        $score += 20;
      }
      if($obj->position != NULL){
        $score += 20;
      }
      if($obj->phone != NULL){
        $score += 20;
      }
      if($obj->line_id != NULL){
        $score += 20;
      }

        $data['url'] = url('admin/student/'.$id);
        $data['header'] = "แก้ไขข้อมูลนักเรียน";
        $data['method'] = "put";
        $data['score'] = $score;
        $data['objs'] = $obj;
        return view('admin.student.edit', $data);
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


     if($image == NULL){

       $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'hbd' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'line_id' => 'required',
        ]);

        $package = users::find($id);
        $package->name = $request['name'];
        $package->email = $request['email'];
        $package->bio = $request['bio'];
        $package->address = $request['address'];
        $package->phone = $request['phone'];
        $package->hbd = $request['hbd'];
        $package->line_id = $request['line_id'];
        $package->save();

      return redirect(url('admin/student/'.$id.'/edit'))->with('success','Edit '.$request['name'].' successful');

      }else{

        $this->validate($request, [
             'image' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
             'name' => 'required',
             'email' => 'required',
             'hbd' => 'required',
             'address' => 'required',
             'phone' => 'required',
             'line_id' => 'required',
         ]);

         $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

          $destinationPath = asset('assets/images/avatar');
          $img = Image::make($image->getRealPath());
          $img->resize(300, 300, function ($constraint) {
          $constraint->aspectRatio();
        })->save('assets/images/avatar/'.$input['imagename']);

         $package = users::find($id);
         $package->avatar = $input['imagename'];
         $package->name = $request['name'];
         $package->email = $request['email'];
         $package->bio = $request['bio'];
         $package->address = $request['address'];
         $package->phone = $request['phone'];
         $package->hbd = $request['hbd'];
         $package->line_id = $request['line_id'];
         $package->save();
         return redirect(url('admin/student/'.$id.'/edit'))->with('success','Edit '.$request['name'].' successful');
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
        //

        $obj = Users::find($id);
        $obj->delete();
        return redirect(url('admin/student'))->with('delete','Delete successful');
    }
}
