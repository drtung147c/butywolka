<?php
namespace NHP\Base\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_URL_PATH = "import/general/url_path";

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getUrlPath()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_URL_PATH, ScopeInterface::SCOPE_WEBSITE);
    }
}
