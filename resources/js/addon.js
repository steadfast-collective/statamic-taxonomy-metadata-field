import TaxonomyMetadata from './components/fieldtypes/TaxonomyMetadata.vue'

Statamic.booting(() => {
    Statamic.component('taxonomy_metadata-fieldtype', TaxonomyMetadata)
})
