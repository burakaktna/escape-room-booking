<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Http\Resources\Booking\BookingCollection;
use App\Http\Resources\Booking\BookingResource;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct(private readonly BookingService $bookingService)
    {
        $this->authorizeResource(Booking::class, 'booking');
    }

    public function index(): JsonResponse
    {
        $bookings = Auth::user()->bookings;
        return BookingCollection::make($bookings)->response();
    }

    public function store(BookingRequest $request): JsonResponse
    {
        $booking = $this->bookingService->createBooking(Auth::user(), $request->validated());
        return BookingResource::make($booking)->response();
    }

    public function destroy(Booking $booking): JsonResponse
    {
        $this->authorize('delete', $booking);

        $booking->delete();

        return response()->json(null, 204);
    }
}
