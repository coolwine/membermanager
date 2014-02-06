<?php


use Phalcon\Mvc\Model\Validator\Email as Email;

class MemberInfo extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $m_id;
     
    /**
     *
     * @var string
     */
    public $user_id;
     
    /**
     *
     * @var string
     */
    public $passwd;
     
    /**
     *
     * @var string
     */
    public $user_name;
     
    /**
     *
     * @var string
     */
    public $user_nick;
     
    /**
     *
     * @var string
     */
    public $ssn1;
     
    /**
     *
     * @var string
     */
    public $ssn2;
     
    /**
     *
     * @var string
     */
    public $email;
     
    /**
     *
     * @var string
     */
    public $zipcode;
     
    /**
     *
     * @var string
     */
    public $addr1;
     
    /**
     *
     * @var string
     */
    public $addr2;
     
    /**
     *
     * @var string
     */
    public $phone;
     
    /**
     *
     * @var string
     */
    public $mobile;
     
    /**
     *
     * @var integer
     */
    public $mailling_yn;
     
    /**
     *
     * @var integer
     */
    public $sms_yn;
     
    /**
     *
     * @var integer
     */
    public $sex;
     
    /**
     *
     * @var string
     */
    public $pic_url;
     
    /**
     *
     * @var integer
     */
    public $reg_time;
     
    /**
     *
     * @var integer
     */
    public $update_time;
     
    /**
     *
     * @var string
     */
    public $sns_url;
     
    /**
     *
     * @var string
     */
    public $language;
     
    /**
     *
     * @var integer
     */
    public $user_type;
     
    /**
     *
     * @var integer
     */
    public $user_status;
     
    /**
     *
     * @var integer
     */
    public $temp_flag;
     
    /**
     *
     * @var integer
     */
    public $kind;
     
    /**
     *
     * @var string
     */
    public $birth;
     
    /**
     *
     * @var string
     */
    public $discr_no;
     
    /**
     *
     * @var string
     */
    public $ciscr_hash;
     
    /**
     *
     * @var string
     */
    public $discr_hash;
     
    /**
     *
     * @var integer
     */
    public $certificate_type;
     
    /**
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(
            new Email(
                array(
                    "field"    => "email",
                    "required" => true,
                )
            )
        );
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'm_id' => 'm_id', 
            'user_id' => 'user_id', 
            'passwd' => 'passwd', 
            'user_name' => 'user_name', 
            'user_nick' => 'user_nick', 
            'ssn1' => 'ssn1', 
            'ssn2' => 'ssn2', 
            'email' => 'email', 
            'zipcode' => 'zipcode', 
            'addr1' => 'addr1', 
            'addr2' => 'addr2', 
            'phone' => 'phone', 
            'mobile' => 'mobile', 
            'mailling_yn' => 'mailling_yn', 
            'sms_yn' => 'sms_yn', 
            'sex' => 'sex', 
            'pic_url' => 'pic_url', 
            'reg_time' => 'reg_time', 
            'update_time' => 'update_time', 
            'sns_url' => 'sns_url', 
            'language' => 'language', 
            'user_type' => 'user_type', 
            'user_status' => 'user_status', 
            'temp_flag' => 'temp_flag', 
            'kind' => 'kind', 
            'birth' => 'birth', 
            'discr_no' => 'discr_no', 
            'ciscr_hash' => 'ciscr_hash', 
            'discr_hash' => 'discr_hash', 
            'certificate_type' => 'certificate_type'
        );
    }

    
    public function get_memberinfo($search_val, $cur_page, $per_page, &$total_row)
    {
    	$count_sql = " 
    		SELECT 
    			count(*) AS cnt 
    		FROM
    			MemberInfo
    	";
    	if( $search_val != '')
    	{
    		$where_sql = " WHERE user_id LIKE :user_id:";
    		$param = array( 'user_id' => '%'.$search_val.'%');
    	}
    	else
    	{
    		$where_sql = "";
    		$param = array();
    	}
    	
    	
    	
    	$query = MemberInfo::getModelsManager()->createQuery($count_sql.$where_sql);
    	$result = $query->execute($param);
    	$total_row = $result[0]->cnt;
    	
    	
    	$sql = "SELECT * FROM MemberInfo";
    	$limit_sql = " LIMIT $cur_page , $per_page";
    	//$query = MemberInfo::getModelsManager()->executeQuery($sql, $param);
    	$query = MemberInfo::getModelsManager()->createQuery($sql.$where_sql.$limit_sql);
    	$result = $query->execute($param);
    	return $result;
    }
    
}
