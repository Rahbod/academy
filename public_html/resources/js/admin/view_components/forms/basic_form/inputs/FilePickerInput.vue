<template>
    <div class="form-group" :class="[index == null?'row':'form-group-float']">
        <label class="cursor-pointer" :class="label_class()" v-text="lable" :for="getId(info.name)"></label>
        <div :class="input_container_class">

            <div class="uniform-uploader" :class="[hasError() ?'border-danger':'']">
                <input type="hidden" :name="getName(info.name+'_src')" :value="input_value">
                <input type="file" class="alpaca-control" name="" autocomplete="off"
                       :ref="getId(info.name)"
                       :name="getName(info.name)"
                       :id="getId(info.name)"
                       @change="previewFiles">
                <span class="filename" style="user-select: none; direction: ltr;text-align: left" >{{input_name}}</span>
                <span class="action btn bg-blue" style="user-select: none;">انتخاب فایل</span>
                <button style="z-index: 10" type="button" class="btn btn-outline bg-danger-400 text-danger-800 btn-icon rounded-round" @click.stop.prevent="removeFile(getId(info.name))"><i class="icon-cross2" ></i></button>
            </div>

            <span class="form-text text-danger" v-if="hasError()" v-for="error in errors[getErrorName(info.name)]">{{error}}</span>
        </div>

    </div>
</template>

<script>
    import InputMixin from '../../../../mixins/InputMixin.vue'

    export default {
        mixins: [InputMixin],
        data(){
            return {
                input_name:""
            }
        },
        methods: {
            previewFiles(event){
                let file=event.target.files[0];
                if(file !== undefined){
                    this.input_name=file.name;
                    this.$emit('change',  this.input_name);
                }

            },
            removeFile(input){
                let ref=this.$refs[input];
                if(ref.files !== undefined){
                    $(ref).val('');
                }
                this.input_name=this.lable+'...';
                this.$emit('change',  null);
            }
        },
        mounted() {
            if(this.input_value){
                this.input_name=this.input_value;
            }
            else {
                this.input_name=this.lable+'...';
            }

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