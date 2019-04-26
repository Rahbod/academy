<script>
    import partial_form from '../view_components/profile/PartialForm.vue';
    import {mapGetters,mapActions} from 'vuex';
    export default {
        components:{partial_form},
        computed:{
            ...mapGetters('form',[ 'model']),
            ...mapGetters(['resource']),
            model_info(){
                let info=this.$store.getters['form/info'];
                let component_info={items:[{name:'profile',info:[]}]};
                this.input_keys.forEach(input_key=>{
                    if  (input_key.indexOf('.') === -1){
                        Object.keys(info).forEach(index=>{
                            if(!Array.isArray(info[index])){
                                if(info[index].name === input_key){
                                    component_info[index]=info[index];
                                }

                            }
                        })
                    }
                    else {
                        input_key = input_key.replace("profile.", "");
                        info.items.forEach(item => {
                            if (item.name === 'profile') {
                                item.info.forEach(profile_field => {
                                    if (profile_field.name === input_key) {
                                        component_info.items[0].info.push(profile_field);
                                    }
                                })
                            }
                        });
                    }
                });
                return component_info;
            }
        },
        methods:{
            ...mapActions(['collapseCard', 'fullScreen']),
            getLabel(key){
                if  (key.indexOf('.') === -1){
                    return this.$t(this.resource + ':items.'+key)
                }else {
                    key = key.replace("profile.", "");
                    return this.$t(this.resource + ':items.profile.'+key).replace("پروفایل", "");
                }
            },
            getValue(key){
                let value =null;
                if  (key.indexOf('.') === -1){
                    value= this.model[key]
                }else {
                    if(this.model.profile !== undefined){
                        key = key.replace("profile.", "");
                        value = this.model.profile[key];
                    }

                }
                switch (key){
                    case 'gender':
                        return this.getGenderValue(value);
                        break;
                    case 'status':
                    case 'is_admin':
                        return this.getStatusValue(value);
                        break;
                    default:
                        return value;
                        break;
                }
            },
            getStatusValue(code) {
                code=parseInt(code);
                switch (code) {
                    case 0:
                        return this.$t('values.active');
                    case 1:
                        return this.$t('values.inactive');
                }
                return code;
            },
            getGenderValue(code) {
                code=parseInt(code);
                switch (code) {
                    case 1:
                        return this.$t('values.female');
                    case 0:
                        return this.$t('values.male');
                }
                return code;
            },
            toggleStatus(){
                this.edit_status=!this.edit_status;
            }
        },
    }
</script>
