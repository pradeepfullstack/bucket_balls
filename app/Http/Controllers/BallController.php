<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ball;
use Illuminate\Support\Facades\Log;
use App\Models\Bucket;
use App\Models\Suggestion;


class BallController extends Controller
{

    public function create(Request $request)
    {
        Log::info($request);

        $request->validate([
            'name' => 'required|string',
            'size' => 'required|integer',
        ]);

        $ball = Ball::create([
            'name' => $request->name,
            'size' => $request->size,
        ]);

        Log::info($ball);
        return redirect()->route('welcome')->with(['message' => 'ball created successfully', 'ball' => $ball]);
    }

    public function store(Request $request)
    {
        Log::info($request);
        $request->validate([
            'color' => 'required|string',
            'size' => 'required|integer',
            'ball_id' => 'required|exists:balls,id',
        ]);

        // Retrieve the ball
        $ball = Ball::find($request->ball_id);

        if ($ball) {
            // Calculate the volume of the ball to be placed
            $ballVolume = $request->size;

            // Check if placement is possible
            if ($this->canPlaceBall($ball, $ballVolume)) {
                // Find the suitable bucket for placement
                $bucket = $this->findSuitableBucket($ballVolume);

                if ($bucket) {
                    // Create a suggestion record
                    Suggestion::create([
                        'ball_id' => $request->ball_id,
                        'bucket_id' => $bucket->id,
                    ]);

                    // Return a response indicating success
                    return redirect()->route('welcome')->with(['message' => 'Suggestion created successfully']);
                } else {
                    // Return a response indicating insufficient space in any bucket
                    return redirect()->route('welcome')->with(['message' => 'Insufficient space in any bucket', 'ball']);
                }
            } else {
                // Return a response indicating insufficient space in the ball
                return redirect()->route('welcome')->with(['message' => 'Insufficient space in the ball', 'ball']);
            }
        } else {
            // Return a response indicating invalid ball
            return redirect()->route('welcome')->with(['message' => 'Invalid ball', 'ball']);
        }
    }


    private function canPlaceBall($ball, $ballVolume)
    {
        // Check if there is enough empty volume to place the ball
        $remainingEmptyVolume = max($ball->capacity - $ball->balls()->sum('size'), 0);
        return $ballVolume <= $remainingEmptyVolume;
    }

    private function findSuitableBucket($ballVolume)
    {
        // Get all buckets and calculate their remaining empty volumes
        $buckets = Bucket::all();
        $suitableBucket = null;

        foreach ($buckets as $bucket) {
            $remainingEmptyVolume = max($bucket->capacity - $bucket->balls()->sum('size'), 0);

            // Check if the bucket has enough space for the ball
            if ($ballVolume <= $remainingEmptyVolume) {
                if (!$suitableBucket || $remainingEmptyVolume > $suitableBucket->capacity - $suitableBucket->balls()->sum('size')) {
                    $suitableBucket = $bucket;
                }
            }
        }

        return $suitableBucket;
    }

}
