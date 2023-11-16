<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bucket;
use App\Models\Ball;

class BallController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'color' => 'required|string',
            'size' => 'required|integer',
            'bucket_id' => 'required|exists:buckets,id',
        ]);

        // Retrieve the bucket
        $bucket = Bucket::find($request->bucket_id);

        if ($bucket) {
            // Check if there is enough empty volume to place the ball
            $remainingEmptyVolume = max($bucket->capacity - $bucket->balls()->sum('size'), 0);

            // Calculate the volume of the ball to be placed
            $ballVolume = $request->size;

            // Check if placement is possible
            if ($ballVolume <= $remainingEmptyVolume) {
                // Create a new ball
                $ball = Ball::create([
                    'color' => $request->color,
                    'size' => $request->size,
                    'bucket_id' => $request->bucket_id,
                ]);

                // Update the empty volume of the bucket
                $bucket->update(['capacity' => $remainingEmptyVolume - $ballVolume]);

                // Return a response indicating success
                return response()->json(['message' => 'Ball placed successfully', 'ball' => $ball], 201);
            } else {
                // Return a response indicating insufficient space
                return response()->json(['message' => 'Insufficient space in the bucket'], 400);
            }
        } else {
            // Return a response indicating invalid bucket
            return response()->json(['message' => 'Invalid bucket'], 404);
        }
    }

}
