create table area
(
    area_id         int(255) auto_increment
        primary key,
    area_region_id  int                                     null,
    area_user_id    int(255)                                null,
    area_name       varchar(255)                            null,
    area_remarks    varchar(255)                            null,
    area_created_at timestamp default current_timestamp()   null on update current_timestamp(),
    area_updated_at timestamp default '0000-00-00 00:00:00' null
)
    engine = InnoDB;

create table business_category
(
    business_category_id         int(255) auto_increment
        primary key,
    business_category_user_id    varchar(255) null,
    business_category_name       varchar(255) null,
    business_category_created_at varchar(255) null,
    business_category_updated_at varchar(255) null
)
    engine = InnoDB;

create table business_profile
(
    business_profile_id          int(255) auto_increment
        primary key,
    business_profile_logo        varchar(255)                            null,
    business_profile_name        varchar(255)                            null,
    business_profile_address     varchar(255)                            null,
    business_profile_ntn_no      varchar(255)                            null,
    business_profile_gst_no      varchar(255)                            null,
    business_profile_mobile_no   varchar(255)                            null,
    business_profile_ptcl_no     varchar(255)                            null,
    business_profile_email       varchar(255)                            null,
    business_profile_web_address varchar(255)                            null,
    business_profile_created_at  timestamp default current_timestamp()   not null on update current_timestamp(),
    business_profile_updated_at  timestamp default '0000-00-00 00:00:00' not null
)
    engine = InnoDB;

create table category
(
    cat_id       int(255) auto_increment
        primary key,
    cat_user_id  int(255)                                not null,
    cat_category varchar(255)                            not null,
    created_at   timestamp default current_timestamp()   not null on update current_timestamp(),
    updated_at   timestamp default '0000-00-00 00:00:00' not null
)
    engine = InnoDB;

create table company
(
    id                   bigint unsigned auto_increment
        primary key,
    user_id              int(255)     not null,
    business_category_id int(255)     null,
    com_region_id        varchar(255) not null,
    com_sector_id        varchar(255) not null,
    com_area_id          varchar(255) not null,
    company_name         varchar(191) not null,
    comp_remarks         text         null,
    created_at           timestamp    null,
    updated_at           timestamp    null
)
    engine = InnoDB
    collate = utf8mb4_unicode_ci;

create table company_poc_profile
(
    com_poc_profile_id          int(255) auto_increment
        primary key,
    com_poc_profile_user_id     varchar(255)                            null,
    com_poc_profile_name        varchar(255)                            null,
    com_poc_profile_company_id  varchar(255)                            null,
    com_poc_profile_designation varchar(255)                            null,
    com_poc_profile_mobile_no   varchar(255)                            null,
    com_poc_profile_whatsapp_no varchar(255)                            null,
    com_poc_profile_email       varchar(255)                            null,
    com_poc_profile_status      varchar(255)                            null,
    com_poc_profile_address     varchar(255)                            null,
    com_poc_profile_created_at  timestamp default current_timestamp()   not null on update current_timestamp(),
    com_poc_profile_updated_at  timestamp default '0000-00-00 00:00:00' not null
)
    engine = InnoDB;

create table company_profile
(
    comprofile_id          int(255) auto_increment
        primary key,
    comprofile_user_id     varchar(255) null,
    comprofile_company_id  varchar(255) null,
    comprofile_name        varchar(255) null,
    comprofile_ptcl        varchar(255) null,
    comprofile_address     varchar(255) null,
    comprofile_mobile_no   varchar(255) null,
    comprofile_whatsapp_no varchar(255) null,
    comprofile_email       varchar(255) null,
    comprofile_status      varchar(255) null,
    comprofile_web_address varchar(255) null,
    comprofile_created_at  timestamp    null,
    comprofile_updated_at  timestamp    null
)
    engine = InnoDB;

create table funnel
(
    id                     bigint unsigned auto_increment
        primary key,
    user_id                int(255)     not null,
    date                   varchar(255) null,
    company_id             int          null,
    category_id            varchar(191) null,
    mrc                    varchar(191) null,
    status_remarks         varchar(255) null,
    cat_remarks            varchar(255) null,
    status_id              varchar(191) null,
    otc                    varchar(191) null,
    funnel_reminder_reason varchar(255) null,
    created_at             timestamp    null,
    updated_at             timestamp    null
)
    engine = InnoDB
    collate = utf8mb4_unicode_ci;

create table funnel_target
(
    funnel_target_id               int(255) auto_increment
        primary key,
    funnel_target_your_manager     varchar(255)                            null,
    funnel_target_user_id          varchar(255)                            null,
    funnel_target_by               int(255)                                null,
    funnel_target_product_category varchar(255)                            null,
    funnel_target_date             varchar(255)                            null,
    funnel_target_role             varchar(255)                            null,
    funnel_target_otc              varchar(255)                            null,
    funnel_target_mrc              varchar(255)                            null,
    funnel_target_created_at       timestamp default current_timestamp()   not null on update current_timestamp(),
    funnel_target_updated_at       timestamp default '0000-00-00 00:00:00' not null
)
    engine = InnoDB;

create table invoice
(
    id                      bigint unsigned auto_increment
        primary key,
    invoice_no              int(255)     null,
    user_id                 varchar(255) null,
    date                    varchar(255) not null,
    company_id              int          not null,
    grand_total             varchar(255) not null,
    invoice_reminder_reason varchar(255) null,
    created_at              timestamp    null,
    updated_at              timestamp    null
)
    engine = InnoDB
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
    engine = InnoDB
    collate = utf8mb4_unicode_ci;

create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(191) not null,
    batch     int          not null
)
    engine = InnoDB
    collate = utf8mb4_unicode_ci;

create table `order`
(
    id                    bigint unsigned auto_increment
        primary key,
    user_id               int(255)                 not null,
    invoice_id            varchar(255)             not null,
    order_no              int                      null,
    tandc_id              varchar(255) default '0' null,
    sale_date             varchar(255)             null,
    company_id            int(191)                 null,
    grand_total           varchar(255)             not null,
    order_reminder_reason varchar(255)             null,
    created_at            timestamp                null,
    updated_at            timestamp                null
)
    engine = InnoDB
    collate = utf8mb4_unicode_ci;

create table order_purposal
(
    order_purposal_id              int(255) auto_increment
        primary key,
    order_purposal_order_id        varchar(255)                            not null,
    order_purposal_user_id         varchar(255)                            not null,
    order_purposal_category_id     varchar(255)                            null,
    order_purposal_product_id      varchar(255)                            not null,
    order_purposal_qty             varchar(255)                            not null,
    order_purposal_sale            varchar(255)                            not null,
    order_purposal_total_amount    varchar(255)                            not null,
    order_purposal_pro_description text                                    not null,
    order_purposal_payment_type    varchar(255)                            not null,
    order_purposal_date            varchar(255)                            null,
    order_purposal_created_at      timestamp default current_timestamp()   not null on update current_timestamp(),
    order_purposal_updated_at      timestamp default '0000-00-00 00:00:00' not null
)
    engine = InnoDB;

create table order_target
(
    order_target_id               int(255) auto_increment
        primary key,
    order_target_your_manager     varchar(255)                            null,
    order_target_user_id          varchar(255)                            null,
    order_target_by               int(255)                                null,
    order_target_product_category varchar(255)                            null,
    order_target_date             varchar(255)                            null,
    order_target_role             varchar(255)                            null,
    order_target_otc              varchar(255)                            null,
    order_target_mrc              varchar(255)                            null,
    order_target_created_at       timestamp default current_timestamp()   not null on update current_timestamp(),
    order_target_updated_at       timestamp default '0000-00-00 00:00:00' not null
)
    engine = InnoDB;

create table post
(
    id               int          not null
        primary key,
    post_title       varchar(255) null,
    post_description text         null
);

create table product
(
    id             bigint unsigned auto_increment
        primary key,
    user_id        int(255)     null,
    cat_id         varchar(255) null,
    product_name   varchar(191) null,
    description    text         null,
    product_status varchar(255) null,
    created_at     timestamp    null,
    updated_at     timestamp    null
)
    engine = InnoDB
    collate = utf8mb4_unicode_ci;

create table product_price
(
    product_price_id         int(255) auto_increment
        primary key,
    product_price_user_id    int(255)                                null,
    product_price_product_id int(255)                                null,
    product_price_purchase   varchar(255)                            null,
    product_price_sale       varchar(255)                            null,
    product_price_status     varchar(255)                            null,
    product_price_created_at timestamp default current_timestamp()   not null on update current_timestamp(),
    product_price_updated_at timestamp default '0000-00-00 00:00:00' not null
)
    engine = InnoDB;

create table quotation_target
(
    quotation_target_id               int(255) auto_increment
        primary key,
    quotation_target_your_manager     varchar(255)                            null,
    quotation_target_user_id          varchar(255)                            null,
    quotation_target_by               int(255)                                null,
    quotation_target_product_category varchar(255)                            null,
    quotation_target_date             varchar(255)                            null,
    quotation_target_role             varchar(255)                            null,
    quotation_target_otc              varchar(255)                            null,
    quotation_target_mrc              varchar(255)                            null,
    quotation_target_created_at       timestamp default current_timestamp()   not null on update current_timestamp(),
    quotation_target_updated_at       timestamp default '0000-00-00 00:00:00' not null
)
    engine = InnoDB;

create table region
(
    region_id      int(255) auto_increment
        primary key,
    reg_user_id    int(255)                                null,
    reg_name       varchar(255)                            null,
    reg_remarks    varchar(255)                            null,
    reg_created_at timestamp default current_timestamp()   null on update current_timestamp(),
    reg_updated_at timestamp default '0000-00-00 00:00:00' null
)
    engine = InnoDB;

create table remarks
(
    remarks_id          int(255) auto_increment
        primary key,
    remarks_user_id     varchar(255) null,
    remarks_for_id      varchar(255) null,
    remarks_schedule_id varchar(255) null,
    remarks_funnel_id   varchar(255) null,
    remarks_purposal_id varchar(255) null,
    remarks_order_id    varchar(255) null,
    remarks_detail      varchar(255) null,
    remarks_date        varchar(255) null,
    remarks_created_at  timestamp    null,
    remarks_updated_at  timestamp    null
)
    engine = InnoDB;

create table reminder
(
    reminder_id          int(255) auto_increment
        primary key,
    reminder_user_id     varchar(255) null,
    reminder_for_id      varchar(255) null,
    reminder_schedule_id varchar(255) null,
    reminder_funnel_id   varchar(255) null,
    reminder_purposal_id varchar(255) null,
    reminder_order_id    varchar(255) null,
    reminder_remarks     varchar(255) null,
    reminder_date        varchar(255) null,
    reminder_reason      varchar(255) null,
    reminder_created_at  timestamp    null,
    reminder_updated_at  timestamp    null
)
    engine = InnoDB;

create table sale_invoice
(
    id           bigint unsigned auto_increment
        primary key,
    user_id      int(255)     not null,
    inv_id       int          not null,
    category_id  varchar(255) null,
    product_id   varchar(191) null,
    qty          double       null,
    sale         double       null,
    total_amount double       null,
    payment_type varchar(255) not null,
    date         varchar(255) null,
    created_at   timestamp    null,
    updated_at   timestamp    null
)
    engine = InnoDB
    collate = utf8mb4_unicode_ci;

create table schedule
(
    id                  bigint unsigned auto_increment
        primary key,
    user_id             int(255)     not null,
    date                varchar(255) null,
    company_id          int          null,
    type_of_visit       varchar(255) null,
    sch_remarks         text         null,
    schedule_status     varchar(255) null,
    sch_reminder_reason varchar(255) null,
    created_at          timestamp    null,
    updated_at          timestamp    null
)
    engine = InnoDB
    collate = utf8mb4_unicode_ci;

create table schedule_target
(
    sch_target_id                   int(255) auto_increment
        primary key,
    sch_target_your_manager         varchar(255)                            null,
    sch_target_user_id              varchar(255)                            not null,
    sch_target_by                   int(255)                                null,
    sch_target_date                 varchar(255)                            null,
    sch_target_role                 varchar(255)                            null,
    sch_target_business_category_id varchar(255)                            null,
    sch_target_total_visits         varchar(255)                            null,
    sch_target_min_new_visits       varchar(255)                            null,
    sch_target_created_at           timestamp default current_timestamp()   not null on update current_timestamp(),
    sch_target_updated_at           timestamp default '0000-00-00 00:00:00' not null
)
    engine = InnoDB;

create table sector
(
    sector_id      int(255) auto_increment
        primary key,
    sec_region_id  int(255)                                null,
    sec_area_id    int(255)                                null,
    sec_user_id    int(255)                                null,
    sec_name       varchar(255)                            null,
    sec_remarks    varchar(255)                            null,
    sec_created_at timestamp default current_timestamp()   null on update current_timestamp(),
    sec_updated_at timestamp default '0000-00-00 00:00:00' null
)
    engine = InnoDB;

create table status
(
    sta_id     bigint(255) auto_increment
        primary key,
    sta_status varchar(255)                            not null,
    created_at timestamp default current_timestamp()   not null on update current_timestamp(),
    updated_at timestamp default '0000-00-00 00:00:00' not null
)
    engine = InnoDB;

create table term_and_condition
(
    tandc_id          int(255) auto_increment
        primary key,
    tandc_title       varchar(255)                          not null,
    tandc_description text                                  not null,
    tandc_created_at  timestamp default current_timestamp() not null on update current_timestamp(),
    tandc_updated_at  timestamp default current_timestamp() not null on update current_timestamp()
)
    engine = InnoDB;

create table testing
(
    testing_id   int(255) auto_increment
        primary key,
    testing_name varchar(255) null
)
    engine = InnoDB;

create table upload_video
(
    id         bigint unsigned auto_increment
        primary key,
    title      varchar(191) null,
    video_file varchar(191) null,
    created_at timestamp    null,
    updated_at timestamp    null
)
    engine = InnoDB
    collate = utf8mb4_unicode_ci;

create table users
(
    id                bigint unsigned auto_increment
        primary key,
    name              varchar(255) null,
    email             varchar(255) not null,
    email_verified_at timestamp    null,
    password          varchar(255) not null,
    username          varchar(255) not null,
    mob               varchar(255) not null,
    address           varchar(255) not null,
    role              varchar(255) not null,
    supervisor        int(255)     null,
    image             varchar(255) not null,
    remember_token    varchar(100) null,
    created_at        timestamp    null,
    updated_at        timestamp    null
)
    engine = InnoDB
    collate = utf8mb4_unicode_ci;

create table visit_type
(
    visit_type_id         int(255) auto_increment
        primary key,
    visit_type_name       varchar(255)                            not null,
    visit_type_user_id    varchar(255)                            not null,
    visit_type_created_at timestamp default current_timestamp()   not null on update current_timestamp(),
    visit_type_updated_at timestamp default '0000-00-00 00:00:00' not null
)
    engine = InnoDB;

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
    engine = InnoDB
    collate = utf8mb4_unicode_ci;


