<?php
/**
 * Created by PhpStorm.
 * User: nicof
 * Date: 24/03/2017
 * Time: 16:29
 */
namespace App\Http\Controllers\Validators;

use Illuminate\Http\Request;

class ImageValidator
{
    protected $uploadOk = false;
    protected $extension;
    protected $target_dir;
    protected $hash_name;
    protected $target_file;
    protected $image_size;
    protected $file_type;

    public function __construct(Request $request)
    {
        $this->extension = '.'.$request->file('fotoResum')->getClientOriginalExtension();
        $this->file_type = $request->file('fotoResum')->getMimeType();
        $this->target_dir = base_path() . '\public\img\image\\';
        $this->hash_name = hash('md5',time() . $request->file('fotoResum')->getClientOriginalName()). $this->extension;
        $this->target_file = $this->target_dir . $this->hash_name;
        $this->image_size = bcdiv($request->file('fotoResum')->getSize()/1024,1,1);
    }

    public function isBiggerThan($size =  2048)
    {
        return $this->image_size < $size;
    }
    public function isImage()
    {
        return substr($this->file_type, 0, 5) === 'image';
    }
    public function isInRequiredImagesTypes($types = ['png','jpg','jpeg'])
    {
        $valid = false;
        $extension = substr($this->extension,1);
        foreach ($types as $type){
            if($extension == $type){
                $valid = true;
                break;
            }
        }
        return $valid;
    }
    public function ifExistSetNewName()
    {
        while(file_exists($this->target_file)){
            $this->hash_name = hash('md5',$this->hash_name).$this->extension;
            $this->target_file = $this->target_dir . $this->hash_name;
        }
    }
    public function validateImage($types = null)
    {
        if ($types != null){
            $requiredimage = $this->isInRequiredImagesTypes($types);
        }else{
            $requiredimage = $this->isInRequiredImagesTypes();
        }
        if($this->isImage()) {
            if ($requiredimage) {
                if ($this->isBiggerThan()) {
                    $this->ifExistSetNewName();
                    $this->uploadOk = true;
                }
            }
        }
        return $this->uploadOk;
    }
}