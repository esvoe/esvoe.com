<?php

use App\Repositories\UserRepository;
use App\User;
use Faker\Factory as Faker;

trait MakeUserTrait
{
    /**
     * Create fake instance of User and save it in database.
     *
     * @param array $userFields
     *
     * @return User
     */
    public function makeUser($userFields = [])
    {
        /** @var UserRepository $userRepo */
        $userRepo = App::make(UserRepository::class);
        $theme = $this->fakeUserData($userFields);

        return $userRepo->create($theme);
    }

    /**
     * Get fake instance of User.
     *
     * @param array $userFields
     *
     * @return User
     */
    public function fakeUser($userFields = [])
    {
        return new User($this->fakeUserData($userFields));
    }

    /**
     * Get fake data of User.
     *
     * @param array $postFields
     *
     * @return array
     */
    public function fakeUserData($userFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'timeline_id'       => $fake->randomDigitNotNull,
            'email'             => $fake->word,
            'verification_code' => $fake->word,
            'email_verified'    => $fake->word,
            'remember_token'    => $fake->word,
            'password'          => $fake->word,
            'birthday'          => $fake->word,
            'city'              => $fake->word,
            'gender'            => $fake->word,
            'last_logged'       => $fake->word,
            'timezone'          => $fake->word,
            'referral_id'       => $fake->randomDigitNotNull,
            'language_id'       => $fake->randomDigitNotNull,
            'created_at'        => $fake->word,
            'updated_at'        => $fake->word,
            'deleted_at'        => $fake->word,
        ], $userFields);
    }
}
