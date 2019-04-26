<template>
    <div style="display: inline;">
        <label>
            <select2
                    :user_options="filterCandidate.field.options"
                    :id="'filterCandidate-input1-'+id"
                    :key="'filterCandidate-input1-'+id"
                    :name="'filterCandidate-input1-'+id"
                    :tags="false"
                    :width="'12.5rem'"
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
        <label>
            <select2
                    :user_options="filterCandidate.field.options"
                    :id="'filterCandidate-input2-'+_uid"
                    :key="'filterCandidate-input2-'+_uid"
                    :name="'filterCandidate-input2-'+_uid"
                    :tags="false"
                    :width="'12.5rem'"
                    :placeholder="$t('messages.select_item')"
                    :value="query_2"
                    :search="false"
                    :multiple="false"
                    :allowClear="true"
                    :direction="$store.getters.direction"
                    @input="updateInput({key:'query_2',value:$event})"
            >
            </select2>
        </label>
    </div>
</template>

<script>
    import filterable_inputs_mixin from '../../mixins/FilterableInputesMixin.vue';
    import select2 from '../../components/Select2.vue';

    export default {
        mixins: [filterable_inputs_mixin],
        components: {select2}
    }
</script>