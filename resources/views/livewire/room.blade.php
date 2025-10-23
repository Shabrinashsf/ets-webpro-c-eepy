<div class="bg-[#d8ecf7] p-6 rounded-2xl">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-[#78b3ce] font-bold text-xl">Rooms List</h2>

        <div class="flex items-center gap-3">
            <input
                type="text"
                placeholder="🔍 Search..."
                wire:model.live="katakunci"
                class="w-64 px-4 py-2 border border-[#d8ecf7] rounded-xl focus:ring-2 focus:ring-[#78b3ce] outline-none bg-white"
            >

            <select
                wire:model.live="entries"
                class="px-3 py-2 border border-[#d8ecf7] rounded-xl bg-white text-gray-700 focus:ring-2 focus:ring-[#78b3ce]"
            >
                <option value="10">10 Entries</option>
                <option value="20">20 Entries</option>
                <option value="50">50 Entries</option>
            </select>

            {{-- Add Room Button --}}
            <button wire:click="$set('showEditModal', true)" 
                class="bg-[#f96e2a] text-white px-4 py-2 rounded-xl hover:bg-[#d14b08] transition">
                + Add Room
            </button>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-[#78b3ce] text-white text-left">
                    <th class="py-3 px-4 text-sm font-semibold">No</th>
                    <th class="py-3 px-4 text-sm font-semibold">Room Type</th>
                    <th class="py-3 px-4 text-sm font-semibold">Number</th>
                    <th class="py-3 px-4 text-sm font-semibold">Status</th>
                    <th class="py-3 px-4 text-sm font-semibold">Action</th>
                </tr>
            </thead>

            <tbody class="bg-[#F8F5FF] text-gray-800">
                @foreach ($dataRooms as $key => $room)
                    <tr>
                        <td class="py-3 px-4 text-sm">{{ $dataRooms->firstItem() + $key }}</td>
                        <td class="py-3 px-4 text-sm">{{ $room->roomType->name ?? '-' }}</td>
                        <td class="py-3 px-4 text-sm">{{ $room->number }}</td>
                        <td class="py-3 px-4 text-sm capitalize">{{ $room->status }}</td>
                        <td class="py-3 px-4 text-sm">
                            <button wire:click="edit({{ $room->id }})"
                                class="text-[#631ACB] font-semibold hover:underline cursor-pointer">
                                Edit
                            </button>
                            <button wire:click="delete({{ $room->id }})"
                                class="text-red-500 font-semibold hover:underline cursor-pointer">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-between items-center mt-6">
        <div class="text-sm text-gray-600">
            Showing {{ $dataRooms->firstItem() }} to {{ $dataRooms->lastItem() }} of {{ $dataRooms->total() }} entries
        </div>
        <div class="flex items-center gap-2">
            {{ $dataRooms->links('pagination::tailwind') }}
        </div>
    </div>

    {{-- Modal --}}
    @if($showEditModal)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
            <div class="bg-white rounded-2xl shadow-lg p-6 w-[400px]">
                <h2 class="text-lg font-bold text-[#78b3ce] mb-4">
                    {{ $editingRoomId ? 'Edit Room' : 'Add Room' }}
                </h2>

                <form wire:submit.prevent="{{ $editingRoomId ? 'updateRoom' : 'createRoom' }}" class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Room Type</label>
                        <select wire:model="room_type_id"
                            class="text-[#040720] w-full border border-[#d8ecf7] rounded-xl px-3 py-2 focus:ring-2 focus:ring-[#78b3ce] outline-none">
                            <option value="">Select Type</option>
                            @foreach ($roomTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('room_type_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Room Number</label>
                        <input type="text" wire:model="number"
                            class="text-[#040720] w-full border border-[#d8ecf7] rounded-xl px-3 py-2 focus:ring-2 focus:ring-[#78b3ce] outline-none">
                        @error('number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select wire:model="status"
                            class="text-[#040720] w-full border border-[#d8ecf7] rounded-xl px-3 py-2 focus:ring-2 focus:ring-[#78b3ce] outline-none">
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
                        @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-3 mt-4">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2 bg-gray-300 rounded-xl hover:bg-gray-400">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 bg-[#78b3ce] text-white rounded-xl hover:bg-[#4c98bb]">Save</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
