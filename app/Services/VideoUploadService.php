<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
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
        $storageDir = storage_path('app/public/' . trim($folder, '/'));
        
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0755, true);
        }

        $ffmpegPath = $this->findFfmpeg();
        $targetVideoPath = $storageDir . '/' . $filename . '.mp4';
        $relativeVideoPath = '/storage/' . trim($folder, '/') . '/' . $filename . '.mp4';
        $relativeThumbPath = null;

        if ($ffmpegPath && file_exists($file->getRealPath())) {
            $sourcePath = escapeshellarg($file->getRealPath());
            $escapedTarget = escapeshellarg($targetVideoPath);
            $thumbTarget = $storageDir . '/' . $filename . '-thumb.webp';
            $escapedThumb = escapeshellarg($thumbTarget);

            // 1. Compress video with high-efficiency CRF 28 and max 1280px resolution
            $compressCmd = "{$ffmpegPath} -y -i {$sourcePath} -vcodec libx264 -crf 28 -preset fast -vf \"scale='min(1280,iw)':-2\" -acodec aac -b:a 128k -movflags +faststart {$escapedTarget} 2>&1";
            exec($compressCmd, $output, $resultCode);

            // If compression succeeded and output file exists
            if ($resultCode === 0 && file_exists($targetVideoPath) && filesize($targetVideoPath) > 0) {
                // 2. Generate video poster snapshot at 1 second
                $thumbCmd = "{$ffmpegPath} -y -ss 00:00:01 -i {$escapedTarget} -vframes 1 -vf \"scale='min(1280,iw)':-2\" {$escapedThumb} 2>&1";
                exec($thumbCmd, $thumbOut, $thumbResult);

                if ($thumbResult === 0 && file_exists($thumbTarget)) {
                    $relativeThumbPath = '/storage/' . trim($folder, '/') . '/' . $filename . '-thumb.webp';
                }
            } else {
                // Fallback to storing raw file if ffmpeg compression command failed
                $file->move($storageDir, $filename . '.' . $extension);
                $relativeVideoPath = '/storage/' . trim($folder, '/') . '/' . $filename . '.' . $extension;
            }
        } else {
            // FFMPEG not present on system: store directly
            $file->move($storageDir, $filename . '.' . $extension);
            $relativeVideoPath = '/storage/' . trim($folder, '/') . '/' . $filename . '.' . $extension;
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
            if (is_executable($path)) {
                return $path;
            }
        }

        // Try `which ffmpeg`
        $output = [];
        $returnCode = 1;
        @exec('which ffmpeg 2>/dev/null', $output, $returnCode);

        if ($returnCode === 0 && !empty($output[0]) && is_executable(trim($output[0]))) {
            return trim($output[0]);
        }

        return null;
    }
}
