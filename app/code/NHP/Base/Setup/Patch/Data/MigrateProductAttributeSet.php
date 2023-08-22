<?php

namespace NHP\Base\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Api\Data\ProductAttributeInterface;

/**
 * Class MigrateProductAttributeSet
 * @package NHP\Base\Setup\Patch\Data
 */
class MigrateProductAttributeSet implements DataPatchInterface
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
        //Create Attribute Set: Migration_Default, Migration_Shoes
        $this->createAttributeSet($eavSetup);
        //Create Attribute Set Group: Migration_Default
        $this->createAttributeGroupMigrationDefault($eavSetup);
        //Create Attribute Set Group: Migration_Shoes
        $this->createAttributeGroupMigrationShoes($eavSetup);
        //Add Attribute to Attribute Set Default
        $this->addAttrToAttrGroupDefault($eavSetup);
        //Add Attribute to Attribute Set Migration_Default
        $this->addAttrToAttrGroupMigrationDefault($eavSetup);
        //Add Attribute to Attribute Set Migration_Shoes
        $this->addAttrToAttrGroupMigrationShoes($eavSetup);
    }

    /**
     * @param EavSetup $eavSetup
     */
    private function createAttributeSet(EavSetup $eavSetup)
    {
        $eavSetup->addAttributeSet(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            'Migration_Default'
        );
        $eavSetup->addAttributeSet(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            'Migration_Shoes'
        );
    }

    /**
     * @param EavSetup $eavSetup
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function createAttributeGroupMigrationDefault(EavSetup $eavSetup)
    {
        $attrSetGroupDefaultId = $eavSetup->getAttributeSetId(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            'Migration_Default'
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'General',
            0
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Migration_Prices',
            1
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Migration_Meta Information',
            2
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Migration_Images',
            3
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Migration_Description',
            4
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Migration_Design',
            5
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Migration_Recurring Profile',
            6
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Migration_Gift Options',
            7
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Bundle Items',
            8
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Schedule Design Update',
            9
        );
    }

    /**
     * @param EavSetup $eavSetup
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function createAttributeGroupMigrationShoes(EavSetup $eavSetup)
    {
        $attrSetGroupDefaultId = $eavSetup->getAttributeSetId(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            'Migration_Shoes'
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Bundle Items',
            0
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'General',
            1
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Migration_Prices',
            2
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Migration_Meta Information',
            3
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Migration_Images',
            4
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Migration_Description',
            5
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Migration_Shoe Attributes',
            6
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Migration_Design',
            7
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Migration_Recurring Profile',
            8
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Migration_Gift Options',
            9
        );
        $eavSetup->addAttributeGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $attrSetGroupDefaultId,
            'Schedule Design Update',
            10
        );
    }

    /**
     * @param EavSetup $eavSetup
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function addAttrToAttrGroupDefault(EavSetup $eavSetup)
    {
        $setId = $eavSetup->getAttributeSetId(ProductAttributeInterface::ENTITY_TYPE_CODE, 'Default');
        //Default: General group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'custom_label',
            2
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'model_produktu',
            9
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'kolor',
            10
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'rozmiar',
            11
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'telefon',
            12
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'ts_packaging_id',
            14
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'sw_featured',
            18
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'ts_hs_code',
            19
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'ts_country_of_origin',
            21
        );
        //Default: Images group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Images',
            'alt_image',
            7
        );
    }

    /**
     * @param EavSetup $eavSetup
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function addAttrToAttrGroupMigrationDefault(EavSetup $eavSetup)
    {
        $setId = $eavSetup->getAttributeSetId(ProductAttributeInterface::ENTITY_TYPE_CODE, 'Migration_Default');
        //Migration_Default: General group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'price',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'name',
            1
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'sku',
            2
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'weight',
            3
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'status',
            4
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'tax_class_id',
            5
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'url_key',
            6
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'visibility',
            7
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'news_from_date',
            8
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'news_to_date',
            9
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'price_type',
            10
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'sw_featured',
            11
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'sku_type',
            12
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'weight_type',
            13
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'quantity_and_stock_status',
            14
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'category_ids',
            15
        );
        //Migration_Default: Migration_Prices group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Prices',
            'tier_price',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Prices',
            'special_price',
            1
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Prices',
            'special_from_date',
            2
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Prices',
            'special_to_date',
            3
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Prices',
            'price_view',
            4
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Prices',
            'enable_googlecheckout',
            5
        );
        //Migration_Default: Migration_Meta Information group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Meta Information',
            'meta_title',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Meta Information',
            'meta_keyword',
            1
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Meta Information',
            'meta_description',
            2
        );
        //Migration_Default: Migration_Images group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Images',
            'thumbnail',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Images',
            'small_image',
            1
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Images',
            'gallery',
            2
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Images',
            'swatch_image',
            3
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Images',
            'image',
            4
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Images',
            'media_gallery',
            5
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Images',
            'alt_image',
            6
        );
        //Migration_Default: Migration_Description group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Description',
            'description',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Description',
            'short_description',
            1
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Description',
            'model_produktu',
            2
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Description',
            'rozmiar',
            3
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Description',
            'dostawca',
            4
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Description',
            'telefon',
            5
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Description',
            'kolor',
            6
        );
        //Migration_Shoes: Migration_Design group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Design',
            'custom_design_from',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Design',
            'custom_design_to',
            1
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Design',
            'options_container',
            2
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Design',
            'page_layout',
            3
        );
        //Migration_Default: Migration_Recurring Profile group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Recurring Profile',
            'is_recurring',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Recurring Profile',
            'recurring_profile',
            1
        );
        //Migration_Default: Migration_Gift Options group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Gift Options',
            'gift_message_available',
            0
        );
        //Migration_Default: Bundle Items group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Bundle Items',
            'shipment_type',
            0
        );
        //Migration_Default: Schedule Design Update group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Schedule Design Update',
            'custom_design',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Schedule Design Update',
            'custom_layout',
            1
        );
    }

    /**
     * @param EavSetup $eavSetup
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function addAttrToAttrGroupMigrationShoes(EavSetup $eavSetup)
    {
        $setId = $eavSetup->getAttributeSetId(ProductAttributeInterface::ENTITY_TYPE_CODE, 'Migration_Shoes');
        //Migration_Shoes: Bundle Items group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Bundle Items',
            'shipment_type',
            0
        );
        //Migration_Shoes: General group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'price',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'name',
            1
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'model',
            2
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'sku',
            3
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'weight',
            4
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'manufacturer',
            5
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'status',
            6
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'tax_class_id',
            7
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'url_key',
            8
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'visibility',
            9
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'news_from_date',
            10
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'news_to_date',
            11
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'price_type',
            12
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'sku_type',
            13
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'weight_type',
            14
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'is_imported',
            15
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'country_of_manufacture',
            16
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'Featured',
            17
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'Deal',
            18
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'Hot',
            19
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'category_ids',
            20
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'General',
            'custom_label',
            21
        );
        //Migration_Shoes: Migration_Prices group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Prices',
            'cost',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Prices',
            'tier_price',
            1
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Prices',
            'special_price',
            2
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Prices',
            'special_from_date',
            3
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Prices',
            'special_to_date',
            4
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Prices',
            'price_view',
            5
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Prices',
            'enable_googlecheckout',
            6
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Prices',
            'msrp_display_actual_price_type',
            7
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Prices',
            'msrp',
            8
        );
        //Migration_Shoes: Migration_Meta Information group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Meta Information',
            'meta_title',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Meta Information',
            'meta_keyword',
            1
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Meta Information',
            'meta_description',
            2
        );
        //Migration_Shoes: Migration_Images group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Images',
            'swatch_image',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Images',
            'alt_image',
            1
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Images',
            'thumbnail',
            2
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Images',
            'small_image',
            3
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Images',
            'image',
            4
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Images',
            'gallery',
            5
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Images',
            'media_gallery',
            6
        );
        //Migration_Shoes: Migration_Description group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Description',
            'short_description',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Description',
            'description',
            1
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Description',
            'in_depth',
            2
        );
        //Migration_Shoes: Migration_Shoe Attributes group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Shoe Attributes',
            'shoe_size',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Shoe Attributes',
            'shoe_type',
            1
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Shoe Attributes',
            'color',
            2
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Shoe Attributes',
            'gender',
            3
        );
        //Migration_Shoes: Migration_Design group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Design',
            'custom_design_from',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Design',
            'custom_design_to',
            1
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Design',
            'options_container',
            2
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Design',
            'page_layout',
            3
        );
        //Migration_Shoes: Migration_Recurring Profile group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Recurring Profile',
            'is_recurring',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Recurring Profile',
            'recurring_profile',
            1
        );
        //Migration_Shoes: Migration_Gift Options group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Migration_Gift Options',
            'gift_message_available',
            0
        );
        //Migration_Shoes: Schedule Design Update group
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Schedule Design Update',
            'custom_design',
            0
        );
        $eavSetup->addAttributeToGroup(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            $setId,
            'Schedule Design Update',
            'custom_layout',
            1
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [
            MigrateProductAttribute::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
