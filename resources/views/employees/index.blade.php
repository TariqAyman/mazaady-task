<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white shadow sm:rounded-lg p-6">
            <!-- Flash message -->
            @if(session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold">All Employees</h3>
                <a href="{{ route('employees.create') }}">
                    + New Employee
                </a>
            </div>

            @if($employees->count() > 0)
                <table class="min-w-full divide-y divide-gray-200 border">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Name
                        </th>
                        <th class="px-6 py-3"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($employees as $employee)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $employee->id }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <a href="{{ route('employees.show', $employee) }}"
                                   class="text-blue-600 hover:underline"
                                >
                                    {{ $employee->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-right">
                                <a href="{{ route('employees.edit', $employee) }}"
                                   class="text-indigo-600 hover:text-indigo-900 mr-2"
                                >
                                    Edit
                                </a>
                                <form action="{{ route('employees.destroy', $employee) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Delete this employee?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- Pagination (if using paginate) -->
                <div class="mt-4">
                    {{ $employees->links() }}
                </div>
            @else
                <p class="text-gray-600 mt-4">No employees found.</p>
            @endif
        </div>
    </div>
</x-app-layout>
