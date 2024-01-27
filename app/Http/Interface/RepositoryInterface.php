<?php

namespace App\Http\Interface;

interface RepositoryInterface
{
    public function getAll();
    // public function getById($id);
    public function create(array $attributes);
    // public function update($id, array $attributes);
    // public function delete($id);
}
