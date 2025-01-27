create table area
(
    area_id         int auto_increment
        primary key,
    area_region_id  varchar(191)                            null,
    area_user_id    int                                     null,
    area_name       varchar(191)                            null,
    area_remarks    varchar(191)                            null,
    area_created_at timestamp default current_timestamp()   null,
    area_updated_at datetime  default '0000-00-00 00:00:00' null,
    ip_address      varchar(191)                            null,
    os_name         varchar(191)                            null,
    browser         varchar(191)                            null,
    device          varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table business_category
(
    business_category_id         int auto_increment
        primary key,
    business_category_user_id    varchar(191) null,
    business_category_name       varchar(191) null,
    business_category_created_at varchar(191) null,
    business_category_updated_at varchar(191) null,
    ip_address                   varchar(191) null,
    os_name                      varchar(191) null,
    browser                      varchar(191) null,
    device                       varchar(191) null
)
    collate = utf8mb4_unicode_ci;

create table business_profile
(
    business_profile_id          int auto_increment
        primary key,
    business_profile_logo        varchar(191)                            null,
    business_profile_name        varchar(191)                            null,
    business_profile_address     varchar(191)                            null,
    business_profile_ntn_no      varchar(191)                            null,
    business_profile_gst_no      varchar(191)                            null,
    business_profile_mobile_no   varchar(191)                            null,
    business_profile_ptcl_no     varchar(191)                            null,
    business_profile_email       varchar(191)                            null,
    business_profile_web_address varchar(191)                            null,
    business_profile_created_at  timestamp default current_timestamp()   not null,
    business_profile_updated_at  datetime  default '0000-00-00 00:00:00' not null,
    ip_address                   varchar(191)                            null,
    os_name                      varchar(191)                            null,
    browser                      varchar(191)                            null,
    device                       varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table cat_product_grp
(
    cat_product_grp_id int auto_increment
        primary key,
    product_cat_id     varchar(191) null,
    product_grp_id     varchar(191) null
)
    collate = utf8mb4_unicode_ci;

create table category
(
    cat_id               int auto_increment
        primary key,
    cat_user_id          int          not null,
    cat_product_group_id varchar(191) null,
    created_at           timestamp    null,
    updated_at           timestamp    null,
    ip_address           varchar(191) null,
    os_name              varchar(191) null,
    browser              varchar(191) null,
    device               varchar(191) null,
    cat_category         varchar(191) not null
)
    collate = utf8mb4_unicode_ci;

create table company
(
    id                   bigint unsigned auto_increment
        primary key,
    user_id              int          not null,
    business_category_id int          null,
    com_region_id        varchar(191) not null,
    com_sector_id        varchar(191) not null,
    com_area_id          varchar(191) not null,
    company_name         varchar(191) not null,
    comp_remarks         text         null,
    created_at           timestamp    null,
    updated_at           timestamp    null,
    ip_address           varchar(191) null,
    os_name              varchar(191) null,
    browser              varchar(191) null,
    device               varchar(191) null
)
    collate = utf8mb4_unicode_ci;

create table company_poc_profile
(
    com_poc_profile_id          int auto_increment
        primary key,
    com_poc_profile_user_id     varchar(191)                            null,
    com_poc_profile_name        varchar(191)                            null,
    com_poc_profile_company_id  varchar(191)                            null,
    com_poc_profile_designation varchar(191)                            null,
    com_poc_profile_mobile_no   varchar(191)                            null,
    com_poc_profile_whatsapp_no varchar(191)                            null,
    com_poc_profile_email       varchar(191)                            null,
    com_poc_profile_status      varchar(191)                            null,
    com_poc_profile_address     varchar(191)                            null,
    com_poc_profile_created_at  timestamp default current_timestamp()   not null,
    com_poc_profile_updated_at  datetime  default '0000-00-00 00:00:00' not null,
    ip_address                  varchar(191)                            null,
    os_name                     varchar(191)                            null,
    browser                     varchar(191)                            null,
    device                      varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table company_profile
(
    comprofile_id          int auto_increment
        primary key,
    comprofile_user_id     varchar(191) null,
    comprofile_company_id  varchar(191) null,
    comprofile_name        varchar(191) null,
    comprofile_ptcl        varchar(191) null,
    comprofile_address     varchar(191) null,
    comprofile_mobile_no   varchar(191) null,
    comprofile_whatsapp_no varchar(191) null,
    comprofile_email       varchar(191) null,
    comprofile_status      varchar(191) null,
    comprofile_web_address varchar(191) null,
    comprofile_created_at  datetime     null,
    comprofile_updated_at  datetime     null,
    ip_address             varchar(191) null,
    os_name                varchar(191) null,
    browser                varchar(191) null,
    device                 varchar(191) null
)
    collate = utf8mb4_unicode_ci;

create table funnel
(
    id                     bigint unsigned auto_increment
        primary key,
    user_id                int          not null,
    date                   varchar(191) null,
    company_id             int          null,
    category_id            varchar(191) null,
    mrc                    varchar(191) null,
    status_remarks         varchar(191) null,
    cat_remarks            varchar(191) null,
    status_id              varchar(191) null,
    otc                    varchar(191) null,
    funnel_reminder_reason varchar(191) null,
    created_at             timestamp    null,
    updated_at             timestamp    null,
    ip_address             varchar(191) null,
    os_name                varchar(191) null,
    browser                varchar(191) null,
    device                 varchar(191) null
)
    collate = utf8mb4_unicode_ci;

create table funnel_target
(
    funnel_target_id               int auto_increment
        primary key,
    funnel_target_your_manager     varchar(191)                            null,
    funnel_target_user_id          varchar(191)                            null,
    funnel_target_by               int                                     null,
    funnel_target_product_category varchar(191)                            null,
    funnel_target_date             varchar(191)                            null,
    funnel_target_role             varchar(191)                            null,
    funnel_target_otc              varchar(191)                            null,
    funnel_target_mrc              varchar(191)                            null,
    funnel_target_created_at       timestamp default current_timestamp()   not null,
    funnel_target_updated_at       datetime  default '0000-00-00 00:00:00' not null,
    ip_address                     varchar(191)                            null,
    os_name                        varchar(191)                            null,
    browser                        varchar(191)                            null,
    device                         varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table invoice
(
    id                      bigint unsigned auto_increment
        primary key,
    invoice_no              int          null,
    user_id                 varchar(191) null,
    date                    varchar(191) not null,
    company_id              int          not null,
    grand_total             varchar(191) not null,
    invoice_reminder_reason varchar(191) null,
    created_at              timestamp    null,
    updated_at              timestamp    null,
    ip_address              varchar(191) null,
    os_name                 varchar(191) null,
    browser                 varchar(191) null,
    device                  varchar(191) null
)
    collate = utf8mb4_unicode_ci;

create table main_unit
(
    main_unit_id         int auto_increment
        primary key,
    main_unit_user_id    int                                     null,
    main_unit_name       varchar(191)                            null,
    main_unit_remarks    varchar(191)                            null,
    main_unit_created_at timestamp default current_timestamp()   null,
    main_unit_updated_at datetime  default '0000-00-00 00:00:00' null,
    ip_address           varchar(191)                            null,
    os_name              varchar(191)                            null,
    browser              varchar(191)                            null,
    device               varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table messages
(
    id         bigint unsigned auto_increment
        primary key,
    user_id    int unsigned not null,
    message    text         not null,
    created_at timestamp    null,
    updated_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(191) not null,
    batch     int          not null
)
    collate = utf8mb4_unicode_ci;

create table `order`
(
    id                    bigint unsigned auto_increment
        primary key,
    user_id               int                      not null,
    invoice_id            varchar(191)             not null,
    order_no              int                      null,
    tandc_id              varchar(191) default '0' null,
    sale_date             varchar(191)             null,
    company_id            int                      null,
    grand_total           varchar(191)             not null,
    order_reminder_reason varchar(191)             null,
    created_at            timestamp                null,
    updated_at            timestamp                null,
    ip_address            varchar(191)             null,
    os_name               varchar(191)             null,
    browser               varchar(191)             null,
    device                varchar(191)             null
)
    collate = utf8mb4_unicode_ci;

create table order_purposal
(
    order_purposal_id              int auto_increment
        primary key,
    order_purposal_order_id        varchar(191)                            not null,
    order_purposal_user_id         varchar(191)                            not null,
    order_purposal_category_id     varchar(191)                            null,
    order_purposal_product_id      varchar(191)                            not null,
    order_purposal_qty             varchar(191)                            not null,
    order_purposal_sale            varchar(191)                            not null,
    order_purposal_total_amount    varchar(191)                            not null,
    order_purposal_pro_description text                                    not null,
    order_purposal_payment_type    varchar(191)                            not null,
    order_purposal_date            varchar(191)                            null,
    order_purposal_created_at      timestamp default current_timestamp()   not null,
    order_purposal_updated_at      datetime  default '0000-00-00 00:00:00' not null,
    ip_address                     varchar(191)                            null,
    os_name                        varchar(191)                            null,
    browser                        varchar(191)                            null,
    device                         varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table order_target
(
    order_target_id               int auto_increment
        primary key,
    order_target_your_manager     varchar(191)                            null,
    order_target_user_id          varchar(191)                            null,
    order_target_by               int                                     null,
    order_target_product_category varchar(191)                            null,
    order_target_date             varchar(191)                            null,
    order_target_role             varchar(191)                            null,
    order_target_otc              varchar(191)                            null,
    order_target_mrc              varchar(191)                            null,
    order_target_created_at       timestamp default current_timestamp()   not null,
    order_target_updated_at       datetime  default '0000-00-00 00:00:00' not null,
    ip_address                    varchar(191)                            null,
    os_name                       varchar(191)                            null,
    browser                       varchar(191)                            null,
    device                        varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table post
(
    id               int auto_increment
        primary key,
    post_title       varchar(191) null,
    post_description text         null
)
    collate = utf8mb4_unicode_ci;

create table product
(
    id             bigint unsigned auto_increment
        primary key,
    user_id        int                                     null,
    cat_id         varchar(191)                            null,
    product_unit   varchar(191)                            null,
    product_status varchar(191)                            null,
    product_name   varchar(191)                            null,
    description    text                                    null,
    created_at     timestamp default current_timestamp()   not null,
    updated_at     datetime  default '0000-00-00 00:00:00' not null,
    ip_address     varchar(191)                            null,
    os_name        varchar(191)                            null,
    browser        varchar(191)                            null,
    device         varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table product_group
(
    product_group_id         int auto_increment
        primary key,
    product_group_user_id    int                                     null,
    product_group_name       varchar(191)                            null,
    product_group_remarks    varchar(191)                            null,
    ip_address               varchar(191)                            null,
    os_name                  varchar(191)                            null,
    browser                  varchar(191)                            null,
    device                   varchar(191)                            null,
    product_group_created_at timestamp default current_timestamp()   null,
    product_group_updated_at datetime  default '0000-00-00 00:00:00' null
)
    collate = utf8mb4_unicode_ci;

create table product_group_target
(
    product_group_target_id           int auto_increment
        primary key,
    product_group_target_your_manager varchar(191)                            null,
    product_group_target_user_id      varchar(191)                            null,
    product_group_target_by           int                                     null,
    product_group_target              varchar(191)                            null,
    product_group_target_date         varchar(191)                            null,
    product_group_target_role         varchar(191)                            null,
    product_group_target_created_at   timestamp default current_timestamp()   not null,
    product_group_target_updated_at   datetime  default '0000-00-00 00:00:00' not null,
    ip_address                        varchar(191)                            null,
    os_name                           varchar(191)                            null,
    browser                           varchar(191)                            null,
    device                            varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table product_price
(
    product_price_id         int auto_increment
        primary key,
    product_price_user_id    int                                     null,
    product_price_product_id int                                     null,
    product_price_purchase   varchar(191)                            null,
    product_price_sale       varchar(191)                            null,
    product_price_status     varchar(191)                            null,
    product_price_unit       varchar(191)                            null,
    product_price_updated_at datetime  default '0000-00-00 00:00:00' not null,
    product_price_created_at timestamp default current_timestamp()   not null,
    os_name                  varchar(191)                            null,
    browser                  varchar(191)                            null,
    device                   varchar(191)                            null,
    ip_address               varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table quotation_target
(
    quotation_target_id               int auto_increment
        primary key,
    quotation_target_your_manager     varchar(191)                            null,
    quotation_target_user_id          varchar(191)                            null,
    quotation_target_by               int                                     null,
    quotation_target_product_category varchar(191)                            null,
    quotation_target_date             varchar(191)                            null,
    quotation_target_role             varchar(191)                            null,
    quotation_target_otc              varchar(191)                            null,
    quotation_target_mrc              varchar(191)                            null,
    quotation_target_created_at       timestamp default current_timestamp()   not null,
    quotation_target_updated_at       datetime  default '0000-00-00 00:00:00' not null,
    ip_address                        varchar(191)                            null,
    os_name                           varchar(191)                            null,
    browser                           varchar(191)                            null,
    device                            varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table region
(
    region_id      int auto_increment
        primary key,
    reg_user_id    int                                     null,
    reg_name       varchar(191)                            null,
    reg_remarks    varchar(191)                            null,
    reg_created_at timestamp default current_timestamp()   null,
    reg_updated_at datetime  default '0000-00-00 00:00:00' null,
    ip_address     varchar(191)                            null,
    os_name        varchar(191)                            null,
    browser        varchar(191)                            null,
    device         varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table remarks
(
    remarks_id          int auto_increment
        primary key,
    remarks_user_id     varchar(191) null,
    remarks_for_id      varchar(191) null,
    remarks_schedule_id varchar(191) null,
    remarks_funnel_id   varchar(191) null,
    remarks_purposal_id varchar(191) null,
    remarks_order_id    varchar(191) null,
    remarks_detail      varchar(191) null,
    remarks_date        varchar(191) null,
    remarks_created_at  datetime     null,
    remarks_updated_at  datetime     null,
    ip_address          varchar(191) null,
    os_name             varchar(191) null,
    browser             varchar(191) null,
    device              varchar(191) null
)
    collate = utf8mb4_unicode_ci;

create table reminder
(
    reminder_id          int auto_increment
        primary key,
    reminder_user_id     varchar(191) null,
    reminder_for_id      varchar(191) null,
    reminder_schedule_id varchar(191) null,
    reminder_funnel_id   varchar(191) null,
    reminder_purposal_id varchar(191) null,
    reminder_order_id    varchar(191) null,
    reminder_remarks     varchar(191) null,
    reminder_date        varchar(191) null,
    reminder_reason      varchar(191) null,
    reminder_created_at  datetime     null,
    reminder_updated_at  datetime     null,
    ip_address           varchar(191) null,
    os_name              varchar(191) null,
    browser              varchar(191) null,
    device               varchar(191) null
)
    collate = utf8mb4_unicode_ci;

create table sale_invoice
(
    id           bigint unsigned auto_increment
        primary key,
    user_id      int          not null,
    inv_id       int          not null,
    category_id  varchar(191) null,
    product_id   varchar(191) null,
    qty          double       null,
    sale         double       null,
    total_amount double       null,
    payment_type varchar(191) not null,
    date         varchar(191) null,
    created_at   timestamp    null,
    updated_at   timestamp    null,
    ip_address   varchar(191) null,
    os_name      varchar(191) null,
    browser      varchar(191) null,
    device       varchar(191) null
)
    collate = utf8mb4_unicode_ci;

create table schedule
(
    id                  bigint unsigned auto_increment
        primary key,
    user_id             int          not null,
    date                varchar(191) null,
    company_id          int          null,
    type_of_visit       varchar(191) null,
    sch_remarks         text         null,
    schedule_status     varchar(191) null,
    sch_reminder_reason varchar(191) null,
    created_at          timestamp    null,
    updated_at          timestamp    null,
    ip_address          varchar(191) null,
    os_name             varchar(191) null,
    browser             varchar(191) null,
    device              varchar(191) null
)
    collate = utf8mb4_unicode_ci;

create table schedule_target
(
    sch_target_id                   int auto_increment
        primary key,
    sch_target_your_manager         varchar(191)                            null,
    sch_target_user_id              varchar(191)                            not null,
    sch_target_by                   int                                     null,
    sch_target_date                 varchar(191)                            null,
    sch_target_role                 varchar(191)                            null,
    sch_target_business_category_id varchar(191)                            null,
    sch_target_total_visits         varchar(191)                            null,
    sch_target_min_new_visits       varchar(191)                            null,
    sch_target_created_at           timestamp default current_timestamp()   not null,
    sch_target_updated_at           datetime  default '0000-00-00 00:00:00' not null,
    ip_address                      varchar(191)                            null,
    os_name                         varchar(191)                            null,
    browser                         varchar(191)                            null,
    device                          varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table sector
(
    sector_id      int auto_increment
        primary key,
    sec_region_id  int                                     null,
    sec_area_id    int                                     null,
    sec_user_id    int                                     null,
    sec_name       varchar(191)                            null,
    sec_remarks    varchar(191)                            null,
    sec_created_at timestamp default current_timestamp()   null,
    sec_updated_at datetime  default '0000-00-00 00:00:00' null,
    ip_address     varchar(191)                            null,
    os_name        varchar(191)                            null,
    browser        varchar(191)                            null,
    device         varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table status
(
    sta_id     bigint auto_increment
        primary key,
    sta_status varchar(191) not null,
    created_at timestamp    null,
    updated_at timestamp    null,
    ip_address varchar(191) null,
    os_name    varchar(191) null,
    browser    varchar(191) null,
    device     varchar(191) null
)
    collate = utf8mb4_unicode_ci;

create table term_and_condition
(
    tandc_id          int auto_increment
        primary key,
    tandc_title       varchar(191)                          not null,
    tandc_description text                                  not null,
    tandc_created_at  timestamp default current_timestamp() not null,
    tandc_updated_at  timestamp default current_timestamp() not null,
    ip_address        varchar(191)                          null,
    os_name           varchar(191)                          null,
    browser           varchar(191)                          null,
    device            varchar(191)                          null,
    tandc_user_id     varchar(191)                          null
)
    collate = utf8mb4_unicode_ci;

create table testing
(
    testing_id   int auto_increment
        primary key,
    testing_name varchar(191) null
)
    collate = utf8mb4_unicode_ci;

create table town
(
    town_id         int auto_increment
        primary key,
    town_region_id  int                                     null,
    town_area_id    int                                     null,
    town_sector_id  int                                     null,
    town_user_id    int                                     null,
    town_name       varchar(191)                            null,
    town_remarks    varchar(191)                            null,
    town_created_at timestamp default current_timestamp()   null,
    town_updated_at datetime  default '0000-00-00 00:00:00' null,
    ip_address      varchar(191)                            null,
    os_name         varchar(191)                            null,
    browser         varchar(191)                            null,
    device          varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table unit
(
    unit_id           int auto_increment
        primary key,
    unit_user_id      int                                     null,
    unit_main_unit_id varchar(191)                            null,
    unit_name         varchar(191)                            null,
    unit_scale_size   varchar(191)                            null,
    unit_remarks      varchar(191)                            null,
    ip_address        varchar(191)                            null,
    os_name           varchar(191)                            null,
    browser           varchar(191)                            null,
    device            varchar(191)                            null,
    unit_created_at   timestamp default current_timestamp()   null,
    unit_updated_at   datetime  default '0000-00-00 00:00:00' null
)
    collate = utf8mb4_unicode_ci;

create table upload_video
(
    id         bigint unsigned auto_increment
        primary key,
    title      varchar(191) null,
    video_file varchar(191) null,
    created_at timestamp    null,
    updated_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table user_role
(
    user_role_id           int auto_increment
        primary key,
    user_role_user_id      varchar(191)                            null,
    user_role_line_manager varchar(191)                            null,
    user_role_name         varchar(191)                            null,
    user_role_created_at   timestamp default current_timestamp()   null,
    user_role_updated_at   datetime  default '0000-00-00 00:00:00' null
)
    collate = utf8mb4_unicode_ci;

create table users
(
    id                 bigint unsigned auto_increment
        primary key,
    name               varchar(191)                            null,
    email              varchar(191)                            not null,
    email_verified_at  datetime                                null,
    password           varchar(191)                            not null,
    username           varchar(191)                            not null,
    mob                varchar(191)                            not null,
    address            varchar(191)                            not null,
    role               varchar(191)                            not null,
    supervisor         int                                     null,
    image              varchar(191)                            not null,
    remember_token     varchar(100)                            null,
    created_at         timestamp default current_timestamp()   null,
    updated_at         datetime  default '0000-00-00 00:00:00' null,
    ip_address         varchar(191)                            null,
    os_name            varchar(191)                            null,
    browser            varchar(191)                            null,
    device             varchar(191)                            null,
    users_user_role_id varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table visit_type
(
    visit_type_id         int auto_increment
        primary key,
    visit_type_name       varchar(191)                            not null,
    visit_type_user_id    varchar(191)                            not null,
    visit_type_created_at timestamp default current_timestamp()   not null,
    visit_type_updated_at datetime  default '0000-00-00 00:00:00' not null,
    ip_address            varchar(191)                            null,
    os_name               varchar(191)                            null,
    browser               varchar(191)                            null,
    device                varchar(191)                            null
)
    collate = utf8mb4_unicode_ci;

create table websockets_statistics_entries
(
    id                      int unsigned auto_increment
        primary key,
    app_id                  varchar(191) not null,
    peak_connection_count   int          not null,
    websocket_message_count int          not null,
    api_message_count       int          not null,
    created_at              timestamp    null,
    updated_at              timestamp    null
)
    collate = utf8mb4_unicode_ci;


