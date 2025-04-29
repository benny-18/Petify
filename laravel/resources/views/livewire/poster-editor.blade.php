<div style="position: relative; width: 1587px; height: 2245px; overflow: hidden;">
    <!-- Template Image -->
    <img src="{{ asset('images/templates/template-1.png') }}" alt="Poster Template"
         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 10; pointer-events: none; user-select: none;">

    <!-- Pet Image -->
    @if ($petImage)
        <img src="{{ asset('storage/' . $petImage) }}"
             style="position: absolute; top: 996px; left: 170px; width: 685px; height: 757px; object-fit: cover; z-index: 5;">
    @endif

    <!-- Pet Name -->
    <div style="
        position: absolute;
        top: 573px;
        left: 163px;
        width: 1261px;
        height: 200px;
        font-size: 100px;
        font-weight: bold;
        color: white;
        text-align: center;
        line-height: 180px;
        z-index: 20;
        overflow: hidden;
        margin-top: auto;
        margin-right: auto;
        margin-left: auto;
        margin-bottom: auto;

    ">
        {{ $petName ?? 'Pet Name' }}
    </div>

    <!-- Pet Description -->
    <div style="
        padding: 50px;
        position: absolute;
        top: 984px;
        left: 908px;
        width: 510px;
        height: 442px;
        font-size: 40px;
        color: white;
        line-height: 1.3;
        z-index: 20;
        overflow-wrap: break-word;
        overflow: hidden;
    ">
        {{ $petDescription ?? 'Pet Description' }}
    </div>

    <!-- Reward -->
    <div style="
        position: absolute;
        top: 1585px;
        left: 903px;
        width: 517px;
        height: 170px;
        font-size: 64px;
        font-weight: 600;
        color: white;
        text-align: center;
        z-index: 20;
        overflow: hidden;
    ">
        {{ $reward ?? '₱0.00' }}
    </div>

    <!-- Contact Number -->
    <div style="
        position: absolute;
        top: 1905px;
        left: 157px;
        width: 1268px;
        height: 172px;
        font-size: 72px;
        color: white;
        text-align: center;
        z-index: 20;
        overflow: hidden;
    ">
        {{ $contactNumber ?? '+63 900 000 0000' }}
    </div>
</div>
