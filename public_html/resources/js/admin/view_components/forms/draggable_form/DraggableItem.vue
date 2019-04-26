<template>
    <ol class="dd-list">
        <li class="dd-item dd3-item" :data-id="item.id" v-for="item in items">
            <div class="dd-handle dd3-handle btn bg-info-600"><i class="icon-move"></i></div>
            <div class="dd3-content">
                <ul class="list-icons" style="float: right; margin-left: 20px; list-style: none;padding-right: 0">
                    <li v-for="base_action in base_actions" :class="base_action.class" @click.prevent="get_action(base_action.name,item)" v-if="hasAction(base_action.name,prefix)">
                        <a><i :class="base_action.icon"></i></a>
                    </li>
                </ul>
                <div style="display: inline-block;">
                    {{item.display_name}}
                </div>

            </div>
            <draggable_item @edit="$emit('edit',$event)"  @deleteRecord="$emit('deleteRecord',$event)" v-if="item.children!== undefined && item.children.length>0" :items="item.children" :info="info" :prefix="prefix" :index="index"></draggable_item>
        </li>
    </ol>
</template>
<script>
    import {mapGetters} from 'vuex';
    export default {
        data: function () {
            return {
                base_actions: [
                    {
                        name: 'edit',
                        class: 'text-primary-600',
                        icon: 'icon-pencil7',
                        data_toggle: 'modal',
                        data_target: '#sub_modal'
                    },
                    {
                        name: 'destroy',
                        class: 'text-danger-600',
                        icon: 'icon-trash',
                        data_toggle: '',
                        data_target: ''
                    }
                ],
            }
        },
        computed:{
            ...mapGetters(['actions']),
        },
        props: ['items', 'info', 'prefix', 'index'],
        methods: {
            hasAction(action_name,resource_name){
                if(resource_name===undefined)
                {
                    if(this.actions[action_name]===1)
                    {
                        return true;
                    }
                    return false;
                }
                else {

                    if(this.actions[resource_name][action_name]===1)
                    {
                        return true;
                    }
                    return false;
                }
            },
            get_action(action, data) {
                switch (action) {
                    case 'edit':
                        this.edit(data);
                        break;
                    case 'destroy':
                        this.$emit('deleteRecord', {id: data.id, resource: this.prefix});
                        break;
                    default:
                        console.log(name);
                }
            },
            edit(event) {
                this.$emit('edit',event);
            },
            deleteRecord(data)
            {
                this.$emit('deleteRecord', data);
            }
        },
        beforeCreate() {
            this.$options.components.draggable_item = require('./DraggableItem.vue')
        },
        mounted() {
            setTimeout(function () {
                $(function () {
                    $('#nestable3').nestable();
                });
            }, 500);
        }
    }
</script>