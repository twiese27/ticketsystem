<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Answer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    /* public function toArray($request)
    {
        return parent::toArray($request);
    } */
    public function toArray($request)
    {
        
        return [
            'entry_id' => $this->entry_id,
            'user_id' => $this->user_id,
            'answer_text' => $this->answer_text
        ];
    }
}
