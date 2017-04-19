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
      //dd($objs);
      return view('news.index',$data);
  }
  public function show($id)
  {
    $objs = blog::find($id);
    $data['objs'] = $objs;
    return view('news.detail',$data);
  }
}
