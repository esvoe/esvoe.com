<?php

use App\Repositories\TimelineRepository;
use App\Timeline;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TimelineRepositoryTest extends TestCase
{
    use MakeTimelineTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TimelineRepository
     */
    protected $timelineRepo;

    public function setUp()
    {
        parent::setUp();
        $this->timelineRepo = App::make(TimelineRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTimeline()
    {
        $timeline = $this->fakeTimelineData();
        $createdTimeline = $this->timelineRepo->create($timeline);
        $createdTimeline = $createdTimeline->toArray();
        $this->assertArrayHasKey('id', $createdTimeline);
        $this->assertNotNull($createdTimeline['id'], 'Created Timeline must have id specified');
        $this->assertNotNull(Timeline::find($createdTimeline['id']), 'Timeline with given id must be in DB');
        $this->assertModelData($timeline, $createdTimeline);
    }

    /**
     * @test read
     */
    public function testReadTimeline()
    {
        $timeline = $this->makeTimeline();
        $dbTimeline = $this->timelineRepo->find($timeline->id);
        $dbTimeline = $dbTimeline->toArray();
        $this->assertModelData($timeline->toArray(), $dbTimeline);
    }

    /**
     * @test update
     */
    public function testUpdateTimeline()
    {
        $timeline = $this->makeTimeline();
        $fakeTimeline = $this->fakeTimelineData();
        $updatedTimeline = $this->timelineRepo->update($fakeTimeline, $timeline->id);
        $this->assertModelData($fakeTimeline, $updatedTimeline->toArray());
        $dbTimeline = $this->timelineRepo->find($timeline->id);
        $this->assertModelData($fakeTimeline, $dbTimeline->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTimeline()
    {
        $timeline = $this->makeTimeline();
        $resp = $this->timelineRepo->delete($timeline->id);
        $this->assertTrue($resp);
        $this->assertNull(Timeline::find($timeline->id), 'Timeline should not exist in DB');
    }
}
