<x-admin>
      <x-slot name="header">
          <h2 class="font-semibold text-xl text-base-100 leading-tight">
          </h2>
      </x-slot>
  
      <div>
          <div class="">
              @livewire('admin.fungamess.game', ['provider_id' => $provider_id])
          </div>
      </div>
  </x-admin>