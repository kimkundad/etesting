<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\Http\Requests;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $objs = category::all();
      $data['objs'] = $objs;
      $data['datahead'] = "หมวดหมู่แบบฝึกหัด";
      return view('admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data['method'] = "post";
      $data['url'] = url('admin/category');
      $data['header'] = "เพิ่มหมวดหมู่แบบฝึกหัด";
      return view('admin.category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $package = new category();
      $package->name_category = $request['name_category'];
      $package->save();
      return redirect(url('admin/category'))->with('success','เพิ่ม'.$request['name_category'].' เสร็จเรียบร้อยแล้ว');
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
      $obj = category::find($id);
      $data['url'] = url('admin/category/'.$id);
      $data['header'] = "แก้ไขหมวดหมู่แบบฝึกหัด";
      $data['method'] = "put";
      $data['objs'] = $obj;
      return view('admin.category.edit', $data);
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
      $package = category::find($id);
       $package->name_category = $request['name_category'];
       $package->save();
       return redirect(url('admin/category'))->with('success','Edit successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $obj = category::find($id);
      $obj->delete();
      return redirect(url('admin/category'))->with('delete','Delete successful');
    }
}
