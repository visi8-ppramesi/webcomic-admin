<?php

namespace App\Services;

use App\Helpers\Uploader;
use App\Models\Chapter;

class ChapterService extends Service{
    public $pages = [];
    protected $model = Chapter::class;
    protected $fields = [
        "image_url",
        "comic_id",
        "chapter",
        "token_price",
        "token_price_ar",
        "release_date",
    ];

    public function savePreviewImage($base64File){
        $file = Uploader::saveBase64File($base64File, 'storage/media/previews/');
        $this->data['image_url'] = $file['pathname'];
    }
}
