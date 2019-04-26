<template>
    <div>
        <div class="col-sm-12" v-for="(section,item_index) in model.sections"
             v-if="section.master_page_id == model.master_page_id && Array.isArray(model.sections)"
             :key="'sections'+item_index">
            <div class="card border-teal">
                <div class="card-header header-elements-inline">

                    <h6 class="card-title text-teal">
                        <i class="icon-grid5" style="font-size: 18px;"></i>
                        {{ $t(resource + ':items.sections.main_name') + ' ' + section.display_name}}
                    </h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a href="#" class="btn btn-labeled btn-labeled-right btn-labeled bg-teal"
                               @click.prevent="addRecord('sections',item.info,item_index)">
                                {{$t(resource + ':actions.create_new_module')}} <b><i class="icon-plus2"></i></b>
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

                    <input type="hidden" :name="'sections['+item_index+'][id]'" :value="section.id">
                    <!--sub form-->
                    <div class="row" v-if="section.modules.length>0">
                        <div class="col-lg-4 col-md-6 col-sm-12"
                             v-for="(subItem,sub_index) in section.modules">
                            <div class="card ">
                                <div class="card-body">
                                    <component
                                            v-for="(form_info) in item.info"
                                            :is="getComponent(form_info.type)"
                                            :key="subItem['guid']+'-'+form_info.name"
                                            :info="form_info"
                                            :value="subItem[form_info.name]"
                                            :options="getOptions(form_info,'sections.'+item_index+'.modules',sub_index)"
                                            :prefix="'sections['+item_index+'][modules]'"
                                            :index="sub_index"
                                            :errors="errors"
                                            @input="updateModel($event,form_info.name,item_index,sub_index)"
                                    ></component>
                                    <div class="text-center">

                                        <button type="submit" class="btn btn-danger"
                                                @click.prevent="deleteRecord(item_index,sub_index)">
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
    </div>


</template>

<script>
    import global_mixin from '../../../mixins/GlobalMixin.vue';
    import sub_form_mixin from '../../../mixins/form/SubFormMixin.vue';

    import {mapMutations} from 'vuex'
    export default {
        mixins: [global_mixin, sub_form_mixin],
        methods: {
            ...mapMutations('form',['updateOptions','deleteOption']),
            updateModel(value, key, main_index, index) {
                let prefix = 'sections.' + main_index + '.modules';
                let payload = {
                    index: index,
                    prefix: prefix,
                    key: key,
                    value: value
                };
                let module = this.model.sections[main_index].modules[index];
                let update_status = false;
                if (index !== null && main_index !== null && module[key] != value) {
                    update_status = true;
                }
//
                if (update_status) {
                    this.setValueAtModel(payload);
                }

            },
            deleteRecord(main_index, deleteIndex) {

                let prefix = 'sections.' + main_index + '.modules';
                let items = this.model.sections[main_index].modules;
                let delete_item=this.model.sections[main_index].modules[deleteIndex];
                let vm=this;
                if (items.length > 0 && delete_item.order !== undefined) {
                    items.forEach(function (item,index) {
                        if (item.order > delete_item.order) {
                            let payload = {
                                index: index,
                                prefix: prefix,
                                key: 'order',
                                value: item.order - 1
                            };
                            vm.setValueAtModel(payload);
                        }
                        if(index  >= deleteIndex){
                            let next_index=index+1;
                            let action_id=vm.options[prefix+'.'+next_index+'.action_id'];
                            let relations=vm.options[prefix+'.'+next_index+'.relations'];
                            let fields=vm.options[prefix+'.'+next_index+'.fields'];
                            if(action_id !== undefined){
                                let payload={
                                    key:prefix+'.'+index+'.action_id',
                                    value:action_id
                                };
                                vm.updateOptions(payload)
                            }
                            if(relations !== undefined){
                                let payload={
                                    key:prefix+'.'+index+'.relations',
                                    value:relations
                                };
                                vm.updateOptions(payload)
                            }
                            if(fields !== undefined){
                                let payload={
                                    key:prefix+'.'+index+'.fields',
                                    value:fields
                                };
                                vm.updateOptions(payload)
                            }
                        }
                    });

                    if(vm.options[prefix+'.'+(items.length-1)+'.action_id'] !== undefined){
                        vm.deleteOption(prefix+'.'+(items.length-1)+'.action_id')
                    }
                    if(vm.options[prefix+'.'+(items.length-1)+'.relations'] !== undefined){
                        vm.deleteOption(prefix+'.'+(items.length-1)+'.relations')
                    }
                    if(vm.options[prefix+'.'+(items.length-1)+'.fields'] !== undefined){
                        vm.deleteOption(prefix+'.'+(items.length-1)+'.fields')
                    }
                }

//                items.splice(deleteIndex, 1);
                let payload = {
                    deleteIndex: deleteIndex,
                    prefix: 'sections.' + main_index,
                    item_name: 'modules',
                };
                this.$store.commit('form/deleteRecord',payload);
            },


            addRecord(item_name, info, index) {
                let model = this.model;
                if (Array.isArray(model[item_name])) {
                    let new_item = {};
                    let items = this.model[item_name];
                    new_item.guid = this.guid();
                    info.forEach(function (item) {

                        if (item.name === 'id') {
                            new_item[item.name] = 0
                        }
                        else if (item.name === 'order') {
                            new_item[item.name] = items[index].modules.length + 1;
                        }
                        else if (item.name) {
                            new_item[item.name] = ''
                        }


                    });
                    let payload = {
                        index: items.length,
                        prefix: item_name+'.'+index,
                        key: 'modules',
                        value: new_item
                    };
                    this.setValueAtModel(payload);
                }

            },
        }
    }
</script>