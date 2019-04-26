<template>
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title"
                v-text="$t(resource+':attributes.'+component_name)"></h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse" @click.prevent="collapseCard($event.target)"></a>
                    <a class="list-icons-item" data-action="fullscreen" @click.prevent="fullScreen($event.target)"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <transition name="fade" mode="out-in">
                                <button :key="'show-'+component_name" type="button" class="btn btn-success" @click.prevent="toggleStatus"
                                        v-if="edit_status == false">
                                    {{$t('actions.edit')}} <i class="icon-pencil7 position-right"></i>
                                </button>
                                <partial_form :key="'form-'+component_name" v-else :name="component_name" :input_keys="input_keys"
                                              @toggleStatus="toggleStatus"></partial_form>
                            </transition>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>
</template>

<script>
    import prfile_mixin from '../../mixins/ProfileMixin.vue';

    export default {
        mixins: [prfile_mixin],
        data() {
            return {
                input_keys: [
                    'password', 'password_confirmation',
                ],
                component_name: 'password',
                edit_status: false
            }
        },
    }
</script>