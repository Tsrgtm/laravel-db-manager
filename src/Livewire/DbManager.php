<?php

namespace Tsrgtm\DbManager\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DbManager extends Component
{
    public $tables = [];
    public $selectedTable = null;
    public $rows = [];
    public $currentRow = [];
    public $isEditing = false;
    public $message = '';

    public function mount()
    {
        // Get the database tables
        $this->tables = $this->getTables();
        $this->selectedTable = null; // Initialize the selected table
    }

    private function getTables()
    {
        // Get the database tables depending on the database connection
        $connection = config('database.default');

        switch ($connection) {
            case 'sqlite':
                return DB::select("SELECT name FROM sqlite_master WHERE type='table'");
            case 'mysql':
            case 'pgsql':
                return DB::select('SHOW TABLES');
            case 'sqlsrv':
                return DB::select("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE'");
            default:
                return []; // Return an empty array for unsupported databases
        }
    }

    public function updatedSelectedTable($table)
    {
        // Fetch data from the selected table
        $this->rows = DB::table($table)->get();
        $this->currentRow = [];
        $this->isEditing = false;
        $this->message = "Data fetched for table: $table";
    }

    public function edit($row)
    {
        $this->currentRow = (array) $row;
        $this->isEditing = true;
    }

    public function update()
    {
        if ($this->selectedTable) {
            DB::table($this->selectedTable)
                ->where('id', $this->currentRow['id'])
                ->update($this->currentRow);
            
            $this->message = "Row updated successfully.";
            $this->resetFields();
            $this->updatedSelectedTable($this->selectedTable);
        }
    }

    public function delete($id)
    {
        if ($this->selectedTable) {
            DB::table($this->selectedTable)->where('id', $id)->delete();
            $this->message = "Row deleted successfully.";
            $this->updatedSelectedTable($this->selectedTable);
        }
    }

    public function resetFields()
    {
        $this->currentRow = [];
        $this->isEditing = false;
        $this->message = '';
    }

    public function render()
    {
        return view('db-manager::db-manager');
    }
}
