<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TravelPlan\TravelPlanGenerateRequest;
use App\Services\Api\TravelPlanService;
use Illuminate\Support\Facades\Http;

class TravelPlanController extends Controller
{
    private TravelPlanService $travelPlanService;

    public function __construct(TravelPlanService $travelPlanService)
    {
        $this->travelPlanService = $travelPlanService;
    }

    /**
     * Generate a travel plan.
     *
     * @param  \App\Http\Requests\TravelPlanRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateTravelPlan(TravelPlanGenerateRequest $request)
    {
        return $this->travelPlanService->generateTravelPlan($request);
    }

    /**
     * Get location details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLocationDetails(Request $request)
    {
        $validatedData = $request->validate([
            'location' => 'required|string',
        ]);
        return $this->travelPlanService->getLocationDetails($validatedData);
    }
}
