<?php

use App\Repositories\TimelineRepository;
use App\Timeline;
use Faker\Factory as Faker;

trait MakeTimelineTrait
{
    /**
     * Create fake instance of Timeline and save it in database.
     *
     * @param array $timelineFields
     *
     * @return Timeline
     */
    public function makeTimeline($timelineFields = [])
    {
        /** @var TimelineRepository $timelineRepo */
        $timelineRepo = App::make(TimelineRepository::class);
        $theme = $this->fakeTimelineData($timelineFields);

        return $timelineRepo->create($theme);
    }

    /**
     * Get fake instance of Timeline.
     *
     * @param array $timelineFields
     *
     * @return Timeline
     */
    public function fakeTimeline($timelineFields = [])
    {
        return new Timeline($this->fakeTimelineData($timelineFields));
    }

    /**
     * Get fake data of Timeline.
     *
     * @param array $postFields
     *
     * @return array
     */
    public function fakeTimelineData($timelineFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'username'       => $fake->word,
            'name'           => $fake->word,
            'about'          => $fake->text,
            'avatar_id'      => $fake->randomDigitNotNull,
            'cover_id'       => $fake->randomDigitNotNull,
            'cover_position' => $fake->word,
            'type'           => $fake->word,
            'created_at'     => $fake->word,
            'updated_at'     => $fake->word,
            'deleted_at'     => $fake->word,
        ], $timelineFields);
    }
}
