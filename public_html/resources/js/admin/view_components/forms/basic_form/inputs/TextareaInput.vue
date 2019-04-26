<template>
    <div class="form-group" :class="[index == null?'row':'form-group-float']">
        <label class="cursor-pointer" :class="label_class()" v-text="lable" :for="getId(info.name)"></label>
        <div :class="input_container_class">
            <textarea rows="4" cols="3" class="form-control" :class="[hasError()?'border-danger':'']" :type="info.type" :style="input_style" v-model="input_value" :name="getName(info.name)" :id="getId(info.name)" :placeholder="lable+'...'"></textarea>
            <span class="form-text text-danger" v-if="hasError()" v-for="error in errors[getErrorName(info.name)]">{{error}}</span>
        </div>
    </div>
</template>

<script>
    import InputMixin from '../../../../mixins/InputMixin.vue'

    export default {
        mixins: [InputMixin],
    }
</script>