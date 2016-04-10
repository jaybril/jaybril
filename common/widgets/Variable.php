<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/13
 * Time: 15:38
 */
    namespace common\widgets;
class Variable{

    //session string
    public static $session_userId='session_userId';
    public static $session_userToken='session_userToken';
    public static $session_userType='session_userType';
    public static $session_success='session_success';
    public static $session_error='session_error';
    public static $session_enrollMsg_childId='session_enrollMsg_childId';//报名信息-孩子id
    public static $session_enrollMsg_enrolledId='session_enrollMsg_enrolledId';//报名信息-课程包id
    public static $session_enrollMsg_selectTimes='session_enrollMsg_selectTimes';//报名信息-上课时间
    public static $session_enrollMsg_description='session_enrollMsg_description';//报名信息-备注
    public static $session_enrollMsg_roomId='sessione_enrollMsg_roomId';//报名信息-课室id
    public static $session_enrollMsg_tag='session_enrollMsg_tag';//报名信息-tag

    //cookie string
    public static $cookie_userId='cookie_userId';
    public static $cookie_userToken='cookie_userToken';
    public static $cookie_userType='cookie_userType';
    public static $cookie_enrollMsg_childId='cookie_enrollMsg_childId';//报名信息-孩子id
    public static $cookie_enrollMsg_enrolledId='cookie_enrollMsg_enrolledId';//报名信息-课程包id
    public static $cookie_enrollMsg_selectTimes='cookie_enrollMsg_selectTimes';//报名信息-上课时间
    public static $cookie_enrollMsg_description='cookie_enrollMsg_description';//报名信息-备注
    public static $cookie_enrollMsg_roomId='cookie_enrollMsg_roomId';//报名信息-课室id
    public static $cookie_enrollMsg_tag='cookie_enrollMsg_tag';//报名信息-tag
    public static $cookie_select_city_id='cookie_select_city_id';//选择的城市id
    public static $cookie_select_city_name='cookie_select_city_name';//选择的城市名称
    public static $cookie_super_r='cookie_super_r';//上家推广id
    public static $cookie_enrollSearch_history='cookie_enrollSearch_history';//上家推广id


    //string 0-家长 1-老师 2-房东 3-业务员
    public static $string_userType_parent=0;
    public static $string_userType_teacher=1;
    public static $string_userType_landlord=2;
    public static $string_userType_salesman=3;
    /*年级数组*/
    public static $grader_arr=[
        0=>'一年级',
        1=>'一年级',
        2=>'二年级',
        3=>'三年级'
    ];
    /*支付方式*/
    public static $payWay_arr=[
        '0'=>'余额支付',
        '1'=>'支付宝支付',
        '2'=>'微信支付'
    ];
    /*支付状态*/
    public static $payStatus_arr=[
        '0'=>'已支付',
        '1'=>'未支付',
    ];
    /*订单课程状态*/
    public static $orderCourseStatus_arr=[
        '0'=>'待进行',
        '1'=>'进行中',
        '2'=>'已结束',
        '3'=>'取消',
        '4'=>'失效'
    ];
    /*性别*/
    public static $user_sex_arr=[
        '0'=>'男',
        '1'=>'女',
    ];
    /*角色的用户中心链接*/
    public static $userTypeUrlList=[
        '0'=>'/parent/index',
        '1'=>'/teacher/index',
        '2'=>'/landlord/index',
        '3'=>'/salesman/index',
    ];
}