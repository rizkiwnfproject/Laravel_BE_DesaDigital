<?php

namespace App\Interfaces;

interface ProfileRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute
    );

    public function getAllPaginated(
        ?string $search,
        ?int $rowPerPage,
    );

    public function getById(
        string $id
    );
    
    public function create(
        array $data
    );
    
    public function update(
        string $id,
        array $data
    );
    
    public function delete(
        string $id
    );
}
