<?php

namespace App\Helper;

use Exception;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\NamerInterface;
//use Vich\UploaderBundle\Util\Transliterator;

class DownloadFileNamer implements NamerInterface {

    //private Transliterator $transliterate;

    //function __construct (Transliterator $transliterate) {
    //    $this->transliterate = $transliterate;
    //}

    /**
     * @param object $object
     * @param \Vich\UploaderBundle\Mapping\PropertyMapping $mapping
     *
     * @return string
     * @throws \Exception
     */
    function name ($object, PropertyMapping $mapping): string {
        $file = $mapping->getFile($object);
        $originalName = $file->getClientOriginalName();
       // $originalName = $this->transliterate->transliterate($originalName);
        $originalExtension = strtolower(\pathinfo($originalName, PATHINFO_EXTENSION));
        $originalBasename = pathinfo($originalName, PATHINFO_FILENAME);
        $smartName = sprintf('%s%s', $originalBasename, $originalExtension);

        if (strlen($smartName) <= 255) {
            return $smartName;
        }
        throw new Exception("file name is to long");
    }
}

