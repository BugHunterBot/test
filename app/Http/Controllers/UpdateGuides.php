<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

class UpdateGuides extends Controller
{
    public function __construct()
    {
        $this->middleware(['demo'])->only(['runUpdatedCommand']);
    }

    public function index()
    {
        return view('backend.update_guides');
    }

    public function runUpdatedCommand()
    {
        try {
            // Step 0: Run migrations before DB statements
            Artisan::call('migrate', ['--force' => true]);

            // Step 1: Clear cachesy
            Artisan::call('cache:clear');
            Artisan::call('optimize:clear');

            // Step 2: DB inserts
            DB::beginTransaction();

            // Step 3: Alter post_seo_onpages table (for meta fields)
            DB::statement("
                ALTER TABLE `post_seo_onpages`
                MODIFY COLUMN `meta_keyword` VARCHAR(255) NULL,
                MODIFY COLUMN `meta_description` TEXT NULL;
            ");

            // Insert / update google recaptcha setting
            DB::statement("INSERT INTO `settings` (`id`, `event`, `details`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) 
                VALUES 
                (122, 'custom_code', '{\"tags\":\"\",\"status\":0}', NULL, 1, '2025-09-16 22:43:25', '2025-09-16 22:43:25', NULL)
                ON DUPLICATE KEY UPDATE 
                `details` = VALUES(`details`), `updated_by` = VALUES(`updated_by`), `updated_at` = VALUES(`updated_at`);
            ");

            DB::statement("UPDATE `settings` SET `details` = '{
                \"alert_title\": \"We value your privacy!\",
                \"alert_content\": \"We use cookies to improve your experience, deliver personalized content and ads, and analyze our traffic. By continuing to browse our site, you agree to our use of cookies.\",
                \"page_title\": \"Cookie Policy\",
                \"page_url\": \"https://latestnews365.bdtask-demo.com/privacy-policy\",
                \"cookie_duration\": \"10\",
                \"show_cookie\": 1
            }' WHERE `event` = 'cookie_content'");

            DB::statement("
                INSERT INTO `themes` (
                    `id`, `name`, `image_path`, `background_color`, `text_color`, `font_family`, `font_size`, `footer_color`, `hover_color`, 
                    `hero_title`, `hero_description`, `is_default`, `is_active`, `updated_by`, `created_at`, `updated_at`
                ) VALUES 
                    (7, 'Penmark', 'backend/img/themes/7.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, '2025-09-02 11:06:05', '2025-09-17 07:30:29'),
                    (8, 'Storylane', 'backend/img/themes/8.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, '2025-09-09 11:06:05', '2025-09-17 07:30:29'),
                    (9, 'Wordcraft', 'backend/img/themes/9.png', NULL, NULL, NULL, NULL, NULL, NULL, 
                        'News365 Stories, Journeys, and Ideas for the Creatively Curious', 
                        'Explore the latest trends, insights, and perspectives from the world of news and media. Stay informed and inspired with our curated collection of articles, videos, and multimedia content.', 
                        1, 1, 1, '2025-09-10 11:06:05', '2025-09-17 07:30:29'
                    )
                ON DUPLICATE KEY UPDATE 
                    `image_path` = VALUES(`image_path`),
                    `hero_title` = VALUES(`hero_title`),
                    `hero_description` = VALUES(`hero_description`),
                    `is_default` = VALUES(`is_default`),
                    `is_active` = VALUES(`is_active`),
                    `updated_by` = VALUES(`updated_by`),
                    `updated_at` = VALUES(`updated_at`);
            ");

            // Insert / update menu items
            $menuItems = [
                [
                    'uuid'          => '',
                    'parentmenu_id' => 26,
                    'lable'         => 0,
                    'menu_name'     => 'Custom Code',
                    'created_by'    => null,
                    'updated_by'    => null,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                    'deleted_at'    => null,
                ],
            ];

            foreach ($menuItems as $item) {
                // Insert or update by menu_name (or another unique field you prefer)
                DB::table('per_menus')->updateOrInsert(
                    ['menu_name' => $item['menu_name']],
                    $item
                );

                // Fetch the actual auto-increment ID
                $menuId = DB::table('per_menus')
                    ->where('menu_name', $item['menu_name'])
                    ->value('id');

                // Define permission actions dynamically
                $actions = ['create', 'update', 'read', 'delete'];

                foreach ($actions as $action) {
                    DB::table('permissions')->updateOrInsert(
                        ['name' => "{$action}_custom_code", 'guard_name' => 'web'],
                        [
                            'name'        => "{$action}_custom_code",
                            'guard_name'  => 'web',
                            'per_menu_id' => $menuId,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ]
                    );
                }
            }

            DB::commit();

            return redirect('admin/update/guides')->with('success', localize('update_completed_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Update command failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect('admin/update/guides')
                ->with('fail', localize('update_failed'));
        }
    }
}
