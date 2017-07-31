<?php
namespace Baytek\Laravel\Users\Members\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use Baytek\Laravel\Users\Members\Models\Member;
use Baytek\Laravel\Users\UserMeta;

class FakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->generateUsers();
    }

    public function generateUsers($total = 50)
    {
        $faker = Faker::create();

        foreach(range(1,$total) as $index) {

            //Member info
            $first_name = $faker->firstName;
            $last_name = $faker->lastName;
            $email = $faker->safeEmail($first_name.' '.$last_name);
            $meta = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'work_phone' => $faker->phoneNumber,
                'home_phone' => $faker->phoneNumber,
                'company' => $faker->company,
                'title' => $faker->jobTitle,
            ];

            //Save the user
            $member = new Member();
            $member->email = $email;
            $member->name = $first_name . ' ' . $last_name;
            $member->password = bcrypt('password');
            $member->save();

            //Save the user meta
            foreach($meta as $key => $value) {
                $metaRecord = (new UserMeta([
                    'language' => 'en',
                    'key' => $key,
                    'value' => $value
                ]));
                $member->meta()->save($metaRecord);
                $metaRecord->save();
            }

            $member->assignRole(['Member']);
            $member->onBit(Member::APPROVED)->update();
        }
    }
}
