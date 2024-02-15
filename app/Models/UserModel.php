<?php 
namespace App\Models;
use CodeIgniter\Model;
class UserModel extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'user_id';
    
    protected $allowedFields = ['user_name','user_email',
                                'user_phone_number', 'user_login_username',
                                'user_login_password','user_is_active',
                                'user_available_date','user_image_path','user_access_type',
                                'create_date','create_by','update_date','update_by'];
}