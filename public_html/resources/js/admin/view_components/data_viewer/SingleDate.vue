<template>
    <label>
        <!--<input type="text" :placeholder="'عبارت جستجو ...'" class="two_column">-->
        <span style="display: flex">
            <DatePicker v-model="query_1" input-class="input_date filter_input" placeholder="عبارت جستجو ..."></DatePicker>
        </span>
    </label>
</template>

<script>
    import filterable_inputs_mixin from '../../mixins/FilterableInputesMixin.vue';
    import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
    export default {
        mixins:[filterable_inputs_mixin],
        components:{DatePicker:VuePersianDatetimePicker}
    }
</script>

<style>
    @media only screen and (min-width: 1212px) {
        .input_date {
            width: 23rem !important;
        }
    }
    @media only screen and (max-width: 1211px) {
        .input_date {
            width: 10.2rem !important;
        }
    }
    .filter_input {
        outline: 0;
        width: 10.2rem;
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