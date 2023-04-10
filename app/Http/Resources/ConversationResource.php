<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data['id'] = $this->id;
		$data['user'] = auth()->user()->id == $this->user_id ? new UserResource(User::find($this->seconde_user_id)) :  new UserResource(User::find($this->user_id)) ;
		$data['created_at'] = $this->created_at;
		$data['messages'] = MessageResource::collection($this->messages);
		return $data;
    }
}
