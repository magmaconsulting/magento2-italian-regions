<?php
namespace Magma\ItalianRegions\Setup;

use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Directory\Helper\Data;

class UpgradeData implements UpgradeDataInterface {

    /**
     * Directory data
     *
     * @var Data
     */
    private $directoryData;

    /**
     * Constructor
     *
     * @param Data $directoryData
     */
    public function __construct(Data $directoryData)
    {
        $this->directoryData = $directoryData;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context ) {
        if (version_compare($context->getVersion(), '1.1.0', '<' )) {
            $data = [
                'FC' => 'Forlì-Cesena',
            ];

            foreach ($data as $code => $name) {
                $sql = "SELECT region_id from " . $setup->getTable('directory_country_region') . " where code like '$code' and country_id like 'IT'";
                $regionIdArray = $setup->getConnection()->fetchAll($sql);
                if (count($regionIdArray) == 1) {
                    $regionId = $regionIdArray[0]['region_id'];
                    echo "\nUPDATE $code (region_id: $regionId) IN $name\n";
                    $sql = "UPDATE " . $setup->getTable('directory_country_region_name') . " SET name = '$name' where locale like 'it_IT' and region_id = $regionId";
                    $setup->getConnection()->query($sql);
                } else {
                    echo "\nERROR UPDATING $code IN $name: regionId not found in " . $setup->getTable('directory_country_region') . " table.\n";
                }
            }
        }
    }
}
