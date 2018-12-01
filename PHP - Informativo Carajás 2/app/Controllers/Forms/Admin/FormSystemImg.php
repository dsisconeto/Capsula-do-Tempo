<?php

namespace App\Controllers\Forms\Admin;

use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;
use DSisconeto\Simple\UploadImage;
use App\Models\User\Login;

class FormSystemImg extends Form
{
    public function __construct()
    {
        Login::validateServices(Request::cookie("jwt"));
    }

    public function croppic()
    {
        $this->jsonExit(UploadImage::croppic(Request::post('imgUrl'), Request::post('imgInitW'), Request::post('imgInitH'), Request::post('imgW'), Request::post('imgH'), Request::post('imgY1'), Request::post('imgX1'), Request::post('cropW'), Request::post('cropH'), Request::post('rotation')));
    }

    public function croppicTempUpload()
    {
        $this->jsonExit(UploadImage::croppicTemp($_FILES));
    }
}