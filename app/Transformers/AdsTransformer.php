<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class AdsTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'tags'
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [

    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($ads)
    {

        return [
            'id' => $ads->title ?? '-',
            'title' => $ads->title ?? '-',
            'description' => $ads->description ?? '-',
            'category_id' => $ads->category_id ?? '-',
            'category' => $ads->category->name ?? '-',
            'type' => $ads->type ?? '-',
            'advertiser_id' => $ads->advertiser_id ?? '-',
            'advertiser' => $ads->advertiser->name ?? '-',
            'start_date' => $ads->start_date ?? '-',
        ];
    }

    public function includeTags($ads)
    {
        $tags = $ads->tags;

        return $this->collection($tags, new TagsTransformer());
    }
}
