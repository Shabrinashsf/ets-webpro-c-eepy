<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        // Hardcoded room types lengkap
        $roomTypes = [
            1 => [
                'name' => 'Standard',
                'price' => 500000,
                'description' => 'A 26 sqm Standard room located on second to fourth floor, street view, breakfast included.',
                'area' => '26 sqm',
                'capacity' => '2 people',
                'facilities' => ['AC', 'Mini bar', 'TV', 'Hair dryer', 'Shower', 'Hot water', 'Toiletries'],
                'image' => 'standard1.jpeg'
            ],
            2 => [
                'name' => 'Deluxe',
                'price' => 700000,
                'description' => '27 sqm Deluxe Room located on Ground to fourth floor, offers village scenery, breakfast included.',
                'area' => '27 sqm',
                'capacity' => '2 people',
                'facilities' => ['AC', 'Mini bar', 'TV', 'Brankas', 'Hair dryer', 'Shower', 'Bath tub', 'Hot water', 'Toiletries'],
                'image' => 'deluxe1.jpeg'
            ],
            3 => [
                'name' => 'Suite',
                'price' => 1300000,
                'description' => '30 sqm Suite Room on Ground to fourth floor, city view, spacious with sofa, breakfast included.',
                'area' => '34 sqm',
                'capacity' => '4 people',
                'facilities' => ['Balcony','Sofa','AC','Mini bar','TV','Brankas','Hair dryer','Shower','Bath tub','Hot water','Toiletries'],
                'image' => 'suite1.jpeg'
            ],
            4 => [
                'name' => 'President',
                'price' => 2000000,
                'description' => '40 sqm President Room, city view, ensuite with sofa & living room, breakfast included.',
                'area' => '40 sqm',
                'capacity' => '6 people',
                'facilities' => ['Balcony','Living room','AC','Mini kitchen','Dining area','TV','Brankas','Hair dryer','Shower','Bath tub','Hot water','Toiletries'],
                'image' => 'pres2.jpeg'
            ],
        ];

        $startDate = $request->query('checkin');
        $endDate = $request->query('checkout');

        $availableRooms = [];
        foreach ($roomTypes as $id => $data) {
            $query = Room::where('room_type_id', $id);

            if ($startDate && $endDate) {
                $bookedRoomIds = Booking::where('roomid', '!=', null)
                    ->where(function($q) use ($startDate, $endDate) {
                        $q->whereBetween('checkin', [$startDate, $endDate])
                          ->orWhereBetween('checkout', [$startDate, $endDate])
                          ->orWhere(function($q2) use ($startDate, $endDate){
                              $q2->where('checkin', '<', $startDate)
                                 ->where('checkout', '>', $endDate);
                          });
                    })
                    ->pluck('roomid')->toArray();

                $query->whereNotIn('id', $bookedRoomIds);
            }

            $availableRooms[$id] = $query->count();
        }


        return view('room', compact('roomTypes', 'availableRooms', 'startDate', 'endDate'));
    }
}