<template>
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title"
                v-text="$t(resource+':attributes.'+component_name)"></h5>
            <div class="header-elements">
                <div class="list-icons">

                    <span v-if="edit_status==false" class="text-info" style="cursor: pointer;" @click.prevent="toggleStatus"><i
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
            <transition name="fade" mode="out-in">
                <div :key="'show-'+component_name" class="row" v-if="edit_status == false">
                <div class="col-lg-3">

                    <div class="card">
                        <div class="card-body text-center">
                            <div class="card-img-actions d-inline-block mb-3">
                                <img class="img-fluid rounded-circle"  :src="model.avatar" width="170" height="170" alt="">
                            </div>

                            <h6 class="font-weight-semibold mb-0">{{model.name}}</h6>
                            <span class="d-block text-muted">{{model.email}}</span>
                        </div>
                    </div>

                </div>
                <div class="col-lg-9">
                    <div class="card" style="min-height: 274.48px;">
                        <div class="card-body ">
                            <div class="row" v-for="key in input_keys" v-if="key != 'avatar'">
                                <label class=" col-lg-2 col-md-4 text-bold text-grey text-right">{{getLabel(key)}} : </label>
                                <div class="col-md-6"> {{getValue(key)}}</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
                <partial_form :key="'from-'+component_name" v-else :name="component_name" :input_keys="input_keys" @toggleStatus="toggleStatus"></partial_form>
            </transition>
        </div>

    </div>
</template>

<script>
    import prfile_mixin from '../../mixins/ProfileMixin.vue';
    export default {
        mixins:[prfile_mixin],
        data(){
            return{
                input_keys: [
                    'name', 'username', 'email', 'profile.gender','profile.birthday', 'avatar'
                ],
                component_name:'basic_info',
                edit_status:false
            }
        },
    }
</script>