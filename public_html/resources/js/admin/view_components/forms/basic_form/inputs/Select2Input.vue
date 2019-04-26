<template>
    <div class="form-group" :class="[index == null?'row':'form-group-float']">
        <label class="cursor-pointer" :class="label_class()" v-text="lable" :for="getId(info.name)"></label>
        <div :class="input_container_class">
            <select2
                    :user_options="options"
                    :name="getName(info.name)"
                    :id="getId(info.name)"
                    :key="_uid"
                    :type="info.type"
                    v-model="input_value"
                    :input_class="(hasError === true)?'border-danger':''"
                    :placeholder="lable+'...'"
                    :allowClear="true"
                    :search="true"
                    :direction="$store.getters.direction">
            </select2>
            <span class="form-text text-danger" v-if="hasError()" v-for="error in errors[getErrorName(info.name)]">{{error}}</span>
        </div>
    </div>
</template>

<script>
    import InputMixin from '../../../../mixins/InputMixin.vue'
    import select2 from '../../../../components/Select2.vue';

    export default {
        mixins: [InputMixin],
        components: {select2},

    }
</script>