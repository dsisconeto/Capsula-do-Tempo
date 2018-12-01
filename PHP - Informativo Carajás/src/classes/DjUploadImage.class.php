<?php

use Intervention\Image\ImageManagerStatic as Image;
use grandt\ResizeGif\ResizeGif;

class DjUploadImage
{
    public static function moveImage($nameImage, $folder, $tempFile, $width, $height)
    {
        // verificando se o arquivo existe

        if (file_exists($tempFile) && (filesize($tempFile) > 1) && strlen($tempFile) >= 1 && self::isImage($nameImage)) {
            // carregando imagem

            $loadImg = Image::make($tempFile);


            $image['name'] = $nameImage;
            // destinos
            $image['lg']['destiny'] = "img/$folder/lg/$nameImage";
            $image['md']['destiny'] = "img/$folder/md/$nameImage";
            $image['sm']['destiny'] = "img/$folder/sm/$nameImage";
            $image['xs']['destiny'] = "img/$folder/xs/$nameImage";
            $image['xxs']['destiny'] = "img/$folder/xxs/$nameImage";
            // novos tamanhos
            $image["lg"]["width"] = intval($width);
            $image["lg"]["height"] = intval($height);

            $image["md"]["width"] = intval($width * 0.70);
            $image["md"]["height"] = intval($height * 0.70);

            $image["sm"]["width"] = intval($width * 0.50);
            $image["sm"]["height"] = intval($height * 0.50);

            $image["xs"]["width"] = intval($width * 0.25);
            $image["xs"]["height"] = intval($height * 0.25);

            $image["xxs"]["width"] = intval($width * 0.15);
            $image["xxs"]["height"] = intval($height * 0.15);
            // criando novos arquivos com tamanhos diferentes

            if (self::getExtension($tempFile) == "gif") {

                copy($tempFile, $image['lg']['destiny']);

            } else {


                Image::make($tempFile)->resize($image["lg"]["width"], $image["lg"]["height"])->crop($image["lg"]["width"], $image["lg"]["height"])
                    ->save($image['lg']['destiny']);
            }


            //MD
            Image::make($tempFile)->resize($image["md"]["width"], $image["md"]["height"])->crop($image["md"]["width"], $image["md"]["height"])
                ->save($image['md']['destiny']);

            Image::make($tempFile)->resize($image["sm"]["width"], $image["sm"]["height"])->crop($image["sm"]["width"], $image["sm"]["height"])
                ->save($image['sm']['destiny']);

            Image::make($tempFile)->resize($image["xs"]["width"], $image["xs"]["height"])->crop($image["xs"]["width"], $image["xs"]["height"])
                ->save($image['xs']['destiny']);


            Image::make($tempFile)->resize($image["xxs"]["width"], $image["xxs"]["height"])->crop($image["xxs"]["width"], $image["xxs"]["height"])
                ->save($image['xxs']['destiny']);


            self::deleteFile($tempFile);
            return $image;
        } else {
            self::deleteImgTemp($tempFile);
            return false;
        }
    }

    public static function deleteFile($file)
    {
        if (file_exists($file)) {
            unlink($file);
        }
    }

    public static function upload($file, $folder, $width, $height)
    {
        // validando se é uma imagem
        if (self::isFile($file) && self::isImage($file)) {
            $extension = self::getExtension($file);
            // gerando nome aleatorio
            $name = md5(uniqid(time())) . "." . $extension;
            // criando destino temporio
            $tempFile = "img/temp/$name";

            if (move_uploaded_file($file["tmp_name"], $tempFile)) {

                return self::moveImage($name, $folder, $tempFile, $width, $height);
            } else {
                return false;
            }


        } else {
            return false;
        }

    }

    public static function deleteImgTemp($name)
    {
        $temp = "img/temp/$name";
        if (strlen($name) && file_exists($temp)) {
            unlink($temp);
        }

    }

    public static function croppicFinish($tempFile, $folder, $width, $height)
    {

        $tempFile = str_replace(DjWork::getHost(), "", $tempFile);
        $name = explode("/", $tempFile);
        $name = isset($name[2]) ? $name[2] : $name[1];

        return self::moveImage($name, $folder, $tempFile, $width, $height);
    }


    public static function croppicTemp($file)
    {
        /*
   *	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
   */
        $imagePath = "img/temp/";

        $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
        $temp = explode(".", $file["img"]["name"]);
        $extension = end($temp);

        //Check write Access to Directory

        if (!is_writable($imagePath)) {
            $response = Array(
                "status" => 'error',
                "message" => 'Can`t upload File; no write Access'
            );

            return $response;
        }

        if (in_array($extension, $allowedExts)) {
            if ($file["img"]["error"] > 0) {
                $response = array(
                    "status" => 'error',
                    "message" => 'ERROR Return Code: ' . $file["img"]["error"],
                );
            } else {

                $filename = $file["img"]["tmp_name"];
                list($width, $height) = getimagesize($filename);

                move_uploaded_file($filename, $imagePath . $file["img"]["name"]);

                $response = array(
                    "status" => 'success',
                    "url" => $imagePath . $file["img"]["name"],
                    "width" => $width,
                    "height" => $height
                );

            }
        } else {
            $response = array(
                "status" => 'error',
                "message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
            );
        }

        return $response;
    }


    public static function croppic($imgUrl, $imgInitW, $imgInitH, $imgW, $imgH, $imgY1, $imgX1, $cropW, $cropH, $angle)
    {

        $jpeg_quality = 100;

        $output_filename = "img/temp/" . md5(uniqid(time()));

// uncomment line below to save the cropped image in the same location as the original image.
//$output_filename = dirname($imgUrl). "/croppedImg_".rand();

        $what = getimagesize($imgUrl);

        switch (strtolower($what['mime'])) {
            case 'image/png':
                $img_r = imagecreatefrompng($imgUrl);
                $source_image = imagecreatefrompng($imgUrl);
                $type = '.png';
                break;
            case 'image/jpeg':
                $img_r = imagecreatefromjpeg($imgUrl);
                $source_image = imagecreatefromjpeg($imgUrl);
                error_log("jpg");
                $type = '.jpeg';
                break;
            case 'image/gif':
                $img_r = imagecreatefromgif($imgUrl);
                $source_image = imagecreatefromgif($imgUrl);
                $type = '.gif';
                break;
            default:
                die('image type not supported');
        }


//Check write Access to Directory

        if (!is_writable(dirname($output_filename))) {
            $response = Array(
                "status" => 'error',
                "message" => 'Can`t write cropped File'
            );
        } else {

            // resize the original image to size of editor
            $resizedImage = imagecreatetruecolor($imgW, $imgH);
            imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
            // rotate the rezized image
            $rotated_image = imagerotate($resizedImage, -$angle, 0);
            // find new width & height of rotated image
            $rotated_width = imagesx($rotated_image);
            $rotated_height = imagesy($rotated_image);
            // diff between rotated & original sizes
            $dx = $rotated_width - $imgW;
            $dy = $rotated_height - $imgH;
            // crop rotated image to fit into original rezized rectangle
            $cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
            imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
            imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
            // crop image into selected area
            $final_image = imagecreatetruecolor($cropW, $cropH);
            imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
            imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
            // finally output png image
            //imagepng($final_image, $output_filename.$type, $png_quality);
            imagejpeg($final_image, $output_filename . $type, $jpeg_quality);
            $response = Array(
                "status" => 'success',
                "url" => DjWork::getHost() . $output_filename . $type
            );
        }

        return $response;


    }

    public static function uploadBase64($imagem, $folder, $widthMax, $heightMax)
    {
        // Exemplo: data:image/png;base64,AAAFBfj42Pj4


        // Separando tipo dos dados da imagem
        // $tipo: data:image/png
        // $dados: base64,AAAFBfj42Pj4
        list($tipo, $dados) = explode(';', $imagem);

        // Isolando apenas o tipo da imagem
        // $tipo: image/png
        list(, $tipo) = explode(':', $tipo);

        // Isolando apenas os dados da imagem
        // $dados: AAAFBfj42Pj4
        list(, $dados) = explode(',', $dados);

        // Convertendo base64 para imagem
        $dados = base64_decode($dados);
        // Gerando nome aleatório para a imagem
        $nome = md5(uniqid(time())) . ".jpg";
        $tempFile = "img/temp/{$nome}";
        // Salvando imagem em disco
        file_put_contents($tempFile, $dados);

        return self::moveImage($nome, $folder, $tempFile, $widthMax, $heightMax);

    }


    private static function isImage($file)
    {
        $extension = self::getExtension($file);
        $extensions = array("gif", "jpeg", "jpg", "png");

        if (in_array($extension, $extensions)):
            return true;
        else:
            return false;
        endif;


    }

    private static function isFile($file)
    {
        return (isset($file["name"]) && $file["tmp_name"]);
    }


    private static function getExtension($file)
    {
        // retorna a extensao da img
        $file = isset($file["name"]) ? $file["name"] : $file;
        $nome = explode('.', $file);
        $nome = end($nome);
        return strtolower($nome);
    }


}