<template>
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title"
                v-text="$t(resource+':attributes.'+component_name)"></h5>
            <div class="header-elements">
                <div class="list-icons">

                    <span v-if="edit_status==false" class="text-info" style="cursor: pointer;"
                          @click.prevent="toggleStatus"><i
                            class="icon-pencil7"></i> {{$t('actions.edit')}} </span>

                    <span v-if="edit_status==true" class="text-danger" style="cursor: pointer;"
                          @click.prevent="toggleStatus"><i
                            class="icon-x"></i> {{$t('actions.cancel')}} </span>
                    <a class="list-icons-item" data-action="collapse" @click.prevent="collapseCard($event.target)"></a>
                    <a class="list-icons-item" data-action="fullscreen" @click.prevent="fullScreen($event.target)"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <transition name="fade" mode="out-in">
                                <div :key="'show-'+component_name" v-if="edit_status == false">
                                    <div class="row" v-for="key in input_keys" v-if="key != 'avatar'">
                                        <label class=" col-lg-2 col-md-4 text-bold text-grey text-right">{{getLabel(key)}} : </label>
                                        <div class="col-md-6"> {{getValue(key)}}</div>
                                    </div>
                                </div>
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
                    'email',  'profile.melli_code','profile.mobile_number','profile.grade', 'profile.city','profile.address', 'profile.postal_code',
                ],
                component_name: 'personal_info',
                edit_status: false
            }
        },
    }
</script>