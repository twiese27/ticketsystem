<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Entry extends JsonResource
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
            'ticketnumber' => $this->ticketnumber,
            'first_name' => $this->first_name ,
            'last_name' => $this->last_name,
            'customer_number' => $this->customer_number,
            'email' => $this->email,
            'category' => $this->category,
            'text' => $this->text,
            'status_id' => $this->status_id,
            'link' => $this->link,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
