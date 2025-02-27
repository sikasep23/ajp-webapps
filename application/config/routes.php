<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//route master
$route['master/project_area'] = 'project_area';
$route['master/project_area_get'] = 'project_area/project_area_get';
$route['master/project_area_edit/(:any)'] = 'project_area/project_area_edit/$1';
$route['master/project_area_delete/(:any)'] = 'project_area/project_area_delete/$1';
$route['master/project_area_update'] = 'project_area/project_area_update';
$route['master/project_area_add'] = 'project_area/project_area_add';
$route['master/project_area_code'] = 'project_area/project_area_code';
//route dept
$route['master/department'] = 'department';
$route['master/department_get'] = 'department/department_get';
$route['master/department_edit/(:any)'] = 'department/department_edit/$1';
$route['master/department_delete/(:any)'] = 'department/department_delete/$1';
$route['master/department_update'] = 'department/department_update';
$route['master/department_add'] = 'department/department_add';
$route['master/department_code'] = 'department/department_code';
//route manpower
$route['master/manpower'] = 'manpower';
$route['master/manpower_get'] = 'manpower/manpower_get';
$route['master/manpower_edit/(:any)'] = 'manpower/manpower_edit/$1';
$route['master/manpower_delete/(:any)'] = 'manpower/manpower_delete/$1';
$route['master/manpower_update'] = 'manpower/manpower_update';
$route['master/manpower_add'] = 'manpower/manpower_add';
$route['master/manpower_new'] = 'manpower/manpower_new';
$route['master/manpower_code'] = 'manpower/manpower_code';
$route['master/manpower_enable'] = 'manpower/manpower_enable';
$route['master/manpower_disable'] = 'manpower/manpower_disable';
//route equipment
$route['master/equipment_type'] = 'equipment_type';
$route['master/equipment_type_get'] = 'equipment_type/equipment_type_get';
$route['master/equipment_type_edit/(:any)'] = 'equipment_type/equipment_type_edit/$1';
$route['master/equipment_type_delete/(:any)'] = 'equipment_type/equipment_type_delete/$1';
$route['master/equipment_type_update'] = 'equipment_type/equipment_type_update';
$route['master/equipment_type_add'] = 'equipment_type/equipment_type_add';
$route['master/equipment_type_new'] = 'equipment_type/equipment_type_new';
$route['master/equipment_type_code'] = 'equipment_type/equipment_type_code';
//route manufacture
$route['master/manufacture'] = 'manufacture';
$route['master/manufacture_get'] = 'manufacture/manufacture_get';
$route['master/manufacture_edit/(:any)'] = 'manufacture/manufacture_edit/$1';
$route['master/manufacture_delete/(:any)'] = 'manufacture/manufacture_delete/$1';
$route['master/manufacture_update'] = 'manufacture/manufacture_update';
$route['master/manufacture_add'] = 'manufacture/manufacture_add';
$route['master/manufacture_new'] = 'manufacture/manufacture_new';
$route['master/manufacture_code'] = 'manufacture/manufacture_code';
//route model_unit
$route['master/modelunit'] = 'modelunit';
$route['master/modelunit_get'] = 'modelunit/modelunit_get';
$route['master/modelunit_edit/(:any)'] = 'modelunit/modelunit_edit/$1';
$route['master/modelunit_delete/(:any)'] = 'modelunit/modelunit_delete/$1';
$route['master/modelunit_update'] = 'modelunit/modelunit_update';
$route['master/modelunit_add'] = 'modelunit/modelunit_add';
$route['master/modelunit_new'] = 'modelunit/modelunit_new';
$route['master/modelunit_code'] = 'modelunit/modelunit_code';
//route pic
$route['master/pic'] = 'pic';
$route['master/pic_get'] = 'pic/pic_get';
$route['master/pic_edit/(:any)'] = 'pic/pic_edit/$1';
$route['master/pic_delete/(:any)'] = 'pic/pic_delete/$1';
$route['master/pic_update'] = 'pic/pic_update';
$route['master/pic_add'] = 'pic/pic_add';
$route['master/pic_new'] = 'pic/pic_new';
$route['master/pic_code'] = 'pic/pic_code';
//route material_caategory
$route['master/material_category'] = 'material_category';
$route['master/material_category_get'] = 'material_category/material_category_get';
$route['master/material_category_edit/(:any)'] = 'material_category/material_category_edit/$1';
$route['master/material_category_delete/(:any)'] = 'material_category/material_category_delete/$1';
$route['master/material_category_update'] = 'material_category/material_category_update';
$route['master/material_category_add'] = 'material_category/material_category_add';
$route['master/material_category_new'] = 'material_category/material_category_new';
$route['master/material_category_code'] = 'material_category/material_category_code';
//route material_group
$route['master/material_group'] = 'material_group';
$route['master/material_group_get'] = 'material_group/material_group_get';
$route['master/material_group_edit/(:any)'] = 'material_group/material_group_edit/$1';
$route['master/material_group_delete/(:any)'] = 'material_group/material_group_delete/$1';
$route['master/material_group_update'] = 'material_group/material_group_update';
$route['master/material_group_add'] = 'material_group/material_group_add';
$route['master/material_group_new'] = 'material_group/material_group_new';
$route['master/material_group_code'] = 'material_group/material_group_code';
//route master_equiptment
$route['master/m_equipment'] = 'm_equipment';
$route['master/m_equipment_get'] = 'm_equipment/m_equipment_get';
$route['master/m_equipment_edit/(:any)'] = 'm_equipment/m_equipment_edit/$1';
$route['master/m_equipment_delete/(:any)'] = 'm_equipment/m_equipment_delete/$1';
$route['master/m_equipment_update'] = 'm_equipment/m_equipment_update';
$route['master/m_equipment_add'] = 'm_equipment/m_equipment_add';
$route['master/m_equipment_new'] = 'm_equipment/m_equipment_new';
$route['master/m_equipment_code'] = 'm_equipment/m_equipment_code';
//route uom
$route['master/uom'] = 'uom';
$route['master/uom_get'] = 'uom/uom_get';
$route['master/uom_edit/(:any)'] = 'uom/uom_edit/$1';
$route['master/uom_delete/(:any)'] = 'uom/uom_delete/$1';
$route['master/uom_update'] = 'uom/uom_update';
$route['master/uom_add'] = 'uom/uom_add';
$route['master/uom_new'] = 'uom/uom_new';
$route['master/uom_code'] = 'uom/uom_code';
//route brand
$route['master/m_brand'] = 'm_brand';
$route['master/m_brand_get'] = 'm_brand/m_brand_get';
$route['master/m_brand_edit/(:any)'] = 'm_brand/m_brand_edit/$1';
$route['master/m_brand_delete/(:any)'] = 'm_brand/m_brand_delete/$1';
$route['master/m_brand_update'] = 'm_brand/m_brand_update';
$route['master/m_brand_add'] = 'm_brand/m_brand_add';
$route['master/m_brand_new'] = 'm_brand/m_brand_new';
$route['master/m_brand_code'] = 'm_brand/m_brand_code';
//route supplier group
$route['master/supplier_group'] = 'supplier_group';
$route['master/supplier_group_get'] = 'supplier_group/supplier_group_get';
$route['master/supplier_group_edit/(:any)'] = 'supplier_group/supplier_group_edit/$1';
$route['master/supplier_group_delete/(:any)'] = 'supplier_group/supplier_group_delete/$1';
$route['master/supplier_group_update'] = 'supplier_group/supplier_group_update';
$route['master/supplier_group_add'] = 'supplier_group/supplier_group_add';
$route['master/supplier_group_new'] = 'supplier_group/supplier_group_new';
$route['master/supplier_group_code'] = 'supplier_group/supplier_group_code';
//route storage location
$route['master/m_storage_location'] = 'm_storage_location';
$route['master/m_storage_location_get'] = 'm_storage_location/m_storage_location_get';
$route['master/m_storage_location_edit/(:any)'] = 'm_storage_location/m_storage_location_edit/$1';
$route['master/m_storage_location_delete/(:any)'] = 'm_storage_location/m_storage_location_delete/$1';
$route['master/m_storage_location_update'] = 'm_storage_location/m_storage_location_update';
$route['master/m_storage_location_add'] = 'm_storage_location/m_storage_location_add';
$route['master/m_storage_location_new'] = 'm_storage_location/m_storage_location_new';
$route['master/m_storage_location_code'] = 'm_storage_location/m_storage_location_code';
//route master supplier
$route['master/m_supplier'] = 'm_supplier';
$route['master/m_supplier_get'] = 'm_supplier/m_supplier_get';
$route['master/m_supplier_edit/(:any)'] = 'm_supplier/m_supplier_edit/$1';
$route['master/m_supplier_delete/(:any)'] = 'm_supplier/m_supplier_delete/$1';
$route['master/m_supplier_update'] = 'm_supplier/m_supplier_update';
$route['master/m_supplier_add'] = 'm_supplier/m_supplier_add';
$route['master/m_supplier_new'] = 'm_supplier/m_supplier_new';
$route['master/m_supplier_code'] = 'm_supplier/m_supplier_code';