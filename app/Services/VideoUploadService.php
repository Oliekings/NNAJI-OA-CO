<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoUploadService
{
    /**
     * Upload and compress video file, generating a poster thumbnail if ffmpeg is available.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @return array ['video_url' => string, 'video_thumbnail' => ?string]
     */
    public function uploadAndCompress(UploadedFile $file, string $folder = 'properties/videos'): array
    {
        $allowedExtensions = ['mp4', 'webm', 'mov', 'm4v', 'ogv', 'avi', '3gp'];
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, $allowedExtensions)) {
            throw new \InvalidArgumentException("Unsupported video format. Allowed formats: " . implode(', ', $allowedExtensions));
        }

        $filename = (string) Str::uuid();
        $cleanFolder = trim($folder, '/');
        
        // 1. Store raw file safely via Laravel Storage disk
        try {
            $storedFilename = $filename . '.' . $extension;
            $storedPath = $file->storeAs($cleanFolder, $storedFilename, 'public');
            $relativeVideoPath = '/storage/' . ltrim($storedPath, '/');
        } catch (\Throwable $e) {
            // Direct disk fallback
            $storageDir = storage_path('app/public/' . $cleanFolder);
            if (!is_dir($storageDir)) {
                @mkdir($storageDir, 0755, true);
            }
            $file->move($storageDir, $filename . '.' . $extension);
            $relativeVideoPath = '/storage/' . $cleanFolder . '/' . $filename . '.' . $extension;
        }

        // Mirror to public/images for hosts where symlinks are disabled
        $publicMirrorDir = public_path('images/' . $cleanFolder);
        if (!is_dir($publicMirrorDir)) {
            @mkdir($publicMirrorDir, 0755, true);
        }
        $fullStorageVideo = storage_path('app/public/' . $cleanFolder . '/' . $filename . '.' . $extension);
        if (file_exists($fullStorageVideo)) {
            @copy($fullStorageVideo, $publicMirrorDir . '/' . $filename . '.' . $extension);
        }

        $relativeThumbPath = null;
        $ffmpegPath = $this->findFfmpeg();

        // If ffmpeg is present, compress video and generate snapshot
        if ($ffmpegPath && file_exists($fullStorageVideo)) {
            try {
                $targetCompressed = storage_path('app/public/' . $cleanFolder . '/' . $filename . '-opt.mp4');
                $thumbTarget = storage_path('app/public/' . $cleanFolder . '/' . $filename . '-thumb.webp');

                $srcEscaped = escapeshellarg($fullStorageVideo);
                $targetEscaped = escapeshellarg($targetCompressed);
                $thumbEscaped = escapeshellarg($thumbTarget);

                // 1. Compress video with high-efficiency CRF 28 and max 1280px resolution
                $compressCmd = "{$ffmpegPath} -y -i {$srcEscaped} -vcodec libx264 -crf 28 -preset fast -vf \"scale='min(1280,iw)':-2\" -acodec aac -b:a 128k -movflags +faststart {$targetEscaped} 2>&1";
                @exec($compressCmd, $output, $resultCode);

                if ($resultCode === 0 && file_exists($targetCompressed) && filesize($targetCompressed) > 0) {
                    @unlink($fullStorageVideo);
                    @rename($targetCompressed, $fullStorageVideo);
                    @copy($fullStorageVideo, $publicMirrorDir . '/' . $filename . '.' . $extension);
                }

                // 2. Generate video poster snapshot at 1 second
                $thumbCmd = "{$ffmpegPath} -y -ss 00:00:01 -i {$srcEscaped} -vframes 1 -vf \"scale='min(1280,iw)':-2\" {$thumbEscaped} 2>&1";
                @exec($thumbCmd, $thumbOut, $thumbResult);

                if ($thumbResult === 0 && file_exists($thumbTarget)) {
                    $relativeThumbPath = '/storage/' . $cleanFolder . '/' . $filename . '-thumb.webp';
                    @copy($thumbTarget, $publicMirrorDir . '/' . $filename . '-thumb.webp');
                }
            } catch (\Throwable $e) {
                Log::warning('FFmpeg video optimization failed, retaining original: ' . $e->getMessage());
            }
        }

        return [
            'video_url' => $relativeVideoPath,
            'video_thumbnail' => $relativeThumbPath,
        ];
    }

    /**
     * Find the ffmpeg binary path on the system.
     */
    protected function findFfmpeg(): ?string
    {
        $commonPaths = [
            '/usr/bin/ffmpeg',
            '/usr/local/bin/ffmpeg',
            '/opt/homebrew/bin/ffmpeg',
            '/usr/local/share/ffmpeg',
        ];

        foreach ($commonPaths as $path) {
            if (@is_executable($path)) {
                return $path;
            }
        }

        // Try `which ffmpeg`
        $output = [];
        $returnCode = 1;
        @exec('which ffmpeg 2>/dev/null', $output, $returnCode);

        if ($returnCode === 0 && !empty($output[0]) && @is_executable(trim($output[0]))) {
            return trim($output[0]);
        }

        return null;
    }
}
