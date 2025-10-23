<div class="bg-[#d8ecf7] p-6 rounded-2xl">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-[#78b3ce] font-bold text-xl">Bookings List</h2>

        <div class="flex items-center gap-3">
            <input type="text" placeholder="🔍 Search..." wire:model.live="katakunci"
                class="w-64 px-4 py-2 border border-[#d8ecf7] rounded-xl focus:ring-2 focus:ring-[#78b3ce] outline-none bg-white">
            <select wire:model.live="entries"
                class="px-3 py-2 border border-[#d8ecf7] rounded-xl bg-white text-gray-700 focus:ring-2 focus:ring-[#78b3ce]">
                <option value="10">10 Entries</option>
                <option value="20">20 Entries</option>
                <option value="50">50 Entries</option>
            </select>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-[#78b3ce] text-white">
                    <th class="py-3 px-4 text-sm font-semibold">No</th>
                    <th class="py-3 px-4 text-sm font-semibold">Guest Name</th>
                    <th class="py-3 px-4 text-sm font-semibold">Check-In</th>
                    <th class="py-3 px-4 text-sm font-semibold">Check-Out</th>
                    <th class="py-3 px-4 text-sm font-semibold">Price</th>
                    <th class="py-3 px-4 text-sm font-semibold">Method</th>
                </tr>
            </thead>
            <tbody">
                @foreach ($bookings as $key => $booking)
                    <tr">
                        <td class="text-[#040720]">{{ $bookings->firstItem() + $key }}</td>
                        <td class="text-[#040720]">{{ $booking->name }}</td>
                        <td class="text-[#040720]">{{ $booking->checkin }}</td>
                        <td class="text-[#040720]">{{ $booking->checkout }}</td>
                        <td class="text-[#040720]">Rp{{ number_format($booking->price) }}</td>
                        <td class="text-[#040720]">{{ $booking->method ?? '-' }}</td>
                        </tr>
                @endforeach
                </tbody>
        </table>
    </div>

    <div class="flex justify-between items-center mt-6">
        <div class="text-sm text-gray-600">
            Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} of {{ $bookings->total() }} entries
        </div>
        <div class="flex items-center gap-2">
            {{ $bookings->links('pagination::tailwind') }}
        </div>
    </div>

    {{-- Modal --}}
    @if ($showEditModal)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
            <div class="bg-white rounded-2xl shadow-lg p-6 w-[400px]">
                <h2 class="text-lg font-bold text-[#3C1361] mb-4">Edit Booking</h2>

                <form wire:submit.prevent="updateBooking" class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Guest Name</label>
                        <input type="text" wire:model="name"
                            class="w-full border border-[#d8ecf7] rounded-xl px-3 py-2 focus:ring-2 focus:ring-[#78b3ce] outline-none">
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Room ID</label>
                        <input type="number" wire:model="roomid"
                            class="w-full border border-[#d8ecf7] rounded-xl px-3 py-2 focus:ring-2 focus:ring-[#78b3ce] outline-none">
                        @error('roomid')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Check-In</label>
                        <input type="date" wire:model="checkin"
                            class="w-full border border-[#d8ecf7] rounded-xl px-3 py-2 focus:ring-2 focus:ring-[#78b3ce] outline-none">
                        @error('checkin')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Check-Out</label>
                        <input type="date" wire:model="checkout"
                            class="w-full border border-[#d8ecf7] rounded-xl px-3 py-2 focus:ring-2 focus:ring-[#78b3ce] outline-none">
                        @error('checkout')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" wire:model="price"
                            class="w-full border border-[#d8ecf7] rounded-xl px-3 py-2 focus:ring-2 focus:ring-[#78b3ce] outline-none">
                        @error('price')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Method</label>
                        <input type="text" wire:model="method"
                            class="w-full border border-[#d8ecf7] rounded-xl px-3 py-2 focus:ring-2 focus:ring-[#78b3ce] outline-none">
                        @error('method')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
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
