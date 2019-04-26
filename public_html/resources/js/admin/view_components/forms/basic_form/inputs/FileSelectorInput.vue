<template>
    <div class="form-group" :class="[index == null?'row':'form-group-float']">
        <label class="cursor-pointer" :class="label_class()" v-text="lable" :for="getId(info.name)"></label>
        <div :class="input_container_class">
            <div class="uniform-uploader" :class="[hasError() ?'border-danger':'']">
                <input type="text" :style="input_style" v-model="input_value" :name="getName(info.name)" :id="getId(info.name)" :placeholder="lable+'...'" class="filename">
                <span class="action btn bg-blue" @click.prevent="popup()">انتخاب فایل</span>
            </div>
            <span class="form-text text-danger" v-if="hasError()" v-for="error in errors[getErrorName(info.name)]">{{error}}</span>
        </div>

    </div>
</template>

<script>
    import InputMixin from '../../../../mixins/InputMixin.vue'

    export default {
        mixins: [InputMixin],
        methods:{
            popup(){
                let url=this.main_url+'/'+this.resource+'/file_manager/popup/'+this.getId(this.info.name);
                $.colorbox({
                    href: url,
                    fastIframe: true,
                    iframe: true,
                    width: '70%',
                    height: '50%'
                });
            }
        },
        mounted(){
//            let vm=this;
//            let el=$('#' + this.getId(this.info.name));
//            el.val(this.input_value).trigger('change');
//            el.change(function() {
//                let value=el.val();
//                vm.input_value=value;
//                vm.$emit('input', value);
//            });
        }
    }
</script>

<style>
    .uniform-uploader input[type=text] {
        /*width: 100%;*/
        /*margin-top: 0;*/
        /*position: absolute;*/
        /*top: 0;*/
        /*left: 0;*/
        /*bottom: 0;*/
        /*height: 36px;*/
        /*border: 0;*/
        /*cursor: pointer;*/
        /*z-index: 10;*/
        /*opacity: 0;*/
        direction: rtl;
        text-align: left;
    }
</style>