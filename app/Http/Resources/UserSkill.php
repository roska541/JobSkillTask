<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSkill extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => 'user_skills',
            'attributes' => [
                'user_id'  => (string)$this->user_id,
                'skill_id' => (string)$this->skill_id
            ]
        ];
    }
}
