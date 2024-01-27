<?php

namespace App\Http\Interface;


interface UserInterface
{
    public function getAll();
    public function getById($id);
    public function create();
    public function update();
    public function delete($id);
}
