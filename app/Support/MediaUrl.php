<?php

namespace App\Support;

class MediaUrl
{
    /**
     * Normalize any image URL or file path to work reliably on the current domain.
     * Strips placeholder or foreign hosts (e.g. 'https://your-domain.com/storage/...')
     * and converts relative paths into fully qualified dynamic asset URLs.
     */
    public static function normalize(?string $url): ?string
    {
        if (empty($url)) {
            return null;
        }

        $url = trim($url);

        // 1. Detect if the URL contains /storage/ with any foreign or placeholder host
        if (preg_match('#https?://[^/]+/storage/(.+)#i', $url, $matches)) {
            $subpath = ltrim($matches[1], '/');
            return self::resolveAssetPath($subpath, 'storage');
        }

        // 2. Detect if the URL contains /images/ with any foreign or placeholder host
        if (preg_match('#https?://[^/]+/images/(.+)#i', $url, $matches)) {
            $subpath = ltrim($matches[1], '/');
            return self::resolveAssetPath($subpath, 'images');
        }

        // 3. Handle root-relative /storage/ path
        if (str_starts_with($url, '/storage/') || str_starts_with($url, 'storage/')) {
            $subpath = preg_replace('#^/?storage/#', '', $url);
            return self::resolveAssetPath($subpath, 'storage');
        }

        // 4. Handle root-relative /images/ path
        if (str_starts_with($url, '/images/') || str_starts_with($url, 'images/')) {
            $subpath = preg_replace('#^/?images/#', '', $url);
            return self::resolveAssetPath($subpath, 'images');
        }

        // 5. Keep legitimate third-party external URLs (e.g. Unsplash or CDNs)
        if (preg_match('#^https?://#i', $url)) {
            return $url;
        }

        // 6. Default to asset URL
        return self::resolveAssetPath(ltrim($url, '/'), 'storage');
    }

    /**
     * Resolve whether an asset is located in public/images or public/storage/app/public.
     */
    private static function resolveAssetPath(string $subpath, string $preferredPrefix = 'storage'): string
    {
        $cleanSubpath = ltrim($subpath, '/');

        // Check if file exists in public/images/
        if (file_exists(public_path('images/' . $cleanSubpath))) {
            return asset('images/' . $cleanSubpath);
        }

        // Check if file exists in public/storage/
        if (file_exists(public_path('storage/' . $cleanSubpath))) {
            return asset('storage/' . $cleanSubpath);
        }

        // Check if file exists in storage/app/public/
        if (file_exists(storage_path('app/public/' . $cleanSubpath))) {
            return asset('storage/' . $cleanSubpath);
        }

        // Default fallback
        return asset($preferredPrefix . '/' . $cleanSubpath);
    }

    /**
     * Normalize an array of image URLs (for gallery images).
     */
    public static function normalizeArray($images): array
    {
        if (is_string($images)) {
            $decoded = json_decode($images, true);
            $images = is_array($decoded) ? $decoded : [$images];
        }

        if (!is_array($images)) {
            return [];
        }

        $normalized = [];
        foreach ($images as $img) {
            if ($resolved = self::normalize($img)) {
                $normalized[] = $resolved;
            }
        }

        return $normalized;
    }
}
