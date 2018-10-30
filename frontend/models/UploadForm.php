<?php

namespace frontend\models;

namespace app\models;
use yii\imagine\Image;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('images/320-240/' .  $this->imageFile->baseName . '.' . $this->imageFile->extension);

            Image::thumbnail('images/' . $this->imageFile, 320, 240)
                ->save('images/' . $this->imageFile->baseName . '.' . $this->imageFile->extension,
                    ['quality' => 70]);
            unlink('images/320-240/' .  $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}