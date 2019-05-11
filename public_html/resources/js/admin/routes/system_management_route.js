import VueRouter from 'vue-router';

import RouterViewApp from '../view_components/RouterViewApp.vue';
import NestedRouterViewApp from '../view_components/NestedRouterViewApp.vue';
const dashboard = resolve => require(['../views/Dashboard'], resolve);

const ListView=resolve=>{
    require.ensure(['../views/ListView.vue'],()=>{
        resolve(require('../views/ListView.vue'))
    })
};
const FormView=resolve=>{
    require.ensure(['../views/FormView.vue'],()=>{
        resolve(require('../views/FormView.vue'))
    })
};
const ShowView=resolve=>{
    require.ensure(['../views/users/Show.vue'],()=>{
        resolve(require('../views/users/Show.vue'))
    })
};
const SingleView = resolve => {
    require.ensure(['../views/SingleView.vue'], () => {
        resolve(require('../views/SingleView.vue'))
    })
};
const ResourceView = resolve => {
    require.ensure(['../views/ResourceView.vue'], () => {
        resolve(require('../views/ResourceView.vue'))
    })
};

const MenuFormView=resolve=>{
    require.ensure(['../views/menus/FormView.vue'],()=>{
        resolve(require('../views/menus/FormView.vue'))
    })
};

export default new VueRouter ({
    routes:[
        {
            component: SingleView,
            path: '/profile',
            meta: {resource: 'profile',action: 'show'},
        },
        {
            component: NestedRouterViewApp,
            path: '/resources',
            meta: { base_resource: 'resources' },
            children:[
                {
                    component: RouterViewApp,
                    path: 'sp_namespaces',
                    meta: { resource: 'sp_namespaces' },
                    children:[
                        {
                            component: ListView,
                            path: 'list-view',
                            name: 'sp_namespaces-list-view',
                            meta: { action: 'listView' },
                        },
                        {
                            component: FormView,
                            path: 'create',
                            name: 'sp_namespaces-create',
                            meta: { action: 'create' },
                        },
                        {
                            component: FormView,
                            path: ':id/edit',
                            name: 'sp_namespaces-edit',
                            meta: { action: 'edit' },
                        },
                        {
                            component: ShowView,
                            path: ':id',
                            name: 'sp_namespaces-show',
                        },

                    ]
                },
                {
                    component: RouterViewApp,
                    path: 'departments',
                    meta: { resource: 'departments' },
                    children:[
                        {
                            component: ListView,
                            path: 'list-view',
                            name: 'departments-list-view',
                            meta: { action: 'listView' },
                        },
                        {
                            component: FormView,
                            path: 'create',
                            name: 'departments-create',
                            meta: { action: 'create' },
                        },
                        {
                            component: FormView,
                            path: ':id/edit',
                            name: 'departments-edit',
                            meta: { action: 'edit' },
                        },
                        {
                            component: ShowView,
                            path: ':id',
                            name: 'departments-show',
                        },

                    ]
                },
                {
                    component: RouterViewApp,
                    path: 'resource_groups',
                    meta: { resource: 'resource_groups' },
                    children:[
                        {
                            component: ListView,
                            path: 'list-view',
                            name: 'resource_groups-list-view',
                            meta: { action: 'listView' },
                        },
                        {
                            component: FormView,
                            path: 'create',
                            name: 'resource_groups-create',
                            meta: { action: 'create' },
                        },
                        {
                            component: FormView,
                            path: ':id/edit',
                            name: 'resource_groups-edit',
                            meta: { action: 'edit' },
                        },
                        {
                            component: ShowView,
                            path: ':id',
                            name: 'resource_groups-show',
                        },

                    ]
                },
                {
                    component: RouterViewApp,
                    path: 'resources',
                    meta: { resource: 'resources' },
                    children:[
                        {
                            component: ListView,
                            path: 'list-view',
                            name: 'resources-list-view',
                            meta: { action: 'listView' },
                        },
                        {
                            component: FormView,
                            path: 'create',
                            name: 'resources-create',
                            meta: { action: 'create' },
                        },
                        {
                            component: FormView,
                            path: ':id/edit',
                            name: 'resources-edit',
                            meta: { action: 'edit' },
                        },
                        {
                            component: ShowView,
                            path: ':id',
                            name: 'resources-show',
                        },

                    ]
                },
                {
                    component: RouterViewApp,
                    path: 'actions',
                    meta: { resource: 'actions' },
                    children:[
                        {
                            component: ListView,
                            path: 'list-view',
                            name: 'actions-list-view',
                            meta: { action: 'listView' },
                        },
                        {
                            component: FormView,
                            path: 'create',
                            name: 'actions-create',
                            meta: { action: 'create' },
                        },
                        {
                            component: FormView,
                            path: ':id/edit',
                            name: 'actions-edit',
                            meta: { action: 'edit' },
                        },
                        {
                            component: ShowView,
                            path: ':id',
                            name: 'actions-show',
                        },

                    ]
                },
            ]
        },
        {
            component: RouterViewApp,
            path: '/paths',
            meta: { resource: 'paths' },
            name:'paths',
            children:[
                {
                    component: ListView,
                    path: 'list-view',
                    name: 'paths-list-view',
                    meta: { action: 'listView' },
                },
                {
                    component: FormView,
                    path: 'create',
                    name: 'paths-create',
                    meta: { action: 'create' },
                },
                {
                    component: FormView,
                    path: ':id/edit',
                    name: 'paths-edit',
                    meta: { action: 'edit' },
                },
                {
                    component: ShowView,
                    path: ':id',
                    name: 'paths-show',
                },

            ]
        },
        {
            component: NestedRouterViewApp,
            path: '/menus',
            meta: { base_resource: 'menus' },
            children:[
                {
                    component: ResourceView,
                    path: '/',
                    name: 'base_menus-resource-view',
                },
                {
                    component: RouterViewApp,
                    path: 'menus',
                    meta: { resource: 'menus' },
                    children:[
                        {
                            component: ResourceView,
                            path: '/',
                            name: 'menus-resource-view',
                        },
                        {
                            component: ListView,
                            path: 'list-view',
                            name: 'menus-list-view',
                            meta: { action: 'listView'},
                        },
                        {
                            component: MenuFormView,
                            path: 'create',
                            name: 'menus-create',
                            meta: { action: 'create' },
                        },
                        {
                            component: MenuFormView,
                            path: ':id/edit',
                            name: 'menus-edit',
                            meta: { action: 'edit' },
                        },
                        {
                            component: ShowView,
                            path: ':id',
                            name: 'menus-show',
                        },

                    ]
                },
                {
                    component: RouterViewApp,
                    path: 'menu_items',
                    meta: { resource: 'menu_items' },
                    children:[
                        {
                            component: ResourceView,
                            path: '/',
                            name: 'menu_items-resource-view',
                        },
                        {
                            component: ListView,
                            path: 'list-view',
                            name: 'menu_items-list-view',
                            meta: { action: 'listView' },
                        },
                        {
                            component: FormView,
                            path: 'create',
                            name: 'menu_items-create',
                            meta: { action: 'create' },
                        },
                        {
                            component: FormView,
                            path: ':id/edit',
                            name: 'menu_items-edit',
                            meta: { action: 'edit' },
                        },
                        {
                            component: ShowView,
                            path: ':id',
                            name: 'menu_items-show',
                        },

                    ]
                },
            ]
        },
        {
            component: NestedRouterViewApp,
            path: '/settings',
            meta: { base_resource: 'settings' },
            children:[
                {
                    component: RouterViewApp,
                    path: 'settings',
                    meta: { resource: 'settings' },
                    children:[
                        {
                            component: ListView,
                            path: 'list-view',
                            name: 'settings-list-view',
                            meta: { action: 'listView' },
                        },
                        {
                            component: FormView,
                            path: 'create',
                            name: 'settings-create',
                            meta: { action: 'create' },
                        },
                        {
                            component: FormView,
                            path: ':id/edit',
                            name: 'settings-edit',
                            meta: { action: 'edit' },
                        },
                        {
                            component: ShowView,
                            path: ':id',
                            name: 'settings-show',
                        },

                    ]
                },
                {
                    component: RouterViewApp,
                    path: 'setting_groups',
                    meta: { resource: 'setting_groups' },
                    children:[
                        {
                            component: ListView,
                            path: 'list-view',
                            name: 'setting_groups-list-view',
                            meta: { action: 'listView' },
                        },
                        {
                            component: FormView,
                            path: 'create',
                            name: 'setting_groups-create',
                            meta: { action: 'create' },
                        },
                        {
                            component: FormView,
                            path: ':id/edit',
                            name: 'setting_groups-edit',
                            meta: { action: 'edit' },
                        },
                        {
                            component: ShowView,
                            path: ':id',
                            name: 'setting_groups-show',
                        },

                    ]
                },
            ]
        },
    ]
});