<?php
interface CrudInterface extends ListableInterface
{
    public function getById(string $id): ?array;
    public function create(array $datos): bool;
    public function update(string $id, array $datos): bool;
    public function delete(string $id): bool;
}
