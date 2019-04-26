<template>
    <div class="form-group" :class="[index == null?'row':'form-group-float']">
        <label :class="label_class()" v-text="lable"></label>
        <div :class="input_container_class">
            <div class="form-check form-check-inline" v-for="(option,option_index) in options">
                <label class="form-check-label" :for="getId(info.name)+'-'+option_index">
                    <input type="radio" class="form-check-input-styled" :value="option.id" v-model="input_value" :name="getName(info.name)" :id="getId(info.name)+'-'+option_index">
                    {{option.text}}
                </label>
            </div>
            <span class="form-text text-danger" v-if="hasError()" v-for="error in errors[getErrorName(info.name)]">{{error}}</span>
        </div>
    </div>
</template>

<script>
    import InputMixin from '../../../../mixins/InputMixin.vue'
    export default {
        mixins:[InputMixin],
    }
</script>