<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*系统全局函数*/

/**
 * 静态资源路径函数
 */
if (! function_exists('static_admin')){
    function static_admin($file='')
    {
        return base_url('/static/admin/'.$file);
    }
}

function admin_site($filename = 'index')
{
    $CI =& get_instance();
    return site_url($CI->uri->segment(1).'/'.$filename);
}

function admin_base($fun='')
{
    $CI =& get_instance();
    return base_url($CI->uri->segment(1).'/'.$fun);
}

/**
 *  utf-8中文截取，单字节截取模式
 *
 * @access    public
 * @param     string  $str  需要截取的字符串
 * @param     int  $slen  截取的长度
 * @param     int  $startdd  开始标记处
 * @return    string
 */
if ( ! function_exists('cn_substr'))
{
    function cn_substr($str, $length, $start=0)
    {
        if(strlen($str) < $start+1)
        {
            return '';
        }
        preg_match_all("/./su", $str, $ar);
        $str = '';
        $tstr = '';

        //为了兼容mysql4.1以下版本,与数据库varchar一致,这里使用按字节截取
        for($i=0; isset($ar[0][$i]); $i++)
        {
            if(strlen($tstr) < $start)
            {
                $tstr .= $ar[0][$i];
            }
            else
            {
                if(strlen($str) < $length + strlen($ar[0][$i]) )
                {
                    $str .= $ar[0][$i];
                }
                else
                {
                    break;
                }
            }
        }
        return $str;
    }
}

/**
 *  将日期转换为时间戳
 *
 * @access    public
 * @param     string  $timestamp  转换的日期 2008-08-08 20:08:00
 * @return    boole
 */
if ( ! function_exists('str_format_time'))
{
	function str_format_time($timestamp = '')
	{   
		if (preg_match("/[0-9]{4}-[0-9]{1,2}-[0-9]{1,2} (0[0-9]|1[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])/i", $timestamp)) 
		{
			list($date,$time)=explode(" ",$timestamp);
			list($year,$month,$day)=explode("-",$date);
	    	list($hour,$minute,$seconds )=explode(":",$time);
	 		$timestamp=mktime($hour,$minute,$seconds,$month,$day,$year);
		}
		else
		{
			$timestamp=time();
		}
		return $timestamp;
	}
}

/**
 *  通用提示消息接口
 *
 * @access    public
 * @param     string  $msg  提示消息的内容
 * @param     string  $url  跳转目的地址 -1返回上一页
 * @param     string  $time  显示时间毫秒数
 * @param     string  $title  消息title
 * @return    boole
 */
function msgShow($msg='提交成功！', $url='-1', $time=2000, $title='操作提示')
{
    $CI =& get_instance();
    $data['msg']=$msg;
    $data['url']=$url;
    $data['time']=$time;
    $data['title']=$title;
    $CI->load->view('msgShow', $data);
}


/**
 *  通用JSON消息函数
 *
 * @access    public
 * @param     string  $msg  提示消息的内容
 * @param     string  $code  操作码
 * @param     string  $time  附加数据
 * @return    json
 */
if( ! function_exists('jsonMsg')){
    function jsonMsg($retMsg='操作成功', $errNum=0, $retData='')
    {
        $array = array(
            'errNum' =>$errNum,
            'retMsg' =>$retMsg,
            'retData'=>$retData
        );
        die(json_encode($array));
    }
}


/*
 * 获取用户IP的函数
 */
function getIp(){
    $onlineip = "";
    if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $onlineip = getenv('HTTP_CLIENT_IP');
    } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $onlineip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $onlineip = getenv('REMOTE_ADDR');
    } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $onlineip = $_SERVER['REMOTE_ADDR'];
    }
    return $onlineip;
}

//目录遍历创建mkdirs('a/b/c',0777); 
function mkdirs($dir,$mode=0777){
    if(is_dir($dir)||@mkdir($dir,$mode)){
        return true;
    }
    if(!mkdirs(dirname($dir),$mode)){
        return false;
    }
    return @mkdir($dir,$mode);
}

function getTypename($tid)
{
    $CI =& get_instance();
    $CI->load->config('global');
    foreach ($CI->config->item('arctype') as $r) {
        if($r['tid']==$tid){
            return $r['typename'];
        }
    }
    return false;
}