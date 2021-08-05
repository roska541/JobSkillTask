<?php

namespace App\Http\Resources;

use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\UserSkill as UserSkillModel;

class User extends JsonResource
{
    protected $storage;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->storage['user_skills'] = $this->user_skills;

        return [
            'id' => (string)$this->id,
            'type' => 'users',
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email
            ]
        ];
    }

    /**
     * Attach additional data to the resource array
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        $included = $this->storage['user_skills'] ?: collect([]);

        return [
            'included' => $this->withIncluded($included),
        ];
    }



    /**
     * Filter each resource object through its resource representation
     *
     * @param  \Illuminate\Support\Collection  $included
     * @return array
     */
    private function withIncluded(Collection $included)
    {
        // Reset indexes
        return array_values($included->map(function ($include) {
            if ($include instanceof UserSkillModel) {
                return new UserSkill($include);
            }
        })->all());
    }
}
