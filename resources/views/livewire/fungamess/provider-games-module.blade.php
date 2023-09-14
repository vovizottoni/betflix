<x-app-layout>
      <x-slot name="header">
          <h2 class="font-semibold text-xl text-base-100 leading-tight">
          </h2>
      </x-slot>
  
      <div>
          <div class="">
            @livewire('fungamess.provider-games', ['name' => $name, 'id' => $id])
          </div>
      </div>
  </x-app-layout>