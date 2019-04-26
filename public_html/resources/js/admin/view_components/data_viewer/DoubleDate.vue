<template>
    <div style="display: inline;">
        <label>
            <span style="display: flex">
                <DatePicker v-model="query_1" input-class="double_date" placeholder="عبارت جستجو ..."></DatePicker>
            </span>
        </label>
        <label>
            <span style="display: flex">
                <DatePicker v-model="query_2" input-class="double_date" placeholder="عبارت جستجو ..."></DatePicker>
            </span>
        </label>
    </div>

</template>

<script>
    import filterable_inputs_mixin from '../../mixins/FilterableInputesMixin.vue';
    import VuePersianDatetimePicker from 'vue-persian-datetime-picker';

    export default {
        mixins: [filterable_inputs_mixin],
        components: {DatePicker: VuePersianDatetimePicker}
    }
</script>

<style>
    .vpd-input-group .double_date {
        outline: 0;
        width: 10.2rem !important;
        padding: .4375rem .875rem !important;
        padding-left: 2rem !important;
        font-size: .8125rem;
        line-height: 1.5385 !important;
        color: #333;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: .1875rem;
    }
</style>