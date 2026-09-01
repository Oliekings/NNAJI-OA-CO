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
        // e.g. https://your-domain.com/storage/properties/abc.webp or http://localhost/storage/team/xyz.webp
        if (preg_match('#https?://[^/]+/storage/(.+)#i', $url, $matches)) {
            return asset('storage/' . ltrim($matches[1], '/'));
        }

        // 2. Detect if the URL contains /images/ with any foreign or placeholder host
        if (preg_match('#https?://[^/]+/images/(.+)#i', $url, $matches)) {
            return asset('images/' . ltrim($matches[1], '/'));
        }

        // 3. Handle root-relative /storage/ path
        if (str_starts_with($url, '/storage/') || str_starts_with($url, 'storage/')) {
            $cleaned = preg_replace('#^/?storage/#', '', $url);
            return asset('storage/' . ltrim($cleaned, '/'));
        }

        // 4. Handle root-relative /images/ path
        if (str_starts_with($url, '/images/') || str_starts_with($url, 'images/')) {
            $cleaned = preg_replace('#^/?images/#', '', $url);
            return asset('images/' . ltrim($cleaned, '/'));
        }

        // 5. Keep legitimate third-party external URLs (e.g. Unsplash or CDNs)
        if (preg_match('#^https?://#i', $url)) {
            return $url;
        }

        // 6. Default to asset URL
        return asset(ltrim($url, '/'));
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
