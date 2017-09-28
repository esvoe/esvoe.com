<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TimelineApiTest extends TestCase
{
    use MakeTimelineTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTimeline()
    {
        $timeline = $this->fakeTimelineData();
        $this->json('POST', '/api/v1/timelines', $timeline);

        $this->assertApiResponse($timeline);
    }

    /**
     * @test
     */
    public function testReadTimeline()
    {
        $timeline = $this->makeTimeline();
        $this->json('GET', '/api/v1/timelines/'.$timeline->id);

        $this->assertApiResponse($timeline->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTimeline()
    {
        $timeline = $this->makeTimeline();
        $editedTimeline = $this->fakeTimelineData();

        $this->json('PUT', '/api/v1/timelines/'.$timeline->id, $editedTimeline);

        $this->assertApiResponse($editedTimeline);
    }

    /**
     * @test
     */
    public function testDeleteTimeline()
    {
        $timeline = $this->makeTimeline();
        $this->json('DELETE', '/api/v1/timelines/'.$timeline->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/timelines/'.$timeline->id);

        $this->assertResponseStatus(404);
    }
}
