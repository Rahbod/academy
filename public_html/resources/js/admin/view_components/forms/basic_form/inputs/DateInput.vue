<template>
    <div class="form-group row" :class="[index == null?'row':'']">
        <label class="cursor-pointer" :class="label_class()" v-text="lable" :for="getId(info.name)"></label>
        <div :class="input_container_class">
            <DatePicker :class="hasError()?'border-danger':''" :type="info.type" v-model="input_value"
                        :name="getName(info.name)" :id="getId(info.name)" :placeholder="lable+'...'"></DatePicker>
            <span class="form-text text-danger" v-if="hasError()" v-for="error in errors[getErrorName(info.name)]">{{error}}</span>
        </div>
    </div>
</template>

<script>
    import InputMixin from '../../../../mixins/InputMixin.vue'
    import VuePersianDatetimePicker from 'vue-persian-datetime-picker';

    export default {
        mixins: [InputMixin],
        components: {DatePicker: VuePersianDatetimePicker},
    }
</script>