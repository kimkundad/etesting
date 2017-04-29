<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\blog;
use App\Http\Requests;

class NewsController extends Controller
{
  public function index()
  {
      $objs = blog::paginate(12);
      $data['objs'] = $objs;

      $popu = DB::table('blogs')
        ->select(
           'blogs.*',
           'blogs.image'
           )
        ->orderBy('view', 'desc')
        ->limit(6)
        ->get();
        $data['popu'] = $popu;
      //dd($objs);
      return view('news.index',$data);
  }
  public function show($id)
  {

    $package = blog::find($id);
    $package->view += 1;
    $package->save();

    $orderBy = blog::limit(6);
    $data['orderBy'] = $orderBy;

    $popu = DB::table('blogs')
      ->select(
         'blogs.*',
         'blogs.image'
         )
      ->orderBy('view', 'desc')
      ->limit(6)
      ->get();
      $data['popu'] = $popu;
    //dd($popu);

    $objs = blog::find($id);
    $data['objs'] = $objs;
    return view('news.detail',$data);
  }
}
