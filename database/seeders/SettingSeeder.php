<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'Laravel Blog CMS',
            ],
            [
                'key' => 'site_description',
                'value' => 'A powerful multi-author blog built with Laravel',
            ],
            [
                'key' => 'site_email',
                'value' => 'admin@blog.com',
            ],
            [
                'key' => 'site_url',
                'value' => 'https://blog.example.com',
            ],
            [
                'key' => 'site_logo',
                'value' => '/images/logo.png',
            ],
            [
                'key' => 'site_favicon',
                'value' => '/images/favicon.ico',
            ],
            [
                'key' => 'posts_per_page',
                'value' => 10,
            ],
            [
                'key' => 'comments_enabled',
                'value' => true,
            ],
            [
                'key' => 'comment_approval_required',
                'value' => true,
            ],
            [
                'key' => 'social_links',
                'value' => [
                    'twitter' => 'https://twitter.com/blog',
                    'facebook' => 'https://facebook.com/blog',
                    'github' => 'https://github.com/blog',
                    'linkedin' => 'https://linkedin.com/company/blog',
                ],
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'laravel, blog, cms, php, web development',
            ],
            [
                'key' => 'meta_description',
                'value' => 'A modern blog CMS built with Laravel featuring multi-author support',
            ],
            [
                'key' => 'google_analytics_id',
                'value' => null,
            ],
            [
                'key' => 'maintenance_mode',
                'value' => false,
            ],
            [
                'key' => 'allowed_file_types',
                'value' => ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'],
            ],
            [
                'key' => 'max_file_size',
                'value' => 5, // in MB
            ],
            [
                'key' => 'default_user_role',
                'value' => 'Writer',
            ],
            [
                'key' => 'auto_approve_comments',
                'value' => false,
            ],
            [
                'key' => 'recaptcha_enabled',
                'value' => false,
            ],
            [
                'key' => 'contact_email',
                'value' => 'contact@blog.com',
            ],
            [
                'key' => 'header_scripts',
                'value' => null,
            ],
            [
                'key' => 'footer_scripts',
                'value' => null,
            ],
            [
                'key' => 'custom_css',
                'value' => null,
            ],
            [
                'key' => 'theme',
                'value' => 'default',
            ],
            [
                'key' => 'timezone',
                'value' => 'UTC',
            ],
            [
                'key' => 'date_format',
                'value' => 'F j, Y',
            ],
            [
                'key' => 'time_format',
                'value' => 'g:i A',
            ],
            [
                'key' => 'language',
                'value' => 'en',
            ],
            [
                'key' => 'admin_email',
                'value' => 'admin@blog.com',
            ],
            [
                'key' => 'notification_emails',
                'value' => ['admin@blog.com'],
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }

        $this->command->info('Settings seeded successfully!');
    }
}