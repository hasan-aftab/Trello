<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Column;
use App\Models\User;
use Illuminate\Database\Seeder;

class ColumnCardSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'hasanaftab007@gmail.com')->first();
        $userId = $user ? $user->id : 1;

        $columns = [
            ['title' => 'Backlog', 'cards' => [
                ['title' => 'Implement Dark Mode', 'description' => 'Add tailwind dark mode toggling across the entire dashboard.', 'activity' => 'Design'],
                ['title' => 'Stripe Webhook Integration', 'description' => 'Handle subscription cancellation webhooks.', 'activity' => 'Programming'],
                ['title' => 'Optimize Image Uploads', 'description' => 'Implement server-side resizing for profile images.', 'activity' => 'Programming'],
                ['title' => 'SEO Meta Tags', 'description' => 'Add dynamic meta title/description for all public pages.', 'activity' => 'Documentation'],
                ['title' => 'Multi-tenant Isolation', 'description' => 'Ensure database scope is locked to tenant_id.', 'activity' => 'Security'],
                ['title' => 'Refactor Repository Pattern', 'description' => 'Decouple Eloquent models from controller logic.', 'activity' => 'Programming'],
                ['title' => 'Setup Redis Cache', 'description' => 'Cache heavy dashboard queries for 60 minutes.', 'activity' => 'Deployment'],
                ['title' => 'User Feedback Form', 'description' => 'Create a modal for users to report bugs.', 'activity' => 'Design'],
                ['title' => 'GDPR Data Export', 'description' => 'Allow users to download their personal data as JSON.', 'activity' => 'Programming'],
                ['title' => 'Add Email Notifications', 'description' => 'Configure SES for transactional emails.', 'activity' => 'Deployment'],
                ['title' => 'Update Tailwind Config', 'description' => 'Sync custom brand colors in tailwind.config.js.', 'activity' => 'Design'],
                ['title' => 'API Rate Limiting', 'description' => 'Implement throttle for mobile app requests.', 'activity' => 'Security'],
                ['title' => 'Upgrade Laravel Version', 'description' => 'Migration check for new framework release.', 'activity' => 'Deployment'],
                ['title' => 'Write Unit Tests', 'description' => 'Cover core service class logic with PEST tests.', 'activity' => 'Testing'],
                ['title' => 'Documentation Cleanup', 'description' => 'Update README with new setup instructions.', 'activity' => 'Documentation'],
            ]],
            ['title' => 'To Do', 'cards' => [
                ['title' => 'Fix Broken Password Reset', 'description' => 'Email token link returns 404 on production.', 'activity' => 'Programming'],
                ['title' => 'Update Logo Assets', 'description' => 'Replace current logo with high-res PNG version.', 'activity' => 'Design'],
                ['title' => 'Dashboard Empty State', 'description' => 'Design illustration for when no tasks exist.', 'activity' => 'Design'],
                ['title' => 'Add 2FA Verification', 'description' => 'Implement Google Authenticator TOTP support.', 'activity' => 'Security'],
                ['title' => 'Review Security Audit', 'description' => 'Check findings from recent package vulnerability scan.', 'activity' => 'Security'],
                ['title' => 'Database Indexing', 'description' => 'Add indexes to search columns in the transactions table.', 'activity' => 'Programming'],
                ['title' => 'CSS Print Styles', 'description' => 'Add media print queries for invoice generation.', 'activity' => 'Design'],
                ['title' => 'Configure CI/CD Pipeline', 'description' => 'Update GitHub Actions to run migrations.', 'activity' => 'Deployment'],
                ['title' => 'Fix Mobile Nav Overflow', 'description' => 'Hamburger menu causes horizontal scroll on mobile.', 'activity' => 'Design'],
                ['title' => 'Audit Third-party APIs', 'description' => 'Check Stripe and WorldPay connection latency.', 'activity' => 'Testing'],
                ['title' => 'Update Dependency Versions', 'description' => 'Run composer update and check for breaking changes.', 'activity' => 'Programming'],
                ['title' => 'Setup Error Logging', 'description' => 'Integrate Sentry to monitor production exceptions.', 'activity' => 'Deployment'],
                ['title' => 'Write Component Specs', 'description' => 'Define props for the new TaskCard component.', 'activity' => 'Documentation'],
                ['title' => 'Validate Form Input', 'description' => 'Tighten request validation rules in controllers.', 'activity' => 'Security'],
                ['title' => 'Optimize Font Loading', 'description' => 'Self-host Google fonts to reduce layout shift.', 'activity' => 'Design'],
            ]],
            ['title' => 'In Progress', 'cards' => [
                ['title' => 'Livewire Component State', 'description' => 'Syncing drag-and-drop state with backend.', 'activity' => 'Programming'],
                ['title' => 'Auth Controller Cleanup', 'description' => 'Standardizing redirect paths for guest users.', 'activity' => 'Programming'],
                ['title' => 'Design System Tokens', 'description' => 'Standardizing color palette for the UI library.', 'activity' => 'Design'],
                ['title' => 'S3 Storage Driver', 'description' => 'Configuring presigned URLs for user uploads.', 'activity' => 'Deployment'],
                ['title' => 'Search Query Optimization', 'description' => 'Refactoring search queries to use full-text search.', 'activity' => 'Programming'],
                ['title' => 'Add Localization', 'description' => 'Implementing translatable strings for new regions.', 'activity' => 'Documentation'],
                ['title' => 'Refactor Migrations', 'description' => 'Cleaning up unused foreign key constraints.', 'activity' => 'Programming'],
                ['title' => 'Improve Loading UX', 'description' => 'Adding skeleton screens while data fetches.', 'activity' => 'Design'],
                ['title' => 'Sanitize User Input', 'description' => 'Adding HTMLPurifier to WYSIWYG editor content.', 'activity' => 'Security'],
                ['title' => 'Integrate WorldPay API', 'description' => 'Testing the webhook callback handshake.', 'activity' => 'Programming'],
                ['title' => 'Add Browser Icon', 'description' => 'Generate and export favicon set for various OS.', 'activity' => 'Design'],
                ['title' => 'Update User Permissions', 'description' => 'Add Admin role for system moderation.', 'activity' => 'Security'],
                ['title' => 'Refactor Service Providers', 'description' => 'Optimize booting time for core application.', 'activity' => 'Programming'],
                ['title' => 'Draft Help Articles', 'description' => 'Create onboarding guide for new platform users.', 'activity' => 'Documentation'],
                ['title' => 'Configure Queue Workers', 'description' => 'Set up supervisor for background task handling.', 'activity' => 'Deployment'],
            ]],
            ['title' => 'Testing Phase', 'cards' => [
                ['title' => 'Regression Testing Suite', 'description' => 'Verify no breaking changes in core auth flow.', 'activity' => 'Testing'],
                ['title' => 'Cross-Browser Check', 'description' => 'Test site behavior on Safari and Firefox.', 'activity' => 'Testing'],
                ['title' => 'API Response Testing', 'description' => 'Ensure all JSON responses follow the spec.', 'activity' => 'Testing'],
                ['title' => 'Load Testing App', 'description' => 'Simulate 100 concurrent users for DB pressure test.', 'activity' => 'Testing'],
                ['title' => 'Responsive Breakpoints', 'description' => 'Check alignment on tablet (768px) views.', 'activity' => 'Testing'],
                ['title' => 'Payment Flow QA', 'description' => 'Test Stripe sandbox checkout flow end-to-end.', 'activity' => 'Testing'],
                ['title' => 'Accessibility Audit', 'description' => 'Test screen reader compatibility for inputs.', 'activity' => 'Testing'],
                ['title' => 'Permission Edge Cases', 'description' => 'Verify user cannot access other team records.', 'activity' => 'Testing'],
                ['title' => 'Form Validation Tests', 'description' => 'Test edge cases for edge length/regex inputs.', 'activity' => 'Testing'],
                ['title' => 'Session Timeout Check', 'description' => 'Verify app logs out user after inactivity.', 'activity' => 'Testing'],
                ['title' => 'Data Export Accuracy', 'description' => 'Check integrity of exported CSV data.', 'activity' => 'Testing'],
                ['title' => 'Cache Invalidation Tests', 'description' => 'Verify UI updates after record deletion.', 'activity' => 'Testing'],
                ['title' => 'Link Integrity Check', 'description' => 'Scan all navigation links for 404 status.', 'activity' => 'Testing'],
                ['title' => 'Keyboard Nav Audit', 'description' => 'Ensure tab-order follows logical flow.', 'activity' => 'Testing'],
                ['title' => 'Visual Regression Testing', 'description' => 'Use Percy/Playwright to check UI snapshots.', 'activity' => 'Testing'],
            ]],
            ['title' => 'Deployment Tasks', 'cards' => [
                ['title' => 'Update Production Env', 'description' => 'Set production-level logging and caching.', 'activity' => 'Deployment'],
                ['title' => 'Warm DB Connection', 'description' => 'Optimize pool sizes for high-traffic hours.', 'activity' => 'Deployment'],
                ['title' => 'Clear Application Cache', 'description' => 'Run artisan commands for fresh deployment.', 'activity' => 'Deployment'],
                ['title' => 'Backup Database', 'description' => 'Perform manual snapshot before deployment.', 'activity' => 'Deployment'],
                ['title' => 'Switch SSL Certificates', 'description' => 'Renew LetsEncrypt certs for production domain.', 'activity' => 'Security'],
                ['title' => 'Monitor Server Load', 'description' => 'Setup alerts for CPU usage spikes.', 'activity' => 'Deployment'],
                ['title' => 'Flush Redis Cache', 'description' => 'Prevent serving stale cached data post-release.', 'activity' => 'Deployment'],
                ['title' => 'Sync Assets to CDN', 'description' => 'Push updated CSS/JS assets to cloud storage.', 'activity' => 'Deployment'],
                ['title' => 'Validate Deployment Log', 'description' => 'Verify no runtime errors in logs.', 'activity' => 'Deployment'],
                ['title' => 'Final Smoke Test', 'description' => 'Quick manual navigation of main user paths.', 'activity' => 'Testing'],
                ['title' => 'Notify Stakeholders', 'description' => 'Send internal update on release contents.', 'activity' => 'Documentation'],
                ['title' => 'Post-Deploy Cleanup', 'description' => 'Remove temporary build files from server.', 'activity' => 'Deployment'],
                ['title' => 'Archive Old Logs', 'description' => 'Move logs to storage bucket for auditing.', 'activity' => 'Deployment'],
                ['title' => 'Check Cron Job Status', 'description' => 'Ensure scheduled tasks are running correctly.', 'activity' => 'Deployment'],
                ['title' => 'Verify Domain DNS', 'description' => 'Confirm TTL settings are optimized.', 'activity' => 'Deployment'],
            ]],
            ['title' => 'Done', 'cards' => [
                ['title' => 'Database Schema Design', 'description' => 'Initial migration setup completed.', 'activity' => 'Programming'],
                ['title' => 'Login System MVP', 'description' => 'Authentication scaffolding configured.', 'activity' => 'Programming'],
                ['title' => 'Basic Layout Shell', 'description' => 'Main navigation and footer implemented.', 'activity' => 'Design'],
                ['title' => 'User Profile CRUD', 'description' => 'Users can update name, email, and password.', 'activity' => 'Programming'],
                ['title' => 'Initial Seeders', 'description' => 'Populated basic roles and permissions data.', 'activity' => 'Programming'],
                ['title' => 'Form Styles', 'description' => 'Custom Tailwind styles for inputs and buttons.', 'activity' => 'Design'],
                ['title' => 'Error 404 Page', 'description' => 'Branded page for missing routes.', 'activity' => 'Design'],
                ['title' => 'Laravel Breeze Setup', 'description' => 'Standard auth boilerplate finalized.', 'activity' => 'Programming'],
                ['title' => 'README Setup', 'description' => 'Installation instructions added.', 'activity' => 'Documentation'],
                ['title' => 'Tailwind Integration', 'description' => 'CSS engine configured for current theme.', 'activity' => 'Programming'],
                ['title' => 'Route Grouping', 'description' => 'Separated admin and user routes.', 'activity' => 'Programming'],
                ['title' => 'Component Extraction', 'description' => 'Moved nav and sidebar to Blade components.', 'activity' => 'Programming'],
                ['title' => 'Validation Rules', 'description' => 'Implemented server-side validation logic.', 'activity' => 'Programming'],
                ['title' => 'Git Ignore Setup', 'description' => 'Excluded vendor and node_modules folders.', 'activity' => 'Deployment'],
                ['title' => 'Environment Variables', 'description' => 'Set up standard local .env structure.', 'activity' => 'Deployment'],
            ]],
        ];

        foreach ($columns as $colIndex => $columnData) {
            $column = Column::create([
                'user_id' => $userId,
                'title' => $columnData['title'],
                'position' => $colIndex,
            ]);

            foreach ($columnData['cards'] as $cardIndex => $cardData) {
                Card::create([
                    'user_id' => $userId,
                    'column_id' => $column->id,
                    'title' => $cardData['title'],
                    'description' => $cardData['description'],
                    'activity' => $cardData['activity'],
                    'position' => $cardIndex,
                ]);
            }
        }
    }
}