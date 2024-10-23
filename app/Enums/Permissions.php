<?php

namespace Modules\Core\Enums;

enum Permissions
{
    const VIEW_ROLES = 'view roles';
    const UPDATE_ROLE = 'update role';
    const CREATE_ROLE = 'create role';
    const VIEW_ADMINS = 'view admins';

    const UPDATE_ADMIN = 'update admin';

    const CREATE_ADMIN = 'create admin';

    const SHOW_ADMIN = 'show admin';

    const CHANGE_ADMIN_STATUS = 'change admin status';

    // Base module permissions
    const LIST_BASE_MODULES = 'list base modules';
    const UPDATE_BASE_MODULE = 'update base module';
    const CREATE_BASE_MODULE = 'create base module';
    const SHOW_BASE_MODULE = 'show base module';
    const DELETE_BASE_MODULE = 'delete base module';
    const CHANGE_BASE_MODULE_STATUS = 'change base module status';


    const LIST_REGIONS = 'list regions';
    const UPDATE_REGION = 'update region';
    const CREATE_REGION = 'create region';
    const SHOW_REGION = 'show region';
    const DELETE_REGION = 'delete region';
    const CHANGE_REGION_STATUS = 'change region status';


    const LIST_AREAS = 'list areas';
    const UPDATE_AREA = 'update area';
    const CREATE_AREA = 'create area';
    const SHOW_AREA = 'show area';
    const DELETE_AREA = 'delete area';
    const CHANGE_AREA_STATUS = 'change area status';

    const LIST_BUSINESS_UNITS = 'list business units';
    const UPDATE_BUSINESS_UNIT = 'update business unit';
    const CREATE_BUSINESS_UNIT = 'create business unit';
    const SHOW_BUSINESS_UNIT = 'show business unit';
    const DELETE_BUSINESS_UNIT = 'delete business unit';
    const CHANGE_BUSINESS_UNIT_STATUS = 'change business unit status';


    const LIST_PRODUCT_GROUPS = 'list product groups';
    const UPDATE_PRODUCT_GROUP = 'update product group';
    const CREATE_PRODUCT_GROUP = 'create product group';
    const SHOW_PRODUCT_GROUP = 'show product group';
    const DELETE_PRODUCT_GROUP = 'delete product group';
    const CHANGE_PRODUCT_GROUP_STATUS = 'change product group status';


    const LIST_PRODUCT_CATEGORIES = 'list product categories';
    const UPDATE_PRODUCT_CATEGORY = 'update product category';
    const CREATE_PRODUCT_CATEGORY = 'create product category';
    const SHOW_PRODUCT_CATEGORY = 'show product category';
    const DELETE_PRODUCT_CATEGORY = 'delete product category';
    const CHANGE_PRODUCT_CATEGORY_STATUS = 'change product category status';


    const LIST_TEAMS = 'list teams';
    const UPDATE_TEAM = 'update team';
    const CREATE_TEAM = 'create team';
    const SHOW_TEAM = 'show team';
    const DELETE_TEAM = 'delete team';
    const CHANGE_TEAM_STATUS = 'change team status';


    const LIST_PROMOTERS = 'list promoters';
    const UPDATE_PROMOTER = 'update promoter';
    const CREATE_PROMOTER = 'create promoter';
    const SHOW_PROMOTER = 'show promoter';
    const DELETE_PROMOTER = 'delete promoter';
    const CHANGE_PROMOTER_STATUS = 'change promoter status';

    const LIST_AUDITS = 'list audits';

    const LIST_SHOPS = 'list shops';
    const UPDATE_SHOP = 'update shop';
    const CREATE_SHOP = 'create shop';
    const SHOW_SHOP = 'show shop';
    const DELETE_SHOP = 'delete shop';
    const CHANGE_SHOP_STATUS = 'change shop status';


    const LIST_ATTENDANCES = 'list attendances';
    const UPDATE_ATTENDANCE = 'update attendance';
    const CREATE_ATTENDANCE = 'create attendance';
    const SHOW_ATTENDANCE = 'show attendance';
    const ADD_ATTENDANCE_NOTE = 'add attendance note';
    const DELETE_ATTENDANCE = 'delete attendance';
    const CHANGE_ATTENDANCE_STATUS = 'change attendance status';


    const LIST_SPECS = 'list specs';
    const UPDATE_SPEC = 'update spec';
    const CREATE_SPEC = 'create spec';
    const SHOW_SPEC = 'show spec';
    const DELETE_SPEC = 'delete spec';
    const CHANGE_SPEC_STATUS = 'change spec status';


    const LIST_BRANDS = 'list brands';
    const UPDATE_BRAND = 'update brand';
    const CREATE_BRAND = 'create brand';
    const SHOW_BRAND = 'show brand';
    const DELETE_BRAND = 'delete brand';
    const CHANGE_BRAND_STATUS = 'change brand status';


    const LIST_MODELS = 'list models';
    const UPDATE_MODEL = 'update model';
    const CREATE_MODEL = 'create model';
    const SHOW_MODEL = 'show model';
    const DELETE_MODEL = 'delete model';
    const CHANGE_MODEL_STATUS = 'change model status';


    const LIST_SELLOUTS = 'list sellouts';
    const UPDATE_SELLOUT = 'update sellout';
    const CREATE_SELLOUT = 'create sellout';
    const SHOW_SELLOUT = 'show sellout';
    const DELETE_SELLOUT = 'delete sellout';
    const CHANGE_SELLOUT_STATUS = 'change sellout status';
    const EXPORT_INCENTIVE = 'export incentive';

    const CHECK_SELLOUT = 'check sellout';


    const LIST_NOTIFICATIONS = 'list notifications';
    const UPDATE_NOTIFICATION = 'update notification';
    const CREATE_NOTIFICATION = 'create notification';
    const SHOW_NOTIFICATION = 'show notification';
    const DELETE_NOTIFICATION = 'delete notification';
    const CHANGE_NOTIFICATION_STATUS = 'change notification status';

    const LIST_DISPLAY = 'list display';
    const SHOW_DISPLAY = 'show display';

    const LIST_SHOP_TARGETS = 'list shop targets';

    const LIST_CHANNEL_TYPES = 'list channel types';
    const UPDATE_CHANNEL_TYPE = 'update channel type';
    const CREATE_CHANNEL_TYPE = 'create channel type';
    const SHOW_CHANNEL_TYPE = 'show channel type';
    const DELETE_CHANNEL_TYPE = 'delete channel type';
    const CHANGE_CHANNEL_TYPE_STATUS = 'change channel type status';

    // append permissions here
    const LIST_PAGES = 'list pages';
    const UPDATE_PAGE = 'update page';
    const CREATE_PAGE = 'create page';
    const SHOW_PAGE = 'show page';
    const DELETE_PAGE = 'delete page';
    const CHANGE_PAGE_STATUS = 'change page status';


    const LIST_CONTACTS = 'list contacts';
    const SHOW_CONTACT = 'show contact';
}
