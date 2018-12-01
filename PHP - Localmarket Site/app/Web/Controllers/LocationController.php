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
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocationController extends Controller
{
    public function Location(Request $request, Client $client)
    {

        $latitude =  $request->input('latitude');
        $longitude =  $request->input('longitude');

        $city  = $client->get("/cities?latitude={$latitude}&longitude={$longitude}");

        Session::put('cidade', $city);

        return response()->json($city);
    }


}
