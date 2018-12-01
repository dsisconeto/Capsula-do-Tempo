<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 26/09/2018
 * Time: 16:50
 */

namespace App\Web\Controllers;


use App\Framework\Http\Controllers\Controller;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function index(Client $client)
    {



        return view('pages.home.index', compact('cep'));
    }


}
