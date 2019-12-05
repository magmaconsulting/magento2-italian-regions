<?php
namespace Magma\ItalianRegions\Setup;

use Magento\Directory\Helper\Data;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class InstallData implements InstallDataInterface
{
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

    /**
     * Install: add new regions
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $data = [
            'AG' => 'Agrigento',
            'AL' => 'Alessandria',
            'AN' => 'Ancona',
            'AO' => 'Aosta',
            'AP' => 'Ascoli Piceno',
            'AQ' => 'L\'Aquila',
            'AR' => 'Arezzo',
            'AT' => 'Asti',
            'AV' => 'Avellino',
            'BA' => 'Bari',
            'BG' => 'Bergamo',
            'BI' => 'Biella',
            'BL' => 'Belluno',
            'BN' => 'Benevento',
            'BO' => 'Bologna',
            'BR' => 'Brindisi',
            'BS' => 'Brescia',
            'BT' => 'Barletta-Andria-Trani',
            'BZ' => 'Bolzano',
            'CA' => 'Cagliari',
            'CB' => 'Campobasso',
            'CE' => 'Caserta',
            'CH' => 'Chieti',
            'CL' => 'Caltanissetta',
            'CN' => 'Cuneo',
            'CO' => 'Como',
            'CR' => 'Cremona',
            'CS' => 'Cosenza',
            'CT' => 'Catania',
            'CZ' => 'Catanzaro',
            'EN' => 'Enna',
            'FC' => 'Forlì-Cesena',
            'FE' => 'Ferrara',
            'FG' => 'Foggia',
            'FI' => 'Firenze',
            'FM' => 'Fermo',
            'FR' => 'Frosinone',
            'GE' => 'Genova',
            'GO' => 'Gorizia',
            'GR' => 'Grosseto',
            'IM' => 'Imperia',
            'IS' => 'Isernia',
            'KR' => 'Crotone',
            'LC' => 'Lecco',
            'LE' => 'Lecce',
            'LI' => 'Livorno',
            'LO' => 'Lodi',
            'LT' => 'Latina',
            'LU' => 'Lucca',
            'MB' => 'Monza e della Brianza',
            'MC' => 'Macerata',
            'ME' => 'Messina',
            'MI' => 'Milano',
            'MN' => 'Mantova',
            'MO' => 'Modena',
            'MS' => 'Massa e Carrara',
            'MT' => 'Matera',
            'NA' => 'Napoli',
            'NO' => 'Novara',
            'NU' => 'Nuoro',
            'OR' => 'Oristano',
            'PA' => 'Palermo',
            'PC' => 'Piacenza',
            'PD' => 'Padova',
            'PE' => 'Pescara',
            'PG' => 'Perugia',
            'PI' => 'Pisa',
            'PN' => 'Pordenone',
            'PO' => 'Prato',
            'PR' => 'Parma',
            'PT' => 'Pistoia',
            'PU' => 'Pesaro e Urbino',
            'PV' => 'Pavia',
            'PZ' => 'Potenza',
            'RA' => 'Ravenna',
            'RC' => 'Reggio Calabria',
            'RE' => 'Reggio Emilia',
            'RG' => 'Ragusa',
            'RI' => 'Rieti',
            'RM' => 'Roma',
            'RN' => 'Rimini',
            'RO' => 'Rovigo',
            'SA' => 'Salerno',
            'SI' => 'Siena',
            'SO' => 'Sondrio',
            'SP' => 'La spezia',
            'SR' => 'Siracusa',
            'SS' => 'Sassari',
            'SU' => 'Sud Sardegna',
            'SV' => 'Savona',
            'TA' => 'Taranto',
            'TE' => 'Teramo',
            'TN' => 'Trento',
            'TO' => 'Torino',
            'TP' => 'Trapani',
            'TR' => 'Terni',
            'TS' => 'Trieste',
            'TV' => 'Treviso',
            'UD' => 'Udine',
            'VA' => 'Varese',
            'VB' => 'Verbano Cusio Ossola',
            'VC' => 'Vercelli',
            'VE' => 'Venezia',
            'VI' => 'Vicenza',
            'VR' => 'Verona',
            'VT' => 'Viterbo',
            'VV' => 'Vibo Valentia',
        ];

        foreach ($data as $code => $name) {

            $binds = ['country_id'   => 'IT', 'code' => $code, 'default_name' => $name];
            $setup->getConnection()->insert($setup->getTable('directory_country_region'), $binds);
            $regionId = $setup->getConnection()->lastInsertId($setup->getTable('directory_country_region'));


            $binds = ['locale'=> 'it_IT', 'region_id' => $regionId, 'name'=> $name];
            $setup->getConnection()->insert($setup->getTable('directory_country_region_name'), $binds);
        }

        $setup->endSetup();
    }
}
