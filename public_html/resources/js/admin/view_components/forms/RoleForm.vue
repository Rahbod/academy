<template>
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title" v-text="$t(resource+':'+action+'_form_title')"></h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse" @click.prevent="collapseCard($event.target)"></a>
                    <a class="list-icons-item" data-action="reload" @click.prevent="refreshInputData"></a>
                    <a class="list-icons-item" data-action="fullscreen" @click.prevent="fullScreen($event.target)"></a>
                    <a class="list-icons-item" data-action="remove" @click.prevent="cancelAction"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="#" v-if="!loading" @submit.prevent="submitForm">
                <main_fieldset></main_fieldset>


                <div class="col-sm-12" v-if="options.departments.length>0">
                    <div class="card border-teal">
                        <div class="card-header header-elements-inline">

                            <h6 class="card-title text-teal">
                                <i class="icon-grid5" style="font-size: 18px;"></i>
                                عملیات
                            </h6>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"
                                       @click.prevent="collapseCard($event.target)"></a>
                                    <a class="list-icons-item" data-action="fullscreen"
                                       @click.prevent="fullScreen($event.target)"></a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <hr class="border-top-teal " style="margin-top: 0;">


                            <div class="card border-info  border-2" v-for="department in options.departments">
                                <div class="card-header header-elements-inline bg-info">
                                    <h6 class="card-title">{{department.display_name}}</h6>
                                    <div class="header-elements">
                                        <div class="list-icons">
                                            <a @click="collapseCard($event.target)" class="list-icons-item"
                                               data-action="collapse"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div v-for="resource_group in department.resource_groups">
                                        <legend class="font-weight-bold text-info-700" style="font-size: larger">
                                            {{resource_group.display_name}}
                                        </legend>
                                        <div v-for="resource in resource_group.resources">

                                            <div class="dropdown-menu border-info"
                                                 style="display: block; position: static; width: 100%; margin-top: 0; float: none;">
                                                <a href="#" class="dropdown-item"
                                                   @click.prevent="selectResourceActions(resource)">
                                                    <label class="form-check font-weight-semibold">
                                                        <input type="checkbox" class="form-check-input-styled-primary"
                                                               :value="resource.id" v-model="selectedResource">
                                                        {{resource.display_name}}
                                                    </label>
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <div class="dropdown-item co-lg-3 col-md-4 col-sm-6"
                                                     style="display: inline-block;cursor: pointer"
                                                     v-for="action in resource.actions">
                                                    <label class="form-check" @click="resetFormStyle"
                                                           style="cursor: pointer">
                                                        <input type="checkbox" class="form-check-input-styled-info"
                                                               :name="'action_id['+action.id+']'" :value="action.id"
                                                               v-model="model.action_id">
                                                        {{action.display_name}}
                                                    </label>
                                                </div>
                                            </div>
                                            <div style="margin-bottom: 10px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">{{$t('actions.submit')}} <i
                                    class="icon-paperplane ml-2"></i></button>
                            <button type="button" class="btn btn bg-teal-400" @click.prevent="refreshInputData">
                                {{$t('actions.reset')}} <i class="icon-undo2 ml-2"></i></button>
                            <button type="button" class="btn btn-danger" @click.prevent="cancelAction">
                                {{$t('actions.cancel')}} <i
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

    import {mapGetters} from 'vuex';

    export default {
        mixins: [global_mixin, form_mixin],
        components: {main_fieldset},
        computed: {
            ...mapGetters('form', ['options']),
            selectedResource: {
                get: function () {
                    let selected_resource = [];
                    if (this.options.departments !== undefined && this.model.action_id !== undefined) {
                        let self = this;
                        for (let department of this.options.departments) {
                            for (let resource_group of department.resource_groups) {

                                for (let resource of resource_group.resources) {
                                    let selected = true;
                                    for (let action of resource.actions) {
                                        if (self.model.action_id.indexOf(action.id) === -1) {
                                            selected = false;
                                            break;
                                        }
                                    }
                                    if (selected) {
                                        selected_resource.push(resource.id);
                                    }

                                }
                            }
                        }
                    }
                    return selected_resource;
                },
                // setter
                set: function (newValue) {

                }

            }
        },
        watch:{
            loading(value){
                if(value == false){
                    this.resetFormStyle();
                }
            }
        },
        methods: {
            selectResourceActions(resource) {
                let self = this;
                let count = 0;
                resource.actions.forEach(function (action) {
                    self.model.action_id.forEach(function (itemAction, index) {
                        if (action.id == itemAction) {
                            count = count + 1;
                            self.model.action_id.splice(index, 1);
                        }
                    });
                });
                if (resource.actions.length > count) {
                    resource.actions.forEach(function (action) {
                        self.model.action_id.push(action.id);
                    })
                }

                this.resetFormStyle();

            },
            resetFormStyle() {
                setTimeout(function () {
                    $('.form-check-input-styled-primary').uniform({
                        wrapperClass: 'border-primary-600 text-primary-800'
                    });
                    $('.form-check-input-styled-info').uniform({
                        wrapperClass: 'border-info-600 text-info-800'
                    });
                }, 100);
            }
        },
        mounted() {
            this.setEl(this.$el);
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