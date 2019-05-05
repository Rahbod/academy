<template>
    <div class="form-group" :class="[index == null?'row':'form-group-float']">
        <label class="cursor-pointer" :class="label_class()" v-text="lable" :for="getId(info.name)"></label>
        <input type="hidden" :name="getName(info.name+'_src')" :value="input_value">
        <div :class="[index == null?'col-sm-12':'']">
            <picture-input
                    ref="pictureInput"
                    width="400"
                    height="400"
                    margin="16"
                    accept="image/jpeg,image/png"
                    size="10"
                    buttonClass="btn btn-primary"
                    removeButtonClass="btn btn-danger"
                    :zIndex="100"
                    :name="getName(info.name)"
                    :id="getId(info.name)"
                    :prefill="input_value"
                    :removable="true"
                    @remove="input_value=null"
                    :customStrings="{
                                        upload: '<h1>Bummer!</h1>',
                                        change:'تغییر تصویر',
                                        remove: 'حذف تصویر',
                                        drag:  'تصویر خود را اینجا بکشید یا  <br>جهت انتخاب تصویر کلید کنید'
                    }"
                    @change="onChange">
            </picture-input>
            <span class="form-text text-danger" v-if="hasError()" v-for="error in errors[getErrorName(info.name)]">{{error}}</span>
        </div>

    </div>
</template>

<script>
    import PictureInput from 'vue-picture-input'
    import InputMixin from '../../../../mixins/InputMixin.vue'
    export default {
        mixins:[InputMixin],
        components:{ 'picture-input': PictureInput},
        methods:{
            onChange (image) {
//                console.log('New picture selected!');
                if (image) {
//                    console.log('Picture loaded.');
                    this.$emit('change', image);
                } else {
                    console.log('FileReader API not supported: use the <form>, Luke!')
                }
            }
        }
    }
</script>