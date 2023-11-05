<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface TaskServiceInterface
{
    public function all();
    public function store(array $attribute);
    public function update(array $attributes, int $id);
    public function find(int $id);
    public function delete(int $id);
}
