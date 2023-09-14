<div>
    <ul tabindex="0"
    class="dropdown-content card-compact mt-2 w-36 rounded-sm border border-zinc-700 bg-base-900">
    <li>
      <span wire:key='key_language_pt' wire:click='switchLang("pt")' class="flex p-3 w-full">
        <img src="/assets/images/flags/brazil.png" alt=""
          class="w-5 mr-0">
        <span class="ml-2">{{ __('app.portuguese') }}</span>
      </span>
    </li>
    {{-- <li>
      <span wire:key='key_language_en' wire:click='switchLang("en")' class="flex p-3 w-full">
        <img src="/assets/images/flags/united-states.png" alt=""
          class="w-5 mr-0">
        <span class="ml-2">{{ __('app.english') }}</span>
      </span>
    </li> --}}
  </ul>
</div>
