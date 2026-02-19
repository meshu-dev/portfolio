<?php

namespace App\Http\Resources;

use App\Actions\File\GetFileUrlAction;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Collection<int, Technology> $technologies */
        $technologies = TechnologyResource::collection($this->technologies);
        $technologies = $technologies->pluck('name');

        $imageUrl = resolve(GetFileUrlAction::class, ['name' => $this->files[0]->name])->execute();

        return [
            'name'         => $this->name,
            'description'  => $this->description,
            'url'          => $this->url,
            'image'        => $imageUrl,
            'repositories' => RepositoryResource::collection($this->repositories),
            'technologies' => $technologies
        ];
    }
}
