<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 10:21
 */

sysLoadClass("DjUploadImage");


class AdminFormSystemImg extends DjReturnMsg
{
    public function __construct()
    {

    }

    public function croppic()
    {
        $this->jsonExit(DjUploadImage::croppic(DjRequest::post('imgUrl'), DjRequest::post('imgInitW'), DjRequest::post('imgInitH'), DjRequest::post('imgW'), DjRequest::post('imgH'), DjRequest::post('imgY1'), DjRequest::post('imgX1'), DjRequest::post('cropW'), DjRequest::post('cropH'), DjRequest::post('rotation')));
    }

    public function croppicTempUpload()
    {
        $this->jsonExit(DjUploadImage::croppicTemp($_FILES));
    }
}