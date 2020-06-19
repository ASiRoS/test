<?php

namespace App\Message\Storage;

use Illuminate\Support\Facades\Storage;

class File
{
    private string $file;
    private array $order;

    public function __construct(string $file, array $order)
    {
        $this->file = $file;
        $this->order = $order;

        $this->createIfNotExists();
    }

    public function generateId(): int
    {
        $rows = $this->getRows();
        $count = count($rows);

        if($count < 1) {
            return 1;
        }

        $lastRow = $this->getLastRow($rows);

        return (int)$lastRow['id'] + 1;
    }

    public function append(array $row): void
    {
        Storage::append($this->file, $this->toString($row));
    }

    public function getRowWithConditions(array $where): ?array
    {
        foreach($this->getRows() as $row) {
            if($this->rowHasValidConditions($row, $where)) {
                return $row;
            }
        }

        return null;
    }

    public function getRowsWithConditions(array $where): array
    {
        return array_filter(
            $this->getRows(),
            fn($row) => $this->rowHasValidConditions($row, $where)
        );
    }

    private function rowHasValidConditions(array $row, array $where): bool
    {
        foreach($where as $field => $value) {
            if($row[$field] != $value) {
               return false;
            }
        }

        return true;
    }

    public function getRows(): array
    {
        $rows = explode(
            "\n",
            Storage::get($this->file)
        );

        $rows = array_filter($rows, fn(string $row) => !empty(trim($row)));

        foreach($rows as $key => $row) {
            $rows[$key] = $this->getFields($row);
        }

        return $rows;
    }

    public function getLastRow(array $rows): array
    {
        return $rows[count($rows) - 1];
    }

    private function getFields(string $row): array
    {
        $fields = explode('|', $row);
        $result = [];

        foreach($fields as $index => $field) {
            $result[$this->order[$index]] = $field;
        }

        return $result;
    }

    private function put(string $content = ''): void
    {
        Storage::put($this->file, $content);
    }

    private function toString(array $row): string
    {
        $fields = array_reduce(
            $this->order,
            fn(string $acc, string $field) => $acc . '|' . $row[$field],
            ''
        );

        return ltrim($fields,'|');
    }

    public function remove(array $where)
    {
        $rows = $this->getRows();

        foreach($rows as $index => $row) {
            if($this->rowHasValidConditions($row, $where)) {
                unset($rows[$index]);
            }
        }

        $rows = array_map([$this, 'toString'], $rows);
        $rows = implode(PHP_EOL, $rows);

        $this->put($rows);
    }

    private function createIfNotExists(): void
    {
        if(Storage::missing($this->file)) {
            $this->put();
        }
    }
}
