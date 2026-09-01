<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Property;
use App\Models\TeamMember;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageUploadAndSecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        Storage::fake('public');
    }

    public function test_admin_can_upload_and_optimize_property_image()
    {
        $admin = User::first();

        // Create a fake genuine image
        $imageFile = UploadedFile::fake()->image('luxury_office.jpg', 2400, 1600)->size(3000);

        $response = $this->actingAs($admin)->post(route('admin.properties.store'), [
            'title' => 'Secure Commercial Tower',
            'property_type' => 'Commercial',
            'listing_type' => 'for_sale',
            'price' => 850000000,
            'location_city' => 'Abuja',
            'location_state' => 'Abuja FCT',
            'description' => 'A premier commercial tower.',
            'status' => 'available',
            'featured_image_file' => $imageFile,
        ]);

        $response->assertRedirect(route('admin.properties.index'));
        $response->assertSessionHas('success');

        $property = Property::where('title', 'Secure Commercial Tower')->first();
        $this->assertNotNull($property);
        $this->assertNotNull($property->featured_image);
        $this->assertTrue(str_contains($property->featured_image, '/properties/'));
        $this->assertStringEndsWith('.webp', $property->featured_image);
    }

    public function test_uploading_php_file_is_strictly_blocked_and_rejected()
    {
        $admin = User::first();

        // Attempt to upload a malicious PHP script disguised as image or direct .php
        $maliciousFile = UploadedFile::fake()->create('exploit.php', 100, 'application/x-php');

        $response = $this->actingAs($admin)->post(route('admin.properties.store'), [
            'title' => 'Malicious Attempt',
            'property_type' => 'Commercial',
            'listing_type' => 'for_sale',
            'price' => 1000000,
            'location_city' => 'Kaduna',
            'location_state' => 'Kaduna State',
            'description' => 'Test description',
            'status' => 'available',
            'featured_image_file' => $maliciousFile,
        ]);

        // Must fail validation for mimes:jpeg,jpg,png,webp
        $response->assertSessionHasErrors('featured_image_file');
        $this->assertDatabaseMissing('properties', ['title' => 'Malicious Attempt']);
    }

    public function test_uploading_disguised_php_script_is_rejected_by_service()
    {
        $admin = User::first();

        // Malicious file with .jpg extension but containing PHP code (not a genuine binary image)
        $fakeJpgWithPhp = UploadedFile::fake()->createWithContent('backdoor.jpg', '<?php echo "pwned"; ?>');

        $response = $this->actingAs($admin)->post(route('admin.properties.store'), [
            'title' => 'Fake Image With Script',
            'property_type' => 'Commercial',
            'listing_type' => 'for_sale',
            'price' => 1000000,
            'location_city' => 'Kaduna',
            'location_state' => 'Kaduna State',
            'description' => 'Test description',
            'status' => 'available',
            'featured_image_file' => $fakeJpgWithPhp,
        ]);

        // Validation rejects because it's not a genuine image mime/binary
        $response->assertSessionHasErrors('featured_image_file');
    }

    public function test_admin_can_upload_team_avatar_optimized()
    {
        $admin = User::first();
        $avatar = UploadedFile::fake()->image('surveyor.png', 1200, 1200)->size(1500);

        $response = $this->actingAs($admin)->post(route('admin.team.store'), [
            'name' => 'ESV Samuel Okafor',
            'designation' => 'Senior Valuer',
            'bio' => 'Experienced registered estate surveyor.',
            'avatar_file' => $avatar,
        ]);

        $response->assertRedirect(route('admin.team.index'));
        $member = TeamMember::where('name', 'ESV Samuel Okafor')->first();
        $this->assertNotNull($member);
        $this->assertNotNull($member->avatar);
        $this->assertTrue(str_contains($member->avatar, '/team/'));
        $this->assertStringEndsWith('.webp', $member->avatar);
    }

    public function test_public_pages_do_not_contain_admin_or_cms_links()
    {
        $pages = ['/', '/properties', '/portfolio', '/services', '/about', '/team', '/contact'];

        foreach ($pages as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
            $response->assertDontSee('Staff Portal');
            $response->assertDontSee('CMS Portal');
            $response->assertDontSee('href="' . route('admin.login') . '"', false);
        }
    }
}
