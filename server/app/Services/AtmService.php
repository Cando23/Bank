<?php

namespace App\Services;

use App\Models\Card;
use Illuminate\Validation\ValidationException;

class AtmService
{

    public function createCard()
    {
        return Card::query()->create([
            "number" => str_pad(mt_rand(0, 9999999999999999), 16, '0', STR_PAD_LEFT),
            "pin" => str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT)
        ])->id;
    }

    public function validateCard($data) {
        $card = Card::query()->where("number", $data["number"])->firstOrFail();
        if ($card->pin !== $data["pin"]) {
            throw ValidationException::withMessages([
                'error' => 'Wrong pin!'
            ]);
        }
        return $card->id;
    }
}
