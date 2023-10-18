<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function index($lang)
    {
        if(in_array($lang, \config('app.locales'))) {
            Session::put('locale', $lang);
        }

        return back();
    }
}
