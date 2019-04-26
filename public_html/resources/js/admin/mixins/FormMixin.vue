<script>
    import {mapGetters,mapActions,mapMutations} from 'vuex';
    const basic_input = resolve => {
        require.ensure(['../view_components/forms/basic_form/inputs/BasicInput.vue'], () => {
            resolve(require('../view_components/forms/basic_form/inputs/BasicInput.vue'))
        })
    };
    const hidden_input = resolve => {
        require.ensure(['../view_components/forms/basic_form/inputs/HiddenInput.vue'], () => {
            resolve(require('../view_components/forms/basic_form/inputs/HiddenInput.vue'))
        })
    };
    const select2_input = resolve => {
        require.ensure(['../view_components/forms/basic_form/inputs/Select2Input.vue'], () => {
            resolve(require('../view_components/forms/basic_form/inputs/Select2Input.vue'))
        })
    };
    const textarea_input = resolve => {
        require.ensure(['../view_components/forms/basic_form/inputs/TextareaInput.vue'], () => {
            resolve(require('../view_components/forms/basic_form/inputs/TextareaInput.vue'))
        })
    };
    const editor_input = resolve => {
        require.ensure(['../view_components/forms/basic_form/inputs/EditorInput.vue'], () => {
            resolve(require('../view_components/forms/basic_form/inputs/EditorInput.vue'))
        })
    };
    const radio_input = resolve => {
        require.ensure(['../view_components/forms/basic_form/inputs/RadioInput.vue'], () => {
            resolve(require('../view_components/forms/basic_form/inputs/RadioInput.vue'))
        })
    };
    const date_input = resolve => {
        require.ensure(['../view_components/forms/basic_form/inputs/DateInput.vue'], () => {
            resolve(require('../view_components/forms/basic_form/inputs/DateInput.vue'))
        })
    };
    const image_input = resolve => {
        require.ensure(['../view_components/forms/basic_form/inputs/ImageInput.vue'], () => {
            resolve(require('../view_components/forms/basic_form/inputs/ImageInput.vue'))
        })
    };

    export default {
        components: {
            basic_input,
            textarea_input,
            radio_input,
            hidden_input,
            date_input,
            select2_input,
            image_input,
            editor_input
        },
        computed: {
            ... mapGetters('form', ['loading', 'action', 'errors', 'model', 'info', 'options', 'updating']),
            ... mapGetters(['resource']),
        },
        methods: {
            ...mapMutations('form', ['setEl', 'resetForm']),
            ...mapActions('form', ['setValueAtModel', 'sendFormRequest', 'getFormData']),
            ...mapActions(['collapseCard', 'fullScreen']),
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
            getComponent(name) {
                let component_name = name;
                switch (name) {
                    case 'text':
                    case 'email':
                    case 'password':
                    case 'number':
                        component_name = 'basic_input';
                        break;
                    case 'select':
                    case 'tags':
                    case 'multiple':
                        component_name = 'select2_input';
                        break;
                    case 'textarea':
                        component_name = 'textarea_input';
                        break;
                    case 'editor':
                        component_name = 'editor_input';
                        break;
                    case 'hidden':
                        component_name = 'hidden_input';
                        break;
                    case 'radio':
                        component_name = 'radio_input';
                        break;
                    case 'date':
                        component_name = 'date_input';
                        break;
                    case 'image':
                        component_name = 'image_input';
                        break;
                }
                return component_name;
            },
            getOptions(form_info, prefix = null) {
                let input_options = [];
                if (form_info.options !== undefined && form_info.options.length > 0) {
                    input_options = form_info.options;
                }
                else if (prefix !== null && this.options[prefix + '.' + form_info.name] !== undefined && this.options[prefix + '.' + form_info.name].length > 0) {
                    input_options = this.options[prefix + '.' + form_info.name];
                }
                else if (this.options[form_info.name] !== undefined && this.options[form_info.name].length > 0) {
                    input_options = this.options[form_info.name];
                }
                return input_options;
            },
            refreshInputData() {
                this.resetForm();
                this.getFormData(this.$route.params.id);
            },
            cancelAction() {
                if (this.hasAction('listView')) {
                    this.$router.push({name: this.resource + '-list-view'});
                } else {
                    this.$router.push('/');
                }
            },
            submitForm($event) {
                this.sendFormRequest($event)
                    .then((response) => {
                        if (this.hasAction('listView')) {
                            this.$router.push({name: this.resource + '-list-view'});
                        }
                    })
                    .catch((error) => {

                    })
            },
            addRecord(item_name, info) {
                let model = this.model;
                if (Array.isArray(model[item_name])) {
                    let new_item = {};
                    let items = this.model[item_name];
                    new_item.guid = this.guid();
                    info.forEach(function (item) {
                        if (item.name == 'id') {
                            new_item[item.name] = 0
                        }
                        else if (item.name == 'order') {
                            new_item[item.name] = items.length + 1;
                        }
                        else {
                            new_item[item.name] = ''
                        }

                    });
                    items.push(new_item);
                    let payload = {
                        index: null,
                        prefix: null,
                        key: item_name,
                        value: items
                    };
                    this.setValueAtModel(payload);
                }

            },
            deleteRecord(deleteIndex, item_name) {

                if (Array.isArray(this.model[item_name])) {
                    let items = this.model[item_name];
                    if (items.length > 1 && items[0].order !== undefined) {
                        items.forEach(function (item, index) {
                            if (index > deleteIndex) {
                                item.order = item.order - 1;
                            }
                        });
                    }
                    items.splice(deleteIndex, 1);
                    let payload = {
                        index: null,
                        prefix: null,
                        key: item_name,
                        value: items
                    };
                    this.setValueAtModel(payload);
                }


            },
            guid() {
                return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
                    (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16))
            }
        },

    }
</script>