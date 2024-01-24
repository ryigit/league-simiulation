<div>
    <table class="border-collapse table-auto w-full text-sm">
        <thead class="table-auto">
        <tr>
            <th class="border-b dark:border-slate-600 text-left">Team</th>
            <th class="border-b dark:border-slate-600 text-left">Chance(%)</th>
        </tr>
        </thead>
        <tbody class="bg-white dark:bg-slate-800">
        @foreach($predictions as $team)
            <tr>
                <td class="border-b border-slate-200 dark:border-slate-600 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $team->name }}</td>
                <td class="border-b border-slate-200 dark:border-slate-600 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $team->chance }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
