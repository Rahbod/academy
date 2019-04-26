<?php


return [
    /*
    |--------------------------------------------------------------------------
    | Acl Role Model
    |--------------------------------------------------------------------------
    |
    | This is the Role model used by Acl to create correct relations.  Update
    | the role if it is in a different namespace.
    |
    */
    'role' => 'App\Role',
    /*
    |--------------------------------------------------------------------------
    | Acl Roles Table
    |--------------------------------------------------------------------------
    |
    | This is the roles table used by Acl to save roles to the database.
    |
    */
    'roles_table' => 'roles',
    /*
    |--------------------------------------------------------------------------
    | Acl role foreign key
    |--------------------------------------------------------------------------
    |
    | This is the role foreign key used by Acl to make a proper
    | relation between actions and roles & roles and users
    |
    */
    'role_foreign_key' => 'role_id',
    /*
    |--------------------------------------------------------------------------
    | Application User Model
    |--------------------------------------------------------------------------
    |
    | This is the User model used by Acl to create correct relations.
    | Update the User if it is in a different namespace.
    |
    */
    'user' => 'App\User',
    /*
    |--------------------------------------------------------------------------
    | Application Users Table
    |--------------------------------------------------------------------------
    |
    | This is the users table used by the application to save users to the
    | database.
    |
    */
    'users_table' => 'users',
    /*
    |--------------------------------------------------------------------------
    | Acl role_user Table
    |--------------------------------------------------------------------------
    |
    | This is the role_user table used by Acl to save assigned roles to the
    | database.
    |
    */
    'role_user_table' => 'role_user',
    /*
    |--------------------------------------------------------------------------
    | Acl user foreign key
    |--------------------------------------------------------------------------
    |
    | This is the user foreign key used by Acl to make a proper
    | relation between roles and users
    |
    */
    'user_foreign_key' => 'user_id',
    /*
    |--------------------------------------------------------------------------
    | Acl Action Model
    |--------------------------------------------------------------------------
    |
    | This is the Action model used by Acl to create correct relations.
    | Update the action if it is in a different namespace.
    |
    */
    'action' => 'App\Action',
    /*
    |--------------------------------------------------------------------------
    | Acl Action Table
    |--------------------------------------------------------------------------
    |
    | This is the actions table used by Acl to save actions to the
    | database.
    |
    */
    'action_table' => 'actions',
    /*
    |--------------------------------------------------------------------------
    | Acl action_role Table
    |--------------------------------------------------------------------------
    |
    | This is the action_role table used by Acl to save relationship
    | between actions and roles to the database.
    |
    */
    'action_role_table' => 'action_role',
    /*
    |--------------------------------------------------------------------------
    | Acl action foreign key
    |--------------------------------------------------------------------------
    |
    | This is the action foreign key used by Acl to make a proper
    | relation between actions and roles
    |
    */
    'action_foreign_key' => 'action_id',
];