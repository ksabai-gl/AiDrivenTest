<?php 
namespace App\Contracts\Queries;
interface QueryInterface {
    function handle(array $data) : array;
}