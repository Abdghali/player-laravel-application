<?php

namespace Abdo\RestoreFeesCard;

use Laravel\Nova\Card;

class RestoreFeesCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/2';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'restore-fees-card';
    }

    public function value($count = 0)
    {
        return $this->withMeta([
            'count' => $count
        ]);
    }

    public function name($name = '')
    {
        return $this->withMeta([
            'name' => $name
        ]);
    }
}
