drop table if exists wx_activity;

drop table if exists wx_activity_comment;

drop table if exists wx_activity_prize;

drop table if exists wx_admin_user;

drop table if exists wx_advert;

drop table if exists wx_advert_position;

drop table if exists wx_apply_cach_back_log;

drop index Index_parent_id on wx_area;

drop table if exists wx_area;

drop table if exists wx_article;

drop table if exists wx_article_category;

drop index Index_card_no on wx_card;

drop index Index_uid on wx_card;

drop table if exists wx_card;

drop table if exists wx_card_model;

drop table if exists wx_color;

drop index Index_class_id on wx_design;

drop index Index_uid on wx_design;

drop table if exists wx_design;

drop index Index_parent_id on wx_design_category;

drop table if exists wx_design_category;

drop index Index_did on wx_design_comment;

drop table if exists wx_design_comment;

drop table if exists wx_design_comment_reply;

drop index Index_uid on wx_design_favorite;

drop index Index_did on wx_design_favorite;

drop table if exists wx_design_favorite;

drop index Index_did on wx_design_vote;

drop table if exists wx_design_vote;

drop index Index_favorite_uid on wx_designer_favorite;

drop table if exists wx_designer_favorite;

drop table if exists wx_express_delivery_company;

drop table if exists wx_integral_redemption_product;

drop index index_uid on wx_invoice;

drop table if exists wx_invoice;

drop index Index_uid on wx_mail_subscription;

drop table if exists wx_mail_subscription;

drop index Index_uid on wx_order;

drop table if exists wx_order;

drop index Index_order_sn on wx_order_product;

drop table if exists wx_order_product;

drop index Index_order_sn on wx_picking;

drop table if exists wx_picking;

drop index Index_picking_id on wx_picking_product;

drop table if exists wx_picking_product;

drop index Index_sell_price on wx_product;

drop index Index_pname on wx_product;

drop index Index_did on wx_product;

drop index Index_class_id on wx_product;

drop table if exists wx_product;

drop index Index_attr_value on wx_product_attr;

drop index Index_pid on wx_product_attr;

drop table if exists wx_product_attr;

drop index Index_parent_id on wx_product_category;

drop table if exists wx_product_category;

drop index Index_pid on wx_product_collocation;

drop table if exists wx_product_collocation;

drop index Index_uid on wx_product_comment;

drop index Index_pid on wx_product_comment;

drop table if exists wx_product_comment;

drop index Index_uid on wx_product_favorite;

drop index Index_pid on wx_product_favorite;

drop table if exists wx_product_favorite;

drop table if exists wx_product_model;

drop table if exists wx_product_model_attr;

drop table if exists wx_product_photo;

drop index Index_uid on wx_product_qa;

drop index Index_pid on wx_product_qa;

drop table if exists wx_product_qa;

drop index Index_qa_id on wx_product_qa_reply;

drop table if exists wx_product_qa_reply;

drop index Index_comment_id on wx_product_reply;

drop table if exists wx_product_reply;

drop index Index_pid on wx_product_size;

drop table if exists wx_product_size;

drop index Index_uid on wx_receivable;

drop index Index_order_sn on wx_receivable;

drop table if exists wx_receivable;

drop index Index_uname_code on wx_retrieve_password_log;

drop table if exists wx_retrieve_password_log;

drop index Index_order_sn on wx_returns;

drop index Index_uid on wx_returns;

drop table if exists wx_returns;

drop index Index_uid on wx_share;

drop index Index_pid on wx_share;

drop table if exists wx_share;

drop index Index_uid on wx_share_comment;

drop index Index_share_id on wx_share_comment;

drop table if exists wx_share_comment;

drop index Index_share_id on wx_share_images;

drop table if exists wx_share_images;

drop index Index_uid on wx_shopping_cart;

drop index uid_pid_unqiue on wx_shopping_cart;

drop table if exists wx_shopping_cart;

drop table if exists wx_size;

drop table if exists wx_system_proposal;

drop index Index_tuan_id on wx_tuan_comment;

drop table if exists wx_tuan_comment;

drop table if exists wx_tuan_product;

drop index index_uname on wx_user;

drop table if exists wx_user;

drop index Index_create_time on wx_user_consume_log;

drop index index_uid on wx_user_consume_log;

drop table if exists wx_user_consume_log;

drop index uid_unique on wx_user_info;

drop table if exists wx_user_info;

drop index Index_create_time on wx_user_integral_log;

drop index Index_uid on wx_user_integral_log;

drop table if exists wx_user_integral_log;

drop table if exists wx_user_level;

drop index index_uid on wx_user_login_log;

drop table if exists wx_user_login_log;

drop index Index_designer_id on wx_user_message;

drop index Index_uid on wx_user_message;

drop table if exists wx_user_message;

drop index Index_message_id on wx_user_message_reply;

drop table if exists wx_user_message_reply;

drop index Index_uid on wx_user_recipient_address;

drop table if exists wx_user_recipient_address;

drop index Index_create_time on wx_user_up_level_log;

drop index Index_uid on wx_user_up_level_log;

drop table if exists wx_user_up_level_log;

/*==============================================================*/
/* Table: wx_activity                                           */
/*==============================================================*/
create table wx_activity
(
   activity_id          int unsigned not null auto_increment comment '活动ID',
   subject              varchar(128) comment '活动主题',
   start_time           datetime comment '开始时间',
   end_time             datetime comment '结束时间',
   descr                varchar(128) comment '活动介绍',
   event_initiator      tinyint unsigned comment '活动发起方，1系统，2用户，3企业，4其他',
   initiator_name       varchar(128) comment '发起方名称',
   initiator_desc       text comment '发起方介绍',
   specification        text comment '活动规范',
   create_time          datetime comment '创建时间',
   primary key (activity_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_activity comment '活动表';

/*==============================================================*/
/* Table: wx_activity_comment                                   */
/*==============================================================*/
create table wx_activity_comment
(
   id                   int unsigned not null auto_increment comment '自增ID',
   activity_id          int unsigned comment '活动ID',
   uid                  int unsigned comment '用户ID',
   title                varchar(32) comment '评论标题',
   content              varchar(255) comment '评论内容',
   ip                   char(16) comment 'IP地址',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_activity_comment comment '活动评论表';

/*==============================================================*/
/* Table: wx_activity_prize                                     */
/*==============================================================*/
create table wx_activity_prize
(
   id                   int unsigned not null auto_increment comment '自增ID',
   activity_id          int unsigned comment '活动ID',
   prize_name           varchar(64) comment '奖品名称',
   img_addr             varchar(128) comment '图片地址',
   number               smallint unsigned comment '数量',
   descr                varchar(128) comment '奖品说明',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_activity_prize comment '活动奖品设置';

/*==============================================================*/
/* Table: wx_admin_user                                         */
/*==============================================================*/
create table wx_admin_user
(
   am_uid               int comment '用户ID',
   am_uname             varchar(32) comment '用户名称',
   password             char(32) comment '用户密码',
   ip                   char(16) comment '最后登陆IP',
   last_login_time      datetime comment '最后登陆时间',
   status               tinyint comment '用户状态,0已禁用，1正常',
   contact              char(12) comment '联系电话'
)
engine = MYISAM
auto_increment = 1;

alter table wx_admin_user comment '后台用户表';

INSERT INTO `wx_admin_user` SET `am_uid`=1,`am_uname`='hjpking',`password`='25f2261cd6924d96df4bf75227f3d5fa',`ip`='127.0.01',`last_login_time`='2012-06-02 16:20:00',`status`=1,`contact`='15101559313';

/*==============================================================*/
/* Table: wx_advert                                             */
/*==============================================================*/
create table wx_advert
(
   ad_id                int unsigned not null auto_increment comment '广告ID',
   position_id          int unsigned comment '位置ID',
   ad_name              int comment '广告名称',
   ad_type              tinyint unsigned comment '广告类型，1:图片 2:flash 3:代码 4:文字',
   ad_content           int comment '广告内容',
   click_num            int unsigned comment '点击数量',
   status               tinyint unsigned comment '状态,0不显示，1显示',
   ad_link              int comment '广告链接',
   sort                 smallint unsigned comment '广告排序',
   descr                varchar(128) comment '广告描述',
   start_time           datetime comment '开始时间',
   end_time             datetime comment '结束时间',
   create_time          datetime comment '创建时间',
   primary key (ad_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_advert comment '广告';

/*==============================================================*/
/* Table: wx_advert_position                                    */
/*==============================================================*/
create table wx_advert_position
(
   position_id          int unsigned not null auto_increment comment '位置ID',
   name                 varchar(32) comment '位置名称',
   width                int unsigned comment '宽度',
   height               int unsigned comment '高度',
   status               tinyint unsigned comment '状态，0不显示，1显示',
   view_num             tinyint unsigned comment '显示数量',
   descr                varchar(128) comment '描述',
   create_time          datetime comment '创建时间',
   primary key (position_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_advert_position comment '广告位置表';

/*==============================================================*/
/* Table: wx_apply_cach_back_log                                */
/*==============================================================*/
create table wx_apply_cach_back_log
(
   acb_id               int unsigned not null auto_increment comment '返现记录ID',
   uid                  int unsigned comment '用户ID',
   uname                varchar(32) comment '用户名称',
   amount               int unsigned comment '金额,单位为分',
   descr                varchar(128) comment '描述',
   ip                   char(16) comment 'IP地址',
   status               tinyint unsigned comment '状态,0提交申请，1已打款，2取消',
   create_time          datetime comment '创建时间',
   primary key (acb_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_apply_cach_back_log comment '申请返现记录';

/*==============================================================*/
/* Table: wx_area                                               */
/*==============================================================*/
create table wx_area
(
   area_id              int unsigned not null auto_increment comment '地区ID',
   parent_id            int unsigned comment '地区父ID',
   area_name            varchar(50) comment '地区名称',
   sort                 smallint unsigned comment '排序',
   primary key (area_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_area comment '地区信息表';

/*==============================================================*/
/* Index: Index_parent_id                                       */
/*==============================================================*/
create index Index_parent_id on wx_area
(
   parent_id
);

/*==============================================================*/
/* Table: wx_article                                            */
/*==============================================================*/
create table wx_article
(
   id                   int unsigned not null auto_increment comment '文章ID',
   cid                  int unsigned comment '分类',
   title                varchar(32) comment '文章标题',
   content              text comment '内容',
   keywords             varchar(128) comment '关键字',
   descr                varchar(128) comment '描述',
   visiblity            tinyint unsigned comment '是否显示,0不显示，1显示',
   top                  tinyint unsigned comment '置顶，0不置顶，1置顶',
   sort                 smallint comment '排序',
   is_valid             int unsigned comment '是否有效',
   is_invalid           int unsigned comment '是否无效',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_article comment '文章表';

/*==============================================================*/
/* Table: wx_article_category                                   */
/*==============================================================*/
create table wx_article_category
(
   cid                  int unsigned not null auto_increment comment '分类ID',
   cname                varchar(64) comment '名称',
   parent_id            int unsigned comment '父类ID',
   sort                 smallint unsigned comment '排序',
   path                 varchar(64) comment '路径',
   create_time          datetime comment '创建时间',
   primary key (cid)
)
engine = MYISAM
auto_increment = 1;

alter table wx_article_category comment '文章分类表';

/*==============================================================*/
/* Table: wx_card                                               */
/*==============================================================*/
create table wx_card
(
   id                   int unsigned not null auto_increment comment '自增ID',
   card_no              char(20) comment '卡号',
   model_id             int comment '模型id',
   card_amount          int unsigned comment '卡金额,单位为分',
   card_pass            char(8) comment '卡密码',
   start_time           datetime comment '开始时间',
   end_time             datetime comment '截止时间',
   integral             int unsigned comment '兑换积分',
   uid                  int unsigned comment '用户id',
   uname                varchar(32) comment '用户名称',
   use_num              tinyint unsigned default 0 comment '使用次数',
   status               tinyint default 1 comment '状态 0删除  1初始 2已绑定',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_card comment '代金卷/礼品卡';

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_card
(
   uid
);

/*==============================================================*/
/* Index: Index_card_no                                         */
/*==============================================================*/
create unique index Index_card_no on wx_card
(
   card_no
);

/*==============================================================*/
/* Table: wx_card_model                                         */
/*==============================================================*/
create table wx_card_model
(
   model_id             int unsigned not null auto_increment comment '模型id',
   card_name            varchar(32) comment '卡名称',
   card_type            tinyint unsigned comment '卡类型,1礼物卡，2代金卷，3返现卡',
   card_amount          int unsigned comment '卡金额',
   card_num             int unsigned comment '卡数量',
   create_time          datetime comment '创建时间',
   primary key (model_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_card_model comment '卡模型表';

/*==============================================================*/
/* Table: wx_color                                              */
/*==============================================================*/
create table wx_color
(
   color_id             int unsigned not null auto_increment comment '颜色ID',
   china_name           varchar(16) comment '颜色中文名',
   english_name         varchar(16) comment '颜色英文名',
   code                 char(6) comment '颜色代码',
   descr                varchar(128) comment '颜色描述',
   primary key (color_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_color comment '颜色表';

/*==============================================================*/
/* Table: wx_design                                             */
/*==============================================================*/
create table wx_design
(
   did                  int unsigned not null auto_increment comment '设计图ID',
   class_id             int unsigned comment '设计图分类',
   uid                  int comment '用户ID',
   dname                varchar(16) comment '设计图名称',
   ddetail              varchar(32) comment '设计图介绍',
   design_img           varchar(128) comment '设计图片',
   design_source        tinyint unsigned default 1 comment '设计图来源,1系统，2活动，3用户，4其他',
   source_expand        char(10) comment '来源扩展字段,可存活动ID，其他一些标识性信息',
   status               tinyint unsigned comment '状态，0未激活，1正常',
   vote_end_time        datetime comment '投票结束时间',
   total_num            int unsigned comment '总投票人数',
   total_fraction       int unsigned comment '总分数',
   create_time          datetime comment '创建时间',
   primary key (did)
)
engine = MYISAM
auto_increment = 1;

alter table wx_design comment '设计图';

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_design
(
   uid
);

/*==============================================================*/
/* Index: Index_class_id                                        */
/*==============================================================*/
create index Index_class_id on wx_design
(
   class_id
);

/*==============================================================*/
/* Table: wx_design_category                                    */
/*==============================================================*/
create table wx_design_category
(
   class_id             int unsigned not null auto_increment comment '分类ID',
   cname                varchar(64) comment '分类名称',
   parent_id            int unsigned comment '分类父ID',
   sort                 smallint unsigned comment '排序',
   keywords             varchar(128) comment '关键字',
   descr                varchar(128) comment '描述',
   title                varchar(32) comment '标题',
   create_time          datetime comment '创建时间',
   primary key (class_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_design_category comment '设计图分类表';

/*==============================================================*/
/* Index: Index_parent_id                                       */
/*==============================================================*/
create index Index_parent_id on wx_design_category
(
   parent_id
);

/*==============================================================*/
/* Table: wx_design_comment                                     */
/*==============================================================*/
create table wx_design_comment
(
   comment_id           int unsigned not null auto_increment comment '设计图评论ID',
   did                  int unsigned comment '设计图ID',
   uid                  int unsigned comment '用户ID',
   uname                varchar(32) comment '用户名称',
   title                varchar(32) comment '评论标题',
   content              varchar(255) comment '评论内容',
   ip                   char(16) comment 'IP地址',
   reply_num            int comment '评论回复数量',
   create_time          datetime comment '创建时间',
   primary key (comment_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_design_comment comment '设计图评论表';

/*==============================================================*/
/* Index: Index_did                                             */
/*==============================================================*/
create index Index_did on wx_design_comment
(
   did
);

/*==============================================================*/
/* Table: wx_design_comment_reply                               */
/*==============================================================*/
create table wx_design_comment_reply
(
   id                   int unsigned not null auto_increment comment '自增ID',
   comment_id           int unsigned comment '评论ID',
   uid                  int unsigned comment '用户ID',
   uname                varchar(32) comment '用户名称',
   content              varchar(255) comment '内容',
   ip                   char(16) comment 'IP地址',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_design_comment_reply comment '设计师评论回复表';

/*==============================================================*/
/* Table: wx_design_favorite                                    */
/*==============================================================*/
create table wx_design_favorite
(
   id                   int unsigned not null auto_increment comment '自增ID',
   did                  int unsigned comment '设计图ID',
   uid                  int unsigned comment '用户ID',
   uname                varchar(32) comment '用户名称',
   ip                   char(16) comment '收藏IP地址',
   create_time          datetime comment '收藏时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_design_favorite comment '设计图收藏表';

/*==============================================================*/
/* Index: Index_did                                             */
/*==============================================================*/
create index Index_did on wx_design_favorite
(
   did
);

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_design_favorite
(
   uid
);

/*==============================================================*/
/* Table: wx_design_vote                                        */
/*==============================================================*/
create table wx_design_vote
(
   score_id             int unsigned not null auto_increment comment '投票ID',
   uid                  int comment '用户ID',
   uname                varchar(32) comment '用户名称',
   did                  int unsigned comment '设计图ID',
   score                tinyint unsigned comment '评分1,不喜欢，2需要改进，3一般，4喜欢，5非常喜欢',
   ip                   char(16) comment 'IP地址',
   create_time          datetime comment '创建时间',
   primary key (score_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_design_vote comment '设计图投票表';

/*==============================================================*/
/* Index: Index_did                                             */
/*==============================================================*/
create index Index_did on wx_design_vote
(
   did
);

/*==============================================================*/
/* Table: wx_designer_favorite                                  */
/*==============================================================*/
create table wx_designer_favorite
(
   designer_favorite_id int unsigned not null auto_increment comment '用户收藏ID',
   uid                  int unsigned comment '用户ID',
   favorite_uid         int unsigned comment '被收藏用户ID',
   favorite_uname       varchar(32) comment '被收藏用户名称',
   ip                   char(16) comment '收藏IP',
   create_time          datetime comment '收藏时间',
   primary key (designer_favorite_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_designer_favorite comment '设计师收藏表';

/*==============================================================*/
/* Index: Index_favorite_uid                                    */
/*==============================================================*/
create index Index_favorite_uid on wx_designer_favorite
(
   favorite_uid
);

/*==============================================================*/
/* Table: wx_express_delivery_company                           */
/*==============================================================*/
create table wx_express_delivery_company
(
   ed_id                int unsigned not null auto_increment comment '自增ID',
   name                 varchar(32) comment '快递名称',
   descr                varchar(128) comment '快递描述',
   website              varchar(64) comment '网址',
   sort                 smallint unsigned comment '排序',
   status               tinyint unsigned comment '状态,0删除，1正常',
   create_time          datetime comment '创建时间',
   primary key (ed_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_express_delivery_company comment '快递企业表';

/*==============================================================*/
/* Table: wx_integral_redemption_product                        */
/*==============================================================*/
create table wx_integral_redemption_product
(
   redemption_id        int unsigned not null auto_increment comment '换购ID',
   pid                  int unsigned comment '产品ID',
   redemption_integral  int unsigned comment '换购积分',
   price                int unsigned comment '产品价格',
   redemption_price     int unsigned comment '换购价格',
   start_time           datetime comment '开始时间',
   end_time             datetime comment '结束时间',
   create_time          datetime comment '创建时间',
   primary key (redemption_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_integral_redemption_product comment '积分换购表积分换购产品表';

/*==============================================================*/
/* Table: wx_invoice                                            */
/*==============================================================*/
create table wx_invoice
(
   invoice_id           int unsigned not null auto_increment comment '发票ID',
   uid                  int unsigned comment '用户ID',
   invoice_payable      varchar(64) comment '发票抬头',
   invoice_content      varchar(16) default '1' comment '发票内容，1服装，2其他,3用户写入内容',
   `default`            tinyint default 1 comment '默认发票,0否，1是',
   create_time          datetime comment '创建时间',
   primary key (invoice_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_invoice comment '发票';

INSERT INTO `wx_invoice` (`invoice_id`,`uid`,`invoice_payable`,`invoice_content`,`create_time`) VALUES (1,1,'北京市万象乾鑫商贸有限公司','1','2012-06-01 21:45:01');
INSERT INTO `wx_invoice` (`invoice_id`,`uid`,`invoice_payable`,`invoice_content`,`create_time`) VALUES (2,1,'北京市万象乾鑫科技有限公司','1','2012-06-01 21:45:39');

/*==============================================================*/
/* Index: index_uid                                             */
/*==============================================================*/
create index index_uid on wx_invoice
(
   uid
);

/*==============================================================*/
/* Table: wx_mail_subscription                                  */
/*==============================================================*/
create table wx_mail_subscription
(
   id                   int unsigned not null auto_increment comment '自增ID',
   uid                  int unsigned comment '用户ID',
   email_addr           varchar(16) comment '邮件地址',
   get_info_type        tinyint unsigned comment '需要得到那类信息,1特价优惠,2时尚搭配,3新品咨询',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_mail_subscription comment '邮件列表订阅表';

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create unique index Index_uid on wx_mail_subscription
(
   uid
);

/*==============================================================*/
/* Table: wx_order                                              */
/*==============================================================*/
create table wx_order
(
   order_sn             int unsigned not null auto_increment comment '订单ID',
   address_id           int unsigned comment '收货地址',
   uid                  int comment '用户ID',
   uname                varchar(32) comment '用户名称',
   after_discount_price int unsigned comment '打折后金额',
   discount_rate        int unsigned comment '折扣率',
   before_discount_price int unsigned comment '打折前金额',
   pay_type             tinyint unsigned default 1 comment '付款类型，1，线上支付，2货到付款，3邮局汇款，4来万象自提，5公司转账',
   defray_type          char(8) default '0' comment '支付方式，存储银行代码(简码)',
   is_pay               tinyint unsigned default 0 comment '是否付款，0初始，1付款成功，2付款失败，3等待付款(只支付一部分金额)',
   order_source         tinyint unsigned default 1 comment '订单来源,1正常产品，2团购产品，3积分换购',
   pay_time             datetime comment '付款时间',
   delivert_time        tinyint default 1 comment '送货时间,1工作日、双休日与假日均可送货，2只双休日、假日送货，3只工作日送货，4学校地址、白天没有。',
   annotated            varchar(128) comment '附加说明',
   invoice              tinyint unsigned default 0 comment '是否需要发票,0不需要，1需要',
   paid                 int comment '已付款，用户已支付多少',
   need_pay             int comment '需要支付款',
   ip                   char(16) comment 'IP地址',
   invoice_payable      varchar(64) comment '发票抬头',
   invoice_content      varchar(16) default '1' comment '发票内容，1服装，2其他,3用户写入内容',
   recent_name          varchar(16) comment '收货人',
   recent_address       varchar(128) comment '收货地址',
   zipcode              char(7) comment '邮编',
   phone_num            char(11) comment '手机号码',
   call_num             char(11) comment '座机',
   create_time          datetime comment '创建时间',
   primary key (order_sn)
)
engine = MYISAM
auto_increment = 1;

alter table wx_order comment '订单表';

INSERT INTO `wx_order` (`order_sn`,`address_id`,`uid`,`uname`,`after_discount_price`,`discount_rate`,`before_discount_price`,`pay_type`,`defray_type`,`is_pay`,`order_source`,`pay_time`,`delivert_time`,`annotated`,`invoice`,`paid`,`need_pay`,`ip`,`create_time`) VALUES (1,1,1,'hjpking@gmail.com',10,10,10,1,'0',0,1,'2012-06-01 19:16:15',1,'麻烦快点发货',0,10,0,'127.0.0.01','2012-06-01 19:16:15');

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_order
(
   uid
);

/*==============================================================*/
/* Table: wx_order_product                                      */
/*==============================================================*/
create table wx_order_product
(
   id                   int not null auto_increment comment '自增ID',
   order_sn             int comment '订单ID',
   pid                  int comment '产品ID',
   uid                  int comment '用户ID',
   uname                varchar(32) comment '用户名称',
   pname                varchar(120) comment '产品名称',
   market_price         int comment '市场价格',
   sall_price           int comment '销售价格',
   product_num          int comment '产品数量',
   comment_status       tinyint default 0 comment '是否评论，0未评论，1已评论',
   share_status         tinyint default 0 comment '是否晒单，0未晒单，1已晒单',
   product_size         int comment '产品尺码ID',
   presentation_integral int comment '赠送积分',
   preferential         int comment '优惠,人民币，单位为分',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_order_product comment '订单产品';

INSERT INTO `wx_order_product` (`id`,`order_sn`,`pid`,`uid`,`uname`,`pname`,`market_price`,`sall_price`,`product_num`,`create_time`,`comment_status`,`share_status`,`product_size`,`presentation_integral`,`preferential`) VALUES (1,1,1,1,'hjpking@gmail.com','潮人必备个性T恤-红色',10,10,10,'2012-06-01 19:16:15',1,1,1,10,0);
INSERT INTO `wx_order_product` (`id`,`order_sn`,`pid`,`uid`,`uname`,`pname`,`market_price`,`sall_price`,`product_num`,`create_time`,`comment_status`,`share_status`,`product_size`,`presentation_integral`,`preferential`) VALUES (2,1,2,1,'hjpking@gmail.com','潮人必备个性T恤-白色',10,10,10,'2012-06-01 19:16:15',1,1,1,10,0);

/*==============================================================*/
/* Index: Index_order_sn                                        */
/*==============================================================*/
create index Index_order_sn on wx_order_product
(
   order_sn
);

/*==============================================================*/
/* Table: wx_picking                                            */
/*==============================================================*/
create table wx_picking
(
   picking_id           int unsigned not null auto_increment comment '配货ID',
   order_sn             int unsigned comment '订单ID',
   ed_id                int unsigned comment '配送方式，顺风，申通，圆通',
   address_id           int unsigned comment '地址ID',
   logistics_orders_sn  char(32) comment '物流订单号',
   uid                  int unsigned comment '管理员ID',
   descr                varchar(128) comment '管理员备注',
   freight              int unsigned comment '运费,单位为分',
   create_time          datetime comment '创建时间',
   primary key (picking_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_picking comment '配货表';

/*==============================================================*/
/* Index: Index_order_sn                                        */
/*==============================================================*/
create index Index_order_sn on wx_picking
(
   order_sn
);

/*==============================================================*/
/* Table: wx_picking_product                                    */
/*==============================================================*/
create table wx_picking_product
(
   id                   int unsigned not null auto_increment comment '自增ID',
   pid                  int unsigned comment '产品ID',
   picking_id           int unsigned comment '配货ID',
   product_num          int unsigned comment '产品数量',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_picking_product comment '配货产品表';

/*==============================================================*/
/* Index: Index_picking_id                                      */
/*==============================================================*/
create index Index_picking_id on wx_picking_product
(
   picking_id
);

/*==============================================================*/
/* Table: wx_product                                            */
/*==============================================================*/
create table wx_product
(
   pid                  int unsigned not null auto_increment comment '产品ID',
   did                  int unsigned comment '设计图ID',
   class_id             int unsigned comment '分类ID',
   color_id             int unsigned comment '颜色ID',
   uid                  int comment '用户ID',
   model_id             int comment '模型id',
   uname                varchar(32) comment '用户名称',
   pname                varchar(120) comment '产品名称',
   market_price         int unsigned comment '市场价格，单位为分',
   sell_price           int unsigned comment '销售价格，单位为分',
   style_no             char(32) comment '用于统一同一款式不同颜色的衣服',
   stock                int unsigned comment '库存数量',
   product_taobao_addr  varchar(255) comment '产品淘宝地址',
   descr                varchar(128) comment '产品描述',
   pcontent             text comment '产品内容',
   source               tinyint unsigned default 1 comment '产品来源,1系统，2活动，3用户，4其他',
   expand               char(10) comment '来源扩展字段,可存活动ID，其他一些标识性信息',
   gender               tinyint unsigned comment '产品属性，0中性，1男，2女，3 男童，4女童',
   status               tinyint unsigned comment '状态,0已删除，1正常',
   check_status         tinyint unsigned comment '审核，0未通过，1已通过',
   shelves              tinyint unsigned comment '上架，0下架，1上架',
   cost_price           int unsigned comment '成本价格，单位为分',
   create_time          datetime comment '创建时间',
   primary key (pid)
)
engine = MYISAM
auto_increment = 1;

alter table wx_product comment '产品表';

INSERT INTO `wx_product` VALUES (1,1,1,1,1,1,'hjpking@gmail.com','潮人必备',10,10,'1111',10,NULL,'testtest','fdssdsggregergdf',1,'a',1,1,1,1,1,'2012-06-07 13:58:23');

/*==============================================================*/
/* Index: Index_class_id                                        */
/*==============================================================*/
create index Index_class_id on wx_product
(
   class_id
);

/*==============================================================*/
/* Index: Index_did                                             */
/*==============================================================*/
create index Index_did on wx_product
(
   did
);

/*==============================================================*/
/* Index: Index_pname                                           */
/*==============================================================*/
create index Index_pname on wx_product
(
   pname
);

/*==============================================================*/
/* Index: Index_sell_price                                      */
/*==============================================================*/
create index Index_sell_price on wx_product
(
   sell_price
);

/*==============================================================*/
/* Table: wx_product_attr                                       */
/*==============================================================*/
create table wx_product_attr
(
   id                   int unsigned not null auto_increment comment '自增ID',
   pid                  int unsigned comment '产品id',
   attr_id              int unsigned comment '属性id',
   model_id             int unsigned comment '模型id',
   attr_value           char(32) comment '属性值',
   sort                 smallint unsigned comment '排序',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_product_attr comment '产品属性表';

/*==============================================================*/
/* Index: Index_pid                                             */
/*==============================================================*/
create index Index_pid on wx_product_attr
(
   pid
);

/*==============================================================*/
/* Index: Index_attr_value                                      */
/*==============================================================*/
create index Index_attr_value on wx_product_attr
(
   attr_value
);

/*==============================================================*/
/* Table: wx_product_category                                   */
/*==============================================================*/
create table wx_product_category
(
   class_id             int unsigned not null auto_increment comment '分类ID',
   cname                varchar(64) comment '分类名称',
   parent_id            int unsigned comment '分类父ID',
   sort                 smallint comment '排序',
   keywords             varchar(128) comment '关键字',
   descr                varchar(128) comment '描述',
   title                varchar(32) comment '标题',
   create_time          datetime comment '创建时间',
   primary key (class_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_product_category comment '产品分类表';

/*==============================================================*/
/* Index: Index_parent_id                                       */
/*==============================================================*/
create index Index_parent_id on wx_product_category
(
   parent_id
);

/*==============================================================*/
/* Table: wx_product_collocation                                */
/*==============================================================*/
create table wx_product_collocation
(
   id                   int unsigned not null auto_increment comment '自增ID',
   pid                  int unsigned comment '主产品ID',
   spid                 int unsigned comment '搭配产品ID',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_product_collocation comment '产品搭配表';

/*==============================================================*/
/* Index: Index_pid                                             */
/*==============================================================*/
create index Index_pid on wx_product_collocation
(
   pid
);

/*==============================================================*/
/* Table: wx_product_comment                                    */
/*==============================================================*/
create table wx_product_comment
(
   comment_id           int unsigned not null auto_increment comment '评论ID',
   pid                  int unsigned comment '产品ID',
   uid                  int unsigned comment '用户ID',
   uname                varchar(32) comment '用户名称',
   title                varchar(60) comment '评论标题',
   content              varchar(128) comment '评论内容',
   ip                   char(16) comment '评论IP地址',
   rank                 tinyint unsigned comment '评价等级',
   is_valid             int unsigned default 0 comment '是否有效',
   is_invalid           int unsigned default 0 comment '是否无效',
   reply_num            smallint unsigned default 0 comment '回复数量',
   create_time          datetime comment '评论时间',
   primary key (comment_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_product_comment comment '产品评论表';

/*==============================================================*/
/* Index: Index_pid                                             */
/*==============================================================*/
create index Index_pid on wx_product_comment
(
   pid
);

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_product_comment
(
   uid
);

/*==============================================================*/
/* Table: wx_product_favorite                                   */
/*==============================================================*/
create table wx_product_favorite
(
   id                   int unsigned not null auto_increment comment '收藏ID',
   pid                  int unsigned comment '产品ID',
   uid                  int unsigned comment '用户ID',
   ip                   char(16) comment '收藏IP地址',
   create_time          datetime comment '收藏时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_product_favorite comment '产品收藏表';

/*==============================================================*/
/* Index: Index_pid                                             */
/*==============================================================*/
create index Index_pid on wx_product_favorite
(
   pid
);

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_product_favorite
(
   uid
);

/*==============================================================*/
/* Table: wx_product_model                                      */
/*==============================================================*/
create table wx_product_model
(
   model_id             int unsigned not null auto_increment comment '模型id',
   model_name           varchar(32) comment '模型名称',
   primary key (model_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_product_model comment '产品模型表';

/*==============================================================*/
/* Table: wx_product_model_attr                                 */
/*==============================================================*/
create table wx_product_model_attr
(
   attr_id              int unsigned not null auto_increment comment '属性id',
   model_id             int unsigned comment '模型id',
   attr_name            varchar(32) comment '属性名称',
   attr_value           varchar(255) comment '属性值',
   sort                 smallint unsigned comment '排序',
   type                 tinyint unsigned comment '类型，1单选，2复选，3下拉，4文本',
   primary key (attr_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_product_model_attr comment '产品模型属性表';

/*==============================================================*/
/* Table: wx_product_photo                                      */
/*==============================================================*/
create table wx_product_photo
(
   id                   int unsigned not null auto_increment comment '自增ID',
   pid                  int unsigned comment '产品ID',
   img_addr             varchar(128) comment '图片地址',
   is_default           tinyint unsigned comment '0否，1是',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_product_photo comment '产品图片表';

INSERT INTO `wx_product_photo` VALUES (1,1,'sd/dssd/sdsd/a.jpg',1,'2012-06-07 14:31:20');
INSERT INTO `wx_product_photo` VALUES (2,1,'sd/dssd/sdsd/a.jpg',0,'2012-06-07 14:31:20');

/*==============================================================*/
/* Table: wx_product_qa                                         */
/*==============================================================*/
create table wx_product_qa
(
   qa_id                int unsigned not null auto_increment comment '问答ID',
   pid                  int unsigned comment '产品ID',
   uid                  int unsigned comment '用户ID',
   uname                varchar(32) comment '用户名称',
   qa_title             varchar(32) comment '问题标题',
   qa_content           varchar(255) comment '问题内容',
   reply_content        varchar(255) comment '回答内容',
   ip                   char(16) comment '提问IP地址',
   reply_time           datetime comment '回复时间',
   is_reply             tinyint unsigned comment '是否回复',
   is_valid             int unsigned comment '是否有效',
   is_invalid           int unsigned comment '是否无效',
   reply_num            smallint unsigned comment '回复数量',
   create_time          datetime comment '提问时间',
   primary key (qa_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_product_qa comment '产品疑难问答';

/*==============================================================*/
/* Index: Index_pid                                             */
/*==============================================================*/
create index Index_pid on wx_product_qa
(
   pid
);

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_product_qa
(
   uid
);

/*==============================================================*/
/* Table: wx_product_qa_reply                                   */
/*==============================================================*/
create table wx_product_qa_reply
(
   id                   int unsigned not null auto_increment comment '自增ID',
   qa_id                int unsigned comment '问答ID',
   uid                  int unsigned comment '用户ID',
   uname                varchar(32) comment '用户名称',
   ip                   char(16) comment '回复IP地址',
   reply_content        varchar(255) comment '回复内容',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_product_qa_reply comment '产品疑难问答回复';

/*==============================================================*/
/* Index: Index_qa_id                                           */
/*==============================================================*/
create index Index_qa_id on wx_product_qa_reply
(
   qa_id
);

/*==============================================================*/
/* Table: wx_product_reply                                      */
/*==============================================================*/
create table wx_product_reply
(
   id                   int unsigned not null auto_increment comment '自增ID',
   comment_id           int unsigned comment '评论ID',
   uid                  int unsigned comment '用户ID',
   uname                varchar(32) comment '用户名称',
   ip                   char(16) comment '回复IP地址',
   reply_content        varchar(255) comment '回复内容',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_product_reply comment '产品评论回复表';

/*==============================================================*/
/* Index: Index_comment_id                                      */
/*==============================================================*/
create index Index_comment_id on wx_product_reply
(
   comment_id
);

/*==============================================================*/
/* Table: wx_product_size                                       */
/*==============================================================*/
create table wx_product_size
(
   id                   int unsigned not null auto_increment comment '自增ID',
   pid                  int unsigned comment '产品ID',
   size_id              int unsigned not null comment '尺码ID',
   abbreviation         char(6) comment '尺码简称',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_product_size comment '产品尺码表';

/*==============================================================*/
/* Index: Index_pid                                             */
/*==============================================================*/
create index Index_pid on wx_product_size
(
   pid
);

/*==============================================================*/
/* Table: wx_receivable                                         */
/*==============================================================*/
create table wx_receivable
(
   receiver_id          int unsigned not null auto_increment comment '收款单ID',
   order_sn             int unsigned comment '订单号',
   uid                  int unsigned comment '用户ID',
   uname                varchar(32) comment '用户名称',
   amount               int unsigned comment '金额,单位为分',
   pay_time             datetime comment '汇款时间',
   pay_type             tinyint unsigned comment '汇款类型，1银行汇款，2支付宝转账',
   pay_account          varchar(20) comment '收款账户',
   pay_status           tinyint unsigned comment '支付状态,0未支付，1支付成功',
   descr                varchar(128) comment '收款备注',
   manager_id           int unsigned comment '管理员ID',
   create_time          datetime comment '创建时间',
   primary key (receiver_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_receivable comment '收款单表';

/*==============================================================*/
/* Index: Index_order_sn                                        */
/*==============================================================*/
create index Index_order_sn on wx_receivable
(
   order_sn
);

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_receivable
(
   uid
);

/*==============================================================*/
/* Table: wx_retrieve_password_log                              */
/*==============================================================*/
create table wx_retrieve_password_log
(
   id                   int unsigned not null auto_increment comment '自增ID',
   uid                  int comment '用户ID',
   passwd_code          char(32) comment '校验串',
   end_time             tinyint unsigned comment '过期时间',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_retrieve_password_log comment '找回密码申请日志表';

/*==============================================================*/
/* Index: Index_uname_code                                      */
/*==============================================================*/
create index Index_uname_code on wx_retrieve_password_log
(
   passwd_code
);

/*==============================================================*/
/* Table: wx_returns                                            */
/*==============================================================*/
create table wx_returns
(
   return_id            int not null auto_increment comment '退换货ID',
   uid                  int unsigned comment '用户ID',
   order_sn             int comment '订单ID',
   pid                  int comment '产品ID',
   type                 tinyint comment '类型1，退货，2换货',
   reason               tinyint comment '原因,1尺寸不对，2货品有问题，3其他',
   descr                varchar(128) comment '描述',
   logistic_num         char(16) comment '退换货物流单号',
   cs_operations        tinyint default 0 comment '客服操作，0初始，1协商成功，2协商失败',
   store_operations     tinyint default 0 comment '仓库操作，0初始，退货的货物 物流配送中，1货物确认成功，2货物确认失败，',
   financial_operations tinyint default 0 comment '财务操作，0初始，1金额已退换 ',
   img_one              varchar(128) comment '拍照图片1,整体效果图',
   img_two              varchar(128) comment '拍照图片2，问题效果图',
   status               tinyint default 0 comment '状态，0初始，1处理成功，2取消',
   create_time          datetime comment '创建时间',
   primary key (return_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_returns comment '退换货表

退货流程--> 客服与顾客协商 --> 成功 --> 退货流程结束。协调失败 -->';

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_returns
(
   uid
);

/*==============================================================*/
/* Index: Index_order_sn                                        */
/*==============================================================*/
create index Index_order_sn on wx_returns
(
   order_sn
);

/*==============================================================*/
/* Table: wx_share                                              */
/*==============================================================*/
create table wx_share
(
   share_id             int unsigned not null auto_increment comment '晒单ID',
   pid                  int unsigned comment '产品ID',
   uid                  int unsigned comment '用户ID',
   title                varchar(32) comment '标题',
   content              varchar(255) comment '内容',
   ip                   char(16) comment 'IP地址',
   create_time          datetime comment '创建时间',
   primary key (share_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_share comment '晒单表';

/*==============================================================*/
/* Index: Index_pid                                             */
/*==============================================================*/
create index Index_pid on wx_share
(
   pid
);

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_share
(
   uid
);

/*==============================================================*/
/* Table: wx_share_comment                                      */
/*==============================================================*/
create table wx_share_comment
(
   id                   int unsigned not null auto_increment comment '自增ID',
   share_id             int unsigned comment '晒单ID',
   uid                  int unsigned comment '用户ID',
   uname                varchar(32) comment '用户名称',
   content              varchar(255) comment '回复内容',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_share_comment comment '晒单评论表';

/*==============================================================*/
/* Index: Index_share_id                                        */
/*==============================================================*/
create index Index_share_id on wx_share_comment
(
   share_id
);

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_share_comment
(
   uid
);

/*==============================================================*/
/* Table: wx_share_images                                       */
/*==============================================================*/
create table wx_share_images
(
   id                   int unsigned not null auto_increment comment '自增ID',
   share_id             int unsigned comment '晒单ID',
   img_addr             varchar(128) comment '图片地址',
   descr                varchar(128) comment '图片说明',
   is_cover             tinyint unsigned default 0 comment '是否为封面，0否，1是',
   status               tinyint unsigned default 1 comment '状态，0已删除，1正常',
   is_like              int unsigned comment '是否喜欢，记录喜欢的人数',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_share_images comment '晒单图片表';

/*==============================================================*/
/* Index: Index_share_id                                        */
/*==============================================================*/
create index Index_share_id on wx_share_images
(
   share_id
);

/*==============================================================*/
/* Table: wx_shopping_cart                                      */
/*==============================================================*/
create table wx_shopping_cart
(
   cart_id              int unsigned not null auto_increment comment '购物车ID',
   uid                  int unsigned comment '用户ID',
   pid                  int unsigned comment '产品ID',
   pname                varchar(120) comment '产品名称',
   product_price        int unsigned comment '产品价格，单位为分',
   product_num          int unsigned default 1 comment '产品数量',
   product_img          varchar(128) comment '产品图片地址',
   product_size         varchar(6) comment '产品尺寸',
   additional_info      varchar(16) default '0' comment '附加信息',
   status               tinyint unsigned default 1 comment '状态,0已删除，1正常',
   create_time          datetime comment '创建时间',
   primary key (cart_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_shopping_cart comment '购物车表';

INSERT INTO `wx_shopping_cart` VALUES (1,1,2,'潮人必备1',10,1,'sd/dssd/sdsd/a.jpg','M','0',1,'2012-06-07 15:23:01');
INSERT INTO `wx_shopping_cart` VALUES (3,1,1,'潮人必备',10,1,'sd/dssd/sdsd/a.jpg','S','0',1,'2012-06-07 15:23:01');

/*==============================================================*/
/* Index: uid_pid_unqiue                                        */
/*==============================================================*/
create unique index uid_pid_unqiue on wx_shopping_cart
(
   pid,
   uid
);

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_shopping_cart
(
   uid
);

/*==============================================================*/
/* Table: wx_size                                               */
/*==============================================================*/
create table wx_size
(
   size_id              int unsigned not null auto_increment comment '尺码ID',
   name                 varchar(32) comment '尺码名称',
   abbreviation         char(6) comment '尺码简称',
   descr                varchar(128) comment '尺码描述',
   create_time          datetime comment '创建时间',
   primary key (size_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_size comment '尺码表';

/*==============================================================*/
/* Table: wx_system_proposal                                    */
/*==============================================================*/
create table wx_system_proposal
(
   id                   int unsigned not null auto_increment comment '自增ID',
   title                varchar(32) comment '标题',
   content              varchar(255) comment '内容',
   uid                  int unsigned comment '用户ID',
   uname                varchar(32) comment '用户名称',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_system_proposal comment '系统意见和建议';

/*==============================================================*/
/* Table: wx_tuan_comment                                       */
/*==============================================================*/
create table wx_tuan_comment
(
   id                   int unsigned not null auto_increment comment '自增ID',
   tuan_id              int unsigned comment '团购ID',
   uid                  int unsigned comment '用户ID',
   uname                varchar(32) comment '用户名称',
   title                varchar(32) comment '评论标题',
   content              varchar(255) comment '评论内容',
   status               tinyint unsigned comment '评论状态',
   is_valid             int unsigned comment '有效',
   is_invalid           int unsigned comment '无效',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_tuan_comment comment '团购评价表';

/*==============================================================*/
/* Index: Index_tuan_id                                         */
/*==============================================================*/
create index Index_tuan_id on wx_tuan_comment
(
   tuan_id
);

/*==============================================================*/
/* Table: wx_tuan_product                                       */
/*==============================================================*/
create table wx_tuan_product
(
   tuan_id              int unsigned not null auto_increment comment '自增ID',
   pid                  int unsigned comment '产品ID',
   pname                varchar(120) comment '产品名称',
   product_images       varchar(64) comment '产品图片',
   sell_price           int unsigned comment '销售价格，单位为分',
   tuan_price           int unsigned comment '团购价格，单位为分',
   status               tinyint unsigned comment '状态，1正常团购，2已结束团购',
   inventory            int unsigned comment '库存量',
   tuan_num             int unsigned comment '团购数量',
   detail               text comment '详细介绍',
   start_time           datetime comment '团购开始时间',
   end_time             datetime comment '团购结束时间',
   discount_rate        int unsigned comment '折扣率,存储百分比',
   save                 int unsigned comment '节省金额，单位为分',
   descr                varchar(128) comment '描述',
   create_time          datetime comment '创建时间',
   primary key (tuan_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_tuan_product comment '团购产品表';

/*==============================================================*/
/* Table: wx_user                                               */
/*==============================================================*/
create table wx_user
(
   uid                  int unsigned not null auto_increment comment '用户ID',
   uname                varchar(32) comment '用户名称',
   nickname             varchar(32) comment '昵称',
   lid                  int unsigned default 1 comment '等级ID',
   password             char(32) comment '登陆密码',
   source               varchar(128) default '1' comment '用户来源，1主站',
   integral             int unsigned default 0 comment '用户积分',
   amount               int unsigned default 0 comment '用户金额,单位为分。此金额直接对应于人民币',
   status               tinyint default 1 comment '状态,0删除，1正常',
   create_time          datetime comment '创建时间',
   primary key (uid)
)
engine = MYISAM
auto_increment = 1;

alter table wx_user comment '用户基本信息表';

INSERT INTO `wx_user` VALUES (1,'hjpking@gmail.com','凌晨的风',1,'25f2261cd6924d96df4bf75227f3d5fa','1',0,0,1,'2012-06-07 13:19:23');
INSERT INTO `wx_user` VALUES (2,'weidian01@gmail.com','哎哟喂',1,'4297f44b13955235245b2497399d7a93','1',0,0,1,'2012-06-07 13:20:23');

/*==============================================================*/
/* Index: index_uname                                           */
/*==============================================================*/
create unique index index_uname on wx_user
(
   uname
);

/*==============================================================*/
/* Table: wx_user_consume_log                                   */
/*==============================================================*/
create table wx_user_consume_log
(
   consume_id           int unsigned not null auto_increment comment '消费记录ID',
   uid                  int comment '用户ID',
   operat_type          tinyint unsigned comment '操作类型，1消费，2充值，3退款，4返现，5其他',
   before_amount        int unsigned comment '操作前金额，单位为分',
   after_amount         int unsigned comment '操作后金额，单位为分',
   descr                varchar(128) comment '操作描述',
   consume_amount       int comment '消费金额',
   create_time          datetime comment '创建时间',
   primary key (consume_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_user_consume_log comment '用户消费记录表';

/*==============================================================*/
/* Index: index_uid                                             */
/*==============================================================*/
create index index_uid on wx_user_consume_log
(
   uid
);

/*==============================================================*/
/* Index: Index_create_time                                     */
/*==============================================================*/
create index Index_create_time on wx_user_consume_log
(
   create_time
);

/*==============================================================*/
/* Table: wx_user_info                                          */
/*==============================================================*/
create table wx_user_info
(
   uid                  int unsigned not null comment '用户ID',
   real_name            char(16) comment '真实姓名',
   header               varchar(64) comment '头像',
   sex                  tinyint unsigned comment '性别,0为保密，1为男，2女',
   birthday             date comment '生日',
   country              char(16) comment '国家',
   province             char(8) comment '省份',
   city                 char(8) comment '城市',
   zipcode              char(7) comment '邮政编码',
   detail_address       varchar(128) comment '详细地址',
   phone                char(11) comment '手机',
   company_call         char(11) comment '公司电话',
   family_call          char(11) comment '家庭电话',
   height               tinyint unsigned comment '身高，单位为厘米',
   weight               smallint comment '体重，单位公斤（KG）',
   body_type            char(8) comment '体型',
   marital_status       int unsigned comment '婚姻状况,0保密，1已婚，2未婚',
   education_level      tinyint unsigned comment '教育程度',
   job                  tinyint unsigned comment '从事职业',
   industry             tinyint unsigned comment '工作所属行业',
   income               int unsigned comment '月均收入,0:无收入1:2000 元以下,2:2000～3999 元,3:4000～5999 元,4:6000～7999 元,5:8000～9999 元,6:10000～15000 元,7:15000 元以上',
   interest             varchar(16) comment '兴趣爱好',
   introduction         varchar(255) comment '自我介绍',
   website              varchar(64) comment '个人网站',
   id_card              char(18) comment '身份证号码',
   bank_name            varchar(32) comment '开户银行',
   bank_account         char(19) comment '银行账号'
)
engine = MYISAM
auto_increment = 1;

alter table wx_user_info comment '用户详细信息表';

/*==============================================================*/
/* Index: uid_unique                                            */
/*==============================================================*/
create unique index uid_unique on wx_user_info
(
   uid
);

/*==============================================================*/
/* Table: wx_user_integral_log                                  */
/*==============================================================*/
create table wx_user_integral_log
(
   integral_id          int unsigned not null auto_increment,
   uid                  int unsigned,
   operat_type          tinyint unsigned comment '操作类型，0消耗，1增加',
   consume_amount       int unsigned comment '消费金额',
   before_amount        int unsigned comment '操作前金额，单位为分',
   after_amount         int unsigned comment '操作后金额，单位为分',
   descr                varchar(128) comment '操作描述',
   create_time          datetime comment '创建时间',
   primary key (integral_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_user_integral_log comment '用户积分日志表';

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_user_integral_log
(
   uid
);

/*==============================================================*/
/* Index: Index_create_time                                     */
/*==============================================================*/
create index Index_create_time on wx_user_integral_log
(
   create_time
);

/*==============================================================*/
/* Table: wx_user_level                                         */
/*==============================================================*/
create table wx_user_level
(
   lid                  int unsigned not null auto_increment comment '等级ID',
   name                 varchar(16) comment '等级名称',
   type                 tinyint unsigned comment '组类别',
   descr                varchar(128) comment '等级描述',
   discount             tinyint unsigned comment '打折比例',
   create_time          datetime comment '创建时间',
   primary key (lid)
)
engine = MYISAM
auto_increment = 1;

alter table wx_user_level comment '用户等级表';

/*==============================================================*/
/* Table: wx_user_login_log                                     */
/*==============================================================*/
create table wx_user_login_log
(
   id                   int unsigned not null auto_increment comment '自增ID',
   uid                  int comment '用户Id',
   login_source         tinyint comment '登陆来源,1主站，2站外，3其他',
   ip                   char(16) comment '登陆IP',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_user_login_log comment '用户登陆日志表';

INSERT INTO `wx_user_login_log` VALUES (1,1,1,'127.0.0.1','2012-06-01 10:37:55');
INSERT INTO `wx_user_login_log` VALUES (2,1,1,'127.0.0.1','2012-06-01 10:38:12');
INSERT INTO `wx_user_login_log` VALUES (3,1,1,'127.0.0.1','2012-06-01 10:38:35');
INSERT INTO `wx_user_login_log` VALUES (4,1,1,'127.0.0.1','2012-06-01 10:38:59');
INSERT INTO `wx_user_login_log` VALUES (5,1,2,'127.0.0.1','2012-06-01 10:39:56');

/*==============================================================*/
/* Index: index_uid                                             */
/*==============================================================*/
create index index_uid on wx_user_login_log
(
   uid
);

/*==============================================================*/
/* Table: wx_user_message                                       */
/*==============================================================*/
create table wx_user_message
(
   message_id           int unsigned not null auto_increment comment '留言ID',
   designer_id          int unsigned comment '设计师ID',
   uid                  int unsigned comment '用户ID',
   uname                varchar(32) comment '用户名称',
   content              varchar(255) comment '内容',
   ip                   char(16) comment 'IP地址',
   reply_num            int unsigned comment '留言回复数量',
   create_time          datetime comment '创建时间',
   primary key (message_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_user_message comment '用户留言表';

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_user_message
(
   uid
);

/*==============================================================*/
/* Index: Index_designer_id                                     */
/*==============================================================*/
create index Index_designer_id on wx_user_message
(
   designer_id
);

/*==============================================================*/
/* Table: wx_user_message_reply                                 */
/*==============================================================*/
create table wx_user_message_reply
(
   id                   int unsigned not null auto_increment comment '自增ID',
   uid                  int comment '用户ID',
   uname                varchar(32) comment '用户名称',
   message_id           int unsigned comment '留言ID',
   content              varchar(255) comment '内容',
   ip                   char(16) comment 'IP地址',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_user_message_reply comment '留言回复表';

/*==============================================================*/
/* Index: Index_message_id                                      */
/*==============================================================*/
create index Index_message_id on wx_user_message_reply
(
   message_id
);

/*==============================================================*/
/* Table: wx_user_recipient_address                             */
/*==============================================================*/
create table wx_user_recipient_address
(
   address_id           int not null auto_increment comment '地址ID',
   uid                  int comment '用户ID',
   uname                varchar(32) comment '用户名称',
   recent_name          varchar(16) comment '收货人',
   country              varchar(16) comment '国家',
   province             varchar(16) comment '省份',
   city                 varchar(16) comment '城市',
   area                 varchar(16) comment '区域',
   detail_address       varchar(128) comment '详细地址',
   zipcode              char(7) comment '邮编',
   phone_num            char(11) comment '手机号码',
   call_num             char(11) comment '座机',
   default_address      tinyint comment '默认地址,0否，1是',
   create_time          datetime comment '创建时间',
   primary key (address_id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_user_recipient_address comment '用户收件地址';

INSERT INTO `wx_user_recipient_address` (`address_id`,`uid`,`uname`,`recent_name`,`country`,`province`,`city`,`area`,`detail_address`,`zipcode`,`phone_num`,`call_num`,`create_time`) VALUES (1,1,'weidian01@gmail.com','兰国宾','中国','北京','北京市','朝阳区','中国北京市朝阳区十六里桥','100010','13693573005','','2012-06-01 22:14:46');
INSERT INTO `wx_user_recipient_address` (`address_id`,`uid`,`uname`,`recent_name`,`country`,`province`,`city`,`area`,`detail_address`,`zipcode`,`phone_num`,`call_num`,`create_time`) VALUES (2,2,'hjpking@gmail.com','侯积平','中国','北京','北京市','朝阳区','中国北京市朝阳区半壁店','100010','15101559313','','2012-06-01 22:13:06');

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_user_recipient_address
(
   uid
);

/*==============================================================*/
/* Table: wx_user_up_level_log                                  */
/*==============================================================*/
create table wx_user_up_level_log
(
   id                   int unsigned not null auto_increment comment '自增ID',
   uid                  int unsigned comment '用户ID',
   up_action            tinyint unsigned comment '升级事件',
   former_level         tinyint unsigned comment '原等级',
   current_level        tinyint unsigned comment '现等级',
   create_time          datetime comment '创建时间',
   primary key (id)
)
engine = MYISAM
auto_increment = 1;

alter table wx_user_up_level_log comment '用户升级日志表';

/*==============================================================*/
/* Index: Index_uid                                             */
/*==============================================================*/
create index Index_uid on wx_user_up_level_log
(
   uid
);

/*==============================================================*/
/* Index: Index_create_time                                     */
/*==============================================================*/
create index Index_create_time on wx_user_up_level_log
(
   create_time
);
