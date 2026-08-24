<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use InvalidArgumentException;

class ImageUploadService
{
    /**
     * Allowed image MIME types.
     */
    protected const ALLOWED_MIMES = [
        'image/jpeg',
        'image/png',
        'image/webp',
    ];

    /**
     * Strictly blocked extensions that could pose security risks.
     */
    protected const FORBIDDEN_EXTENSIONS = [
        'php', 'phtml', 'php3', 'php4', 'php5', 'php7', 'php8', 'phar', 'inc',
        'blade.php', 'exe', 'sh', 'bat', 'cmd', 'js', 'html', 'htm', 'svg', 'cgi', 'pl', 'py'
    ];

    /**
     * Securely validate, sanitize, optimize, and store an uploaded image.
     *
     * @param UploadedFile $file
     * @param string $directory Storage subdirectory (e.g. 'properties', 'team')
     * @param int $maxWidth Max allowable width in pixels (e.g. 1920 for banners, 800 for portraits)
     * @param int $quality Compression quality (0-100), default 82
     * @return string Publicly accessible relative storage URL
     * @throws InvalidArgumentException
     */
    public function uploadAndOptimize(UploadedFile $file, string $directory = 'properties', int $maxWidth = 1920, int $quality = 82): string
    {
        // 1. Validate file validity
        if (!$file->isValid()) {
            throw new InvalidArgumentException('Uploaded file is corrupted or incomplete.');
        }

        // 2. Strict file size cap (max 10MB input before optimization)
        if ($file->getSize() > 10 * 1024 * 1024) {
            throw new InvalidArgumentException('Image file size exceeds the 10MB limit.');
        }

        // 3. Check client extension against dangerous extensions
        $clientExtension = strtolower($file->getClientOriginalExtension());
        if (in_array($clientExtension, self::FORBIDDEN_EXTENSIONS, true)) {
            throw new InvalidArgumentException('Forbidden file extension detected. Executable or script files are strictly blocked.');
        }

        // 4. Verify true MIME type via finfo
        $realMime = $file->getMimeType();
        if (!in_array($realMime, self::ALLOWED_MIMES, true)) {
            throw new InvalidArgumentException("Invalid image format ($realMime). Only JPEG, PNG, and WebP images are permitted.");
        }

        // 5. Verify image integrity with getimagesize
        $imageInfo = @getimagesize($file->getRealPath());
        if ($imageInfo === false) {
            throw new InvalidArgumentException('The uploaded file is not a valid binary image.');
        }

        [$origWidth, $origHeight] = $imageInfo;
        if ($origWidth <= 0 || $origHeight <= 0) {
            throw new InvalidArgumentException('Invalid image dimensions.');
        }

        // 6. Load image resource into GD memory (strips any embedded malicious scripts/EXIF payloads)
        $sourceImage = match ($realMime) {
            'image/jpeg' => @imagecreatefromjpeg($file->getRealPath()),
            'image/png'  => @imagecreatefrompng($file->getRealPath()),
            'image/webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($file->getRealPath()) : false,
            default      => false,
        };

        if (!$sourceImage) {
            // Fallback attempt via imagecreatefromstring
            $rawContent = file_get_contents($file->getRealPath());
            $sourceImage = @imagecreatefromstring($rawContent);
            if (!$sourceImage) {
                throw new InvalidArgumentException('Unable to decode image data.');
            }
        }

        // 7. Calculate constrained dimensions
        if ($origWidth > $maxWidth) {
            $targetWidth = $maxWidth;
            $targetHeight = (int) round(($origHeight / $origWidth) * $maxWidth);
        } else {
            $targetWidth = $origWidth;
            $targetHeight = $origHeight;
        }

        // 8. Create canvas and resample
        $canvas = imagecreatetruecolor($targetWidth, $targetHeight);

        // Preserve alpha transparency for PNG / WebP
        imagealphablending($canvas, false);
        imagesavealpha($canvas, true);
        $transparent = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
        imagefilledrectangle($canvas, 0, 0, $targetWidth, $targetHeight, $transparent);
        imagealphablending($canvas, true);

        imagecopyresampled(
            $canvas,
            $sourceImage,
            0, 0, 0, 0,
            $targetWidth, $targetHeight,
            $origWidth, $origHeight
        );

        // 9. Generate randomized safe UUID filename
        $safeFilename = Str::uuid()->toString() . '.webp';
        $relativeStoragePath = trim($directory, '/') . '/' . $safeFilename;
        $absoluteDestinationPath = storage_path('app/public/' . $relativeStoragePath);

        // Ensure storage directory exists
        $dir = dirname($absoluteDestinationPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // 10. Save optimized WebP (or fallback JPEG if WebP unsupported)
        if (function_exists('imagewebp')) {
            imagewebp($canvas, $absoluteDestinationPath, $quality);
        } else {
            $safeFilename = Str::uuid()->toString() . '.jpg';
            $relativeStoragePath = trim($directory, '/') . '/' . $safeFilename;
            $absoluteDestinationPath = storage_path('app/public/' . $relativeStoragePath);
            imagejpeg($canvas, $absoluteDestinationPath, $quality);
        }

        // Free GD memory
        imagedestroy($sourceImage);
        imagedestroy($canvas);

        // Return public URL path
        return Storage::url($relativeStoragePath);
    }
}
