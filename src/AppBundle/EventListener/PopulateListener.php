<?php
namespace AppBundle\EventListener;

use FOS\ElasticaBundle\Event\IndexPopulateEvent;
use FOS\ElasticaBundle\Index\IndexManager;

class PopulateListener
{
    /**
     * @var IndexManager
     */
    private $indexManager;
    

    /**
     * @param IndexManager $indexManager
     */
    public function __construct(IndexManager $indexManager)
    {
        $this->indexManager    = $indexManager;
    }

    public function preIndexPopulate(IndexPopulateEvent $event)
    {
        
        $index = $this->indexManager->getIndex($event->getIndex());
        $settings = $index->getSettings();
        $settings->setRefreshInterval(-1);
    }

    public function postIndexPopulate(IndexPopulateEvent $event)
    {
            
        $index = $this->indexManager->getIndex($event->getIndex());
        $settings = $index->getSettings();        
        $index->optimize(['max_num_segments' => 5]);
        $settings->setRefreshInterval('1s');
    }

    
}
