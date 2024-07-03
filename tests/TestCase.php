<?php

namespace SteadfastCollective\StatamicTaxonomyMetadataField\Tests;

use SteadfastCollective\StatamicTaxonomyMetadataField\ServiceProvider;
use Statamic\Testing\AddonTestCase;

abstract class TestCase extends AddonTestCase
{
    protected string $addonServiceProvider = ServiceProvider::class;
}
