<?php

namespace App\Services;

use Google\Client as GoogleClient;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile as GoogleDriveFile;


use Illuminate\Http\Request;

class GoogleDriveService 
{
    protected $drive;
    protected $folderId;

    public function __construct()
    {
        $client = new GoogleClient();
        $client->setAuthConfig(storage_path('app/cred.json'));
        $client->addScope(Drive::DRIVE);
        $client->setHttpClient(new \GuzzleHttp\Client(['verify' => storage_path('app/cacert.pem')]));
        $this->drive = new Drive($client);
        $this->folderId ="1aiTI689p3CxV-ASBE1oNb1Ud9N6JnAF6";
    }

    public function uploadImage($filePath)
    {
        $fileMetadata = new GoogleDriveFile([
            'name' => basename($filePath),
            'parents' => [$this->folderId], 
        ]);

        $content = file_get_contents($filePath);

        $file = $this->drive->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => 'image/jpeg', 
            'uploadType' => 'multipart',
            'fields' => 'id',
        ]);
        return 'https://drive.google.com/thumbnail?id=' . $file->id;
    }

    public function deleteFile($url)
    {
        try {
            $fileId=($this->extractIdFromLink($url));
            $this->drive->files->delete($fileId);
            return true;
        } catch (\Exception $e) {
            // Xử lý lỗi
            return false;
        }
    }
    
    function extractIdFromLink($url)
    {
        preg_match('/[\/?]id=([^\&]+)/', $url, $matches);
        return isset($matches[1]) ? $matches[1] : null;
    }

    public function extractImageUrl($fileId)
{
    $file = $this->drive->files->get($fileId, ['fields' => 'webContentLink']);
    return $file->webContentLink;
}


}
