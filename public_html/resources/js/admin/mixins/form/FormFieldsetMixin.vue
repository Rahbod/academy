<script>
    import {mapGetters,mapActions,mapMutations} from 'vuex';
    import get_input_components from './GetInputComponentsMixin.vue'

    export default {
        mixins:[get_input_components],
        computed: {
            ... mapGetters('form', ['model', 'info', 'options','errors']),
            ... mapGetters(['resource']),
        },
        methods: {
            ...mapActions('form', ['setValueAtModel']),
            updateModel(value, key, prefix = null, index = null) {
                let payload = {
                    index: index,
                    prefix: prefix,
                    key: key,
                    value: value
                };
                let update_status=false;
                if (index !== null && prefix !== null && this.model[prefix][index][key] != value) {
                    update_status=true;
                }
                else if (prefix !== null && this.model[prefix][key] != value) {
                    update_status=true;
                } else if(this.model[key] != value) {
                    update_status=true;
                }
                if(update_status){
                    this.setValueAtModel(payload);
                }

            },
            getOptions(form_info, prefix = null,index=null) {
                let input_options = [];
                if (form_info.options !== undefined && form_info.options.length > 0) {
                    input_options = form_info.options;
                }
                else if(index !== null && prefix !== null && this.options[prefix + '.' +index+'.'+ form_info.name] !== undefined && this.options[prefix + '.' +index+'.'+ form_info.name].length > 0){
                    return this.options[prefix + '.' +index+'.'+ form_info.name];
                }
                else if (prefix !== null && this.options[prefix + '.' + form_info.name] !== undefined && this.options[prefix + '.' + form_info.name].length > 0) {
                    input_options = this.options[prefix + '.' + form_info.name];
                }
                else if (this.options[form_info.name] !== undefined && this.options[form_info.name].length > 0) {
                    input_options = this.options[form_info.name];
                }
                return input_options;
            },
        },

    }
</script>