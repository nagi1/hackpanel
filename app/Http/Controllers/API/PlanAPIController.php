<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreatePlanAPIRequest;
use App\Http\Requests\API\UpdatePlanAPIRequest;
use App\Plan;
use Illuminate\Http\Request;
use Response;

/**
 * Class PlanController.
 */
class PlanAPIController extends AppBaseController
{
    /**
     * Display a listing of the Plan.
     * GET|HEAD /plans.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Plan::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $plans = $query->get();

        return $this->sendResponse($plans->toArray(), 'Plans retrieved successfully');
    }

    /**
     * Store a newly created Plan in storage.
     * POST /plans.
     *
     * @param CreatePlanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePlanAPIRequest $request)
    {
        $input = $request->all();

        /** @var Plan $plan */
        $plan = Plan::create($input);

        return $this->sendResponse($plan->toArray(), 'Plan saved successfully');
    }

    /**
     * Display the specified Plan.
     * GET|HEAD /plans/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Plan $plan */
        $plan = Plan::find($id);

        if (empty($plan)) {
            return $this->sendError('Plan not found');
        }

        return $this->sendResponse($plan->toArray(), 'Plan retrieved successfully');
    }

    /**
     * Update the specified Plan in storage.
     * PUT/PATCH /plans/{id}.
     *
     * @param int $id
     * @param UpdatePlanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlanAPIRequest $request)
    {
        /** @var Plan $plan */
        $plan = Plan::find($id);

        if (empty($plan)) {
            return $this->sendError('Plan not found');
        }

        $plan->fill($request->all());
        $plan->save();

        return $this->sendResponse($plan->toArray(), 'Plan updated successfully');
    }

    /**
     * Remove the specified Plan from storage.
     * DELETE /plans/{id}.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Plan $plan */
        $plan = Plan::find($id);

        if (empty($plan)) {
            return $this->sendError('Plan not found');
        }

        $plan->delete();

        return $this->sendResponse($id, 'Plan deleted successfully');
    }
}
