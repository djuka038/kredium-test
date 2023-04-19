<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <a href="{{ route('reportCsv') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Download report</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full text-gray-900 dark:text-gray-100">
                        <thead>
                            <tr>
                                <th scope="col">Product type</th>
                                <th scope="col">Product value</th>
                                <th scope="col">Creation date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($report as $r)
                                <tr>
                                    <td>{{ $r->product_type }}</td>
                                    <td>{{ $r->product_value }}</td>
                                    <td>{{ $r->creation_date }}</td>
                                </tr>
                            @empty
                                <tr><p>No report</p></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
