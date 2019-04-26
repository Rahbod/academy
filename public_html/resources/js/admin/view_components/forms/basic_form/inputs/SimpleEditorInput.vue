<template>
    <div class="form-group" :class="[index == null?'row':'form-group-float']">
        <label class="cursor-pointer" :class="label_class()" v-text="lable" :for="getId(info.name)"></label>
        <div :class="[index == null?'col-sm-12':'']">
            <textarea rows="4" cols="3" class="editor" :class="[hasError()?'border-danger':'']" :type="info.type" v-model="input_value" :name="getName(info.name)" :id="getId(info.name)" :placeholder="lable+'...'"></textarea>
            <span class="form-text text-danger" v-if="hasError()" v-for="error in errors[getErrorName(info.name)]">{{error}}</span>
        </div>

    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    import InputMixin from '../../../../mixins/InputMixin.vue'
    import  tinymce from 'tinymce';
    export default {
        mixins: [InputMixin],
        mounted() {
            let vm = this;
            setTimeout(function () {
                tinyMCE.baseURL =  vm.$store.getters.base_url + "/assets/tinymce";
                tinymce.init({
                    selector:'#'+vm.getId(vm.info.name),
                    directionality : vm.$store.getters.direction,
                    language: 'fa_IR',
                    height : "500",
                    relative_urls: false,
                    remove_script_host: true,
                    mobile: { theme: 'mobile' },
                    plugins: [
                        'advlist autolink lists hr',
//                        ' visualblocks visualchars code fullscreen',
                        ' nonbreaking  directionality',
                        ' textcolor colorpicker'
                    ],
                    toolbar1: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor fontsizeselect',
                    content_css: [
                        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                        '//www.tinymce.com/css/codepen.min.css'
                    ],
                    setup: function (editor) {
                        editor.on('change', function () {
                            editor.save();
                            vm.input_value=editor.getContent();
                        });
                    }
                });
            }, 10);
        },
        destroyed: function () {
            tinymce.remove()
        }
    }
</script>