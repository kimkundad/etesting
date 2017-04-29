<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\question;
use App\option;
use App\course;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }




    public function store2(Request $request)
    {

      $this->validate($request, [
           'category_id' => 'required',
           'name_question' => 'required',
           'point' => 'required'
       ]);

        $obj = new question();
        $obj->category_id = $request['category_id'];
        $obj->name_questions = $request['name_question'];
        $obj->point = $request['point'];
        $obj->status = $request['status'];
        $obj->save();

         $the_id = $obj->id;

         $name_option = request()->get('name_option');
         $type_option = request()->get('type_option');

         if($the_id){
         if (sizeof($name_option) > 0) {
                    for ($i = 0; $i < sizeof($name_option); $i++) {
                        $admins[] = [
                            'question_id' => $the_id,
                            'name_option' => $name_option[$i],
                            'type_option' => $type_option,
                        ];
                    }

                }
          option::insert($admins);


        return redirect(url('admin/example/'.$request['category_id']))->with('success_questions','เพิ่มข้อสอบ'.$request['name_question'].' สำเร็จ');
    }



    }




    public function updatesort(Request $request, $id)
    {
        $sort_order = $request['sort_order'];



           // dd($sort_order);
            $sort_order = json_decode($sort_order,true);
           // dd($sort_order);
          //  return redirect(url('admin/category'))->with('edit','Edit successful');

            foreach($sort_order as $index=>$ids) {
           // $ids = (int) $ids;

           $obj = DB::table('questions')
            ->select(
            'questions.*'
            )
            ->where('id_questions', $ids['id'])
            ->update(array('order_sort' => ($index + 1) ));

           // echo $ids['id'];
    }

    return redirect(url('admin/example/'.$id))->with('edit','ทำการเรียงลำดับคำถามใหม่เรียบร้อยแล้ว');

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
        //
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
    }

    public function deleteq($id)
    {

      $obj = DB::table('questions')
      ->where('questions.id_questions', $id)
      ->delete();

      $objo = DB::table('options')
      ->where('options.question_id', $id)
      ->delete();

      return back()->with('delete_q','ลบข้อมูล สำเร็จ');
    }


}
