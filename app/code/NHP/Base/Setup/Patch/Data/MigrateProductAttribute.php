<?php

namespace NHP\Base\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Setup\EavSetupFactory;

class MigrateProductAttribute implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * MigrateProductAttribute constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(
            Product::ENTITY,
            'activation_information',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'Activation Information',
                'input' => 'textarea',
                'required' => false,
                'sort_order' => 1,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'searchable' => false,
                'comparable' => false,
                'wysiwyg_enabled' => false,
                'is_html_allowed_on_front' => false,
                'visible_in_advanced_search' => false,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'alt_image',
            [
                'user_defined' => true,
                'type' => 'varchar',
                'label' => 'Alt Image',
                'input' => 'media_image',
                'required' => false,
                'sort_order' => 2,
                'frontend' => \Magento\Catalog\Model\Product\Attribute\Frontend\Image::class,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'used_in_product_listing' => true,
                'visible' => true,
                'visible_on_front' => true
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'custom_block',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'Custom Block',
                'input' => 'textarea',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'searchable' => false,
                'comparable' => false,
                'wysiwyg_enabled' => true,
                'is_html_allowed_on_front' => true,
                'visible_in_advanced_search' => false,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'custom_block_2',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'Custom Block 2',
                'input' => 'textarea',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'searchable' => false,
                'comparable' => false,
                'wysiwyg_enabled' => true,
                'is_html_allowed_on_front' => true,
                'visible_in_advanced_search' => false,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'custom_label',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Nowy?',
                'input' => 'select',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'is_html_allowed_on_front' => true,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'default' => 0,
                'option' => [
                    'values' => [
                        0 => 'Nowość'
                    ]
                ]
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'Deal',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Special Deal',
                'input' => 'boolean',
                'sort_order' => 0,
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'required' => false,
                'is_html_allowed_on_front' => false,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'dimension',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'Dimensions',
                'input' => 'textarea',
                'required' => false,
                'sort_order' => 1,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_comparable' => true,
                'wysiwyg_enabled' => true,
                'is_searchable' => true,
                'search_weight' => '1',
                'is_used_for_promo_rules' => true,
                'is_visible_on_front' => true,
                'is_used_in_grid' => false,
                'visible_in_advanced_search' => false,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'dostawca',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Dostawca',
                'input' => 'select',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'is_html_allowed_on_front' => true,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'option' => [
                    'values' => [
                        0 => 'Hanh',
                        1 => 'Khanh Chi',
                        2 => 'Thanh'
                    ]
                ]
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'enable_googlecheckout',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Is Product Available for Purchase with Google Checkout',
                'input' => 'select',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_for_promo_rules' => true,
                'is_visible_on_front' => false,
                'is_used_in_grid' => false,
                'visible_in_advanced_search' => false,
                'default' => 0,
                'option' => [
                    'values' => [
                        0 => 'Yes',
                        1 => 'No'
                    ]
                ]
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'Featured',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Featured Product',
                'input' => 'boolean',
                'sort_order' => 0,
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'required' => false,
                'is_html_allowed_on_front' => false,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'finish',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'Finish',
                'input' => 'text',
                'required' => false,
                'sort_order' => 1,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_searchable' => true,
                'search_weight' => '1',
                'is_used_for_promo_rules' => true,
                'is_visible_on_front' => true,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'gender',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Gender',
                'input' => 'select',
                'required' => false,
                'sort_order' => 1,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_for_promo_rules' => true,
                'default' => 0,
                'option' => [
                    'values' => [
                        0 => 'Boys',
                        1 => 'Girls',
                        2 => 'Mens',
                        3 => 'Womens',
                    ]
                ]
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'Hot',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Hot Product',
                'input' => 'boolean',
                'sort_order' => 0,
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'required' => false,
                'is_html_allowed_on_front' => false,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'in_depth',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'In Depth',
                'input' => 'textarea',
                'required' => false,
                'sort_order' => 1,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'is_comparable' => true,
                'is_searchable' => true,
                'search_weight' => '1',
                'is_used_for_promo_rules' => true,
                'is_visible_on_front' => true,
                'is_used_in_grid' => false,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'is_imported',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'In feed',
                'input' => 'select',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'used_in_product_listing' => true,
                'default' => 1,
                'option' => [
                    'values' => [
                        0 => 'Yes',
                        1 => 'No'
                    ]
                ]
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'is_recurring',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Enable Recurring Profile',
                'input' => 'select',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'default' => 1,
                'option' => [
                    'values' => [
                        0 => 'Yes',
                        1 => 'No'
                    ]
                ]
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'kolor',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'Kolor',
                'input' => 'text',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'is_used_in_grid' => true,
                'is_filterable_in_grid' => true,
                'is_html_allowed_on_front' => true,
                'is_visible_on_front' => true,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'model',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'Model',
                'input' => 'text',
                'required' => false,
                'sort_order' => 1,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_searchable' => true,
                'search_weight' => '1',
                'is_comparable' => true,
                'is_used_for_promo_rules' => true,
                'is_visible_on_front' => true,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'model_produktu',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'Model:',
                'input' => 'text',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'is_html_allowed_on_front' => true,
                'is_visible_on_front' => true,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'recurring_profile',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'Recurring Payment Profile',
                'input' => 'text',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'room',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Room',
                'input' => 'select',
                'required' => false,
                'sort_order' => 1,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_searchable' => true,
                'search_weight' => '1',
                'is_comparable' => true,
                'is_used_for_promo_rules' => true,
                'option' => [
                    'values' => [
                        0 => 'Bathroom',
                        1 => 'Bedroom',
                        2 => 'Dining Room',
                        3 => 'Kids Room',
                        4 => 'Kitchen',
                        5 => 'Living Room',
                    ]
                ]
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'rozmiar',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'Rozmiar',
                'input' => 'text',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => true,
                'is_filterable_in_grid' => true,
                'is_html_allowed_on_front' => true,
                'is_visible_on_front' => true,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'shape',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'shape',
                'input' => 'text',
                'required' => false,
                'sort_order' => 1,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'is_searchable' => true,
                'search_weight' => '1',
                'is_comparable' => true,
                'is_used_for_promo_rules' => true,
                'is_visible_on_front' => true,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'shirt_size',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Shirt Size',
                'input' => 'select',
                'required' => false,
                'sort_order' => 1,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_searchable' => true,
                'search_weight' => '1',
                'is_comparable' => true,
                'is_used_for_promo_rules' => true,
                'option' => [
                    'values' => [
                        0 => 'Small',
                        1 => 'Medium',
                        2 => 'Large',
                    ]
                ]
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'shoe_size',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Shoe Size',
                'input' => 'select',
                'required' => false,
                'sort_order' => 1,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_searchable' => true,
                'search_weight' => '1',
                'is_used_for_promo_rules' => true,
                'option' => [
                    'values' => [
                        0 => '3',
                        1 => '4',
                        2 => '5',
                        3 => '6',
                        4 => '7',
                        5 => '8',
                        6 => '9',
                        7 => '10',
                        8 => '11',
                        9 => '12',
                    ]
                ]
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'shoe_type',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Shoe Type',
                'input' => 'select',
                'required' => false,
                'sort_order' => 1,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_searchable' => true,
                'search_weight' => '1',
                'is_comparable' => true,
                'is_filterable' => '1',
                'is_filterable_in_search' => true,
                'is_used_for_promo_rules' => true,
                'option' => [
                    'values' => [
                        0 => 'Biking',
                        1 => 'Dress',
                        2 => 'Golf Shoes',
                        3 => 'High Heels',
                        4 => 'Misc',
                        5 => 'Running',
                        6 => 'Sandal',
                        7 => 'Tennis',
                    ]
                ]
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'sw_featured',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Is Featured',
                'input' => 'boolean',
                'sort_order' => 0,
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'required' => false,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'telefon',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'tel',
                'input' => 'text',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => true,
                'is_filterable_in_grid' => true,
                'is_html_allowed_on_front' => true,
                'used_for_sort_by' => true,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'ts_country_of_origin',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Country of Origin',
                'input' => 'select',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'option' => [
                    'values' => $this->getCountry()
                ]
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'ts_dimensions_height',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'Item Height',
                'input' => 'text',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'ts_dimensions_length',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'Item Length',
                'input' => 'text',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'ts_dimensions_width',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'Item Width',
                'input' => 'text',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'ts_hs_code',
            [
                'user_defined' => true,
                'type' => 'text',
                'label' => 'HS Code',
                'input' => 'text',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'ts_packaging_id',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Packaging Name',
                'input' => 'select',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'default' => 0,
                'option' => [
                    'values' => [
                        0 => '-- Please Select --',
                    ]
                ]
            ]
        );
        $eavSetup->addAttribute(
            Product::ENTITY,
            'ts_packaging_type',
            [
                'user_defined' => true,
                'type' => 'int',
                'label' => 'Packaging Type',
                'input' => 'select',
                'required' => false,
                'sort_order' => 0,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'option' => [
                    'values' => [
                        0 => 'None',
                        1 => 'Pre-packaged',
                        2 => 'Assigned',
                    ]
                ]
            ]
        );
    }

    /**
     * @return string[]
     */
    protected function getCountry()
    {
        return [
            0 => '',
            1 => 'Afghanistan',
            2 => 'Åland Islands',
            3 => 'Albania',
            4 => 'Algeria',
            5 => 'American Samoa',
            6 => 'Andorra',
            7 => 'Angola',
            8 => 'Antarctica',
            9 => 'Antigua & Barbuda',
            10 => 'Argentina',
            11 => 'Armenia',
            12 => 'Australia',
            13 => 'Austria',
            14 => 'Azerbaijan',
            15 => 'Bahamas',
            16 => 'Bahrain',
            17 => 'Bangladesh',
            18 => 'Barbados',
            19 => 'Belarus',
            20 => 'Belgium',
            21 => 'Belize',
            22 => 'Benin',
            23 => 'Bhutan',
            24 => 'Bolivia',
            25 => 'Bosnia & Herzegovina',
            26 => 'Botswana',
            27 => 'Bouvet Island',
            28 => 'Brazil',
            29 => 'British Indian Ocean Territory',
            30 => 'British Virgin Islands',
            31 => 'Brunei',
            32 => 'Bulgaria',
            33 => 'Burkina Faso',
            34 => 'Burundi',
            35 => 'Cambodia',
            36 => 'Cameroon',
            37 => 'Canada',
            38 => 'Cape Verde',
            39 => 'Cayman Islands',
            40 => 'Central African Republic',
            41 => 'Chad',
            42 => 'Chile',
            43 => 'China',
            44 => 'Christmas Island',
            45 => 'Cocos (Keeling) Islands',
            46 => 'Colombia',
            47 => 'Comoros',
            48 => 'Congo - Brazzaville',
            49 => 'Congo - Kinshasa',
            50 => 'Cook Islands',
            51 => 'Costa Rica',
            52 => 'Côte d’Ivoire',
            53 => 'Croatia',
            54 => 'Cuba',
            55 => 'Cyprus',
            56 => 'Czech Republic',
            57 => 'Denmark',
            58 => 'Djibouti',
            59 => 'Dominican Republic',
            60 => 'Ecuador',
            61 => 'Egypt',
            62 => 'El Salvador',
            63 => 'Equatorial Guinea',
            64 => 'Eritrea',
            65 => 'Estonia',
            66 => 'Ethiopia',
            67 => 'Falkland Islands',
            68 => 'Faroe Islands',
            69 => 'Fiji',
            70 => 'Finland',
            71 => 'France',
            72 => 'French Guiana',
            73 => 'French Polynesia',
            74 => 'French Southern Territories',
            75 => 'Gabon',
            76 => 'Gambia',
            77 => 'Georgia',
            78 => 'Germany',
            79 => 'Ghana',
            80 => 'Greece',
            81 => 'Greenland',
            82 => 'Grenada',
            83 => 'Guam',
            84 => 'Guatemala',
            85 => 'Guernsey',
            86 => 'Guinea',
            87 => 'Guinea-Bissau',
            88 => 'Guyana',
            89 => 'Haiti',
            90 => 'Heard & McDonald Islands',
            91 => 'Honduras',
            92 => 'Hong Kong SAR China',
            93 => 'Hungary',
            94 => 'Iceland',
            95 => 'India',
            96 => 'Indonesia',
            97 => 'Iran',
            98 => 'Iraq',
            99 => 'Ireland',
            100 => 'Isle of Man',
            101 => 'Israel',
            102 => 'Italy',
            103 => 'Jamaica',
            104 => 'Japan',
            105 => 'Jersey',
            106 => 'Jordan',
            107 => 'Kazakhstan',
            108 => 'Kenya',
            109 => 'Kiribati',
            110 => 'Kuwait',
            111 => 'Kyrgyzstan',
            112 => 'Laos',
            113 => 'Latvia',
            114 => 'Lebanon',
            115 => 'Lesotho',
            116 => 'Liberia',
            117 => 'Libya',
            118 => 'Liechtenstein',
            119 => 'Lithuania',
            120 => 'Luxembourg',
            121 => 'Macau SAR China',
            122 => 'Macedonia',
            123 => 'Madagascar',
            124 => 'Malawi',
            125 => 'Malaysia',
            126 => 'Maldives',
            127 => 'Mali',
            128 => 'Malta',
            129 => 'Marshall Islands',
            130 => 'Martinique',
            131 => 'Mauritania',
            132 => 'Mauritius',
            133 => 'Mayotte',
            134 => 'Mexico',
            135 => 'Micronesia',
            136 => 'Moldova',
            137 => 'Monaco',
            138 => 'Mongolia',
            139 => 'Montenegro',
            140 => 'Morocco',
            141 => 'Mozambique',
            142 => 'Myanmar (Burma)',
            143 => 'Namibia',
            144 => 'Nepal',
            145 => 'Netherlands',
            146 => 'Netherlands Antilles',
            147 => 'New Caledonia',
            148 => 'New Zealand',
            149 => 'Nicaragua',
            150 => 'Niger',
            151 => 'Nigeria',
            152 => 'Norfolk Island',
            153 => 'Northern Mariana Islands',
            154 => 'North Korea',
            155 => 'Norway',
            156 => 'Oman',
            157 => 'Pakistan',
            158 => 'Palestinian Territories',
            159 => 'Panama',
            160 => 'Papua New Guinea',
            161 => 'Paraguay',
            162 => 'Peru',
            163 => 'Philippines',
            164 => 'Poland',
            165 => 'Portugal',
            166 => 'Qatar',
            167 => 'Réunion',
            168 => 'Romania',
            169 => 'Russia',
            170 => 'Rwanda',
            171 => 'Samoa',
            172 => 'San Marino',
            173 => 'São Tomé & Príncipe',
            174 => 'Saudi Arabia',
            175 => 'Senegal',
            176 => 'Serbia',
            177 => 'Seychelles',
            178 => 'Sierra Leone',
            179 => 'Singapore',
            180 => 'Slovakia',
            181 => 'Slovenia',
            182 => 'Solomon Islands',
            183 => 'Somalia',
            184 => 'South Africa',
            185 => 'South Georgia & South Sandwich Islands',
            186 => 'South Korea',
            187 => 'Spain',
            188 => 'Sri Lanka',
            189 => 'St. Barthélemy',
            190 => 'St. Helena',
            191 => 'St. Kitts & Nevis',
            192 => 'St. Lucia',
            193 => 'St. Martin',
            194 => 'St. Pierre & Miquelon',
            195 => 'St. Vincent & Grenadines',
            196 => 'Sudan',
            197 => 'Suriname',
            198 => 'Svalbard & Jan Mayen',
            199 => 'Swaziland',
            200 => 'Sweden',
            201 => 'Switzerland',
            202 => 'Syria',
            203 => 'Taiwan, Province of China',
            204 => 'Tajikistan',
            205 => 'Tanzania',
            206 => 'Thailand',
            207 => 'Timor-Leste',
            208 => 'Togo',
            209 => 'Tokelau',
            210 => 'Tonga',
            211 => 'Trinidad & Tobago',
            212 => 'Tunisia',
            213 => 'Turkey',
            214 => 'Turkmenistan',
            215 => 'Turks & Caicos Islands',
            216 => 'Tuvalu',
            217 => 'Uganda',
            218 => 'Ukraine',
            219 => 'United Arab Emirates',
            220 => 'United Kingdom',
            221 => 'United States',
            222 => 'Uruguay',
            223 => 'U.S. Outlying Islands',
            224 => 'U.S. Virgin Islands',
            225 => 'Uzbekistan',
            226 => 'Vanuatu',
            227 => 'Vatican City',
            228 => 'Venezuela',
            229 => 'Vietnam',
            230 => 'Wallis & Futuna',
            231 => 'Western Sahara',
            232 => 'Yemen',
            233 => 'Zambia',
            234 => 'Zimbabwe',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
