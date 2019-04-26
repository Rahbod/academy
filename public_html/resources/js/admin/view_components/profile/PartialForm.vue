<template>
    <form action="#" :id="form_id" @submit.prevent="sendFormRequest">
        <fieldset class="mb-3">
            <component v-if="form_info.name!= undefined" v-for="(form_info,index) in info"
                       :is="getComponent(form_info.type)" :info="form_info"
                       :key="form_info.name+'-'+index"
                       :value="model[form_info.name]" :options="getOptions(form_info,resource)"
                       :prefix="null"
                       :index="null"
                       :errors="errors"
                       @input="updateModel($event,form_info.name)"
            ></component>
        </fieldset>
        <fieldset class="mb-3" v-if="info.items.length>0">
            <component v-if="form_info.name!= undefined" v-for="(form_info,index) in info.items[0].info"
                       :is="getComponent(form_info.type)" :info="form_info"
                       :key="form_info.name+'-'+index"
                       :value="model['profile'][form_info.name]" :options="getOptions(form_info)"
                       :prefix="'profile'"
                       :index="null"
                       :errors="errors"
                       @input="updateModel($event,form_info.name,'profile')"
            ></component>
        </fieldset>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">{{$t('actions.submit')}} <i
                    class="icon-paperplane ml-2"></i></button>
            <button type="button" class="btn btn-danger" @click.prevent="$emit('toggleStatus')">{{$t('actions.cancel')}} <i
                    class="icon-cross2 ml-2"></i></button>
        </div>
    </form>
</template>

<script>
    import form_fieldset_mixin from '../../mixins/form/FormFieldsetMixin.vue';
    import {mapGetters, mapMutations,mapActions} from 'vuex';

    export default {
        props: ['input_keys', 'name'],
        mixins: [form_fieldset_mixin],
        computed: {
            ...mapGetters('form', ['model', 'info']),
            ...mapGetters(['resource','main_url']),
            form_id() {
                return '#' + this.name + '_id'
            },
            info() {
                let info = this.$store.getters['form/info'];
                let component_info = {items: [{name: 'profile', info: []}]};
                this.input_keys.forEach(input_key => {
                    if (input_key.indexOf('.') === -1) {
                        Object.keys(info).forEach(index => {
                            if (!Array.isArray(info[index])) {
                                if (info[index].name === input_key) {
                                    component_info[index] = info[index];
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
        methods: {
            ...mapActions(['sendRequest']),
            ...mapMutations(['setAuthUser']),
            ...mapMutations('form',['setErrors','setModel']),
            sendFormRequest(event) {
                let el = event.target;
                let form_data = new FormData(el);
                let url = this.main_url;
                let method = null;

                url += '/' + this.resource + '/update_' + this.name;
                method = 'PUT';

                form_data.append('_method', method);
                this.sendRequest({url: url, data: form_data, el: this.$el}, {root: true})
                    .then(response => {
                        if(response.data.model !== undefined){
                            this.setAuthUser(response.data.model);
                            this.setModel(response.data.model);
                        }
                        this.$emit('toggleStatus')
                    })
                    .catch(error => {
                        if (error.response !== undefined && error.response.status === 422) {
                            if (error.response.data.errors !== undefined) {
                                let errors = error.response.data.errors;
                                this.setErrors( errors);
                            }
                        }
                        console.log(error)
                    })
            }

        },
    }
</script>

<style>
    @media only screen and (min-width: 576px) {
        .text-align-right {
            text-align: right !important;
        }

        .text-align-left {
            text-align: left !important;
        }
    }

    .form-group-feedback-right .form-control-feedback {
        left: .875rem;
    }

</style>