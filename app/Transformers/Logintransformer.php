<?php

namespace App\Transformers;

use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;

class Logintransformer extends TransformerAbstract
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
    public function transform($token)
    {
        return [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'token' => $token,
        ];
    }
}
