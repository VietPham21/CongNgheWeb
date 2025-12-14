<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showHomePage(){
        return "Chào mừng bạn đến với PHT Chương 6 - Laravel!";
    }
}
