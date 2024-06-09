<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Booking;
use DB;

class RentalController extends Controller
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
        try{
        // Start transaction
        DB::transaction(function() {
            $rental = Rental::where(['name' => null])->first();
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
                    'rental_name' => null,
                    'booking_date' => now(),
                    'status' => 'confirmed',
                ]);
                $booking->save();
                return response()->json(['message' => 'Booking successful', 'booking_id' => $booking->id], 200);
        },
         5); // Retry up to 5 times in case of failure
    

            
        } catch (\Exception $e) {
            // Rollback the transaction in case of any exception
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
