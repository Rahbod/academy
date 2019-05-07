<template>
    <div>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
            <tr>
                <th colspan="2" style="text-align: center"><b v-text="$t(resource+':title')"></b></th>
            </tr>
            </thead>
            <tbody>
            <!--<tr v-for="(model_info,key) in info" v-if="model[model_info.name] !== undefined && !Array.isArray(model[model_info.name])">-->
            <tr v-for="(model_info,key) in info" v-if="key !== 'items' && model[model_info.name] !== undefined">
                <th style="text-align: center;"><b v-text="$t(resource+':items.'+model_info.name)"> </b></th>
                <td v-html="model[model_info.name]"></td>
            </tr>

            <template v-for="relation in info.items"
                      v-if="info.items!== undefined && model[relation.name ]!== undefined">
                <template v-if="!Array.isArray(model[relation.name])">
                    <tr v-for="(model_info,key) in relation.info"
                        v-if="model[relation.name ][model_info.name] !== undefined">
                        <th style="text-align: center;"><b
                                v-text="$t(resource+':items.'+relation.name+'.'+model_info.name)"> </b></th>
                        <td v-html="model[relation.name ][model_info.name]"></td>
                    </tr>
                </template>
                <template v-if="Array.isArray(model[relation.name])">
                    <template v-if="relation.name === 'attachments'">
                        <th style="text-align: center;"><b
                                v-text="$t(resource+':relations.'+relation.name)"> </b></th>
                        <td>
                            <a v-for="attachment in model[relation.name]" :href="attachment.source"> {{attachment.title}} </a>
                        </td>
                    </template>
                </template>

            </template>
            </tbody>
        </table>

        <!--<template v-for="relation in info.items"-->
                  <!--v-if="info.items!== undefined && model[relation.name ]!== undefined && !Array.isArray(model[relation.name])">-->
            <!--<table class="table table-bordered table-hover">-->
                <!--<thead class="thead-dark">-->
                <!--<tr>-->
                    <!--<th colspan="2" style="text-align: center"><b v-text="$t(resource+':relations.'+relation.name)"></b>-->
                    <!--</th>-->
                <!--</tr>-->
                <!--</thead>-->
                <!--<tbody>-->
                <!--&lt;!&ndash;<tr v-for="(model_info,key) in info" v-if="model[model_info.name] !== undefined && !Array.isArray(model[model_info.name])">&ndash;&gt;-->
                <!--<tr v-for="(model_info,key) in relation.info"-->
                    <!--v-if="model[relation.name ][model_info.name] !== undefined">-->
                    <!--<th style="text-align: center;"><b-->
                            <!--v-text="$t(resource+':items.'+relation.name+'.'+model_info.name)"> </b></th>-->
                    <!--<td v-html="model[relation.name ][model_info.name]"></td>-->
                <!--</tr>-->
                <!--</tbody>-->
            <!--</table>-->
        <!--</template>-->


        <div class="mt-1">
            <div class="text-center">
                <button v-if="hasAction('edit')" @click.prevent="showEditForm" type="button" class="btn btn bg-teal-400">{{$t('actions.edit')}}<i class="icon-undo2 ml-2"></i></button>
                <button type="button" class="btn btn-danger" @click="closeModal()">{{$t('actions.cancel')}} <i class="icon-cross2 ml-2"></i>
                </button>
            </div>
        </div>

    </div>

</template>

<script>
    import {mapGetters} from 'vuex'
    import global_mixin from '../mixins/GlobalMixin.vue';

    export default {
        mixins:[global_mixin],
        computed: {
            ...mapGetters('show', ['model', 'info']),
            ...mapGetters(['resource', 'route_name', 'actions']),
        },
        methods:{
            closeModal(){
                this.$emit('closeModal');
            },
            showEditForm() {
                this.$emit('closeModal');
                let vm=this;
                setTimeout(function () {
                    vm.$router.push({name: vm.route_name + '-edit', params: {id: vm.model.id}})
                })

            },
        }
    }
</script>