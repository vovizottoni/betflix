<div class="p-3" wire:ignore>
    <section>
        <div class="md:flex md:items-center md:justify-between md:space-x-5 p-3">
            <div class="flex items-start space-x-5">
                <div class="pt-1.5">
                    <h1 class="text-2xl font-bold text-gray-900 uppercase"> Relatório analítico de usuários </h1>
                    <p class="text-sm font-medium text-gray-900"> Resumo Geral de Dados </p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="grid md:grid-cols-2 gap-y-6" style="padding: 30px; background: #0000000f; border: 1px dashed #00000021; border-radius: 5px;">
            <div>
                <h3 style="font-size: 70px; color: #000000c4;" class="text-center md:text-left">{{ $total_online_now }} <span style="font-size:20px; opacity: 0.7">usuários</span></h3>
                <p style="margin-top: 10px; background: #ff6101; width: fit-content; color: white; padding: 0 10px; border-radius: 20px; font-size: 13px; height: 20px; line-height: 19px;" class="mx-auto md:mx-0">Jogando agora</p>
            </div>
            <div class="grid md:grid-cols-2 gap-y-6">
                <div class="md:border-l-2 border-gray-400">
                        <p class="text-4xl text-center  font-semibold text-gray-900"> {{ $total_registered_users_today }} </p>
                        <p class="text-center truncate text-sm font-medium text-gray-500">Cadastrados hoje </p>
                    </dd>
                </div>
                <div>
                        <p class="text-4xl text-center font-semibold text-gray-900"> {{ $total_registered_users_yesterday }} </p>
                        <p class="text-center truncate text-sm font-medium text-gray-500">Cadastrados ontem </p>
                    </dd>
                </div>
            </div>
        </div>
        <div class="grid md:grid-cols-4 gap-4">
            <div class="md:col-span-3">
                <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-1 lg:grid-cols-1">
                    <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                        <dt>
                            <canvas id="registrationPeriod"></canvas>
                        </dt>
                    </div>
                </dl>
            </div>
            <dl class="md:col-span-1 mt-5 grid grid-cols-1 gap-4">

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-4 shadow sm:px-6">
                    <dt>
                        <div class="absolute rounded-md bg-red-600 p-3 gradient-card-green">
                        <!-- Heroicon name: outline/users -->
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Registros</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline pb-6 sm:pb-4">
                        <p class="text-2xl font-semibold text-gray-900"> {{ $total_users }} </p>
                    </dd>
                </div>

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-4 shadow sm:px-6">
                    <dt>
                        <div class="absolute rounded-md bg-red-600 p-3 gradient-card-green">
                        <!-- Heroicon name: outline/users -->
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"></path>
                        </svg>
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Verificações</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline pb-6 sm:pb-4">
                        <p class="text-2xl font-semibold text-gray-900"> {{ $total_verified_users }} </p>
                    </dd>
                </div>

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-4 shadow sm:px-6">
                    <dt>
                        <div class="absolute rounded-md bg-red-600 p-3 gradient-card-green">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 9l6-6m0 0l6 6m-6-6v12a6 6 0 01-12 0v-3"></path>
                        </svg>
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Total ativações</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline pb-6 sm:pb-4">
                        <p class="text-2xl font-semibold text-gray-900"> {{ $total_users_made_deposit }} </p>
                    </dd>
                </div>

                <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-4 shadow sm:px-6">
                    <dt>
                        <div class="absolute rounded-md bg-red-600 p-3 gradient-card-green">
                        <!-- Heroicon name: outline/users -->
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path>
                        </svg>
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">Conversão</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline pb-6 sm:pb-4">
                        <p class="text-2xl font-semibold text-gray-900"> {{ $conversion_registration_vs_deposit }}% </p>
                    </dd>
                </div>

            </dl>
        </div>
    </section>

    <section>

    </section>

    <section>
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-2">
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <canvas id="usersCountry"></canvas>
                </dt>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">País</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Usuários Cadastrados</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Usuários Ativos</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($users_country as $item)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                            <div class="flex items-center">
                                <div class="h-10 w-10 flex-shrink-0">
                                    @if(empty($item->country))
                                    <img class="h-10 w-10 rounded-full" src="https://cdn-icons-png.flaticon.com/512/975/975645.png" alt="">
                                    @else
                                    <img class="h-10 w-10 rounded-full" src="https://flagicons.lipis.dev/flags/4x3/{{ strtolower($item->country) }}.svg" alt="">
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="font-medium text-gray-900"> {{ $item->country }} </div>
                                </div>
                            </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div class="text-gray-900"> {{ $item->total }} </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div class="text-gray-900"> {{ $item->total_active }} </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </dl>
    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.1.1/chart.umd.min.js" integrity="sha512-RnIvaWVgsDUVriCOO7ZbDOwPqBY1kdE8KJFmJbCSFTI+a+/s+B1maHN513SFhg1QwAJdSKbF8t2Obb8MIcTwxA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        (async function() {
            const dataUsersCountry = {
                labels: [ '{!! implode("','", $users_country_name) !!}' ],
                datasets: [{
                    label: 'Usuários cadastrados',
                    data: [{{ implode(',', $users_country_total) }}],
                    hoverOffset: 4
                }]
            };

            new Chart(
                document.getElementById('usersCountry'),
                {
                type: 'doughnut',
                data: dataUsersCountry
                }
            );

            const MONTHS = [
                            'Janeiro',
                            'Fevereiro',
                            'Março',
                            'Abril',
                            'Maio',
                            'Junho',
                            'Julho',
                            'Agosto',
                            'Setembro',
                            'Outubro',
                            'Novembro',
                            'Dezembro'
                            ];

            function months(config) {
                var cfg = config || {};
                var count = cfg.count || 12;
                var section = cfg.section;
                var values = [];
                var i, value;

                for (i = 0; i < count; ++i) {
                    value = MONTHS[Math.ceil(i) % 12];
                    values.push(value.substring(0, section));
                }

                return values;
            }

            const labels = months({count: 12});
            const dataRegistrationPeriod = {
            labels: labels,
            datasets: [{
                label: 'Registro por período ano {{ date("Y") }}',
                data: [{{ $total_users_month_year }}],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
            };

            new Chart(
                document.getElementById('registrationPeriod'),
                {
                type: 'line',
                data: dataRegistrationPeriod
                }
            );
        })();
    </script>
</div>
