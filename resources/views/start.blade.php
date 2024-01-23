<x-layout>
    <div class="flex items-center">
        <table class="border-collapse table-auto w-full text-sm">
            <thead class="table-auto">
                <tr>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Team Name</th>
                </tr>
            </thead>
            <tbody>
            @foreach($teams as $team)
                <tr>
                    <td class="border-b border-slate-200 dark:border-slate-600 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $team->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
