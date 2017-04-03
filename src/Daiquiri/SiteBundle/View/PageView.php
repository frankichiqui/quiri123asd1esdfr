<?php
namespace Daiquiri\SiteBundle\View;

use Pagerfanta\View\DefaultView;
use Daiquiri\SiteBundle\View\Template\PageTemplate;

class PageView extends DefaultView {
    
    protected function createDefaultTemplate() {
        return new PageTemplate();
    }

    protected function getDefaultProximity() {
        return 3;
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'page_view';
    }
}

