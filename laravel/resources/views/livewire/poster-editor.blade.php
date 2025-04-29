<div class="relative w-[1587px] h-[2245px] overflow-hidden">
    {{-- Template Image --}}
    <img src="{{ asset('images/templates/template-1.png') }}" alt="Poster Template"
         class="absolute top-0 left-0 w-full h-full z-10 pointer-events-none select-none">

    {{-- Pet Image (positioned below template) --}}
    @if ($petImage)
        <img src="{{ asset('storage/' . $petImage) }}"
             class="absolute z-5"
             style="top: 996px; left: 170px; width: 685px; height: 757px; object-fit: cover;">
    @endif

    {{-- Pet Name --}}
    <div class="absolute z-20 text-black text-center text-[64px] font-bold leading-tight"
         style="top: 573px; left: 163px; width: 1261px; height: 200px;">
        {{ $petName ?? 'Pet Name' }}
    </div>

    {{-- Pet Description --}}
    <div class="absolute z-20 text-black text-[40px] leading-snug"
         style="top: 984px; left: 908px; width: 510px; height: 442px; overflow-wrap: break-word;">
        {{ $petDescription ?? 'Pet Description' }}
    </div>

    {{-- Reward --}}
    <div class="absolute z-20 text-black text-center text-[48px] font-semibold"
         style="top: 1585px; left: 903px; width: 517px; height: 170px;">
        {{ $reward ?? '₱0.00' }}
    </div>

    {{-- Contact Number --}}
    <div class="absolute z-20 text-black text-center text-[48px]"
         style="top: 1905px; left: 157px; width: 1268px; height: 172px;">
        {{ $contactNumber ?? '+63 900 000 0000' }}
    </div>
</div>
