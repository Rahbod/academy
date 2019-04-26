<template>
    <div style="display: inline;">
        <label>
            <input type="text" :placeholder="$t('table.search_placeholder')" v-model="query_1">
        </label>
        <label>
            <input type="text" :placeholder="$t('table.search_placeholder')" v-model="query_2">
        </label>
        <div style="display: none">{{updating}}</div>
    </div>

</template>

<script>
    import filterable_inputs_mixin from '../../mixins/FilterableInputesMixin.vue'
    export default {
        mixins:[filterable_inputs_mixin]
    }
</script>