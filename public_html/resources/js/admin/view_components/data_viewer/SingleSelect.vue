<template>
    <label>
        <select2
                :user_options="filterCandidate.field.options"
                :id="'filterCandidate-input-'+id"
                :name="'filterCandidate-input-'+id"
                :key="'filterCandidate-input-'+id"
                :tags="false"
                input_class="two_column"
                :placeholder="$t('messages.select_item')"
                :value="query_1"
                :search="false"
                :multiple="false"
                :allowClear="true"
                :direction="$store.getters.direction"
                @input="updateInput({key:'query_1',value:$event})"
               >
        </select2>
    </label>
</template>

<script>
    import filterable_inputs_mixin from '../../mixins/FilterableInputesMixin.vue';
    import select2 from '../../components/Select2.vue';

    export default {
        mixins: [filterable_inputs_mixin],
        components: {select2},
    }
</script>

<style>
    @media only screen and (min-width: 1212px) {
        .two_column {
            width: 25.2rem !important;
        }
    }
    @media only screen and (max-width: 1211px) {
        .two_column {
            width: 12.5rem !important;
        }
    }
</style>