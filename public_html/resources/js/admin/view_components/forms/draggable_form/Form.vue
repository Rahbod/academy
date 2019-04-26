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
                <input type="hidden" name="order_ids" v-model="order_ids">
                <main_fieldset></main_fieldset>

                <template v-if="info.items!= undefined && Array.isArray(info.items)"
                          v-for="(item,item_index) in info.items">

                    <template v-if="model[item.name]!= undefined">
                        <sub_fieldset :item="item" v-if="!(Array.isArray(model[item.name]))"></sub_fieldset>
                        <draggable_list :item="item" :item_index="item_index" v-else
                                         @addRecord="addRecord(item_index)" @editRecord="openModalForm($event,'edit',item_index)"
                                        @deleteRecord="deleteRecord"></draggable_list>
                    </template>
                </template>

                <div class="text-center">
                    <button type="button" @click="saveMianModel" class="btn btn-primary">{{$t('actions.submit')}} <i
                            class="icon-paperplane ml-2"></i></button>
                    <button type="button" class="btn bg-teal-400" @click.prevent="refreshInputData">
                        {{$t('actions.reset')}} <i class="icon-undo2 ml-2"></i></button>
                    <button type="button" class="btn btn-danger" @click.prevent="cancelAction">{{$t('actions.cancel')}} <i
                            class="icon-cross2 ml-2"></i></button>
                </div>
                <button  id="submit_button"  type="submit" style="display: none;"></button>
            </form>
        </div>
        <modal_form :modal_data="modal_form" v-if="modal_form.status" @closeForm="closeModalForm" @formUpdated="formUpdated"></modal_form>
    </div>

</template>

<script>
    import main_fieldset from '../basic_form/fieldsets/MainFieldset.vue';
    import sub_fieldset from '../basic_form/fieldsets/SubFieldset.vue';
    import sub_form from '../basic_form/SubForm.vue'
    import modal_form from '../basic_form/ModalForm.vue'
    import draggable_list from './DraggableList.vue'

    import global_mixin from '../../../mixins/GlobalMixin.vue';
    import form_mixin from '../../../mixins/form/FormMixin.vue';
    import pluralize from 'pluralize';

    import {mapActions} from 'vuex'

    export default {
        mixins: [global_mixin, form_mixin],
        components: {main_fieldset, sub_fieldset, sub_form, draggable_list,modal_form},
        data() {
            return {
                modal_form: {},
                order_ids:""
            }
        },
        methods: {
            ...mapActions('form', ['createNewItem']),
            resetModalForm() {
                this.modal_form = {
                    model: {},
                    options: {},
                    info: {},
                    errors: [],
                    resource: "",
                    action: "",
                    status: false
                }
            },
            addRecord(item_index) {
                this.resetModalForm();
                let new_item = {};
                this.createNewItem({item_index})
                    .then(result => {
                        new_item = result;
                        let parent_id=pluralize.singular(this.resource)+'_id';
                        let info=this.info['items'][item_index].info;
                        info.forEach((item_info)=>{
                            if (item_info.name === parent_id){
                                new_item[parent_id]=this.model.id;
                            }
                        });
                        this.openModalForm(new_item,'create',item_index);
                    });
            },
            deleteRecord(event){
                let id=event.id;
                let resource=event.resource;
                let url = this.main_url+'/'+resource+'/'+id;
                let data = {
                    '_method': 'DELETE'
                };
                this.sendRequest( {url: url, data: data,el:this.$el})
                    .then(response => {
                        this.refreshInputData();
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            openModalForm(model,action,item_index){
                this.modal_form.model = model;
                if(this.model.icon_type !== undefined){
                    this.modal_form.model.icon_type=this.model.icon_type;
                }
                this.modal_form.options = this.options;
                this.modal_form.info = this.info['items'][item_index].info;
                this.modal_form.resource = this.info['items'][item_index].table;
                this.modal_form.action=action;
                this.modal_form.status=true;

                setTimeout(function() {
                    $('#open_modal_form').trigger('click');
                },100);

            },
            formUpdated(){
                this.closeModalForm();
                this.refreshInputData();

            },
            closeModalForm(){
                $('#close-modal').trigger("click");
                setTimeout(()=>{
                    this.resetModalForm();
                },100)
            },

            saveMianModel(){
//                console.log('run');
                let nestable_el=$('#nestable3');
                if(nestable_el.length !== 0){
                   this.order_ids=JSON.stringify(nestable_el.nestable('serialize'));
                }
//                console.log(this.order_ids);
                setTimeout(()=>{
                    $("#submit_button").trigger('click');
                },10);

            }
        },
        mounted() {
            this.resetModalForm();
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