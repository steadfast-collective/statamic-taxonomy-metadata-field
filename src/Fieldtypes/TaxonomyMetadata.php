<?php

namespace SteadfastCollective\StatamicTaxonomyMetadataField\Fieldtypes;

use Statamic\Facades\Term;
use Statamic\Fields\Fieldtype;

class TaxonomyMetadata extends Fieldtype
{
    /**
     * The blank/default value.
     *
     * @return array
     */
    public function defaultValue()
    {
        return null;
    }

    /**
     * Pre-process the data before it gets sent to the publish page.
     *
     * @param mixed $data
     * @return array|mixed
     */
    public function preProcess($data)
    {
        return $data;
    }

    /**
     * Process the data before it gets saved.
     *
     * @param mixed $data
     * @return array|mixed
     */
    public function process($data)
    {
        return $data;
    }

    /**
     * Preload the fieldtype with any required data.
     *
     * @return array
     */
    public function preload()
    {
        $terms = Term::query()
            ->where('taxonomy', $this->config('taxonomy'))
            ->get();

        return [
            'terms' => $terms
        ];
    }

    /**
     * Configuration fields.
     *
     * @return array
     */
    protected function configFieldItems(): array
    {
        return [
            'taxonomy' => [
                'display' => 'Select Taxonomy',
                'instructions' => 'Specify taxonomy to be used for this field',
                'type' => 'taxonomies',
                'max_items' => 1,
                'mode' => 'select',
                'create' => false,
                'validate' => 'required',
                'width' => 100
            ],
        ];
    }
}
