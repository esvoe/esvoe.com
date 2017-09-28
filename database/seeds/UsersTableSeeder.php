<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lets create roles first
        //     $roles = array(
        //     array('name' => 'admin' ),
        //     array('name' => 'user' ),
        //     array('name' => 'moderator' )
        // );

        // Role::insert($roles);

        //Create admin user
        $user = User::firstOrNew(['email' => 'admin@bootstrapguru.com']);
        $user->timeline_id = 1;
        $user->email = 'admin@bootstrapguru.com';
        $user->password = Hash::make('vijay');
        $user->remember_token = str_random(10);
        $user->verification_code = str_random(18);
        $user->email_verified = 1;
        $user->city = 'Hyderabad';
        $user->gender = 'male';
        $user->referral_id = 1;
        $user->save();

        // Create user
        $user = User::firstOrNew(['email' => 'hire@vijaykumar.me']);
        $user->timeline_id = 2;
        $user->email = 'hire@vijaykumar.me';
        $user->password = Hash::make('vijay');
        $user->remember_token = str_random(10);
        $user->verification_code = str_random(18);
        $user->email_verified = 1;
        $user->city = 'Hyderabad';
        $user->gender = 'male';
        $user->referral_id = 2;
        $user->save();

        //Populate dummy users
        factory(User::class, 40)->create();
    }
}
