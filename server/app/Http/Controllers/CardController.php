<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Database\Eloquent\Collection;

class CardController extends Controller
{
    public function index() : Collection
    {
        return Card::all();
    }

    public function show(int $id) : Card
    {
        return Card::query()->findOrFail($id);
    }
}
