<?php
/**
 * Created by PhpStorm.
 * User: nicof
 * Date: 24/03/2017
 * Time: 16:29
 */
namespace App\Http\Controllers\Validators;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ImageValidator
{
    protected $uploadOk = false;
    protected $extension;
    protected $target_dir;
    protected $hash_name;
    protected $target_file;
    protected $image_size;
    protected $file_type;
    protected $size;
    protected $types;

    public function __construct(Request $request, $filename)
    {
        $this->file =  $request->file($filename);
        $this->extension = '.'.$request->file($filename)->getClientOriginalExtension();
        $this->file_type = $request->file($filename)->getMimeType();
        $this->target_dir = base_path() . '\public\images\\';
        $this->hash_name = hash('md5',time() . $request->file($filename)->getClientOriginalName()). $this->extension;
        $this->target_file = $this->target_dir . $this->hash_name;
        $this->publicdir = 'public/images/'.$this->hash_name;
        $this->image_size = bcdiv($request->file($filename)->getSize()/1024,1,1);
    }
    public function getTargetFile()
    {
        return $this->target_file;
    }
    public function getHashName()
    {
        return $this->hash_name;
    }
    public function getPublicDir()
    {
        return $this->publicdir;
    }
    public function isBiggerThan($size = null)
    {
        if (is_null($size)) {
            $size = 2048;
        }
        $this->size = $size;
        return $this->image_size < $size;
    }
    public function isImage()
    {
        return substr($this->file_type, 0, 5) === 'image';
    }
    public function isInRequiredImagesTypes($types = null)
    {
        if (is_null($types)) {
            $types = ['png','jpg','jpeg'];
        }
        $this->types = $types;
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
    private function ifExistSetNewName()
    {
        while(file_exists($this->target_file)){
            $this->hash_name = hash('md5',$this->hash_name).$this->extension;
            $this->target_file = $this->target_dir . $this->hash_name;
        }
    }
    public function removeSpace()
    {
        $this->target_file = preg_replace('/\s+/', '', $this->target_file);
    }
    public function validateImage($types = null, $size = null)
    {
        if($this->isImage()) {
            if ($this->isInRequiredImagesTypes($types)) {
                if ($this->isBiggerThan($size)) {
                    $this->ifExistSetNewName();
                    $this->removeSpace();
                    $this->uploadOk = true;
                }
            }
        }
        return $this->uploadOk;
    }
    public function saveImage(){
        $this->file->move($this->target_dir, $this->hash_name);
        return true;
    }
    public function errorUpoad(){
        if(!$this->isBiggerThan()){
            throw new FileException(sprintf('La imagen "%s" no se ha podido subir porque el tamaño de esta es mayor que "%s"KB',
                $this->file->getClientOriginalName(), $this->size));
        }elseif(!$this->isImage()){
            throw new FileException('No se ha podido subir la imagen porque no es una imagen');
        }elseif (!$this->isInRequiredImagesTypes($this->types)){
            throw new FileException(sprintf('No se ha podido subir la imagen porque no es ta dentro de las extensiones permitidas %s', implode($this->types)));
        }
    }
}