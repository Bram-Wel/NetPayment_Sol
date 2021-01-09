<div wire:poll="activeUsers" class="flex flex-row content-between bg-white p-5 rounded shadow-xl" style="width: 18rem">
        <span class="icon bg-green-100 rounded-full w-12 flex align-middle content-center" style="align-items: center"><ion-icon
                style="font-size: 25px" class="flex content-center align-middle mx-auto" name="wifi-outline"></ion-icon></span>
    <div class="sales-number flex flex-col ml-auto text-center">
        <span class="number text-black font-bold">{{ $activeUsers }}</span>
        <span class="total-sales font-light opacity-50">Active PPPOE Users</span>
    </div>
</div>
