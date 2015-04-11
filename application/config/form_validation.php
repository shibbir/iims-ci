<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
    'login' => array(
        array(
            'field' => 'UserName',
            'label' => 'Username',
            'rules' => 'required'
        ),
        array(
            'field' => 'Password',
            'label' => 'Password',
            'rules' => 'trim|required|xss_clean|sha1'
        )
    ),
    'add_user' => array(
        array(
            'field' => 'UserName',
            'label' => 'Username',
            'rules' => 'trim|required|min_length[2]|max_length[25]|is_unique[tbl_user.UserName]|xss_clean'
        ),
        array(
            'field' => 'Password',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[2]|max_length[25]|xss_clean|sha1'
        ),
        array(
            'field' => 'Name',
            'label' => 'Name',
            'rules' => 'trim|required|min_length[1]|xss_clean'
        ),
        array(
            'field' => 'Contact',
            'label' => 'Contact',
            'rules' => 'trim|required|max_length[20]|numeric|xss_clean'
        ),
        array(
            'field' => 'Address',
            'label' => 'Address',
            'rules' => 'trim|required|max_length[200]|xss_clean'
        )
    ),
	'edit_user' => array(
		array(
			'field' => 'UserName',
			'label' => 'Username',
			'rules' => 'trim|required|min_length[2]|max_length[25]|xss_clean'
		),
		array(
			'field' => 'Name',
			'label' => 'Name',
			'rules' => 'trim|required|min_length[2]|xss_clean'
		),
		array(
			'field' => 'Contact',
			'label' => 'Contact',
			'rules' => 'trim|required|max_length[20]|numeric|xss_clean'
		),
		array(
			'field' => 'Address',
			'label' => 'Address',
			'rules' => 'trim|required|max_length[200]|xss_clean'
		)
	),
	'edit_user_password' => array(
		array(
			'field' => 'CurrentPassword',
			'label' => 'Current password',
			'rules' => 'trim|required|xss_clean|sha1'
		),
		array(
			'field' => 'NewPassword',
			'label' => 'New password',
			'rules' => 'trim|required|min_length[5]|max_length[25]|xss_clean|sha1'
		),
		array(
			'field' => 'RepeatNewPassword',
			'label' => 'Repeat new password',
			'rules' => 'trim|required|min_length[5]|max_length[25]|matches[NewPassword]|xss_clean|sha1'
		)
	),
	'add_customer' => array(
		array(
			'field' => 'CustomerName',
			'label' => 'Customer Name',
			'rules' => 'trim|required|min_length[2]|max_length[25]|xss_clean'
		),
		array(
			'field' => 'Contact',
			'label' => 'Contact',
			'rules' => 'trim|required|max_length[20]|is_unique[tbl_customer.Contact]|xss_clean'
		),
		array(
			'field' => 'Address',
			'label' => 'Address',
			'rules' => 'trim|required|max_length[300]|xss_clean'
		)
	),
	'edit_customer' => array(
		array(
			'field' => 'CustomerName',
			'label' => 'Customer Name',
			'rules' => 'trim|required|min_length[2]|max_length[25]|xss_clean'
		),
		array(
			'field' => 'Contact',
			'label' => 'Contact',
			'rules' => 'trim|required|max_length[20]|xss_clean'
		),
		array(
			'field' => 'Address',
			'label' => 'Address',
			'rules' => 'trim|required|max_length[300]|xss_clean'
		)
	),
	'add_category' => array(
		array(
			'field' => 'CategoryName',
			'label' => 'Category Name',
			'rules' => 'trim|required|min_length[2]|max_length[30]|is_unique[tbl_inventory_category.CategoryName]|xss_clean'
		),
		array(
			'field' => 'Description',
			'label' => 'Category Description',
			'rules' => 'trim|min_length[5]|max_length[300]|xss_clean'
		)
	),
	'edit_category' => array(
		array(
			'field' => 'CategoryName',
			'label' => 'Category Name',
			'rules' => 'trim|required|min_length[2]|max_length[30]|xss_clean'
		),
		array(
			'field' => 'Description',
			'label' => 'Category Description',
			'rules' => 'trim|min_length[5]|max_length[300]|xss_clean'
		)
	),
	'add_inventory' => array(
		array(
			'field' => 'Title',
			'label' => 'Product title',
			'rules' => 'trim|required|min_length[2]|max_length[100]|is_unique[tbl_inventory.Title]|xss_clean'
		),
		array(
			'field' => 'CategoryID',
			'label' => 'Category',
			'rules' => 'trim|xss_clean'
		),
		array(
			'field' => 'Quantity',
			'label' => 'Quantity',
			'rules' => 'trim|required|is_natural_no_zero|xss_clean'
		),
		array(
			'field' => 'UnitPrice',
			'label' => 'Unit Price',
			'rules' => 'trim|required|is_natural_no_zero|xss_clean'
		),
		array(
			'field' => 'Description',
			'label' => 'Description',
			'rules' => 'trim|max_length[300]|xss_clean'
		),
		array(
			'field' => 'WarrantyInYear',
			'label' => 'Warranty In Year',
			'rules' => 'trim|xss_clean'
		),
		array(
			'field' => 'WarrantyInMonth',
			'label' => 'Warranty In Month',
			'rules' => 'trim|xss_clean'
		),
		array(
			'field' => 'ImageName',
			'label' => 'Image',
			'rules' => 'trim|xss_clean'
		)
	),
	'edit_inventory' => array(
		array(
			'field' => 'Title',
			'label' => 'Title',
			'rules' => 'trim|required|min_length[2]|max_length[100]|xss_clean'
		),
		array(
			'field' => 'CategoryID',
			'label' => 'Category',
			'rules' => 'trim|xss_clean'
		),
		array(
			'field' => 'Quantity',
			'label' => 'Quantity',
			'rules' => 'trim|required|is_natural_no_zero|xss_clean'
		),
		array(
			'field' => 'UnitPrice',
			'label' => 'Unit Price',
			'rules' => 'trim|required|is_natural_no_zero|xss_clean'
		),
		array(
			'field' => 'Description',
			'label' => 'Description',
			'rules' => 'trim|max_length[300]|xss_clean'
		),
		array(
			'field' => 'WarrantyInYear',
			'label' => 'Warranty In Year',
			'rules' => 'trim|is_natural|xss_clean'
		),
		array(
			'field' => 'WarrantyInMonth',
			'label' => 'Warranty In Month',
			'rules' => 'trim|is_natural|less_than[12]|xss_clean'
		),
		array(
			'field' => 'ImageName',
			'label' => 'Image',
			'rules' => 'trim|xss_clean'
		),
		array(
			'field' => 'Status',
			'label' => 'Status',
			'rules' => 'trim|xss_clean'
		)
	),
	'add_invoice' => array(
		array(
			'field' => 'Date',
			'label' => 'Date',
			'rules' => 'required|xss_clean'
		),
		array(
			'field' => 'ProductID',
			'label' => 'Product Information',
			'rules' => 'required|xss_clean'
		),
		array(
			'field' => 'SerialNumber',
			'label' => 'Product Serial',
			'rules' => 'xss_clean'
		),
		array(
			'field' => 'Customer',
			'label' => 'Customer Information',
			'rules' => 'trim|required|min_length[2]|max_length[25]|xss_clean'
		),
		array(
			'field' => 'CustomerNameForCashSale',
			'label' => 'Customer Name',
			'rules' => 'trim|xss_clean'
		),
		array(
			'field' => 'CustomerMobileForCashSale',
			'label' => 'Customer Mobile',
			'rules' => 'trim|xss_clean'
		),
		array(
			'field' => 'ServiceCharge',
			'label' => 'Service Charge',
			'rules' => 'trim|numeric|xss_clean'
		),
		array(
			'field' => 'TotalDiscount',
			'label' => 'Total Discount',
			'rules' => 'trim|numeric|xss_clean'
		),
		array(
			'field' => 'VAT',
			'label' => 'VAT',
			'rules' => 'trim|numeric|xss_clean'
		),
		array(
			'field' => 'GrandTotal',
			'label' => 'Grand Total',
			'rules' => 'trim|numeric|xss_clean'
		),
	),
	'add_organization' => array(
		array(
			'field' => 'Title',
			'label' => 'Organization Title',
			'rules' => 'required|trim|min_length[5]|max_length[50]|xss_clean'
		),
		array(
			'field' => 'SubTitle',
			'label' => 'Organization Sub Title',
			'rules' => 'trim|min_length[5]|max_length[100]|xss_clean'
		),
		array(
			'field' => 'Mobile',
			'label' => 'Mobile',
			'rules' => 'required|trim|min_length[5]|xss_clean'
		),
		array(
			'field' => 'Phone',
			'label' => 'Phone',
			'rules' => 'trim|min_length[5]|xss_clean'
		),
		array(
			'field' => 'Description',
			'label' => 'Organization Description',
			'rules' => 'trim|min_length[5]|max_length[300]|xss_clean'
		),
		array(
			'field' => 'Address',
			'label' => 'Organization Address',
			'rules' => 'required|trim|min_length[5]|max_length[300]|xss_clean'
		),
		array(
			'field' => 'Email',
			'label' => 'Organization Email',
			'rules' => 'trim|max_length[100]|valid_email|xss_clean'
		),
		array(
			'field' => 'Website',
			'label' => 'Organization Website',
			'rules' => 'trim|min_length[5]|max_length[50]|xss_clean'
		)
	),
	'edit_organization' => array(
		array(
			'field' => 'Title',
			'label' => 'Organization Title',
			'rules' => 'required|trim|min_length[5]|max_length[50]|xss_clean'
		),
		array(
			'field' => 'SubTitle',
			'label' => 'Organization Sub Title',
			'rules' => 'trim|min_length[5]|max_length[100]|xss_clean'
		),
		array(
			'field' => 'Mobile',
			'label' => 'Mobile',
			'rules' => 'required|trim|min_length[5]|xss_clean'
		),
		array(
			'field' => 'Phone',
			'label' => 'Phone',
			'rules' => 'trim|min_length[5]|xss_clean'
		),
		array(
			'field' => 'Address',
			'label' => 'Organization Address',
			'rules' => 'required|trim|min_length[5]|max_length[300]|xss_clean'
		),
		array(
			'field' => 'Description',
			'label' => 'Organization Description',
			'rules' => 'trim|min_length[5]|max_length[300]|xss_clean'
		),
		array(
			'field' => 'Email',
			'label' => 'Organization Email',
			'rules' => 'trim|max_length[100]|valid_email|xss_clean'
		),
		array(
			'field' => 'Website',
			'label' => 'Organization Website',
			'rules' => 'trim|min_length[5]|max_length[50]|xss_clean'
		)
	)
);