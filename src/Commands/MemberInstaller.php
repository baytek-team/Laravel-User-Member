<?php

namespace Baytek\Laravel\Users\Members\Commands;

use Baytek\Laravel\Content\Commands\Installer;

use Baytek\Laravel\Users\Members\Seeders\MemberSeeder;
use Baytek\Laravel\Users\Members\Seeders\FakeDataSeeder;
use Baytek\Laravel\Users\Members\Models\Member;
use Baytek\Laravel\Users\Members\MemberServiceProvider;

use Spatie\Permission\Models\Permission;

use Artisan;
use DB;

class MemberInstaller extends Installer
{
    public $name = 'Member';
    protected $protected = ['Member'];
    protected $provider = MemberServiceProvider::class;
    protected $model = Member::class;
    protected $seeder = MemberSeeder::class;
    protected $fakeSeeder = FakeDataSeeder::class;

    public function shouldPublish()
    {
        return true;
    }

    public function shouldSeed()
    {
        return empty(Role::where('name', 'Member')->first());
    }

    public function shouldProtect()
    {
        foreach ($this->protected as $model) {
            foreach(['view', 'create', 'update', 'delete'] as $permission) {

                // If the permission exists in any form do not reseed.
                if(Permission::where('name', title_case($permission.' '.$model))->exists()) {
                    return false;
                }
            }
        }

        return true;
    }
}
