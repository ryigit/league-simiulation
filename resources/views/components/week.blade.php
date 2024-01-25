<div>
    <table class="border-collapse table-auto w-full text-sm">
        <thead class="table-auto">
        <tr>
            <th class="border-b dark:border-slate-600 font-medium p-4 text-slate-400 dark:text-slate-200 text-left">Week {{ $weekGames[0]->week ?? 'League Ended' }}</th>
        </tr>
        </thead>
        <tbody class="bg-white dark:bg-slate-800">
        @foreach($weekGames as $game)
            <tr>
                <td class="border-b border-slate-200 dark:border-slate-600 p-4 text-slate-500 dark:text-slate-400">{{ $game->homeTeam->name }} - {{ $game->awayTeam->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
