<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AdminRoleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Define Permissions
        $permissions = [
            // Super Admin Permissions
            'manage-admins' => 'Create and delete sub-admins',
            'manage-settings' => 'Change system settings',
            'view-logs' => 'View all system logs',
            'manage-payment-rules' => 'Set payment and refund rules',
            
            // Worker Reviewer Permissions
            'verify-workers' => 'Verify IDs and profiles',
            'grant-badges' => 'Give Verified Badges',
            'suspend-users' => 'Temporary suspension of users',
            
            // Finance Manager Permissions
            'view-subscriptions' => 'View subscription data',
            'confirm-payments' => 'Confirm and modify payment status',
            'view-financial-reports' => 'Generate financial reports',
            
            // CS Permissions
            'handle-complaints' => 'Respond to customer complaints',
            'flag-accounts' => 'Flag suspicious accounts',
            'manage-disputes' => 'Review and resolve disputes',
            
            // Data Admin Permissions
            'manage-locations' => 'Add/Edit Regions, Districts, Wards, Streets',
            'manage-categories' => 'Manage service categories',
        ];

        $permModels = [];
        foreach ($permissions as $slug => $name) {
            $permModels[$slug] = Permission::updateOrCreate(['slug' => $slug], ['name' => $name]);
        }

        // 2. Define Roles
        $roles = [
            'super-admin' => [
                'name' => 'Admin Mkuu',
                'perms' => array_keys($permissions) // All permissions
            ],
            'worker-reviewer' => [
                'name' => 'Mhakiki wa Workers',
                'perms' => ['verify-workers', 'grant-badges', 'suspend-users', 'handle-complaints']
            ],
            'finance-manager' => [
                'name' => 'Msimamizi wa Pesa',
                'perms' => ['view-subscriptions', 'confirm-payments', 'view-financial-reports']
            ],
            'customer-service' => [
                'name' => 'Huduma kwa Wateja',
                'perms' => ['handle-complaints', 'flag-accounts', 'manage-disputes']
            ],
            'data-admin' => [
                'name' => 'Msimamizi wa Data',
                'perms' => ['manage-locations', 'manage-categories']
            ],
        ];

        foreach ($roles as $slug => $data) {
            $roleModel = Role::updateOrCreate(['slug' => $slug], ['name' => $data['name']]);
            
            $permissionIds = [];
            foreach ($data['perms'] as $pSlug) {
                $permissionIds[] = $permModels[$pSlug]->id;
            }
            $roleModel->permissions()->sync($permissionIds);
        }
    }
}
