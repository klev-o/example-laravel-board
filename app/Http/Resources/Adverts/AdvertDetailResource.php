<?php

namespace App\Http\Resources\Adverts;

use App\Entity\Adverts\Advert\Photo;
use App\Entity\Adverts\Advert\Value;
use App\Entity\Adverts\Attribute;
use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Entity\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
// * @property int $user_id
// * @property int $category_id
// * @property int $region_id
 * @property string $title
 * @property string $content
 * @property int $price
 * @property string $address
 * @property Carbon $published_at
 * @property Carbon $expires_at
 *
 * @property User $user
 * @property Region $region
 * @property Category $category
 * @property Value[] $values
 * @property Photo[]|Collection $photos
 *
 * @method  mixed getValue($id)
 */
class AdvertDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => [
                'name' => $this->user->name,
                'phone' => $this->user->phone,
            ],
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ],
            'region' => $this->region ? [
                'id' => $this->region->id,
                'name' => $this->region->name,
            ] : [],
            'title' => $this->title,
            'content' => $this->content,
            'price' => $this->price,
            'address' => $this->address,
            'date' => [
                'published' => $this->published_at,
                'expires' => $this->expires_at,
            ],
            'values' => array_map(function (Attribute $attribute) {
                return [
                    'name' => $attribute->name,
                    'value' => $this->getValue($attribute->id),
                ];
            }, $this->category->allAttributes()),
            'photos' => array_map(function (Photo $photo) {
                return $photo->file;
            }, $this->photos->toArray()),
        ];
    }
}

/**
 * @OA\Schema(
 *     schema="AdvertDetail",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="user", type="object",
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(property="phone", type="string"),
 *     ),
 *     @OA\Property(property="category", type="object",
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="name", type="string"),
 *     ),
 *     @OA\Property(property="region", type="object",
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="name", type="string"),
 *     ),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="content", type="string"),
 *     @OA\Property(property="price", type="integer"),
 *     @OA\Property(property="address", type="string"),
 *     @OA\Property(property="date", type="object",
 *         @OA\Property(property="published", type="date"),
 *         @OA\Property(property="expires", type="date"),
 *     ),
 *     @OA\Property(property="values", type="array", @OA\Items(ref="#/definitions/AdvertValue")),
 *     @OA\Property(property="photos", type="array", @OA\Items(type="string")),
 * )
 *
 * @OA\Schema(
 *     schema="AdvertValue",
 *     type="object",
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="value", type="string"),
 * )
 */
