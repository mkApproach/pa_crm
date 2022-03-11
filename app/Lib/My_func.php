<?php

namespace app\Lib;
use Illuminate\Http\Request;

class My_func
{
  public static function session_clear(Request $request)
  {
    $request->session()->forget('name');
    $request->session()->forget('age_from');
    $request->session()->forget('age_to');  
    $request->session()->forget('wheres');  
    $request->session()->forget('search_criterias');
    // var_dump('独自関数だよ！');
  }
}