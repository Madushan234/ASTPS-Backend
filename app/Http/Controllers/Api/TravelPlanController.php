<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TravelPlan\TravelPlanGenerateRequest;
use Illuminate\Support\Facades\Http;

class TravelPlanController extends Controller
{
    /**
     * Generate a travel plan.
     *
     * @param  \App\Http\Requests\TravelPlanRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateTravelPlan(TravelPlanGenerateRequest $request)
    {
        $response = Http::post(env('TRAVEL_PLAN_GENERATE_API').'/generate-travel-plan', $request->all());

        if ($response->successful()) {
            return response()->json(json_decode($response->json()['travel_plan']), 200);
        } else {
            return response()->json(['error' => 'Unable to generate travel plan.'], 500);
        }
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

        $response = Http::post(env('TRAVEL_PLAN_GENERATE_API').'/get-location-data', $validatedData);

        if ($response->successful()) {
            return response()->json(json_decode($response->json()['location_data']), 200);
        } else {
            return response()->json(['error' => 'Unable to get location details.'], 500);
        }
    }
}
