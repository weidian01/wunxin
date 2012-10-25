<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your CodeIgniter root. Typically this will be your base URL,
| WITH a trailing slash:
|
|	http://example.com/
|
| If this is not set then CodeIgniter will guess the protocol, domain and
| path to your installation.
|
*/
$config['base_url']	= 'http://wunxin.com/';

$config['img_url']	= 'http://wunxin.com/upload/';

$config['static_url']	= 'http://wunxin.com/';

$config['http_expires']	= 7200;

/*
|--------------------------------------------------------------------------
| Index File
|--------------------------------------------------------------------------
|
| Typically this will be your index.php file, unless you've renamed it to
| something else. If you are using mod_rewrite to remove the page set this
| variable so that it is blank.
|
*/
$config['index_page'] = '';

/*
|--------------------------------------------------------------------------
| URI PROTOCOL
|--------------------------------------------------------------------------
|
| This item determines which server global should be used to retrieve the
| URI string.  The default setting of 'AUTO' works for most servers.
| If your links do not seem to work, try one of the other delicious flavors:
|
| 'AUTO'			Default - auto detects
| 'PATH_INFO'		Uses the PATH_INFO
| 'QUERY_STRING'	Uses the QUERY_STRING
| 'REQUEST_URI'		Uses the REQUEST_URI
| 'ORIG_PATH_INFO'	Uses the ORIG_PATH_INFO
|
*/
$config['uri_protocol']	= 'AUTO';

/*
|--------------------------------------------------------------------------
| URL suffix
|--------------------------------------------------------------------------
|
| This option allows you to add a suffix to all URLs generated by CodeIgniter.
| For more information please see the user guide:
|
| http://codeigniter.com/user_guide/general/urls.html
*/

$config['url_suffix'] = '';

/*
|--------------------------------------------------------------------------
| Default Language
|--------------------------------------------------------------------------
|
| This determines which set of language files should be used. Make sure
| there is an available translation if you intend to use something other
| than english.
|
*/
$config['language']	= 'english';

/*
|--------------------------------------------------------------------------
| Default Character Set
|--------------------------------------------------------------------------
|
| This determines which character set is used by default in various methods
| that require a character set to be provided.
|
*/
$config['charset'] = 'UTF-8';

/*
|--------------------------------------------------------------------------
| Enable/Disable System Hooks
|--------------------------------------------------------------------------
|
| If you would like to use the 'hooks' feature you must enable it by
| setting this variable to TRUE (boolean).  See the user guide for details.
|
*/
$config['enable_hooks'] = FALSE;


/*
|--------------------------------------------------------------------------
| Class Extension Prefix
|--------------------------------------------------------------------------
|
| This item allows you to set the filename/classname prefix when extending
| native libraries.  For more information please see the user guide:
|
| http://codeigniter.com/user_guide/general/core_classes.html
| http://codeigniter.com/user_guide/general/creating_libraries.html
|
*/

$config['subclass_prefix'] = 'MY_';


/*
|--------------------------------------------------------------------------
| Allowed URL Characters
|--------------------------------------------------------------------------
|
| This lets you specify with a regular expression which characters are permitted
| within your URLs.  When someone tries to submit a URL with disallowed
| characters they will get a warning message.
|
| As a security measure you are STRONGLY encouraged to restrict URLs to
| as few characters as possible.  By default only these are allowed: a-z 0-9~%.:_-
|
| Leave blank to allow all characters -- but only if you are insane.
|
| DO NOT CHANGE THIS UNLESS YOU FULLY UNDERSTAND THE REPERCUSSIONS!!
|
*/
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-!';


/*
|--------------------------------------------------------------------------
| Enable Query Strings
|--------------------------------------------------------------------------
|
| By default CodeIgniter uses search-engine friendly segment based URLs:
| example.com/who/what/where/
|
| By default CodeIgniter enables access to the $_GET array.  If for some
| reason you would like to disable it, set 'allow_get_array' to FALSE.
|
| You can optionally enable standard query string based URLs:
| example.com?who=me&what=something&where=here
|
| Options are: TRUE or FALSE (boolean)
|
| The other items let you set the query string 'words' that will
| invoke your controllers and its functions:
| example.com/index.php?c=controller&m=function
|
| Please note that some of the helpers won't work as expected when
| this feature is enabled, since CodeIgniter is designed primarily to
| use segment based URLs.
|
*/
$config['allow_get_array']		= TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']	= 'c';
$config['function_trigger']		= 'm';
$config['directory_trigger']	= 'd'; // experimental not currently in use

/*
|--------------------------------------------------------------------------
| Error Logging Threshold
|--------------------------------------------------------------------------
|
| If you have enabled error logging, you can set an error threshold to
| determine what gets logged. Threshold options are:
| You can enable error logging by setting a threshold over zero. The
| threshold determines what gets logged. Threshold options are:
|
|	0 = Disables logging, Error logging TURNED OFF
|	1 = Error Messages (including PHP errors)
|	2 = Debug Messages
|	3 = Informational Messages
|	4 = All Messages
|
| For a live site you'll usually only enable Errors (1) to be logged otherwise
| your log files will fill up very fast.
|
*/
$config['log_threshold'] = 3;

/*
|--------------------------------------------------------------------------
| Error Logging Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/logs/ folder. Use a full server path with trailing slash.
|
*/
$config['log_path'] = '';

/*
|--------------------------------------------------------------------------
| Date Format for Logs
|--------------------------------------------------------------------------
|
| Each item that is logged has an associated date. You can use PHP date
| codes to set your own date formatting
|
*/
$config['log_date_format'] = 'Y-m-d H:i:s';

/*
|--------------------------------------------------------------------------
| Cache Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| system/cache/ folder.  Use a full server path with trailing slash.
|
*/
$config['cache_path'] = APPPATH.'cache/view/';

$config['cache_view'] = array('product@category'=>60); //class@function=>time


/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
|
| If you use the Encryption class or the Session class you
| MUST set an encryption key.  See the user guide for info.
|
*/
$config['encryption_key'] = 'wunxin';

/*
|--------------------------------------------------------------------------
| Session Variables
|--------------------------------------------------------------------------
|
| 'sess_cookie_name'		= the name you want for the cookie
| 'sess_expiration'			= the number of SECONDS you want the session to last.
|   by default sessions last 7200 seconds (two hours).  Set to zero for no expiration.
| 'sess_expire_on_close'	= Whether to cause the session to expire automatically
|   when the browser window is closed
| 'sess_encrypt_cookie'		= Whether to encrypt the cookie
| 'sess_use_database'		= Whether to save the session data to a database
| 'sess_table_name'			= The name of the session database table
| 'sess_match_ip'			= Whether to match the user's IP address when reading the session data
| 'sess_match_useragent'	= Whether to match the User Agent when reading the session data
| 'sess_time_to_update'		= how many seconds between CI refreshing Session Information
|
*/
$config['sess_cookie_name']		= 'ci_session';
$config['sess_expiration']		= 7200;
$config['sess_expire_on_close']	= FALSE;
$config['sess_encrypt_cookie']	= FALSE;
$config['sess_use_database']	= FALSE;
$config['sess_table_name']		= 'ci_sessions';
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update']	= 300;

/*
|--------------------------------------------------------------------------
| Cookie Related Variables
|--------------------------------------------------------------------------
|
| 'cookie_prefix' = Set a prefix if you need to avoid collisions
| 'cookie_domain' = Set to .your-domain.com for site-wide cookies
| 'cookie_path'   =  Typically will be a forward slash
| 'cookie_secure' =  Cookies will only be set if a secure HTTPS connection exists.
|
*/
$config['cookie_prefix']	= "wunxin_";
$config['cookie_domain']	= "wunxin.com";
$config['cookie_path']		= "/";
$config['cookie_secure']	= FALSE;
$config['cookie_cart_expires']	= 1000000;


/*
|--------------------------------------------------------------------------
| Global XSS Filtering
|--------------------------------------------------------------------------
|
| Determines whether the XSS filter is always active when GET, POST or
| COOKIE data is encountered
|
*/
$config['global_xss_filtering'] = TRUE;

/*
|--------------------------------------------------------------------------
| Cross Site Request Forgery
|--------------------------------------------------------------------------
| Enables a CSRF cookie token to be set. When set to TRUE, token will be
| checked on a submitted form. If you are accepting user data, it is strongly
| recommended CSRF protection be enabled.
|
| 'csrf_token_name' = The token name
| 'csrf_cookie_name' = The cookie name
| 'csrf_expire' = The number in seconds the token should expire.
*/
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;

/*
|--------------------------------------------------------------------------
| Output Compression
|--------------------------------------------------------------------------
|
| Enables Gzip output compression for faster page loads.  When enabled,
| the output class will test whether your server supports Gzip.
| Even if it does, however, not all browsers support compression
| so enable only if you are reasonably sure your visitors can handle it.
|
| VERY IMPORTANT:  If you are getting a blank page when compression is enabled it
| means you are prematurely outputting something to your browser. It could
| even be a line of whitespace at the end of one of your scripts.  For
| compression to work, nothing can be sent before the output buffer is called
| by the output class.  Do not 'echo' any values with compression enabled.
|
*/
$config['compress_output'] = FALSE;

/*
|--------------------------------------------------------------------------
| Master Time Reference
|--------------------------------------------------------------------------
|
| Options are 'local' or 'gmt'.  This pref tells the system whether to use
| your server's local time as the master 'now' reference, or convert it to
| GMT.  See the 'date helper' page of the user guide for information
| regarding date handling.
|
*/
$config['time_reference'] = 'local';


/*
|--------------------------------------------------------------------------
| Rewrite PHP Short Tags
|--------------------------------------------------------------------------
|
| If your PHP installation does not have short tag support enabled CI
| can rewrite the tags on-the-fly, enabling you to utilize that syntax
| in your view files.  Options are TRUE or FALSE (boolean)
|
*/
$config['rewrite_short_tags'] = FALSE;


/*
|--------------------------------------------------------------------------
| Reverse Proxy IPs
|--------------------------------------------------------------------------
|
| If your server is behind a reverse proxy, you must whitelist the proxy IP
| addresses from which CodeIgniter should trust the HTTP_X_FORWARDED_FOR
| header in order to properly identify the visitor's IP address.
| Comma-delimited, e.g. '10.0.1.200,10.0.1.201'
|
*/
$config['proxy_ips'] = '';

$config['jobs'] = array(
    '1' => '企业雇主/企业经营者',
    '2' => '高级行政人员(行政总裁、总经理、董事等)',
    '3' => '中层管理人员(总监、经理、主任等)',
    '4' => '专业人士(会计师、律师、工程师、医生、教师等)',
    '5' => '办公职员(一般文职、业务、办事人员等)',
    '6' => '工人/蓝领',
    '7' => '公务员、公共事业单位员工',
    '8' => '自由职业者',
    '9' => '军人',
    '10' => '学生',
    '11' => '退休/无业人员',
    '12' => '家庭主妇',
    '13' => '其他',
);

$config['income'] = array(
    '1' => '2000元以下',
    '2' => '2000～3999元',
    '3' => '4000～5999元',
    '4' => '6000～7999元',
    '5' => '8000～9999元',
    '6' => '10000～15000元',
    '7' => '15000元以上'
);

$config['bodyType'] = array(
    '1' => '偏瘦',
    '2' => '均称',
    '3' => '偏胖',
    '4' => '肥胖'
);

$config['industry'] = array(
    '1' => '政府机关/社会团体',
    '2' => '邮电通讯',
    '3' => 'IT业/互联网',
    '4' => '商业/贸易',
    '5' => '旅游/餐饮/酒店',
    '6' => '银行/金融/证券/保险/投资',
    '7' => '健康/医疗服务',
    '8' => '建筑/房地产',
    '9' => '交通运输/物流仓储',
    '10' => '法律/司法',
    '11' => '文化/娱乐/体育',
    '12' => '媒介/广告/咨询',
    '13' => '教育/科研',
    '14' => '林业/农业/牧业/渔业',
    '15' => '制造业(轻工业)',
    '16' => '制造业(重工业)',
    '17' => '能源/公用事业',
    '18' => '其他',

);

$config['educationLevel'] = array(
    '1' => '高中及以下',
    '2' => '大学专科',
    '3' => '大学本科',
    '4' => '硕士',
    '5' => '博士及以上'
);

$config['maritalStatus'] = array(
    '0' => '保密',
    '1' => '已婚',
    '2' => '未婚',
);

$config['pay_channel'] = array(
    'ICBC-NET-B2C', 'CMBCHINA-NET-B2C', 'BOC-NET-B2C', 'HKBEA-NET-B2C', 'CCB-NET-B2C', 'ABC-NET-B2C', 'GDB-NET-B2C', 'CMBC-NET-B2C', 'CIB-NET-B2C', 'BCCB-NET-B2C', 'BJRCB-NET-B2C',
    'POST-NET-B2C', 'BOCO-NET-B2C', 'SPDB-NET-B2C', 'SDB-NET-B2C', 'CEB-NET-B2C', 'PINGANBANK-NET', 'ECITIC-NET-B2C', 'HZBANK-NET-B2C', 'NBCB-NET-B2C', 'alipay', '1000000-NET', 'ALIPAY'
);

//易宝支付相关信息
$config['yeepay_account'] = 'hjpking@gmail.com';
$config['yeepay_merchant_id'] = '10011840493';
$config['yeepay_merchant_key'] = '254K66x184o3W5ET9jLS3q2bvr41m5tHtJc7P4p967bF0b8xC7S36L7r529X';
$config['yeepay_request_url'] = 'https://www.yeepay.com/app-merchant-proxy/node';

//支付宝支付相关信息
$config['alipay_account'] = 'hjpking@hotmail.com';
$config['alipay_merchant_id'] = '2088002380741030';
$config['alipay_merchant_key'] = 'jarnegpaui4sfpjlzp6h269ph8qjdl6v';
$config['alipay_request_url'] = 'https://mapi.alipay.com/gateway.do?';

$config['pay_back_url'] = $config['base_url'].'pay/payBack/';

//促销活动类型配置
define('PT_DISCOUNT', '1');
define('PT_LIMIT_BUY', '2');
$config['promotion_type'] = array(
    PT_DISCOUNT => '特价热卖',
    PT_LIMIT_BUY => '限时抢购',
);

//促销活动范围配置
define('PR_ALL', '0');
define('PR_PRODUCT', '1');
$config['promotion_range'] = array(
    PR_ALL => '全系统',
    PR_PRODUCT => '特定产品',
);

//促销活动是否并列配置
define('PJ_NO', '0');
define('PJ_YES', '1');
$config['promotion_juxtaposed'] = array(
    PJ_NO => '不并列',
    PJ_YES => '并列',
);

//销售状态配置
define('SS_BERSERK', 1);
define('SS_FREE', 2);
define('SS_HOT', 3);
define('SS_NEW', 4);
$config['sales_status'] = array(
    SS_BERSERK => '疯抢',
    SS_FREE => '包邮',
    SS_HOT => '热卖',
    SS_NEW => '新品',
);

/* End of file config.php */
/* Location: ./application/config/config.php */
