<template>
    <div class="col-sm-12" >
        <div class="card border-teal">
            <div class="card-header header-elements-inline">

                <h6 class="card-title text-teal">
                    <i class="icon-grid5" style="font-size: 18px;"></i>
                    {{$t(resource + ':items.' + item.name + '.main_name')}}
                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a href="#" class="btn btn-labeled btn-labeled-right btn-labeled bg-teal"
                           @click.prevent="addRecord({item_name:item.name,item_index:item_index})">
                            {{$t('actions.create_new_record')}} <b><i class="icon-plus2"></i></b>
                        </a>
                        <a class="list-icons-item" data-action="collapse"
                           @click.prevent="collapseCard($event.target)"></a>
                        <a class="list-icons-item" data-action="fullscreen"
                           @click.prevent="fullScreen($event.target)"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <hr class="border-top-teal " style="margin-top: 0;">

                <!--sub form-->
                <div class="row" v-if="model[item.name].length>0">
                    <div class="col-lg-4 col-md-6 col-sm-12"
                         v-for="(subItem,index) in model[item.name]">
                        <div class="card ">
                            <div class="card-body">
                                <component
                                        v-for="(form_info) in item.info"
                                        :is="getComponent(form_info.type)" :info="form_info"
                                        :key="model[item.name][index]['guid']+'-'+form_info.name"
                                        :value="model[item.name][index][form_info.name]"
                                        :options="getOptions(form_info,item.name)"
                                        :prefix="item.name"
                                        :index="index"
                                        :errors="errors"
                                        @input="updateModel($event,form_info.name,item.name,index)"
                                ></component>
                                <div class="text-center">

                                    <button type="submit" class="btn btn-danger"
                                            @click.prevent="deleteRecord({deleteIndex:index,item_name:item.name})">
                                        {{$t('actions.delete')}} <i class="icon-x position-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="alert alert-warning alert-bordered" v-else>
                    {{$t('messages.not_record_inserted')}}
                </div>

            </div>
        </div>
    </div>

</template>

<script>
    import global_mixin from '../../../mixins/GlobalMixin.vue';
    import sub_form_mixin from '../../../mixins/form/SubFormMixin.vue';
    export default {
        mixins: [global_mixin,sub_form_mixin],
    }
</script>