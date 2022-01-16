<?php

namespace AbdoNajjar\GoogleMapMarker;

use Laravel\Nova\Fields\Field;

class GoogleMapMarker extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'google-map-marker';



    public function zoom($zoom = 8)
    {
        return $this->withMeta([
            'zoom'  => $zoom
        ]);
    }

    public function lat($lat)
    {
        return $this->withMeta([
            'lat'  => $lat
        ]);
    }

    public function lng($lng)
    {
        return $this->withMeta([
            'lng'  => $lng
        ]);
    }
}
