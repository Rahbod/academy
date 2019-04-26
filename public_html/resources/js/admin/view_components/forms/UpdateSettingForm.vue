<template>
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title" v-text="$t('attributes.update_settings_form')"></h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse" @click.prevent="collapseCard($event.target)"></a>
                    <a class="list-icons-item" data-action="reload" @click.prevent="$emit('refreshInputData')"></a>
                    <a class="list-icons-item" data-action="fullscreen" @click.prevent="fullScreen($event.target)"></a>
                    <a class="list-icons-item" data-action="remove" @click.prevent="cancelAction"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="#" v-if="!loading" @submit.prevent="submitForm">
                <template v-for="setting_group in model"
                     v-if="setting_group.settings !== undefined && setting_group.settings.length>0">
                    <legend style="font-weight: bold">{{setting_group.display_name}}</legend>
                    <fieldset class="mb-3">
                        <template v-for="(setting,index) in setting_group.settings">
                            <input type="hidden" :name="'settings['+setting.id+'][id]'" :value="setting.id">
                            <component
                                       :is="getComponent(setting.type)"
                                       :info="{name:'value',label:setting.display_name,type:setting.type,direction:setting.direction}"
                                       :key="setting.name+'-'+setting.id"
                                       :value="setting.value" :options="setting.details"
                                       :prefix="'settings['+setting.id+']'"
                                       :index="null"
                                       :errors="errors"
                            ></component>
                        </template>

                    </fieldset>
                    <!--<update_settings_form_fields :errors="errors" :settings="setting_group.settings" @deleteFormError="deleteFormError($event)"></update_settings_form_fields>-->
                </template>
                <!--<main_fieldset></main_fieldset>-->

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">{{$t('actions.submit')}} <i
                            class="icon-paperplane ml-2"></i></button>
                    <button type="button" class="btn btn bg-teal-400" @click.prevent="$emit('refreshInputData')">
                        {{$t('actions.reset')}} <i class="icon-undo2 ml-2"></i></button>
                    <button type="button" class="btn btn-danger" @click.prevent="cancelAction">{{$t('actions.cancel')}} <i
                            class="icon-cross2 ml-2"></i></button>
                </div>
            </form>
        </div>

    </div>

</template>

<script>
    import main_fieldset from './basic_form/fieldsets/MainFieldset.vue';


    import global_mixin from '../../mixins/GlobalMixin.vue';
    import form_mixin from '../../mixins/form/FormMixin.vue';
    import form_fieldset_mixin from '../../mixins/form/FormFieldsetMixin.vue';

    import {mapGetters} from 'vuex';
    export default {
        mixins: [global_mixin, form_mixin, form_fieldset_mixin],
        components: {main_fieldset},
        computed:{
            ...mapGetters(['resource','base_resource_url'])
        },
        methods:{
            submitForm(event) {
                let el = event.target;
                let form_data = new FormData(el);
                form_data.append('_method', 'PUT');
                let url;
                if (this.resource === 'settings') {
                    url = this.$store.getters.base_resource_url+'/update_all_settings';
                }
                else {
                    url = this.base_resource_url + '/settings/update';
                }
                this.sendRequest({url:url,method:'post',el:this.$el,data:form_data})
                    .then(response=> {

                    })
                    .catch(error=> {
                        if (error.response !== undefined && error.response.status === 422) {
                            if (error.response.data.errors !== undefined) {
                                let errors = error.response.data.errors;
                                this.setErrors( errors);
                            }
                        }
                        console.log(error);
                    })
            },
        }
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