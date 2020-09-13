<?php


namespace App\Helpers;


use PHPStamp\Document\WordDocument;
use PHPStamp\Templator;
use Storage;

class FileHelper
{
    private Templator $templator;

    public function setCache(string $cacheDir)
    {
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir);
        }
        $this->templator = new Templator($cacheDir);
    }

    public function getFile(string $templatePath, array $data): string
    {
        $document = new WordDocument($templatePath);

        $rendered = $this->templator->render($document, $data);
        $filename = uniqid((string)time(), true) . '.docx';
        $rendered->save(\Storage::path(''), $filename);
        $result = base64_encode(file_get_contents(Storage::path($filename)));
        @unlink(Storage::path($filename));

        return $result;
    }
}