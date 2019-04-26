<template>
    <select v-if="multiple===true || type==='tags' || type==='multiple'" :name="name" :id="id" multiple="multiple" :class="input_class"></select>
    <select v-else="" :name="name" :id="id" :class="input_class"></select>
</template>
<script>
    export default {
        props:['user_options','placeholder','allowClear','value','name','id','multiple','tags','type','direction','width','search','input_class'],
        data() {
            return {
                options: {
                    data: this.user_options,
                    placeholder: this.placeholder,
                    direction: this.direction,
                    allowClear: this.allowClear
                }
            }
        },
        mounted() {
            if(this.search === false){
                this.options.minimumResultsForSearch= -1
            }
            if(this.placeholder !== undefined){
                this.options.placeholder= this.placeholder
            }
            if(this.width !== undefined){
                this.options.width= this.width
            }
            if(this.input_class !== undefined){
                this.options.containerCssClass= this.input_class
            }
            if(this.tags !== undefined){
                this.options.tags= this.tags
            }
            if(this.allowClear !== undefined){
                this.options.allowClear= this.allowClear
            }
            if(this.type !== undefined && this.type === 'tags'){
                this.options.tags=true;
            }
            if(this.type !== undefined && (this.type === 'tags' || this.type === 'multiple')){
                this.options.allowClear=false;
            }
            let el = this.$el;
            let vm=this;
            $(el).select2(this.options)
                .val(this.value)
                .trigger('change')
//                .on('change',function (e) {
//                    console.log(e);
//                })
                .change(function (event) {
                    let value=$(this).val();
                    if(!vm.isEqual(vm.value, value)){
                        vm.$emit('input',value);
                    }

                })

        },
        watch: {
//            value: function (value) {
////                 update value
//                $(this.$el).val(value).trigger('change');
//            },
            user_options: function (value,old) {
                if (!this.isEqualArray(value, old)) {
                    this.user_options= value;
                    this.options.data=value;
                    $(this.$el).empty().select2(this.options).val(this.value).trigger('change')
                }

            }
        },
        methods: {
            isEqual: function (item1, item2) {
                if (item1 == "") item1 = null;
                if (item2 == "") item2 = null;
                if (Array.isArray(item1) && Array.isArray(item2)) {
                    return this.isEqualArray(item1, item2);
                } else {
                    return item1 == item2;
                }
            },
            isEqualArray(item1, item2) {
                if (item1 !== undefined && item2 !== undefined){
                    if(item1.length !== item2.length){
                        return false;
                    }
                    for (let i = 0; i < item1.length; i++) {

                        if (item1[i].text !== item2[i].text) {
                            return false;
                        }else if(item1[i].id !== undefined && item2[i].id !==undefined){
                            if (item1[i].id !== item2[i].id){
                                return false
                            }
                        } else if(item1[i].children !== undefined && item2[i].children !== undefined){
                            return this.isEqual(item1[i].children,item2[i].children)
                        }



                    }
                }
                else if(item1 !== item2){
                    return false;
                }

                return true;
            },
        },
        destroyed: function () {
            $(this.$el).off().select2('destroy');
        }
    }
</script>