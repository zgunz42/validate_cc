<?php

namespace App\Http\Controllers;

use App\CreditCard;
use App\Http\Requests\StoreCreditCard;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $cards = CreditCard::all()->sortBy('expires_in');
        return view('index', ["cards" => $cards]);
    }
}
