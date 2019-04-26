<template>
    <div class="col-sm-12">
        <div class="card border-teal">
            <div class="card-header header-elements-inline">

                <h6 class="card-title text-teal">
                    <i class="icon-grid5" style="font-size: 18px;"></i>
                    {{$t(resource + ':items.' + item.name + '.main_name')}}
                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a href="#" class="btn btn-labeled btn-labeled-right btn-labeled bg-teal"
                           @click.prevent="$emit('addRecord')">
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

                    <div class="dd" id="nestable3" style="padding: 10px;"
                         v-if="Array.isArray(model[item.name]) && model[item.name].length>0">
                        <draggable_item :items="model[item.name]" :info="item.info" :prefix="item.name"  @deleteRecord="$emit('deleteRecord',$event)"
                                        :index="item_index" @edit="$emit('editRecord',$event)"></draggable_item>
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

    import draggable_item from './DraggableItem.vue'

    export default {
        mixins: [global_mixin, sub_form_mixin],
        components: {draggable_item},

    }
</script>

<style>


    @media only screen and (min-width: 700px) {

        .dd {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;

        }

        .dd + .dd {
            margin-left: 2%;
        }

    }

    .dd-hover > .dd-handle {
        /*background: #2ea8e5 !important;*/
    }

    /**
     * Nestable Draggable Handles
     */

    .dd3-content {
        display: block;
        height: 30px;
        margin: 5px 0;
        padding: 5px 10px 5px 60px;
        color: #00838F;
        text-decoration: none;
        font-weight: bold;
        border: 1px solid rgb(218, 226, 234);
        background: #F8FAFF;
        background: -webkit-linear-gradient(top, #F8FAFF 0%, #f8faff 100%);
        background: -moz-linear-gradient(top, #F8FAFF 0%, #F8FAFF 100%);
        background: linear-gradient(top, #F8FAFF 0%, #F8FAFF 100%);
        -webkit-border-radius: 3px;
        border-radius: 3px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .dd3-content:hover {
        /*color: #2ea8e5;*/
        background: rgb(244, 246, 247);
    }

    .dd-dragel > .dd3-item > .dd3-content {
        margin: 0;
    }

    .dd3-handle {

        position: absolute;
        margin: 0;
        left: 0;
        top: 0;
        cursor: pointer;
        /*width: 30px;*/
        /*text-indent: 30px;*/
        white-space: nowrap;
        overflow: hidden;
        /*border: 1px solid #aaa;*/
        /*background: #ddd;*/
        /*background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);*/
        /*background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);*/
        /*background: linear-gradient(top, #ddd 0%, #bbb 100%);*/
        /*border-top-right-radius: 0;*/
        /*border-bottom-right-radius: 0;*/
    }

    .dd {
        position: relative;
        display: block;
        margin: 0;
        padding: 0;
        max-width: 1200px;
        list-style: none;
        font-size: 13px;
        line-height: 20px;
    }

    .dd-list {
        display: block;
        position: relative;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .dd-list .dd-list {
        padding-left: 30px;
    }

    .dd-item,
    .dd-empty,
    .dd-placeholder {
        display: block;
        position: relative;
        margin: 0;
        padding: 0;
        min-height: 20px;
        font-size: 13px;
        line-height: 20px;
    }

    .dd-handle {
        display: block;
        height: 30px;
        /*margin: 5px 0;*/
        padding: 5px 10px;
        /*color: #333;*/
        text-decoration: none;
        font-weight: bold;
        /*border: 1px solid #ccc;*/
        /*background: #fafafa;*/
        /*border-radius: 3px;*/
        box-sizing: border-box;
    }

    .dd-handle:hover {
        /*color: #2ea8e5;*/
        /*!*background: #fff; */
    }

    .dd-item > button {
        position: relative;
        cursor: pointer;
        float: left;
        width: 25px;
        height: 20px;
        margin: 5px 0;
        margin-left: 38px;
        margin-right: 20px;
        padding: 0;
        text-indent: 100%;
        white-space: nowrap;
        overflow: hidden;
        border: 0;
        background: transparent;
        font-size: 12px;
        line-height: 1;
        text-align: center;
        font-weight: bold;

        /*background-color: #00acc1;*/
        /*border-color: #00acc1;*/
        /*color: #fff;*/
        /*height: 30px;*/
        /*box-sizing: border-box;*/
        /*font-size: 13px;*/
        /*line-height: 1.5384616;*/
        /*border-radius: 3px;*/
        /*border: 1px solid transparent;*/

        font-family: 'icomoon';
    }

    button + button {
        margin-left: 38px;
    }

    .dd-item > button:before {
        display: block;
        position: absolute;
        width: 100%;
        text-align: center;
        text-indent: 0;
    }

    .dd-item > button.dd-expand:before {
        content: "\e9f7";
    }

    .dd-item > button.dd-collapse:before {
        content: "\e9e2";
    }

    .dd-expand {
        display: none;
    }

    .dd-collapsed .dd-list,
    .dd-collapsed .dd-collapse {
        display: none;
    }

    .dd-collapsed .dd-expand {
        display: block;
    }

    .dd-empty,
    .dd-placeholder {
        margin: 5px 0;
        padding: 0;
        min-height: 30px;
        background: #f2fbff;
        border: 1px dashed #b6bcbf;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .dd-empty {
        border: 1px dashed #bbb;
        min-height: 100px;
        background-color: #e5e5e5;
        background-size: 60px 60px;
        background-position: 0 0, 30px 30px;
    }

    .dd-dragel {
        position: absolute;
        pointer-events: none;
        z-index: 9999;
    }

    .dd-dragel > .dd-item .dd-handle {
        margin-top: 0;
    }

    .dd-dragel .dd-handle {
        box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, 0.1);
    }

    .dd-nochildren .dd-placeholder {
        display: none;
    }

    .kv-avatar .krajee-default.file-preview-frame, .kv-avatar .krajee-default.file-preview-frame:hover {
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
        text-align: center;
    }

    .kv-avatar {
        display: inline-block;
    }

    .kv-avatar .file-input {
        display: table-cell;
        width: 213px;
    }

    .kv-reqd {
        color: red;
        font-family: monospace;
        font-weight: normal;
    }

    .has-error .select2-selection {
        border-color: rgb(185, 74, 72) !important;
    }
</style>