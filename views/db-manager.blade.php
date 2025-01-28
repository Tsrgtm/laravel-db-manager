<div>
    <h1 class="text-2xl font-bold mb-4">Database Manager</h1>
    
    <select wire:model="selectedTable" class="border p-2 mb-4">
        <option value="">Select a Table</option>
        @foreach ($tables as $table)
            <option value="{{ $table->{'Tables_in_' . env('DB_DATABASE')} }}">{{ $table->{'Tables_in_' . env('DB_DATABASE')} }}</option>
        @endforeach
    </select>

    @if ($selectedTable)
        <h2 class="text-xl font-semibold mb-2">Data for: {{ $selectedTable }}</h2>
        @if ($message)
            <div class="mb-4 text-green-600">{{ $message }}</div>
        @endif
        
        <table class="min-w-full border-collapse border border-gray-200">
            <thead>
                <tr>
                    @foreach ($rows->first() as $key => $value)
                        <th class="border border-gray-300 p-2">{{ $key }}</th>
                    @endforeach
                    <th class="border border-gray-300 p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    <tr>
                        @foreach ($row as $cell)
                            <td class="border border-gray-300 p-2">{{ $cell }}</td>
                        @endforeach
                        <td class="border border-gray-300 p-2">
                            <button wire:click="edit({{ json_encode($row) }})" class="bg-blue-500 text-white px-2 py-1">Edit</button>
                            <button wire:click="delete({{ $row->id }})" class="bg-red-500 text-white px-2 py-1">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($isEditing)
            <h3 class="text-lg font-semibold mt-4">Edit Row</h3>
            <form wire:submit.prevent="update">
                @foreach ($currentRow as $key => $value)
                    <div class="mb-2">
                        <label>{{ $key }}:</label>
                        <input type="text" wire:model="currentRow.{{ $key }}" class="border p-2 w-full" />
                    </div>
                @endforeach
                <button type="submit" class="bg-green-500 text-white px-4 py-2">Update</button>
                <button type="button" wire:click="resetFields" class="bg-gray-500 text-white px-4 py-2">Cancel</button>
            </form>
        @endif
    @endif
</div>