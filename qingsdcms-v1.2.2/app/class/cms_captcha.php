<?php
final class cms_captcha
{
    private $charset='abcdefghjkmnpqrstuvwxyz023456789';
    private $code;
    private $codelen=4;
    private $width=130;
    private $height=50;
    private $img;
    private $font;
    private $fontsize=20;
    private $fontcolor;

    public function __construct($w=130,$h=50,$s=25,$l=4)
    {
        $this->codelen=$l;
        $this->width=$w;
        $this->height=$h;
        $this->fontsize=$s;
        $this->font=SYS_PATH.'/public/fonts/elephant.ttf';
    }

    private function createCode()
    {
        $_len=strlen($this->charset)-1;
        for ($i=0;$i<$this->codelen;$i++)
        {
            $this->code.=$this->charset[mt_rand(0,$_len)];
        }
    }

    private function createBg()
    {
        $this->img=imagecreatetruecolor($this->width,$this->height);
        $color=imagecolorallocate($this->img,255,255,255);
        imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);
    }

    private function createFont()
    {
        $_x=$this->width/$this->codelen;
        for($i=0;$i<$this->codelen;$i++)
        {
            $this->fontcolor=imagecolorallocate($this->img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imagettftext($this->img,$this->fontsize,mt_rand(-30,30),intval($_x*$i+mt_rand(1,5)),intval($this->height/1.4),$this->fontcolor,$this->font,$this->code[$i]);
        }
    }

    private function createLine() 
    {
        for($i=0;$i<5;$i++)
        {
            $color=imagecolorallocate($this->img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);
        }
        for($i=0;$i<5;$i++)
        {
            $color=imagecolorallocate($this->img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
        }
    }

    private function outPut()
    {
        header('Content-type:image/png');
        imagepng($this->img);
        imagedestroy($this->img);
    }

    public function doimg()
    {
        $this->createBg();
        $this->createCode();
        $this->createLine();
        $this->createFont();
        $this->outPut();
    }

    public function getCode()
    {
        return strtolower(md5($this->code));
    }

}