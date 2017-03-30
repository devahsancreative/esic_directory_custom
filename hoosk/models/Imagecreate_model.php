<?php

class Imagecreate_model extends CI_Model
{
    function __construct(){
        parent::__construct();
        $this->load->helper('cookie');  
    } 
    public function createimage($filewithpath){
        if($filewithpath){
          $ext = $this->Get_file_extension($filewithpath);
          $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filewithpath);
          $this->Resize_image(258, 206, 90, $filewithpath, $withoutExt.'_thumbnail_258.'.$ext);// for thumbnails 
          $this->Resize_image(60, 50, 90, $filewithpath, $withoutExt.'_icon_258.'.$ext); // for icons
        }

    }
    public function Resize_image($width = 0, $height = 0, $quality = 90, $filename_in = null, $filename_out = null){
      $this->Filename = $filename_in;
      $this->Extension = strtolower($this->Get_file_extension($this->Filename));

      $size = getimagesize($this->Filename);
      $ratio = $size[0] / $size[1];
      if ($ratio >= 1){
          $scale = $width / $size[0];
      } else {
          $scale = $height / $size[1];
      }
      // make sure its not smaller to begin with!
      if ($width >= $size[0] && $height >= $size[1]){
          $scale = 1;
      }

      // echo $fileext;
      switch ($this->Extension)
      {
          case "jpg":
              $im_in = imagecreatefromjpeg($this->Filename);
              $im_out = imagecreatetruecolor($size[0] * $scale, $size[1] * $scale);
              imagecopyresampled($im_out, $im_in, 0, 0, 0, 0, $size[0] * $scale, $size[1] * $scale, $size[0], $size[1]);
              imagejpeg($im_out, $filename_out, $quality);
          break;
          case "gif":
              $im_in = imagecreatefromgif($this->Filename);
              $im_out = imagecreatetruecolor($size[0] * $scale, $size[1] * $scale);
              imagecopyresampled($im_out, $im_in, 0, 0, 0, 0, $size[0] * $scale, $size[1] * $scale, $size[0], $size[1]);
              imagegif($im_out, $filename_out, $quality);
          break;
          case "png":
              $im_in = imagecreatefrompng($this->Filename);
              $im_out = imagecreatetruecolor($size[0] * $scale, $size[1] * $scale);
              imagealphablending($im_out, false); // setting alpha blending on
              imagesavealpha($im_out, true); // save alphablending setting (important)
              $transparent = imagecolorallocatealpha($im_out, 255, 255, 255, 127);
              imagefilledrectangle($im_out, 0, 0, $size[0] * $scale, $size[1] * $scale, $transparent);
              imagecopyresampled($im_out, $im_in, 0, 0, 0, 0, $size[0] * $scale, $size[1] * $scale, $size[0], $size[1]);
              imagepng($im_out, $filename_out, 9);
          break;
      }
      imagedestroy($im_out);
      imagedestroy($im_in);
      
    }
    public function Get_file_extension($filename){
       $filename = strtolower($filename) ;
       $exts = explode(".", $filename) ;
       $n = count($exts)-1;
       $exts = $exts[$n];
       return $exts;
    }
}