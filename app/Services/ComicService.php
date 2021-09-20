<?php

namespace App\Services;

use App\Helpers\Uploader;
use App\Models\Comic;

class ComicService extends Service{
    public $chapters = [];
    protected $model = Comic::class;
    protected $fields = [
        "title",
        "description",
        "tags",
        "genres",
        "cover_url",
        "release_date",
        "is_draft",
    ];

    public function saveCoverImage($base64File){
        $file = Uploader::saveBase64File($base64File, 'storage/media/covers/');
        $this->data['cover_url'] = $file['pathname'];
    }

    public function createComicWithChaptersPages($data){
        //we create the comic first
        $this->setData($data);
        if(!empty($data['base64_cover'])){
            $this->saveCoverImage($data['base64_cover']);
        }
        $this->create();
        $chapters = $data['chapters'];
        foreach($chapters as $chapter){
            $cptSvc = new ChapterService();
            $chapter['comic_id'] = $this->record->id;
            $cptSvc->setData($chapter);
            if(!empty($chapter['base64_preview'])){
                $cptSvc->savePreviewImage($chapter['base64_preview']);
            }
            $cptSvc->create();
            $pages = $chapter['pages'];
            foreach($pages as $page){
                $pgSvc = new PageService();
                $page['chapter_id'] = $cptSvc->record->id;
                $page['comic_id'] = $this->record->id;
                $pgSvc->setData($page);
                if(!empty($page['base64_page'])){
                    $pgSvc->savePageImage($page['base64_page']);
                }
                $pgSvc->create();
                $cptSvc->pages[] = $pgSvc;
            }
            $this->chapters[] = $cptSvc;
        }
    }
}
