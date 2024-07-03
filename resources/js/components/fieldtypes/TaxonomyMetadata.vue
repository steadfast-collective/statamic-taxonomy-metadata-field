<template>
    <div class="flex flex-col gap-2">
        <div class="relative">
            <text-input
                v-model="searchQuery"
                placeholder="Type to search..." />
            <button
                v-if="searchQuery != null "
                @click="searchQuery = null"
                class="absolute right-0 top-0 h-full w-10 flex items-center justify-center text-gray-700"
                aria-label="Clear search"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                    <path d="M18 6 6 18M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div
            v-for="(term, index) in filteredTerms"
            :key="index"
            class="flex border border-gray-300 p-2 gap-4 rounded-md">
            <label class="flex gap-2 items-center w-1/2 hover:cursor-pointer">
                <input
                    type="checkbox"
                    :value="term.slug"
                    v-model="selectedTerms[term.slug]"
                    @change="updateValue">
                <span v-text="term.title" />
            </label>

            <text-input
                class="w-1/2"
                placeholder="Add data..."
                v-model="termData[term.slug]"
                @input="updateValue"
                :disabled="!selectedTerms[term.slug]" />
        </div>
    </div>

</template>

<script>
export default {
    mixins: [Fieldtype],

    data() {
        return {
            selectedTerms: {},
            termData: {},
            searchQuery: null,
        };
    },

    computed: {
        filteredTerms() {
            if(!this.searchQuery) {
                return this.meta.terms
            }

            const lowercaseQuery = this.searchQuery.toLowerCase()

            return this.meta.terms.filter(term => term.title.toLowerCase().includes(lowercaseQuery))
        }
    },

    created() {
        if(this.value !== null) {
            this.value.forEach(item => {
                this.selectedTerms[item.term] = true
                this.termData[item.term] = item.data
            })
        }
    },

    methods: {
        updateValue() {
            const value = Object.keys(this.selectedTerms)
                .filter(termId => this.selectedTerms[termId])
                .map(termId => ({
                    term: termId,
                    data: this.termData[termId] || null
                }));

            this.update(value);
        }
    }
};
</script>
