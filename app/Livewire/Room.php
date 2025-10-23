<?php

namespace App\Livewire;

use App\Models\Room as ModelsRoom;
use App\Models\RoomType;
use Livewire\Component;
use Livewire\WithPagination;

class Room extends Component
{
    use WithPagination;

    public $katakunci = '';
    public $entries = 10;

    public $showEditModal = false;
    public $editingRoomId = null;

    public $room_type_id, $number, $status;

    protected $paginationTheme = 'tailwind';
    protected $rules = [
        'room_type_id' => 'required|exists:room_types,id',
        'number' => 'required|string|max:50',
        'status' => 'required|in:available,unavailable',
    ];

    public function updatingKatakunci()
    {
        $this->resetPage();
    }

    public function render()
    {
        $dataRooms = ModelsRoom::with('roomType')
            ->when($this->katakunci, function($query) {
                $query->where('number', 'like', '%' . $this->katakunci . '%')
                      ->orWhereHas('roomType', function($q) {
                          $q->where('name', 'like', '%' . $this->katakunci . '%');
                      });
            })
            ->paginate($this->entries);

        $roomTypes = RoomType::all();

        return view('livewire.room', [
            'dataRooms' => $dataRooms,
            'roomTypes' => $roomTypes,
        ]);
    }

    public function edit($id)
    {
        $room = ModelsRoom::findOrFail($id);

        $this->editingRoomId = $id;
        $this->room_type_id = $room->room_type_id;
        $this->number = $room->number;
        $this->status = $room->status;

        $this->showEditModal = true;
    }

    public function createRoom()
    {
        $this->validate();

        ModelsRoom::create([
            'room_type_id' => $this->room_type_id,
            'number' => $this->number,
            'status' => $this->status,
        ]);

        $this->reset(['room_type_id', 'number', 'status', 'showEditModal']);
        session()->flash('success', 'Room added successfully!');
    }


    public function updateRoom()
    {
        $this->validate();

        $room = ModelsRoom::findOrFail($this->editingRoomId);
        $room->update([
            'room_type_id' => $this->room_type_id,
            'number' => $this->number,
            'status' => $this->status,
        ]);

        $this->showEditModal = false;
        $this->dispatch('roomUpdated');
    }

    public function delete($id)
    {
        ModelsRoom::findOrFail($id)->delete();
    }

    public function closeModal()
    {
        $this->reset(['showEditModal', 'editingRoomId', 'room_type_id', 'number', 'status']);
    }
}