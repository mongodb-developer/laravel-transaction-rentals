<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use MongoDB\BSON\UTCDateTime;
// Exception class is imported
use Exception;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Booking;
use DB;

class BookingController extends Controller
{
     /**
     * Handle the booking process for a rental.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required',
            'startDate' => 'required|date',
            'endDate' => 'required|date'
            // Add other necessary validation rules
        ]);

        // Start transaction
        DB::beginTransaction();

        try {

            $rental = Rental::where(['name' => $validated['name']])->first();
            if (!$rental) {
                throw new Exception('Rental not found');
            }

            // Assume newAvailability is coming from the request or define how it should be set
            $newAvailability = [
                [
                    "start_date" => new \MongoDB\BSON\UTCDateTime(new \DateTime('2024-01-01')),
                    "end_date" => new \MongoDB\BSON\UTCDateTime(new \DateTime('2024-05-31'))
                ],
                [
                    "start_date" => new \MongoDB\BSON\UTCDateTime(new \DateTime('2024-06-08')),
                    "end_date" => new \MongoDB\BSON\UTCDateTime(new \DateTime('2026-12-31'))
                ]
            ]; // Set the availability dates based on business logic

            // Update rental availability
            $rental->availability = $newAvailability;
            $rental->save();

            // Create booking record
            $booking = new Booking([
                'rental_name' => $validated['name'],
                'booking_date' => now(),
                'status' => 'confirmed',
            ]);
            $booking->save();

            // Commit the transaction
            DB::commit();

            return response()->json(['message' => 'Booking successful', 'booking_id' => $booking->id], 200);
        } catch (\Exception $e) {
            // Rollback the transaction in case of any exception
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
