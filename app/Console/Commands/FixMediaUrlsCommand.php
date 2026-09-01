<?php

namespace App\Console\Commands;

use App\Models\Property;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixMediaUrlsCommand extends Command
{
    protected $signature = 'media:fix-urls';
    protected $description = 'Clean all dummy domain URLs (e.g. your-domain.com) in database records into root-relative storage paths';

    public function handle()
    {
        $this->info('Scanning and sanitizing media URLs in database...');

        $updatedProperties = 0;
        foreach (DB::table('properties')->get() as $prop) {
            $changed = false;
            $updates = [];

            if (!empty($prop->featured_image) && preg_match('#https?://[^/]+/storage/(.+)#i', $prop->featured_image, $m)) {
                $updates['featured_image'] = '/storage/' . ltrim($m[1], '/');
                $changed = true;
            }

            if (!empty($prop->gallery_images)) {
                $gallery = json_decode($prop->gallery_images, true);
                if (is_array($gallery)) {
                    $cleanedGallery = [];
                    foreach ($gallery as $g) {
                        if (preg_match('#https?://[^/]+/storage/(.+)#i', $g, $m)) {
                            $cleanedGallery[] = '/storage/' . ltrim($m[1], '/');
                            $changed = true;
                        } else {
                            $cleanedGallery[] = $g;
                        }
                    }
                    if ($changed) {
                        $updates['gallery_images'] = json_encode($cleanedGallery);
                    }
                }
            }

            if ($changed) {
                DB::table('properties')->where('id', $prop->id)->update($updates);
                $updatedProperties++;
            }
        }

        $updatedTeam = 0;
        foreach (DB::table('team_members')->get() as $member) {
            if (!empty($member->avatar) && preg_match('#https?://[^/]+/storage/(.+)#i', $member->avatar, $m)) {
                DB::table('team_members')->where('id', $member->id)->update([
                    'avatar' => '/storage/' . ltrim($m[1], '/'),
                ]);
                $updatedTeam++;
            }
        }

        $updatedServices = 0;
        foreach (DB::table('services')->get() as $service) {
            if (!empty($service->featured_image) && preg_match('#https?://[^/]+/storage/(.+)#i', $service->featured_image, $m)) {
                DB::table('services')->where('id', $service->id)->update([
                    'featured_image' => '/storage/' . ltrim($m[1], '/'),
                ]);
                $updatedServices++;
            }
        }

        $this->info("Done! Sanitized {$updatedProperties} properties, {$updatedTeam} team members, and {$updatedServices} services.");
        return 0;
    }
}
