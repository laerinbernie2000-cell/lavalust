<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UsersModel
 * 
 * Automatically generated via CLI.
 */
class UsersModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';
    protected $fillable = ['first_name','last_name','hobby'];
    protected $guarded = ['id'];

    public function __construct()
    {
        parent::__construct();
    }
}