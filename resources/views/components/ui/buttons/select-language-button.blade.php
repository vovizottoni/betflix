<div
  class="dropdown-bottom dropdown-end dropdown w-36 cursor-pointer p-0 hover:bg-transparent">
  <div tabindex="0"
    class="auth-btn remove-focus mx-auto flex w-36 items-center justify-start gap-2 border bg-transparent py-2 px-4 text-white hover:bg-white hover:text-black">
    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
      xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
      </path>
    </svg>

    {{-- @if (Session()->has('applocale') && Session()->get('applocale') == 'en')
      <span>{{ __('app.english') }}</span>
    @else --}}
      <span>{{ __('app.portuguese') }}</span>

    {{-- @endif --}}
  </div>

    {{-- componente livewire para troca de idiomas --}}
    @livewire('languages.languages')

  </div>
