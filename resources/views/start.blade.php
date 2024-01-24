<x-layout>
    <div class="flex items-center">
        <table class="border-collapse table-auto w-full text-sm">
            <thead class="table-auto">
                <tr>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Team Name</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-slate-800">
            @foreach($teams as $team)
                <tr>
                    <td class="border-b border-slate-200 dark:border-slate-600 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $team->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex items-center">
        <form action="{{route('fixture.generate')}}" method="post">
            @csrf
            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Generate Fixtures
            </button>
        </form>
    </div>
</x-layout>
