<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardStoreRequest;
use App\Http\Resources\CardResource;
use App\Models\Card;
use Carbon\Carbon;

class CardController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CardStoreRequest $request): CardResource
    {
        $card = new Card();
        $card->user_id = $request->user()->id;
        $card->name = $request->input('name');
        $card->number = $request->input('number');
        $card->validity = Carbon::createFromFormat('Y-m', $request->input('validity'));
        $card->cvv = $request->input('cvv');
        $card->save();

        return new CardResource($card);
    }
}
