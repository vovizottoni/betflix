<x-admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-base-100 leading-tight">
        </h2>
    </x-slot>

    <div>
        <div class="">
            @livewire('admin.kyc.kyc-details', ['user_id' => $user_id])
        </div>
    </div>
</x-admin>