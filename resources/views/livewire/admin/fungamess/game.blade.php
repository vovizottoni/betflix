<div class="px-4 sm:px-6 lg:px-8 p-5">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-base font-semibold leading-6 text-gray-900"> 
            <a href="{{ route('admin.fungamess.provider') }}" style="text-decoration:underline;"> Provedores </a> &raquo; {{ $provider->name }} &raquo; Games </h1>
        </div>
      </div>
      
      <div class="mt-8 flow-root">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <table class="min-w-full divide-y divide-gray-300">
              <thead>
                <tr>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Página Inicial</th>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"> Logo </th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Nome</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"> Tipo </th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                @foreach ($games as $item)
                <tr>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    <div class="relative flex items-start">
                      <div class="flex h-6 items-center">
                        <input class="input-home-page" id="comments-{{ $item->id }}" wire:click="homePage({{ $item->id }}, {{ $item->home_page }})" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" @if ($item->home_page) checked @endif>
                      </div>
                    </div>
                  </td>
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-0">
                    <div class="flex items-center">
                      <div class="h-20 w-20 flex-shrink-0">
                        <img class="h-20 w-20 rounded-full" src="{{$item->img}}" alt="">
                      </div>
                    </div>
                  </td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                      <div class="text-gray-900"> 
                        {{ $item->name }} 
                       </div>
                  </td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <div class="text-gray-900"> 
                          {{ $item->type }} 
                         </div>
                    </td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    <label class="relative inline-flex items-center cursor-pointer" wire:click="activeInactive({{ $item->id }}, {{ $item->active }})">
                      <input type="checkbox" value="{{ $item->active }}" class="sr-only peer" @if($item->active) checked @endif>
                      <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
  
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script>
        $('.input-home-page').click(function(){
          console.log('clicou')
          $("html, body").animate({ scrollTop: 0 }, "slow");
          // return false;
        });
      </script>
    </div>
    