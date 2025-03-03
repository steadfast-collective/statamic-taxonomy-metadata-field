<?php

namespace SteadfastCollective\StatamicTaxonomyMetadataField\Fieldtypes;

use Statamic\Facades\Term;
use Statamic\Fields\Fieldtype;

class TaxonomyMetadata extends Fieldtype
{
    protected $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>';

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

    public function augment($value)
    {
        return collect($value)
            ->map(function ($item) {
                return [
                    'term' => Term::find(
                        __(':taxonomy:::term', [
                            'taxonomy' => $this->config('taxonomy'),
                            'term' => $item['term']
                        ])
                    ),
                    'data' => $item['data']
                ];
            })
            ->filter(function($item) {
                return $item['term'] != null;
            });
    }
}
