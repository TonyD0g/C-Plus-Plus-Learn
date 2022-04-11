<?php
final class cms_image
{
    public function __construct(){}

    public function check()
    {
        return extension_loaded('gd');
    }

    public function file_array($file)
    {
        $info=@getimagesize($file);
        if($info&&is_array($info))
        {
            $arr[0]=$info[0];
            $arr[1]=$info[1];
            switch ($info[2])
            {
                case '1':
                    $a='imagecreatefromgif';
                    $b='imagegif';
                    break;
                case '2':
                    $a='imagecreatefromjpeg';
                    $b='imagejpeg';
                    break;
                case '3':
                    $a='imagecreatefrompng';
                    $b='imagepng';
                    break;
                default:
                    return '';
                    break;
            }
            $arr[2]=$a;
            $arr[3]=$b;
            $arr[4]=$info[2];
            return $arr;
        }
        else
        {
            return '';
        } 
    }

    public function get_postion($a,$source,$water)
    {
        if($a=='0'){$a=mt_rand(1,9);}
        switch ($a) 
        {
            case '1':
                $x=0;
                $y=0;
                break;
            case '2':
                $x=($source[0]-$water[0])/2;
                $y=0;
                break;
            case '3': 
                $x=$source[0]-$water[0];
                $y=0;
                break;
            case '4':
                $x=0;
                $y=($source[1]-$water[1])/2;
                break;
            case '5':
                $x=($source[0]-$water[0])/2;
                $y=($source[1]-$water[1])/2;
                break;
            case '6':
                $x=$source[0]-$water[0];
                $y=($source[1]-$water[1])/2;
                break;
            case '7':
                $x=0;
                $y=$source[1]-$water[1];
                break;
            case '8':
                $x=($source[0]-$water[0])/2;
                $y=$source[1]-$water[1];
                break;
            case '9': 
                $x=$source[0]-$water[0];
                $y=$source[1]-$water[1];
                break;                
        }
        $arr[0]=$x;
        $arr[1]=$y;
        return $arr;
    }

    #生成缩略图
    public function thumb($old,$width=200,$height=200,$new=null)
    {
        if(!self::check())
        {
            return WEB_ROOT.$old;
        }
        if(isempty($new)){$new=$old;}
        $info=$this->file_array($old);
        if(is_array($info))
        {
            $createtype=$info[2];
            $savetype=$info[3];
        }
        else
        {
            return WEB_ROOT.$old;
        }
    
        if($info[0]<$width&&$info[1]<$height)
        {
            return WEB_ROOT.$old;
        }

        $ww=$info[0]/$width;
        $hh=$info[1]/$height;
        if($ww>$hh)
        {
            $w=$width;
            $h=(int)($info[1]/$ww);
        }
        else
        {
            $h=$height;
            $w=(int)($info[0]/$hh);
        }

        $cut=imagecreatetruecolor($width,$height);
        $source=$createtype($old);
        #修复png压缩后背景变黑的bug
        imagealphablending($cut,false);//这里很重要,意思是不合并颜色,直接用$cut图像颜色替换,包括透明色;
        imagesavealpha($cut,true);//这里很重要,意思是不要丢了$cut图像的透明色;
        #修复结束
        imagecopyresampled($cut,$source,0,0,0,0,$w,$h,$info[0],$info[1]);
        $final_image=imagecreatetruecolor($width,$height);
        
        $color=imagecolorallocate($final_image,255,255,255);
        imagefill($final_image,0,0,$color);

        $x=round(($width-$w)/2);
        $y=round(($height-$h)/2);
        imagecopy($final_image,$cut,$x,$y,0,0,$w,$h);
        $info_new=$this->file_array($old);
        $num=($info_new[3]=='imagepng')?9:100;
        $savetype($final_image,$new,$num);

        imagedestroy($final_image);
        imagedestroy($cut);
        return WEB_ROOT.$new;
    }

    #原图等比压缩
    public function create_thumb($old,$width=600)
    {
        if(!self::check())
        {
            return;
        }
        $info=$this->file_array($old);
        if(is_array($info))
        {
            $createtype=$info[2];
            $savetype=$info[3];
            if($info[0]<$width){return;}
            $w=$width;
            $h=intval($info[1]/($info[0]/$width));
            $cut=imagecreatetruecolor($w,$h);
            $source=$createtype($old);
            #修复png压缩后背景变黑的bug
            imagealphablending($cut,false);//这里很重要,意思是不合并颜色,直接用$cut图像颜色替换,包括透明色;
            imagesavealpha($cut,true);//这里很重要,意思是不要丢了$cut图像的透明色;
            #修复结束
            imagecopyresampled($cut,$source,0,0,0,0,$w,$h,$info[0],$info[1]);
            $num=($savetype=='imagepng')?9:100;
            $savetype($cut,$old,$num);
            imagedestroy($cut);
        }    
    }

    #添加水印
    public function watermark($old)
    {
        if(isempty(C('water_logo'))){return;}
        $watermark=SYS_PATH.C('water_logo');
        if(!self::check()){return;}
        if(!file_exists($watermark)){return;}
        $source=$this->file_array($old);
        $water=$this->file_array($watermark);
        if(is_array($source)&&is_array($water))
        {
            $createtype=$source[2];
            $savetype=$source[3];
            if($source[0]<C('water_width')||$source[1]<C('water_height')){return;}
            #原图小于水印图片则不加
            if($source[0]<$water[0]||$source[1]<$water[1]){return;}
            $water_img=$water[2]($watermark);
            $source_img=$source[2]($old);
            $postion=$this->get_postion(C('water_position'),$source,$water);
            $x=$postion[0];
            $y=$postion[1];
            $opacity=C('water_opacity');
            if($water[4]!='3')
            {
                imagecopymerge($source_img,$water_img,$x,$y,0,0,$water[0],$water[1],$opacity);
            }
            else
            {
                $color=imagecolorallocatealpha($water_img,137,137,137,100-$opacity);
                imagelayereffect($water_img,IMG_EFFECT_OVERLAY);
                imagefilledrectangle($water_img,0,0,$water[0],$water[1],$color);
                imagealphablending($water_img, true);
                imagecopy($source_img, $water_img,$x,$y,0,0,$water[0],$water[1]);
            }
            $tmd=($source[3]=='imagepng')?9:100;
            $source[3]($source_img,$old,$tmd);
        }
    }

}