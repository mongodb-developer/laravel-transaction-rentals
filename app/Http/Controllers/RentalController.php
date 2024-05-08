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

        // Start transaction
        DB::beginTransaction();

        try {
            $rental = Rental::find($validated['name']);
            if (!$rental) {
                throw new Exception('Rental not found');
            }

            // Assume newAvailability is coming from the request or define how it should be set
            $newAvailability = [
                ["startDate" => new \DateTime('2024-01-01'),
                "endDate" => new \DateTime('2024-05-31')],
                ["startDate" => new \DateTime('2024-06-08'),
                "endDate" => new \DateTime('2026-12-31')]
            ]; // Set the availability dates based on business logic

            // Update rental availability
            $rental->availability = $newAvailability;
            $rental->save();

            // Create booking record
            $booking = new Booking([
                'rental_id' => $validated['rentalId'],
                'guest_name' => $validated['guestName'],
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
