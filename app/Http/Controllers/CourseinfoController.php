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
use App\Users;
use App\submitcourse;
use App\bank;
use Mail;
use Swift_Transport;
use Swift_Message;
use Swift_Mailer;
use App\qrcode;


class CourseinfoController extends Controller
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $courseinfo = course::find($id);

      $coursess = DB::table('courses')
        ->select(
           'submitcourses.*',
           'submitcourses.user_id as Uid',
           'submitcourses.id as Oid',
           'users.*',
           'courses.*'
           )
        ->where('courses.id', $id)
        ->leftjoin('submitcourses', 'courses.id', '=', 'submitcourses.course_id')
        ->leftjoin('users', 'users.id', '=', 'submitcourses.user_id')
        ->get();
    //  dd($coursess);
      $data['header'] = "แก้ไขคอร์ส";
      //dd($courseinfo);
      return view('course.courseinfo')->with([
           'courseinfos' =>$coursess,
           'objs' => $courseinfo
         ]);
    }



    public function checkmycourse($id)
    {
      $bank = DB::table('banks')
        ->get();
      $getc = DB::table('submitcourses')
        ->select(
           'submitcourses.*'
           )
        ->where('submitcourses.user_id', Auth::user()->id)
        ->where('submitcourses.course_id', $id)
        ->first();

      //  dd($getc->Oid);

      $coursess = DB::table('submitcourses')
        ->select(
           'submitcourses.*',
           'submitcourses.user_id as Uid',
           'submitcourses.id as Oid',
           'users.*',
           'courses.*'
           )
        ->where('submitcourses.user_id', Auth::user()->id)
        ->where('submitcourses.id', $getc->id)
        ->leftjoin('users', 'users.id', '=', 'submitcourses.user_id')
        ->leftjoin('courses', 'courses.id', '=', 'submitcourses.course_id')
        ->first();

    //  dd($data);

   return view('confirm_course.pay_course')->with([
        'courseinfo' =>$coursess,
        'bank' => $bank,
        'bill' =>"บิลเลขที่"
      ]);
    }





    public function confirm_course($id)
    {
      $courseinfo = course::find($id);

    //  dd($data);

      return view('confirm_course.index')->with([
        'objs' =>$courseinfo,
        'user' =>"แก้ไขคอร์ส"
      ]);


    }



    public function pay_course(Request $request, $id)
    {



      $coursess = DB::table('submitcourses')
        ->select(
           'submitcourses.*',
           'submitcourses.user_id as Uid',
           'submitcourses.id as Oid',
           'users.*',
           'courses.*'
           )
        ->where('submitcourses.user_id', Auth::user()->id)
        ->where('submitcourses.id', $id)
        ->leftjoin('users', 'users.id', '=', 'submitcourses.user_id')
        ->leftjoin('courses', 'courses.id', '=', 'submitcourses.course_id')
        ->first();

    //  dd($data);

    /*  return view('confirm_course.pay_course')->with([
        'objs' =>$courseinfo,
        'bill' =>"บิลเลขที่"
      ]); */

      return redirect(url('pay_course/'.$id))->with('hbd','กรอกวันเกิดนักเรียนด้วยนะจ๊ะ');


    }




    public function submit_course(Request $request, $id)
    {

      $bank = DB::table('banks')
        ->get();

      $hbd = $request->get('hbd');

      if($hbd == '0000-00-00'){
          return redirect(url('confirm_course/'.$id))->with('hbd','กรอกวันเกิดนักเรียนด้วยนะจ๊ะ');
      }

      $this->validate($request, [
           'name' => 'required',
           'hbd' => 'required',
           'phone' => 'required',
           'line' => 'required',
       ]);

       $package = Users::find(Auth::user()->id);
       $package->name = $request['name'];
       $package->hbd = $request['hbd'];
       $package->phone = $request['phone'];
       $package->line_id = $request['line'];
       $package->save();

       $countobj = DB::table('submitcourses')
         ->select(
            'submitcourses.*'
            )
         ->where('submitcourses.user_id', Auth::user()->id)
         ->where('submitcourses.course_id', $id)
         ->count();



      if($countobj > 0){

        $getc = DB::table('submitcourses')
          ->select(
             'submitcourses.*'
             )
          ->where('submitcourses.user_id', Auth::user()->id)
          ->where('submitcourses.course_id', $id)
          ->first();

        //  dd($getc->Oid);

        $coursess = DB::table('submitcourses')
          ->select(
             'submitcourses.*',
             'submitcourses.user_id as Uid',
             'submitcourses.id as Oid',
             'users.*',
             'courses.*'
             )
          ->where('submitcourses.user_id', Auth::user()->id)
          ->where('submitcourses.id', $getc->id)
          ->leftjoin('users', 'users.id', '=', 'submitcourses.user_id')
          ->leftjoin('courses', 'courses.id', '=', 'submitcourses.course_id')
          ->first();

      //  dd($data);

     return view('confirm_course.pay_course')->with([
          'courseinfo' =>$coursess,
          'bank' => $bank,
          'bill' =>"บิลเลขที่"
        ]);

      } else{

        $package = new submitcourse();
        $package->user_id = Auth::user()->id;
        $package->course_id = $id;
        $package->save();

        $the_id = $package->id;


        $coursess = DB::table('submitcourses')
          ->select(
             'submitcourses.*',
             'submitcourses.user_id as Uid',
             'submitcourses.id as Oid',
             'users.*',
             'courses.*'
             )
          ->where('submitcourses.user_id', Auth::user()->id)
          ->where('submitcourses.id', $the_id)
          ->leftjoin('users', 'users.id', '=', 'submitcourses.user_id')
          ->leftjoin('courses', 'courses.id', '=', 'submitcourses.course_id')
          ->first();

      //  dd($data);

     return view('confirm_course.pay_course')->with([
          'courseinfo' =>$coursess,
          'bank' => $bank,
          'bill' =>"บิลเลขที่"
        ]);


      }




    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }



    public function bil_course(Request $request, $id)
    {

      $this->validate($request, [
           'bankname' => 'required',
           'totalmoney' => 'required',
           'day' => 'required',
           'timer' => 'required',
       ]);


       $countobj = DB::table('submitcourses')
         ->select(
            'submitcourses.*'
            )
         ->where('submitcourses.user_id', Auth::user()->id)
         ->where('submitcourses.id', $id)
         ->first();

       if($countobj->status > 0){

         $coursess = DB::table('submitcourses')
           ->select(
              'submitcourses.*',
              'submitcourses.user_id as Uid',
              'submitcourses.id as Oid',
              'users.*',
              'courses.*'
              )
           ->where('submitcourses.user_id', Auth::user()->id)
           ->where('submitcourses.id', $id)
           ->leftjoin('users', 'users.id', '=', 'submitcourses.user_id')
           ->leftjoin('courses', 'courses.id', '=', 'submitcourses.course_id')
           ->first();

          return view('confirm_course.bil_course')->with([
               'courseinfo' =>$coursess,
               'bill' =>"บิลเลขที่"
             ]);

       }else{


         $package = submitcourse::find($id);
         $package->bank_id = $request['bankname'];
         $package->money_tran = $request['totalmoney'];
         $package->date_tran = $request['day'];
         $package->time_tran = $request['timer'];
         $package->status = 1;
         $package->save();


         $coursess = DB::table('submitcourses')
           ->select(
              'submitcourses.*',
              'submitcourses.user_id as Uid',
              'submitcourses.id as Oid',
              'users.*',
              'banks.*',
              'courses.*'
              )
           ->where('submitcourses.user_id', Auth::user()->id)
           ->where('submitcourses.id', $id)
           ->leftjoin('users', 'users.id', '=', 'submitcourses.user_id')
           ->leftjoin('courses', 'courses.id', '=', 'submitcourses.course_id')
           ->leftjoin('banks', 'banks.id', '=', 'submitcourses.bank_id')
           ->first();





         // send email
           $data_toview = array();
         //  $data_toview['pathToImage'] = "assets/image/email-head.jpg";
           date_default_timezone_set("Asia/Bangkok");
           $data_toview['data'] = $coursess;
           $data_toview['datatime'] = date("d-m-Y H:i:s");

           $email_sender   = 'learnsbuy@gmail.com';
           $email_pass     = 'Homeayumu4549';

       /*    $email_sender   = 'info@acmeinvestor.com';
           $email_pass     = 'Iaminfoacmeinvestor';  */
           $email_to       =  $coursess->email;
           //echo $admins[$idx]['email'];
           // Backup your default mailer
           $backup = \Mail::getSwiftMailer();

           try{

                       //https://accounts.google.com/DisplayUnlockCaptcha
                       // Setup your gmail mailer
                       $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                       $transport->setUsername($email_sender);
                       $transport->setPassword($email_pass);

                       // Any other mailer configuration stuff needed...
                       $gmail = new Swift_Mailer($transport);

                       // Set the mailer as gmail
                       \Mail::setSwiftMailer($gmail);

                       $data['emailto'] = $email_sender;
                       $data['sender'] = $email_to;
                       //Sender dan Reply harus sama

                       Mail::send('mails.index', $data_toview, function($message) use ($data)
                       {
                           $message->from($data['sender'], 'Learnsbuy');
                           $message->to($data['sender'])
                           ->replyTo($data['sender'], 'Learnsbuy.')
                           ->subject('ใบเสร็จสำหรับการสั่งซื้อคอร์สเรียน Learnsbuy ของคุณในวันที่ '.date("d-m-Y H:i:s"));

                           //echo 'Confirmation email after registration is completed.';
                       });

           }catch(\Swift_TransportException $e){
               $response = $e->getMessage() ;
               echo $response;

           }


           // Restore your original mailer
           Mail::setSwiftMailer($backup);
           // send email










          return view('confirm_course.bil_course')->with([
               'courseinfo' =>$coursess,
               'bill' =>"บิลเลขที่"
             ]);


       }


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
}
