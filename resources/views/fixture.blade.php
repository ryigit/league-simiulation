<x-layout>
    <div class="flex items-center">
        <div class="grid grid-cols-4 gap-4">
            @foreach($weeks as $key => $weekGames)
                <div>
                    <table class="border-collapse table-auto w-full text-sm">
                        <thead class="table-auto">
                        <tr>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Week {{ $key }}</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800">
                        @foreach($weekGames as $game)
                            <tr>
                                <td class="border-b border-slate-200 dark:border-slate-600 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $game->homeTeam->name }} - {{ $game->awayTeam->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
    <div class="flex items-center">
        <a class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" href ="{{ route('simulation.index') }}">Start Simulation</a>
    </div>
</x-layout>
