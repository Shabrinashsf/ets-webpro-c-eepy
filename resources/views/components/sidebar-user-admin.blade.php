@props([
    'profile' => 'Profile',
    'orders' => 'Orders',
    'active' => 'profile',
    'user' => null,
])

{{-- Sidebar Wrapper --}}
<div x-data="{ open: false }" class="relative">

    {{-- Tombol hamburger (hanya muncul di mobile) --}}
    <button 
        @click="open = !open"
        class="lg:hidden fixed top-4 left-4 z-50 bg-[#2C0855] text-white p-2 rounded-md focus:outline-none"
    >
        <x-lucide-menu class="w-6 h-6" />
    </button>

    {{-- Overlay gelap ketika sidebar terbuka di mobile --}}
    <div 
        x-show="open"
        @click="open = false"
        class="fixed inset-0 bg-black/40 z-40 lg:hidden"
        x-transition.opacity
    ></div>

    {{-- Sidebar utama --}}
    <div 
        class="admin-card w-[333px] h-[452px] bg-[#78b3ce] rounded-3xl text-white flex flex-col justify-between items-center p-8 
               float-left lg:relative lg:translate-x-0 fixed top-0 left-0 z-50
               transform transition-transform duration-300 ease-in-out
               lg:h-auto lg:w-[333px]
               lg:block"
        :class="{ '-translate-x-full': !open, 'translate-x-0': open }"
    >
        <div class="flex flex-col items-center">
            {{-- Logo --}} 
            <div class="text-center">
                <img src="{{ asset('images/eepy.png') }}" alt="Logo">
            </div>

            {{-- Menu --}}
            <div class="w-full">

                {{-- Sidebar User --}}
                @if($profile === 'Profile' && $orders === 'Orders')
                    <a href="{{ route('profile') }}"
                        class="group mt-8 flex items-center gap-4 py-3 px-5 rounded-[8px] transition 
                            {{ $active === 'profile'
                                ? 'bg-[#fbf8ef] text-[#000000]' 
                                : 'text-white hover:bg-[rgba(242,242,242,0.3)]' }}"
                    >
                        <x-lucide-user-round class="h-[22px] w-[22px]"></x-lucide-user-round>
                        <span class="transition">
                            {{ $profile }}
                        </span>
                    </a>

                    <a href="{{ route('orders') }}"
                        class="group mt-8 flex items-center gap-4 py-3 px-5 rounded-[8px] transition 
                            {{ $active === 'orders' 
                                ? 'bg-[#fbf8ef] text-[#000000]' 
                                : 'text-white hover:bg-[rgba(242,242,242,0.3)]' }}"
                    >
                        <x-lucide-clipboard-list class="h-[22px] w-[22px]"></x-lucide-clipboard-list>
                        <span class="transition">
                            {{ $orders }}
                        </span>
                    </a>
                @endif

                @if($profile === 'Users' && $orders === 'Rooms')
                    <a href="{{ route('admin') }}"
                        class="group mt-8 flex items-center gap-4 py-3 px-5 rounded-[8px] transition 
                            {{ $active === 'users'
                                ? 'bg-[#fbf8ef] text-[#000000]' 
                                : 'text-white hover:bg-[rgba(242,242,242,0.3)]' }}"
                    >
                        <x-lucide-user-round class="h-[22px] w-[22px]"></x-lucide-user-round>
                        <span class="transition">
                            {{ $profile }}
                        </span>
                    </a>

                    <a href="{{ route('admin.rooms') }}"
                        class="group mt-8 flex items-center gap-4 py-3 px-5 rounded-[8px] transition 
                            {{ $active === 'rooms' 
                                ? 'bg-[#fbf8ef] text-[#000000]' 
                                : 'text-white hover:bg-[rgba(242,242,242,0.3)]' }}"
                    >
                        <x-lucide-clipboard-list class="h-[22px] w-[22px]"></x-lucide-clipboard-list>
                        <span class="transition">
                            {{ $orders }}
                        </span>
                    </a>
                @endif
            </div>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button 
                    type="submit"
                    class="mt-8 bg-white text-[#2C0855] py-3 px-6 rounded-[8px] font-semibold hover:bg-gray-100 transition flex gap-4 items-center w-full justify-center"
                >
                    <x-lucide-log-out class="h-[22px] w-[22px]"></x-lucide-log-out>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
