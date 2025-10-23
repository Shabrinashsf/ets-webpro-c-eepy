<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public $katakunci = '';
    public $entries = 10;
    public $showEditModal = false;
    public $editingBookingId = null;

    public $name, $roomid, $checkin, $checkout, $price, $method;

    protected $paginationTheme = 'tailwind';

    protected $rules = [
        'name' => 'required|string|max:255',
        'roomid' => 'required|exists:rooms,id',
        'checkin' => 'required|string',
        'checkout' => 'required|string',
        'price' => 'required|numeric',
        'method' => 'nullable|string|max:50',
    ];

    public function updatingKatakunci()
    {
        $this->resetPage();
    }

    public function render()
    {
        $bookings = Booking::query()
            ->when($this->katakunci, function($query) {
                $query->where('name', 'like', '%' . $this->katakunci . '%')
                      ->orWhere('method', 'like', '%' . $this->katakunci . '%');
            })
            ->with('room') // eager load room info
            ->paginate($this->entries);

        return view('livewire.orders', [
            'bookings' => $bookings,
        ]);
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);

        $this->editingBookingId = $id;
        $this->name = $booking->name;
        $this->roomid = $booking->roomid;
        $this->checkin = $booking->checkin;
        $this->checkout = $booking->checkout;
        $this->price = $booking->price;
        $this->method = $booking->method;

        $this->showEditModal = true;
    }

    public function updateBooking()
    {
        $this->validate();

        $booking = Booking::findOrFail($this->editingBookingId);
        $booking->update([
            'name' => $this->name,
            'roomid' => $this->roomid,
            'checkin' => $this->checkin,
            'checkout' => $this->checkout,
            'price' => $this->price,
            'method' => $this->method,
        ]);

        $this->showEditModal = false;
        $this->dispatch('bookingUpdated');
    }

    public function closeModal()
    {
        $this->reset(['showEditModal', 'editingBookingId', 'name', 'roomid', 'checkin', 'checkout', 'price', 'method']);
    }

    public function delete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
    }
}
