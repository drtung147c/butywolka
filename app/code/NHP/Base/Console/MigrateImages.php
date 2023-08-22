<?php

namespace NHP\Base\Console;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\HTTP\ClientFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Catalog\Api\ProductRepositoryInterface;

/**
 * Class MigrateImages
 * @package SM\Migration\Console
 */
class MigrateImages extends Command
{
    /**
     * @var DirectoryList
     */
    private $directoryList;
    /**
     * @var ClientFactory
     */
    private $clientFactory;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * MigrateImages constructor.
     * @param DirectoryList $directoryList
     * @param ClientFactory $clientFactory
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param string|null $name
     */
    public function __construct(
        DirectoryList $directoryList,
        ClientFactory $clientFactory,
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        string $name = null
    )
    {
        $this->directoryList = $directoryList;
        $this->clientFactory = $clientFactory;
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('migration:product:images');
        $this->setDescription('Migration product images from old site to new site');
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return $this|int
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("migration start");

        $criteria = $this->searchCriteriaBuilder->create();
        $products = $this->productRepository->getList($criteria);
//        if ($products->getTotalCount() > 0) {
//            foreach ($products->getItems() as $product) {
//
//            }
//        }

//        $client = $this->clientFactory->create();
//        $client->get('https://butywolka24.eu/pub/media/catalog/product/cache/19d4e819f05f80a93108f33f97eed5f0/d/s/dsc06399_1_7.jpg');
//
//        if ($client->getBody()) {
//            file_put_contents($this->directoryList->getPath(
//                    DirectoryList::MEDIA) . '/wysiwyg/dsc06397_1_12.jpg',
//                $client->getBody()
//            );
//        }

        $output->writeln("migration success");
        return $this;
    }
}
