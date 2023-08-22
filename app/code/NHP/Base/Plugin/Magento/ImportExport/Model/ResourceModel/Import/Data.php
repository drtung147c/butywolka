<?php

namespace NHP\Base\Plugin\Magento\ImportExport\Model\ResourceModel\Import;

use NHP\Base\Helper\Data as HelperData;
use Psr\Log\LoggerInterface;

/**
 * Class Data
 * @package NHP\Base\Plugin\Magento\ImportExport\Model\ResourceModel\Import
 */
class Data
{
    /**
     * @var HelperData
     */
    protected $_helperData;
    /**
     * @var LoggerInterface
     */
    protected $_logger;

    protected $_images = [
        'base_image',
        'small_image',
        'thumbnail_image',
        'image',
        'thumbnail'
    ];

    protected $_additionalImages = [
        'additional_images',
        '_media_image'
    ];

    protected $_productImportNum = 0;

    /**
     * Data constructor.
     * @param HelperData $helperData
     * @param LoggerInterface $logger
     */
    public function __construct(
        HelperData $helperData,
        LoggerInterface $logger
    ) {
        $this->_helperData = $helperData;
        $this->_logger = $logger;
    }

    /**
     * @param \Magento\ImportExport\Model\ResourceModel\Import\Data $subject
     * @param $result
     * @return array|null
     */
    public function afterGetNextBunch(
        \Magento\ImportExport\Model\ResourceModel\Import\Data $subject,
        $result
    ) {
        if ($result != null) {
            $this->_productImportNum += count($result);
            $this->_logger->debug("Import product start (count): {$this->_productImportNum}");
        }

        return $result;
    }

    /**
     * @param \Magento\ImportExport\Model\ResourceModel\Import\Data $subject
     * @param $entity
     * @param $behavior
     * @param array $data
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function beforeSaveBunch(
        \Magento\ImportExport\Model\ResourceModel\Import\Data $subject,
        $entity,
        $behavior,
        array $data
    ) {
        if ($entity == 'catalog_product') {
            if ($data != null) {
                $rowData = [];
                foreach ($data as $key => $value) {
                    $rowData[$key] = $this->prepareData($value);
                }
                if (!empty($rowData)) {
                    $data = $rowData;
                }
            }
        }

        return [$entity, $behavior, $data];
    }

    /**
     * @param array $dataRow
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function prepareData(array $dataRow)
    {
        foreach ($this->_images as $imageKey) {
            if (isset($dataRow[$imageKey]) && !empty($dataRow[$imageKey])) {
                $dataRow[$imageKey] = $this->_helperData->getUrlPath() . $dataRow[$imageKey];
            }
        }
        foreach ($this->_additionalImages as $additionalImageKey) {
            if (isset($dataRow[$additionalImageKey]) && !empty($dataRow[$additionalImageKey])) {
                $imageNames = explode(',', $dataRow[$additionalImageKey]);
                if ($imageNames) {
                    $images = [];
                    foreach ($imageNames as $imageName) {
                        $images[] = $this->_helperData->getUrlPath() . $imageName;
                    }
                    $dataRow[$additionalImageKey] = implode(',', $images);
                }
            }
        }

        return $dataRow;
    }
}
