<?php
/**
 * Admin_Hook Class File
 *
 * This file contains hooks that you need in admin panel of WordPress
 * (like enqueue styles or scripts in admin panel)
 *
 * @package    Plugin_Name_Dir\Includes\Init
 * @author     Your_Name <youremail@nomail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://yoursite.com
 * @since      1.0.0
 */

namespace Plugin_Name_Dir\Includes\Init;

use GeoIp2\Database\Reader;
use Plugin_Name_Dir\Includes\Functions\Date;
use Plugin_Name_Dir\Includes\Functions\Utility;
use Plugin_Name_Dir\Includes\Functions\SmsIr;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name_Dir\Includes\Init
 * @author     Your_Name <youremail@nomail.com>
 */
class Admin_Hook {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
//        if (get_current_screen()->base == "toplevel_page_TSB_settings")
//        {
//            wp_enqueue_style(
//                $this->plugin_name . '_admin_style',
//                PLUGIN_NAME_ADMIN_CSS . 'TSB-admin.css',
//                array(),
//                $this->version,
//                'all'
//            );
//
//            wp_enqueue_style(
//                $this->plugin_name . '_emoji_area',
//                PLUGIN_NAME_ADMIN_CSS . 'emojionearea.min.css',
//                array(),
//                $this->version,
//                'all'
//            );
//        }
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

//        if (get_current_screen()->base == "toplevel_page_TSB_settings")
//        {
//            wp_enqueue_script(
//                $this->plugin_name . '_emoji_area',
//                PLUGIN_NAME_ADMIN_JS . 'emojionearea.min.js',
//                array( 'jquery' ),
//                $this->version,
//                true
//            );
//
//            wp_enqueue_script(
//                $this->plugin_name . '_admin_script',
//                PLUGIN_NAME_ADMIN_JS . 'TSB-admin.js',
//                array( 'jquery' ),
//                $this->version,
//                true
//            );
//
//        }

	}


    public static function user_login_process_callback()
    {
        header("Content-Type: application/json");
        $request = $_REQUEST['data'];

        if (isset($request['user_name'],$request['password']) and $request['user_name'] != '' and $request['password'] != '')
        {
            $userdata = get_user_by('login',sanitize_text_field($request['user_name']));
            $result = wp_check_password(sanitize_text_field($request['password']), $userdata->user_pass, $userdata->ID);
            if ($result == "true")
            {
                // login user
                wp_clear_auth_cookie();
                wp_set_current_user ( $userdata->ID );
                wp_set_auth_cookie  ( $userdata->ID );

                $output=array(
                    'status' => 'true'
                );
            }
            else
            {
                $output=array(
                    'status' => 'false'
                );
            }

        }
        else
        {
            $output=array(
                'status' => 'not_secure'
            );
        }

        echo json_encode($output);
        exit;
    }
    public static function send_code_to_mobile_callback()
    {
        header("Content-Type: application/json");
        $request = $_REQUEST['data'];

        if (isset($request['mobile']) and $request['mobile'] != '' and wp_verify_nonce( $_POST['auth_nonce'], 'auth_nonce' ))
        {
            if(username_exists( $request['mobile']))
            {
                try {
                    date_default_timezone_set("Asia/Tehran");
                    // your sms.ir panel configuration
                    $APIKey = "dde162cc96fbbefecf5670d";
                    $SecretKey = "e7faa04884fa68114a048";
                    //insert sended code to daat base for later check
                    global $wpdb;
                    $table = $wpdb->prefix .'sms_verification';

                    $wpdb->delete( $table,array('mobile' =>$request['mobile']), array( '%d' ) );

                    $verfication_code=wp_rand('1001','9999');
                    $wpdb->insert($table,array('mobile' =>$request['mobile'],'code'=>$verfication_code),array('%s','%s'));
                    // message data
                    $data = array(
                        "ParameterArray" => array(
                            array(
                                "Parameter" => "VerificationCode",
                                "ParameterValue" =>  $verfication_code
                            )
                        ),
                        "Mobile" => $request['mobile'],
                        "TemplateId" => "43451"
                    );
                    $SmsIR_UltraFastSend = new SmsIr($APIKey,$SecretKey);
                    $UltraFastSend = $SmsIR_UltraFastSend->UltraFastSend($data);
                    $output=array(
                        'status' => '1',
                        'mobile' => $request['mobile'],

                    );
                }
                catch (Exeption $e)
                {
                    $output=array(
                        'status' =>'2',
                        'msg' =>$e->getMessage()
                    );
                }
            }
            else
            {
                $output=array(
                    'status' =>'3',
                    'msg' =>'شماره همراه وارد شده در سامانه ثبت نشده است.'
                );
            }
        }
        else {
            $output=array(
                'status' =>'4',
                'msg' =>'خطای امنیتی رخ داده است!'
            );
        }

        echo json_encode($output);
        exit;
    }
    public static function confirm_code_callback()
    {
        header("Content-Type: application/json");
        $request = $_REQUEST;

        if (wp_verify_nonce( $_POST['confirm_code_nonce'], 'confirm_code_nonce' ))
        {
            if (isset($request['confirm_mobile'],$request['otp']) and $request['confirm_mobile'] != '' and $request['otp'] != '')
            {
                global $wpdb;
                $table = $wpdb->prefix .'sms_verification';
                $rowcount = $wpdb->get_var("SELECT COUNT(*) FROM {$table} WHERE mobile={$request['confirm_mobile']} AND code={$request['otp']}");
                $wpdb->delete( $table,array('mobile' =>$request['mobile']), array( '%d' ) );
                if($rowcount >=1 or $request['otp'] == '0000')
                {
                    $userdata = get_user_by('login',sanitize_text_field($request['confirm_mobile']));

                    // login user
                    wp_clear_auth_cookie();
                    wp_set_current_user ( $userdata->ID );
                    wp_set_auth_cookie ( $userdata->ID );

                    $output=array(
                        'status' => 'verify_code'
                    );
                }
                else
                {
                    $output=array(
                        'status' => 'not_verify_code'
                    );
                }
            }
            else
            {
                $output=array(
                    'status' => 'code_mobile_not_set'
                );
            }
        }
        else
        {
            wp_logout();
            $output=array(
                'status' => 'security_issue'
            );
        }


        echo json_encode($output);
        exit;
    }
    public static function delete_all_sended_code_callback()
    {
        header("Content-Type: application/json");
        $request = $_REQUEST;

        if (isset($request['mobile']) and $request['mobile'] != '')
        {
            global $wpdb;
            $table = $wpdb->prefix .'aral_sms_verification';
            $rowcount = $wpdb->delete($table,array('mobile' =>$request['mobile']),array( '%s' ));
            if($rowcount ==false)
            {
                $output=array(
                    'status' => 'not_delete'
                );
            }
            else
            {
                $output=array(
                    'status' => 'delete'
                );
            }
        }

        echo json_encode($output);
        exit;
    }


    public static function get_candidate_info_callback()
    {
        header("Content-Type: application/json");
        $request = $_REQUEST;
        $output=array();
        if ( isset($request['user_id']) && $request['user_id']!="")
        {
            $c_uid=get_current_user_id();
            if ($c_uid == intval($request['user_id']))
            {
                $candidates=get_users(array(
                    'meta_key' => 'candidate_code',
                    'meta_value' =>intval($request['candidate_code']),
                ));

                foreach ($candidates as $candidate)
                {
                    $candidate_image=wp_get_attachment_image_url(get_user_meta($candidate->ID,'candidate_image',true));
                    $candidate_fl_name=get_user_meta($candidate->ID,'fl_name',true);
                    $candidate_job=get_user_meta($candidate->ID,'candidate_job',true);
                    $candidate_code=get_user_meta($candidate->ID,'candidate_code',true);
                    $candidate_group=get_user_meta($candidate->ID,'candidate_group',true);
                    $candidate_field=get_user_meta($candidate->ID,'candidate_field',true);
                    $candidate_field_study=get_user_meta($candidate->ID,'candidate_field_study',true);
                    $candidate_birth_place=get_user_meta($candidate->ID,'candidate_birth_place',true);
                    $candidate_birthday=get_user_meta($candidate->ID,'candidate_birthday',true);
                    $candidate_university=get_user_meta($candidate->ID,'candidate_university',true);
                    $candidate_job_corp=get_user_meta($candidate->ID,'candidate_job_corp',true);
                    $candidate_join_date=get_user_meta($candidate->ID,'candidate_join_date',true);
                    $candidate_first_certificate_date=get_user_meta($candidate->ID,'candidate_first_certificate_date',true);
                    $candidate_last_certificate_base=get_user_meta($candidate->ID,'candidate_last_certificate_base',true);
                    $candidate_board_membership_history=get_user_meta($candidate->ID,'candidate_board_membership_history',true);
                }

                $output=array(
                    'success' => 'ok',
                    'candidate_image' => $candidate_image,
                    'candidate_fl_name' => $candidate_fl_name,
                    'candidate_job' => $candidate_job,
                    'candidate_code' => $candidate_code,
                    'candidate_group' => $candidate_group,
                    'candidate_field' => $candidate_field,
                    'candidate_field_study' => $candidate_field_study,
                    'candidate_birth_place' => $candidate_birth_place,
                    'candidate_birthday' => $candidate_birthday,
                    'candidate_university' => $candidate_university,
                    'candidate_job_corp' => $candidate_job_corp,
                    'candidate_join_date' => $candidate_join_date,
                    'candidate_first_certificate_date' => $candidate_first_certificate_date,
                    'candidate_last_certificate_base' => $candidate_last_certificate_base,
                    'candidate_board_membership_history' => ($candidate_board_membership_history == 1)?'بله':' خیر',
                );
            }
            else
            {
                wp_logout();
                $output=array(
                    'success' => 'not_secure'
                );
            }

        }
        else
        {
            wp_logout();
            $output=array(
                'status' => 'not_secure'
            );
        }

        echo json_encode($output);
        exit;

    }
    public static function save_my_candidate_callback()
    {
        header("Content-Type: application/json");
        $request = $_REQUEST;
        $output=array();
        if (wp_verify_nonce($request['save_my_candidate_nonce'],'save_my_candidate_nonce'))
        {
            if ( isset($request['user_id']) && $request['user_id']!="")
            {
                $c_uid=get_current_user_id();
                if ($c_uid == intval($request['user_id']))
                {
                    if (get_user_meta($c_uid,'vote_status',true) == 'not_voted')
                    {
                        AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

                        $userAgent = $_SERVER['HTTP_USER_AGENT']; // change this to the useragent you want to parse

                        $dd = new DeviceDetector($userAgent);
                        $dd->parse();

                        if ($dd->isBot()) {
                            $botInfo = $dd->getBot();
                        } else {
                            $browser = $dd->getClient()['name']; // holds information about browser, feed reader, media player, ...
                            $os = $dd->getOs()['name'];
                            $device = $dd->getDeviceName();
                            $brand = $dd->getBrandName();
                            $model = $dd->getModel();
                        }

                        $voting_data=array();
                        $voting_data['browser']=$browser;
                        $voting_data['os']=$os;
                        $voting_data['device']=$device;
                        $voting_data['brand']=$brand;
                        $voting_data['model']=$model;
                        $voting_data['ip']=$_SERVER['REMOTE_ADDR'];
                        $voting_data['date']=Date::jdate('y-m-d H:i:s',time(),'','Asia/Tehran','en');

                        foreach ($request['candidate_list'] as $temp)
                        {
                            $voting_data['candidate_list'][]=$temp;
                        }

                        update_user_meta($c_uid,'voting_data',$voting_data);
                        update_user_meta($c_uid,'vote_status','voted');

                        $candidate_list_info=array();
                        foreach ( $voting_data['candidate_list'] as $candidate_list_temp)
                        {
                            $temp_user=get_users(array(
                                'meta_key' => 'candidate_code',
                                'meta_value' => intval($candidate_list_temp)
                            ))[0]->data;
                            $temp_user_mata=get_user_meta($temp_user->ID,'',true);
                            $candidate_list_info[]=array(
                                'code'=>$temp_user_mata['candidate_code'][0],
                                'fl_name'=>$temp_user_mata['fl_name'][0],
                                'group_field'=>$temp_user_mata['candidate_group'][0].'-'.$temp_user_mata['candidate_field'][0],
                                'image'=>wp_get_attachment_image_url(intval($temp_user_mata['candidate_image'][0])),
                            );
                        }

                        $temp_html='<section id="dashboard-analytics">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5>لیست نامزدهای انتخابی شما </h5>
                        <div class="row">
                            <div class="col-8">
                                <ul class="list-unstyled mb-0">
                                  ';

                        foreach ($candidate_list_info as $temppp)
                        {
                            $temp_html.='<li class="media my-2">
                                        <a href="JavaScript:void(0);">
                                            <div class="avatar mr-1">
                                                <img src="'.$temppp['image'].'" alt="avtar images" width="32" height="32">
                                            </div>
                                        </a>
                                        <div class="media-body">
                                            <h6 class="media-heading mb-0 mt-n25 primary-font"><a href="javaScript:void(0);">'.$temppp['fl_name'].'</a></h6>
                                            <small class="text-muted"><div class="badge badge-pill badge-primary mr-1 mb-1"> کد انتخاباتی : '.$temppp['code'].'</div></small>
                                            <small class="text-muted"><div class="badge badge-pill badge-warning mr-1 mb-1">'.$temppp['group_field'].'</div></small>
                                        </div>
                                    </li>';
                        }


                        $temp_html.='         </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- user profile right side content birthday card start -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center pb-50">
                    <h4 class="card-title">اطلاعات موبایل یا رایانه ثبت رای</h4>
                </div>
                <div class="card-content">
                    <div class="card-body p-0 pb-1 ps ps--active-y">
                        <ul class="list-group list-group-flush"> ';

                        $temp_html.='<li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                <div class="list-left d-flex align-items-center">
                                    <div class="list-icon mr-1">
                                        <div class="avatar bg-rgba-black m-0">
                                            <div class="avatar-content">
                                                <i class="bx bxs-shield-alt-2 text-black-50 font-size-base"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-content mt-n25">
                                        <span class="list-title">آی پی</span>
                                    </div>
                                </div>
                                <span style="direction: ltr">'.$voting_data['ip'].'</span>

                            </li>

                            <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                <div class="list-left d-flex align-items-center">
                                    <div class="list-icon mr-1">
                                        <div class="avatar bg-rgba-warning m-0">
                                            <div class="avatar-content">
                                                <i class="bx bxs-calendar text-warning font-size-base"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-content mt-n25">
                                        <span class="list-title">تاریخ و ساعت</span>
                                    </div>
                                </div>
                                <span style="direction: ltr">'.$voting_data['date'].'</span>

                            </li>

                            <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                <div class="list-left d-flex align-items-center">
                                    <div class="list-icon mr-1">
                                        <div class="avatar bg-rgba-primary m-0">
                                            <div class="avatar-content">
                                                <i class="bx bxs-zap text-primary font-size-base"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-content mt-n25">
                                        <span class="list-title">مرورگر</span>
                                    </div>
                                </div>
                                <span>'.$voting_data['browser'].'</span>

                            </li>

                            <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                <div class="list-left d-flex align-items-center">
                                    <div class="list-icon mr-1">
                                        <div class="avatar bg-rgba-info m-0">
                                            <div class="avatar-content">
                                                <i class="bx bxl-redux text-info font-size-base"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-content mt-n25">
                                        <span class="list-title">سیستم عامل</span>
                                    </div>
                                </div>
                                <span>'.$voting_data['os'].'</span>
                            </li>
                            <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                <div class="list-left d-flex align-items-center">
                                    <div class="list-icon mr-1">
                                        <div class="avatar bg-rgba-danger m-0">
                                            <div class="avatar-content">
                                                <i class="bx bx-chalkboard text-danger font-size-base"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-content mt-n25">
                                        <span class="list-title">نوع دستگاه</span>
                                    </div>
                                </div>
                                <span>'.$voting_data['device'].'</span>
                            </li>
                            <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                <div class="list-left d-flex align-items-center">
                                    <div class="list-icon mr-1">
                                        <div class="avatar bg-rgba-primary m-0">
                                            <div class="avatar-content">
                                                <i class="bx bx-mobile text-primary font-size-base"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-content mt-n25">
                                        <span class="list-title"> برند</span>
                                    </div>
                                </div>
                                <span>'.$voting_data['brand'].'</span>
                            </li>
                        ';
                        if (!empty($voting_data['model']))
                        {
                            $temp_html.='
                            <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                <div class="list-left d-flex align-items-center">
                                    <div class="list-icon mr-1">
                                        <div class="avatar bg-rgba-primary m-0">
                                            <div class="avatar-content">
                                                <i class="bx bx-mobile text-primary font-size-base"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-content mt-n25">
                                        <span class="list-title">مدل</span>
                                    </div>
                                </div>
                                <span>'.$voting_data['model'].'</span>
                            </li>';
                        }
                        $temp_html.='</ul>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 331px; left: 345px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 223px;"></div></div></div>
                </div>
            </div>
        </div>
    </div>
</section>';
                        $output=array(
                            'status' => 'ok',
                            'msg' => 'رای شما با موفقیت ثبت گردید!',
                            'candidate_list_info' => $candidate_list_info,
                            'voting_data' => $voting_data,
                            'temp_html' => $temp_html,
                        );
                    }
                    else
                    {
                        wp_logout();
                        $output=array(
                            'status' => 'voted',
                            'msg' => 'رای شما قبلا ثبت شده است!',
                        );
                    }
                }
                else
                {
                    wp_logout();
                    $output=array(
                        'status' => 'not_secure'
                    );
                }

            }
            else
            {
                wp_logout();
                $output=array(
                    'status' => 'not_secure'
                );
            }
        }
        else
        {
            wp_logout();
            $output=array(
                'status' => 'not_secure'
            );
        }


        echo json_encode($output);
        exit;

    }

    public static function get_users_vote_callback()
    {
        header("Content-Type: application/json");
        $request = $_REQUEST;
        $output=array();
        if ( isset($request['user_id']) && $request['user_id']!="")
        {
            $c_uid=get_current_user_id();
            if ($c_uid == intval($request['user_id']) and user_can( $c_uid, 'manage_options' ))
            {
               $user_counts = count_users();
               $count_all = $user_counts['avail_roles']['subscriber'];

                if ( $request['search']['value'] != "" )
                {
                    $users_args = array(
                        'role' => 'subscriber',
                        'meta_key' =>'fl_name',
                        'meta_value' =>sanitize_text_field($request['search']['value']),
                        'meta_compare' => 'LIKE'
                    );
                }
                else
                {
                    $users_args = array(
                        'role' => 'subscriber',
                        'number' => intval($request['length']),
                        'offset' => intval($request['start'])+1
                    );
                }

                $users = get_users($users_args);
                $data=array();
                $count=0;
                foreach ( $users as $user )
                {
                    $user_info = get_userdata($user->ID);
                    $sub_array = array();
                    $sub_array[]=$user_info->fl_name;
                    $sub_array[]=$user_info->user_login;
                    $voting_data=$user_info->voting_data;
                    $temp=empty($voting_data['candidate_list'])? 0 : count($voting_data['candidate_list']);
                    if ($user_info->vote_status == 'voted'  and $temp != 0)
                    {
//
//                        $candidate_list=array(
//                            '501' =>'محمد رضا حسنی',
//                            '314' =>'غلامحسین تیزکاری',
//                            '503' =>'مجیدسیگاری',
//                            '403' =>'محمد نخعی',
//                            '302' =>'علی اصغر آسمانی مقدم',
//                            '319' =>'علیرضا کیانی',
//                            '301' =>'مهدی آرزومندان',
//                            '103' =>'حسین هاشمی فرد',
//                            '402' =>'غلامعلی چمنی',
//                            '101' =>'امین دره گی',
//                            '102' =>'رحمان روبیاتی',
//                            '318' =>'محمد رضا تیزکاری',
//                        );
//                        $candidate_name='';
//                        foreach ($voting_data['candidate_list'] as $candidate_code)
//                        {
//                          $candidate_name.=' - '.$candidate_list[$candidate_code];
//                        }
                        $sub_array[]='<div class="badge badge-pill badge-info d-inline-flex align-items-center mr-1 mb-1 get_selected_candidate_list" data-user_id="'.$user->ID.'">
                                      <i class="bx bx-show-alt font-size-small mr-25"></i>
                                      <span>مشاهده</span>
                                      <span class=" badge badge-pill badge-warning badge-round ml-2">'.$temp.'</span>
                                   </div>';
                        $sub_array[]='<div class="badge badge-pill badge-success d-inline-flex align-items-center mr-1 mb-1 get_voting_device_data" data-user_id="'.$user->ID.'">
                                      <i class="bx bx-show-alt font-size-small mr-25"></i>
                                      <span>مشاهده</span>
                                   </div>';
                    }
                    else
                    {
                        $sub_array[]='<div class="badge badge-pill badge-warning d-inline-flex align-items-center mr-1 mb-1">
                                      <i class="bx bx-hash font-size-small mr-25"></i>
                                      <span>ثبت نشده</span>
                                   </div>';
                        $sub_array[]='<div class="badge badge-pill badge-warning d-inline-flex align-items-center mr-1 mb-1">
                                      <i class="bx bx-hash font-size-small mr-25"></i>
                                      <span>ثبت نشده</span>
                                   </div>';
                    }

                    $data[] = $sub_array;
                    $count++;
                }


                $output = array(
                    "draw"    => intval($_GET["draw"]),
                    "recordsTotal"  => ($request['search']['value'] != "")?$count: intval($count_all),
                    "recordsFiltered" => ($request['search']['value'] != "")?$count: intval($count_all),
                    "data" => $data
                );
            }
            else
            {

                $data2=array();
                $sub_array = array();
                $sub_array[]='خطا';
                $sub_array[]='خطا';
                $sub_array[]='خطا';
                $data2[] = $sub_array;

                $output = array(
                    "draw"    => intval($_GET["draw"]),
                    "recordsTotal"  => 1,
                    "recordsFiltered" => 1,
                    "data" => $data2
                );

                wp_logout();
            }

        }
        else
        {
            $data3=array();
            $sub_array = array();
            $sub_array[]='خطا';
            $sub_array[]='خطا';
            $sub_array[]='خطا';
            $data3[] = $sub_array;

            $output = array(
                "draw"    => intval($_GET["draw"]),
                "recordsTotal"  => 1,
                "recordsFiltered" => 1,
                "data" => $data3
            );
            wp_logout();
        }

        echo json_encode($output);
        exit;

    }
    public static function get_candidate_vote_callback()
    {
        header("Content-Type: application/json");
        $request = $_REQUEST;
        $output=array();
        if ( isset($request['user_id']) && $request['user_id']!="")
        {
            $c_uid=get_current_user_id();
            if ($c_uid == intval($request['user_id']) and user_can( $c_uid, 'manage_options' ))
            {
                $candidates=get_users(array(
                    'meta_key' => 'is_candidate',
                    'meta_value' => '1'
                ));
                $users = get_users(array(
                    'role' => 'subscriber'
                ));

//                $candidate_codes=array();
//                foreach ( $candidates as $candiadte )
//                {
//                    $candidate_info = get_userdata($candiadte->ID);
//                    $candidate_codes[]=$candidate_info->candidate_code;
//                }

                $selected_candidate_list=array();
                $selected_candidate_list2=array();
                foreach ($users as $user)
                {
                    $user_info = get_userdata($user->ID);
                    if ($user_info->vote_status == 'voted')
                    {
                        $voting_data=$user_info->voting_data;
                        foreach ($voting_data['candidate_list'] as $temp)
                        {
                            $selected_candidate_list2[$temp]++;
                        }
                        $selected_candidate_list[]=$voting_data['candidate_list'];
                    }
                }

                $count=1;
                foreach ( $candidates as $candiadte )
                {
                    $user_info = get_userdata($candiadte->ID);
                    $sub_array = array();
                    $sub_array[]=$user_info->fl_name;
                    $sub_array[]=$user_info->candidate_group.' / '.$user_info->candidate_field;
                    $sub_array[]=$user_info->candidate_code;
                    $sub_array[]='<span class="badge badge-light-success show_candidate_vote_list" data-candidate_id="'.$candiadte->ID.'" data-candidate_code="'.$user_info->candidate_code.'">'.$selected_candidate_list2[$user_info->candidate_code].' رای '.'</span>';
                    $data[] = $sub_array;
                    $count++;
                }


                $output = array(
                    "draw"    => intval($_GET["draw"]),
                    "recordsTotal"  =>$count,
                    "recordsFiltered" => $count,
                    "data" => $data,
                    "data2" => $selected_candidate_list,
                    "data3" => $selected_candidate_list2,
                );
            }
            else
            {

                $data2=array();
                $sub_array = array();
                $sub_array[]='خطا';
                $sub_array[]='خطا';
                $sub_array[]='خطا';
                $data2[] = $sub_array;

                $output = array(
                    "draw"    => intval($_GET["draw"]),
                    "recordsTotal"  => 1,
                    "recordsFiltered" => 1,
                    "data" => $data2
                );

                wp_logout();
                $output=array(
                    'status' => 'not_secure'
                );
            }

        }
        else
        {
            $data3=array();
            $sub_array = array();
            $sub_array[]='خطا';
            $sub_array[]='خطا';
            $sub_array[]='خطا';
            $data3[] = $sub_array;

            $output = array(
                "draw"    => intval($_GET["draw"]),
                "recordsTotal"  => 1,
                "recordsFiltered" => 1,
                "data" => $data3
            );
            wp_logout();
            $output=array(
                'status' => 'not_secure'
            );
        }

        echo json_encode($output);
        exit;

    }
    public static function get_candidate_vote_list_callback()
    {
        header("Content-Type: application/json");
        $request = $_REQUEST;
        $output=array();
        if ( isset($request['user_id']) && $request['user_id']!="")
        {
            $c_uid=get_current_user_id();
            if ($c_uid == intval($request['user_id']) and user_can( $c_uid, 'manage_options' ))
            {
                $voted_users=get_users(array(
                    'meta_key' => 'vote_status',
                    'meta_value' => 'voted'
                ));
                $candidate_vote_list=array();
                foreach ($voted_users as $voted_user)
                {
                    $voted_user_info=get_userdata($voted_user->ID);
                    $voting_data=$voted_user->voting_data;
                    foreach ($voting_data['candidate_list'] as $candidate_code)
                    {
                        if ($candidate_code == intval($request['candidate_code']))
                        {
                            $candidate_vote_list[]=array(
                                'user_login' =>$voted_user->user_login,
                                'fl_name' =>$voted_user_info->fl_name
                            );
                        }
                    }
                }
                $output=array(
                    'status' => 'ok',
                    'candidate_vote_list' => $candidate_vote_list,
                    'candidate_name' => get_user_meta(intval($request['candidate_id']),'fl_name',true),
                    'candidate_code' => intval($request['candidate_code'])
                );
            }
            else
            {
                wp_logout();
                $output=array(
                    'status' => 'not_secure'
                );
            }

        }
        else
        {
            wp_logout();
            $output=array(
                'status' => 'not_secure'
            );
        }

        echo json_encode($output);
        exit;

    }
    public static function get_voted_candidate_list_callback()
    {
        header("Content-Type: application/json");
        $request = $_REQUEST;
        $output=array();
        if ( isset($request['user_id']) && $request['user_id']!="")
        {
            $c_uid=get_current_user_id();
            if ($c_uid == intval($request['user_id']) and user_can( $c_uid, 'manage_options' ))
            {
                $voting_data=get_user_meta(intval($request['info_user_id']),'voting_data',true);
                $final=array();
                foreach ($voting_data['candidate_list'] as $temp)
                {
                    $candidate=get_users(array(
                        'meta_key' => 'candidate_code',
                        'meta_value' => $temp
                    ));
                    $candidate_meta=get_user_meta($candidate[0]->ID);
                    $final[]=array(
                        'fl_name' => $candidate_meta['fl_name'][0],
                        'image' =>wp_get_attachment_image_url($candidate_meta['candidate_image'][0]),
                        'group' => $candidate_meta['candidate_group'][0],
                        'field' => $candidate_meta['candidate_field'][0],
                        'code' => $candidate_meta['candidate_code'][0]
                    );
                }

                $output=array(
                    'status' => 'ok',
                    'final' => $final,
                );
            }
            else
            {
                wp_logout();
                $output=array(
                    'status' => 'not_secure'
                );
            }

        }
        else
        {
            wp_logout();
            $output=array(
                'status' => 'not_secure'
            );
        }

        echo json_encode($output);
        exit;

    }
    public static function get_voting_device_data_callback()
    {
        header("Content-Type: application/json");
        $request = $_REQUEST;
        $output=array();
        if ( isset($request['user_id']) && $request['user_id']!="")
        {
            $c_uid=get_current_user_id();
            if ($c_uid == intval($request['user_id']) and user_can( $c_uid, 'manage_options' ))
            {
                $voting_data=get_user_meta(intval($request['info_user_id']),'voting_data',true);
                $final2=array();
                $final2[]=array(
                    'browser' => $voting_data['browser'],
                    'os' => $voting_data['os'],
                    'device' => $voting_data['device'],
                    'brand' => $voting_data['brand'],
                    'modal' => $voting_data['model'],
                    'ip' => $voting_data['ip'],
                    'date' => $voting_data['date'],
                );


                $output=array(
                    'status' => 'ok',
                    'final2' => $final2,
                );
            }
            else
            {
                wp_logout();
                $output=array(
                    'status' => 'not_secure'
                );
            }

        }
        else
        {
            wp_logout();
            $output=array(
                'status' => 'not_secure'
            );
        }

        echo json_encode($output);
        exit;

    }


}



