<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Http;

class TravelPlanService
{
    public function generateTravelPlan($validatedData)
    {
        $response = Http::post(env('TRAVEL_PLAN_GENERATE_API').'/generate-travel-plan', $validatedData);

        if ($response->successful()) {
            return response()->json($response->json(), 200);
        } else {
            return response()->json(['error' => 'Unable to generate travel plan.'], 500);
        }
    }

    public function getLocationDetails($validatedData)
    {
        $response = Http::post(env('TRAVEL_PLAN_GENERATE_API').'/get-location-data', $validatedData);
        return $response;

        if ($response->successful()) {
            return response()->json($response->json(), 200);
        } else {
            return response()->json(['error' => 'Unable to get location details.'], 500);
        }
    }
}
