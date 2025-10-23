<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function show(Request $request)
    {
        $checkin = $request->query('checkin');
        $checkout = $request->query('checkout');
        $price = (int) $request->query('price');

        $nights = (strtotime($checkout) - strtotime($checkin)) / (60*60*24);

        $data = [
            'user_id' => $request->query('user_id'),
            'room_type_id' => $request->query('room_type_id'),
            'room_name' => $request->query('room_name'),
            'checkin' => $checkin,
            'checkout' => $checkout,
            'price_per_night' => $price,
            'nights' => $nights,
            'total_price' => $price * $nights,
        ];

        return view('booking', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'room_type_id' => 'required|exists:rooms,room_type_id',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'price_per_night' => 'required|numeric',
        ]);

        // Hitung malam
        $nights = (strtotime($request->checkout) - strtotime($request->checkin)) / (60*60*24);

        // Ambil room_id random yang tersedia
        $bookedRoomIds = Booking::where(function($q) use ($request) {
            $q->whereBetween('checkin', [$request->checkin, $request->checkout])
            ->orWhereBetween('checkout', [$request->checkin, $request->checkout])
            ->orWhere(function($q2) use ($request){
                $q2->where('checkin', '<', $request->checkin)
                    ->where('checkout', '>', $request->checkout);
            });
        })->pluck('roomid')->toArray();

        $availableRoom = Room::where('room_type_id', $request->room_type_id)
                            ->whereNotIn('id', $bookedRoomIds)
                            ->inRandomOrder()
                            ->first();

        if (!$availableRoom) {
            return back()->withErrors('No rooms available for this type and selected dates.');
        }

        // Simpan ke database
        Booking::create([
            'name' => $request->name,
            'userid' => Auth::id(),
            'roomid' => $availableRoom->id,
            'price' => $request->price_per_night * $nights,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'method' => $request->payment_method,
        ]);

        return redirect()->route('success');
    }

}
