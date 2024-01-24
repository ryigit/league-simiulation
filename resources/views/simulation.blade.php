<x-layout>
    <div class="flex items-center">
        <x-standings :teams="$teams"/>
        <x-week :weekGames="$weekGames"/>
        <x-predictions :predictions="$predictions"/>
    </div>
    <div class="flex items-center">
        <form action="{{route('simulation.simulateAllWeeks')}}" method="POST" class="flex items-center justify-center my-6">
            @csrf
            <button type="submit"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Simulate All Weeks
            </button>
        </form>
    </div>
    <div class="flex items-center">
        <form action="{{route('simulation.simulateNextWeek')}}" method="POST" class="flex items-center justify-center my-6">
            @csrf
            <button type="submit"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Simulate Next Week
            </button>
        </form>
    </div>
</x-layout>
