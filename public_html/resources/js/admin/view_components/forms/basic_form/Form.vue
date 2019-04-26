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

                <template v-if="info.items!= undefined && Array.isArray(info.items)"
                          v-for="(item,item_index) in info.items">

                    <template v-if="model[item.name]!= undefined">
                        <sub_fieldset :item="item" v-if="!(Array.isArray(model[item.name]))"></sub_fieldset>
                        <sub_form :item="item" :item_index="item_index" v-else></sub_form>
                    </template>
                    <modules_sub_form v-else-if="resource === 'pages' && item.name == 'modules'" :item="item" :item_index="item_index"></modules_sub_form>
                </template>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">{{$t('actions.submit')}} <i
                            class="icon-paperplane ml-2"></i></button>
                    <button type="button" class="btn btn bg-teal-400" @click.prevent="refreshInputData">
                        {{$t('actions.reset')}} <i class="icon-undo2 ml-2"></i></button>
                    <button type="button" class="btn btn-danger" @click.prevent="cancelAction">{{$t('actions.cancel')}} <i
                            class="icon-cross2 ml-2"></i></button>
                </div>
            </form>
        </div>

    </div>

</template>

<script>
    import main_fieldset from './fieldsets/MainFieldset.vue';
    import sub_fieldset from './fieldsets/SubFieldset.vue';
    import sub_form from './SubForm.vue'
    import modules_sub_form from './ModulesSubForm.vue'

    import global_mixin from '../../../mixins/GlobalMixin.vue';
    import form_mixin from '../../../mixins/form/FormMixin.vue';

    export default {
        mixins: [global_mixin, form_mixin],
        components: {main_fieldset, sub_fieldset, sub_form, modules_sub_form},
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