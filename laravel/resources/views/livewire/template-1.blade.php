<div style="position: relative; width: 1587px; height: 2245px; overflow: hidden;">
    <!-- template image hashhahshas -->
    <img src="{{ asset('images/templates/template-1.png') }}" alt="Poster Template"
         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 10; pointer-events: none; user-select: none;">

    @if ($petImage)
    <img src="{{ asset('storage/' . $petImage) }}"
         style="position: absolute; top: 996px; left: 170px; width: 685px; height: 757px; object-fit: cover; z-index: 5;">
    @else
        <!-- placeholder na pic if waray pa pet image -->
        <img src="{{ asset('images/default-placeholder.jpg') }}"
            style="position: absolute; top: 996px; left: 170px; width: 685px; height: 757px; object-fit: cover; z-index: 5;">
    @endif

    <!-- petname -->
    <div style="
        padding: 6px;
        /* border: 1px solid #C50565; */
        font-family: 'Pridi', sans-serif;
        font-weight: 700;
        text-transform: capitalize;
        position: absolute;
        top: 575px;
        left: 310px;
        width: 960px;
        height: 200px;
        font-size: 130px;
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
        {{ Illuminate\Support\Str::limit( $petName ?? 'Pet name', 12) }}
    </div>


    <!-- age -->
    <div style="
        text-align: center;
        /* border: 1px solid #C50565; */
        font-family: 'Pridi', sans-serif;
        font-weight: 400;
        padding-top: 7px;
        padding-left: 30px;
        padding-right: 30px;
        padding-bottom: 30px;
        position: absolute;
        top: 993px;
        left: 1270px;
        width: 155px;
        height: 70px;
        font-size: 40px;
        color: white;
        line-height: 1.3;
        z-index: 20;
        overflow-wrap: break-word;
        overflow: hidden;
    ">
        {{ $petAge ?? 'Age' }}
    </div>

    <!-- sex -->
    <div style="
        text-align: center;
        /* border: 1px solid #C50565; */
        font-family: 'Pridi', sans-serif;
        font-weight: 400;
        padding-top: 7px;
        padding-left: 30px;
        padding-right: 30px;
        padding-bottom: 30px;
        position: absolute;
        top: 993px;
        left: 903px;
        width: 325px;
        height: 70px;
        font-size: 40px;
        color: white;
        line-height: 1.3;
        z-index: 20;
        overflow-wrap: break-word;
        overflow: hidden;
    ">
        {{ $petSex ?? 'Sex' }}
    </div>

    <!-- bread -->
    <div style="
        text-align: center;
        /* border: 1px solid #C50565; */
        font-family: 'Pridi', sans-serif;
        font-weight: 400;
        padding-top: 7px;
        padding-left: 30px;
        padding-right: 30px;
        padding-bottom: 30px;
        position: absolute;
        top: 1150px;
        left: 908px;
        width: 515px;
        height: 70px;
        font-size: 40px;
        color: white;
        line-height: 1.3;
        z-index: 20;
        overflow-wrap: break-word;
        overflow: hidden;
    ">
        {{ $petBreed ?? 'Pet Breed' }}
    </div>


    <!-- pet desc -->
    <div style="
        text-align: justify;
        /* border: 1px solid #C50565; */
        font-family: 'Pridi', sans-serif;
        font-weight: 400;
        padding-top: 20px;
        padding-left: 30px;
        padding-right: 30px;
        padding-bottom: 30px;
        position: absolute;
        top: 1310px;
        left: 908px;
        width: 515px;
        height: 432px;
        font-size: 40px;
        color: white;
        line-height: 1.3;
        z-index: 20;
        overflow-wrap: break-word;
        overflow: hidden;
    ">
        {{ Illuminate\Support\Str::limit( $petDescription ?? 'Pet description goes here.', 155) }}
    </div>

    <!-- contact person -->
    <div style="
        position: absolute;
        top: 1970px;
        left: 157px;
        width: 1268px;
        height: 140px;
        font-size: 60px;
        color: #eeeeee;
        text-align: center;
        /* border: 1px solid #C50565; */
        font-family: 'Pridi', sans-serif;
        z-index: 20;
        text-transform: uppercase;
        overflow: hidden;
    ">
        {{ $contactPerson ?? 'Jane Doe' }}
    </div>

    <!-- contact number -->
    <div style="
        position: absolute;
        top: 1840px;
        left: 157px;
        width: 1268px;
        height: 172px;
        font-size: 107px;
        color: white;
        text-align: center;
        /* border: 1px solid #C50565; */
        font-family: 'Pridi', sans-serif;
        font-weight: 700;
        z-index: 20;
        overflow: hidden;
    ">
        {{ $contactNumber ?? '+63 900 000 0000' }}
    </div>
</div>
