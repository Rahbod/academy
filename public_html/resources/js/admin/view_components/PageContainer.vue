<template>
    <div class="page-content">

        <!-- Main sidebar -->
        <slot name="sidebar"></slot>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <slot name="header"></slot>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content" id="main-container">

                <slot name="router-view"></slot>

            </div>
            <!-- /content area -->


            <!-- Footer -->
            <slot name="footer"></slot>
            <!-- /footer -->

        </div>
        <!-- /main content -->

    </div>
</template>

<script>
    export default {

    }
</script>

<style>
   #main-container{
        min-height: 70vh;
    }
</style>