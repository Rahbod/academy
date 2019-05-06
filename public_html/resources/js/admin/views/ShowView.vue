<template>
    <div>
        <button style="display: none" id="open-modal-view" data-toggle="modal" data-target="#modal-view"></button>

        <div id="modal-view" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="close-modal" class="close" data-dismiss="modal" @click="">&times;
                        </button>
                        <!--<h5 class="modal-title">{{formTitle}}</h5>-->
                    </div>

                    <div class="modal-body px-5" style="min-height: 500px" id="modal_view_body">
                        <modal_content v-if="!loading" @closeModal="closeModal"></modal_content>
                    </div>

                </div>
            </div>

        </div>

    </div>
</template>

<script>
    import modal_content from '../view_components/ShowContent.vue';
    import {mapGetters, mapActions} from 'vuex'

    export default {
        components: {modal_content},
        computed: {
            ...mapGetters('show', ['model', 'info', 'loading'])
        },
        methods:{
            closeModal(){
                $('#close-modal').trigger('click');
            }
        }
    }
</script>