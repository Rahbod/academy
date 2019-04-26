<template>
    <div id="modal_form" class="modal fade">
        <div id="open_modal_form" style="display: none;" data-toggle="modal" data-target="#modal_form"></div>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" @click="closeForm">&times;</button>
                    <button id="close-modal" data-dismiss="modal" style="display: none"></button>
                </div>

                <div class="modal-body">
                    <form action="" class="form-horizontal" @submit.prevent="sendFormRequest"
                          @keydown="deleteError($event.target.name);">

                        <fieldset class="mb-3">
                            <component v-if="form_info.name!= undefined" v-for="(form_info,index) in info"
                                       :is="getComponent(form_info.type)" :info="form_info"
                                       :key="model['guid']+'-'+index"
                                       :value="model[form_info.name]" :options="getOptions(form_info,resource)"
                                       :prefix="resource"
                                       :index="null"
                                       :errors="errors"
                                       :is_base="true"
                                       :icon_type="model['icon_type']"
                            ></component>
                        </fieldset>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                تایید <i class="icon-arrow-left13 position-right"></i>
                            </button>
                            <button type="button" class="btn btn-danger" @click.prevent="closeForm">
                                انصراف <i class="icon-x position-right"></i></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    //    import form_fields from '../basic_form/ModalFormField.vue';
    import get_input_components from '../../../mixins/form/GetInputComponentsMixin.vue'
    import pluralize from 'pluralize';

    import {mapActions,mapGetters} from 'vuex'

    export default {
        props: ['modal_data'],
        mixins: [get_input_components],
        data() {
            return {
                model: {},
                info: [],
                errors: {},
                options: {},
                resource: null,
                action: null
            }
        },
        computed: {
            ...mapGetters(['main_url']),
            actions() {
                if (this.resource !== null) {
                    return this.$store.getters.actions[this.resource];
                }
                return this.$store.getters.actions;
            },
        },
        methods: {
            ...mapActions(['sendRequest']),
            getOptions(form_info, prefix = null, index = null) {
                let input_options = [];
                if (form_info.options !== undefined && form_info.options.length > 0) {
                    input_options = form_info.options;
                }
                else if (index !== null && prefix !== null && this.options[prefix + '.' + index + '.' + form_info.name] !== undefined && this.options[prefix + '.' + index + '.' + form_info.name].length > 0) {
                    return this.options[prefix + '.' + index + '.' + form_info.name];
                }
                else if (prefix !== null && this.options[prefix + '.' + form_info.name] !== undefined && this.options[prefix + '.' + form_info.name].length > 0) {
                    input_options = this.options[prefix + '.' + form_info.name];
                }
                else if (this.options[form_info.name] !== undefined && this.options[form_info.name].length > 0) {
                    input_options = this.options[form_info.name];
                }
                return input_options;
            },
            setErrorName(name) {
                let str;
                str = name.replace(/\[/g, ".");
                str = str.replace(/]/g, "");
                return str;
            },
            deleteError(error) {
                if (error !== undefined) {
                    delete this.errors[this.setErrorName(error)];
                }

            },
            closeForm() {
                this.$emit('closeForm');
            },
            sendFormRequest(event){
                let el = event.target;
                let form_data = new FormData(el);
                let url=this.main_url;
                let method=null;
                if(this.action == 'create'){
                    url+='/'+this.resource;
                    method='POST';
                }else if (this.action == 'edit'){
                    url+='/'+this.resource+'/'+this.model.id;
                    method='PUT';
                }

                if(method !== null){
                    form_data.append('_method', method);
                    this.sendRequest( {url: url, data: form_data,el:this.$el}, {root: true})
                        .then(response => {
                           this.$emit('formUpdated')
                        })
                        .catch(error => {
                            if (error.response !== undefined && error.response.status === 422) {
                                if (error.response.data.errors !== undefined) {
                                    let errors = error.response.data.errors;
                                    this.errors=errors;
                                }
                            }
                            console.log(error)
                        })
                }
                else {
                    console.log('method is not valid!');
                }

            },

        },
        mounted() {
            this.model = this.modal_data.model;
            this.info = this.modal_data.info;
            this.info.forEach((item, index) => {
                let resource_id = pluralize.singular(this.$store.getters.resource) + '_id';
                if (item.name === 'parent_id' || item.name === resource_id) {
                    item.type = 'hidden'
                }
            });
            this.errors = this.modal_data.errors;
            this.options = this.modal_data.options;
            if (this.modal_data.resource !== undefined) {
                this.resource = this.modal_data.resource;
            } else {
                this.resource = this.$store.getters.resource;
            }
            this.action = this.modal_data.action;
            this.model = this.modal_data.model;
        }
    }
</script>
