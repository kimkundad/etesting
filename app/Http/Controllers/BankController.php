<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bank;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $objs = DB::table('banks')
          ->get();

      $data['objs'] = $objs;
      $data['i'] = $i = 0;
      $data['datahead'] = "รายชื่อธนาคารทั้งหมด";
      return view('admin.bank.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data['method'] = "post";
      $data['url'] = url('admin/bank');
      $data['header'] = "เพิ่มธนาคาร";
      return view('admin.bank.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
       'image' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
       'bank_name' => 'required',
       'bank_owner' => 'required',
       'bank_number' => 'required'
     ]);

     $image = $request->file('image');
     $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

      $destinationPath = asset('assets/images/bank');
      $img = Image::make($image->getRealPath());
      $img->resize(200, 200, function ($constraint) {
      $constraint->aspectRatio();
    })->save('assets/images/bank/'.$input['imagename']);

      $package = new bank();
     $package->image = $input['imagename'];
     $package->bank_name = $request['bank_name'];
     $package->bank_owner = $request['bank_owner'];
     $package->bank_number = $request['bank_number'];
     $package->save();

     return redirect(url('admin/bank'))->with('success','เพิ่มธนาคาร '.$request['bank_name'].' เสร็จเรียบร้อยแล้ว');
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
      $obj = DB::table('banks')
        ->select(
           'banks.*'
           )
        ->where('banks.id', $id)
        ->first();

      $data['url'] = url('admin/bank/'.$id);
      $data['header'] = "แก้ไขข้อมูลธนาคาร";
      $data['method'] = "put";
      $data['objs'] = $obj;
      return view('admin.bank.edit', $data);
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
         'bank_name' => 'required',
         'bank_owner' => 'required',
         'bank_number' => 'required'
        ]);


       $package = bank::find($id);
       $package->bank_name = $request['bank_name'];
       $package->bank_owner = $request['bank_owner'];
       $package->bank_number = $request['bank_number'];
        $package->save();
        return redirect(url('admin/bank/'.$id.'/edit'))->with('success_edit','แก้ไข '.$request['bank_name'].' สำเร็จ');

     }else{

       $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
            'bank_name' => 'required',
            'bank_owner' => 'required',
            'bank_number' => 'required'
        ]);

        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

         $destinationPath = asset('assets/images/bank');
         $img = Image::make($image->getRealPath());
         $img->resize(200, 200, function ($constraint) {
         $constraint->aspectRatio();
       })->save('assets/images/bank/'.$input['imagename']);


       $package = bank::find($id);
       $package->image = $input['imagename'];
       $package->bank_name = $request['bank_name'];
       $package->bank_owner = $request['bank_owner'];
       $package->bank_number = $request['bank_number'];
       $package->save();
       return redirect(url('admin/bank/'.$id.'/edit'))->with('success_edit','แก้ไข '.$request['bank_name'].' สำเร็จ');

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
      $obj = bank::find($id);
      $obj->delete();
      return redirect(url('admin/bank'))->with('delete','Delete successful');
    }
}
