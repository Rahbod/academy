<template>
    <label>
        <input type="text" :placeholder="$t('table.search_placeholder')" class="two_column" v-model="query_1">
    </label>
</template>

<script>
    import filterable_inputs_mixin from '../../mixins/FilterableInputesMixin.vue'
    export default {
        mixins:[filterable_inputs_mixin]
    }
</script>