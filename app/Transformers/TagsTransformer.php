<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class TagsTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($tag)
    {
        return [
            'id' => $tag->id,
            'name' => $tag->name,
        ];
    }
}
