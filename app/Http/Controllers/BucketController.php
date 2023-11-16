<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bucket;
use App\Models\Ball;

class BucketController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'capacity' => 'required|integer',
        ]);

        $bucket = Bucket::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
        ]);

        $this->emptyAllBuckets();

        return response()->json(['message' => 'Bucket created successfully', 'bucket' => $bucket], 201);
    }

    public function getBuckets()
    {
        $buckets = Bucket::all();

        return response()->json(['buckets' => $buckets], 200);
    }

    private function emptyAllBuckets()
    {
        Ball::truncate(); // Deletes all rows in the balls table
    }

    public function suggestBuckets(Request $request)
    {
        // Validate input
        $request->validate([
            'red_balls' => 'required|integer',
            'blue_balls' => 'required|integer',
        ]);

        // Calculate total size of balls
        $totalSize = ($request->red_balls * 5) + ($request->blue_balls * 3);

        // Get all buckets and calculate their remaining empty volumes
        $buckets = Bucket::all();
        $remainingEmptyVolumes = [];

        foreach ($buckets as $bucket) {
            $remainingEmptyVolume = max($bucket->capacity - $bucket->balls()->sum('size'), 0);
            $remainingEmptyVolumes[$bucket->id] = $remainingEmptyVolume;
        }

        // Determine minimum number of buckets required based on the current state
        $minBuckets = 0;
        $remainingTotalVolume = $totalSize;

        foreach ($buckets as $bucket) {
            if ($remainingTotalVolume <= 0) {
                break;
            }

            $minBuckets++;
            $remainingTotalVolume -= $remainingEmptyVolumes[$bucket->id];
        }

        // Return the suggestion
        return response()->json(['message' => 'Suggestion:', 'min_buckets' => $minBuckets]);
    }
}
