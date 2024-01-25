<div>
    <table class="border-collapse table-auto w-full text-sm">
        <thead class="table-auto">
        <tr>
            <th class="border-b dark:border-slate-600 font-medium p-4 text-slate-400 dark:text-slate-200 text-left">Team</th>
            <th class="border-b dark:border-slate-600 font-medium p-4 text-slate-400 dark:text-slate-200 text-left">P</th>
            <th class="border-b dark:border-slate-600 font-medium p-4 text-slate-400 dark:text-slate-200 text-left">W</th>
            <th class="border-b dark:border-slate-600 font-medium p-4 text-slate-400 dark:text-slate-200 text-left">D</th>
            <th class="border-b dark:border-slate-600 font-medium p-4 text-slate-400 dark:text-slate-200 text-left">L</th>
            <th class="border-b dark:border-slate-600 font-medium p-4 text-slate-400 dark:text-slate-200 text-left">GD</th>
        </tr>
        </thead>
        <tbody class="bg-white dark:bg-slate-800">
        @foreach($teams as $team)
            <tr>
                <td class="border-b border-slate-200 dark:border-slate-600 p-4 text-slate-500 dark:text-slate-400">{{ $team->name }}</td>
                <td class="border-b border-slate-200 dark:border-slate-600 p-4 text-slate-500 dark:text-slate-400">{{ $team->point }}</td>
                <td class="border-b border-slate-200 dark:border-slate-600 p-4 text-slate-500 dark:text-slate-400">{{ $team->win }}</td>
                <td class="border-b border-slate-200 dark:border-slate-600 p-4 text-slate-500 dark:text-slate-400">{{ $team->draw }}</td>
                <td class="border-b border-slate-200 dark:border-slate-600 p-4 text-slate-500 dark:text-slate-400">{{ $team->loss }}</td>
                <td class="border-b border-slate-200 dark:border-slate-600 p-4 text-slate-500 dark:text-slate-400">{{ $team->goal_difference }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
