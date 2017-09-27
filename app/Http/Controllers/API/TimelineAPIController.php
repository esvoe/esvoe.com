<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateTimelineAPIRequest;
use App\Http\Requests\API\UpdateTimelineAPIRequest;
use App\Repositories\TimelineRepository;
use App\Timeline;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TimelineController.
 */
class TimelineAPIController extends AppBaseController
{
    /** @var TimelineRepository */
    private $timelineRepository;

    public function __construct(TimelineRepository $timelineRepo)
    {
        $this->timelineRepository = $timelineRepo;
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @SWG\Get(
     *      path="/timelines",
     *      summary="Get a listing of the Timelines.",
     *      tags={"Timeline"},
     *      description="Get all Timelines",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Timeline")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->timelineRepository->pushCriteria(new RequestCriteria($request));
        $this->timelineRepository->pushCriteria(new LimitOffsetCriteria($request));
        $timelines = $this->timelineRepository->all();

        return $this->sendResponse($timelines->toArray(), 'Timelines retrieved successfully');
    }

    /**
     * @param CreateTimelineAPIRequest $request
     *
     * @return Response
     *
     * @SWG\Post(
     *      path="/timelines",
     *      summary="Store a newly created Timeline in storage",
     *      tags={"Timeline"},
     *      description="Store Timeline",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Timeline that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Timeline")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Timeline"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTimelineAPIRequest $request)
    {
        $input = $request->all();

        $timelines = $this->timelineRepository->create($input);

        return $this->sendResponse($timelines->toArray(), 'Timeline saved successfully');
    }

    /**
     * @param int $id
     *
     * @return Response
     *
     * @SWG\Get(
     *      path="/timelines/{id}",
     *      summary="Display the specified Timeline",
     *      tags={"Timeline"},
     *      description="Get Timeline",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Timeline",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Timeline"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Timeline $timeline */
        $timeline = $this->timelineRepository->find($id);

        if (empty($timeline)) {
            return Response::json(ResponseUtil::makeError('Timeline not found'), 400);
        }

        return $this->sendResponse($timeline->toArray(), 'Timeline retrieved successfully');
    }

    /**
     * @param int                      $id
     * @param UpdateTimelineAPIRequest $request
     *
     * @return Response
     *
     * @SWG\Put(
     *      path="/timelines/{id}",
     *      summary="Update the specified Timeline in storage",
     *      tags={"Timeline"},
     *      description="Update Timeline",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Timeline",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Timeline that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Timeline")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Timeline"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTimelineAPIRequest $request)
    {
        $input = $request->all();

        /** @var Timeline $timeline */
        $timeline = $this->timelineRepository->find($id);

        if (empty($timeline)) {
            return Response::json(ResponseUtil::makeError('Timeline not found'), 400);
        }

        $timeline = $this->timelineRepository->update($input, $id);

        return $this->sendResponse($timeline->toArray(), 'Timeline updated successfully');
    }

    /**
     * @param int $id
     *
     * @return Response
     *
     * @SWG\Delete(
     *      path="/timelines/{id}",
     *      summary="Remove the specified Timeline from storage",
     *      tags={"Timeline"},
     *      description="Delete Timeline",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Timeline",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Timeline $timeline */
        $timeline = $this->timelineRepository->find($id);

        if (empty($timeline)) {
            return Response::json(ResponseUtil::makeError('Timeline not found'), 400);
        }

        $timeline->delete();

        return $this->sendResponse($id, 'Timeline deleted successfully');
    }
}
