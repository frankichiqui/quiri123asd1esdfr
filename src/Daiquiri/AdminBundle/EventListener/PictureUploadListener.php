<?php

namespace Daiquiri\AdminBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Daiquiri\AdminBundle\Entity\DUser;
use Daiquiri\AdminBundle\Uploads\FileUploader;

class PictureUploadListener {

    private $uploader;

    public function __construct(FileUploader $uploader) {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args) {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity) {
        // upload only works for User entities
        if (!$entity instanceof DUser) {
            return;
        }

        $file = $entity->getPicture();

        // only upload new files
        if (!$file instanceof UploadedFile) {
            return;
        }

        $fileName = $this->uploader->upload($file);
        $entity->setPicture($fileName);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

}
