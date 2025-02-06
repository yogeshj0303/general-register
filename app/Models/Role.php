<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Table name if it doesn't follow Laravel's default naming convention
    protected $table = 'roles';

    // Primary key field
    protected $primaryKey = 'id';

    // Disable timestamps if you don't want the automatic created_at and updated_at
    public $timestamps = true;

    // Fillable columns, for mass assignment
    protected $fillable = [
        'm_cat_viewown', 'm_cat_viewall', 'm_cat_edit', 'm_cat_delete', 'm_cat_add', 
        'm_taluka_add', 'm_taluka_edit', 'm_taluka_delete', 'm_taluka_viewown', 'm_taluka_viewall',
        'm_gram_add', 'm_gram_edit', 'm_gram_delete', 'm_gram_viewown', 'm_gram_viewall',
        'registered_gram_add', 'registered_gram_edit', 'registered_gram_delete', 'registered_gram_viewown', 
        'registered_gram_viewall', 'registered_gram_print', 'manage_user_add', 'manage_user_edit',
        'manage_user_delete', 'manage_user_viewown', 'manage_user_viewall', 'p_w_bill_add', 'p_w_bill_edit',
        'p_w_bill_delete', 'p_w_bill_viewown', 'p_w_bill_viewall', 'p_w_bill_print', 'about_gram_add', 
        'about_gram_edit', 'about_gram_delete', 'about_gram_viewown', 'about_gram_viewall', 'about_gram_print',
        'population_add', 'population_edit', 'population_delete', 'population_viewown', 'population_viewall',
        'population_print', 'gram_bill_add', 'gram_bill_edit', 'gram_bill_delete', 'gram_bill_viewown',
        'gram_bill_viewall', 'gram_bill_print', 'gram_annual_add', 'gram_annual_edit', 'gram_annual_delete',
        'gram_annual_viewown', 'gram_annual_viewall', 'gram_annual_print', 'dash_pending_taxation_user',
        'dash_pending_water_user', 'paid_annual_m_gram', 'pending_annual_m_gram'
    ];

    // Default values for newly created roles
    protected $attributes = [
        'm_cat_viewown' => 1, 'm_cat_viewall' => 1, 'm_cat_edit' => 1, 'm_cat_delete' => 1, 
        'm_cat_add' => 1, 'm_taluka_add' => 1, 'm_taluka_edit' => 1, 'm_taluka_delete' => 1, 
        'm_taluka_viewown' => 1, 'm_taluka_viewall' => 1, 'm_gram_add' => 1, 'm_gram_edit' => 1,
        'm_gram_delete' => 1, 'm_gram_viewown' => 1, 'm_gram_viewall' => 1, 'registered_gram_add' => 1, 
        'registered_gram_edit' => 1, 'registered_gram_delete' => 1, 'registered_gram_viewown' => 1, 
        'registered_gram_viewall' => 1, 'registered_gram_print' => 1, 'manage_user_add' => 1, 
        'manage_user_edit' => 1, 'manage_user_delete' => 1, 'manage_user_viewown' => 1, 
        'manage_user_viewall' => 1, 'p_w_bill_add' => 1, 'p_w_bill_edit' => 1, 'p_w_bill_delete' => 1,
        'p_w_bill_viewown' => 1, 'p_w_bill_viewall' => 1, 'p_w_bill_print' => 1, 'about_gram_add' => 1,
        'about_gram_edit' => 1, 'about_gram_delete' => 1, 'about_gram_viewown' => 1, 'about_gram_viewall' => 1,
        'about_gram_print' => 1, 'population_add' => 1, 'population_edit' => 1, 'population_delete' => 1,
        'population_viewown' => 1, 'population_viewall' => 1, 'population_print' => 1, 'gram_bill_add' => 1,
        'gram_bill_edit' => 1, 'gram_bill_delete' => 1, 'gram_bill_viewown' => 1, 'gram_bill_viewall' => 1,
        'gram_bill_print' => 1, 'gram_annual_add' => 1, 'gram_annual_edit' => 1, 'gram_annual_delete' => 1,
        'gram_annual_viewown' => 1, 'gram_annual_viewall' => 1, 'gram_annual_print' => 1, 
        'dash_pending_taxation_user' => 1, 'dash_pending_water_user' => 1, 'paid_annual_m_gram' => 1, 
        'pending_annual_m_gram' => 1
    ];
    
    public function users()
    {
        return $this->hasMany(User::class, 'user_type', 'id');
    }
}
