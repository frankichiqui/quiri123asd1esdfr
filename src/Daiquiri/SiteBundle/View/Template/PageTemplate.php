<?php

namespace Daiquiri\SiteBundle\View\Template;

class PageTemplate extends \Pagerfanta\View\Template\Template {

// copy contents of class from  ./vendor/pagerfanta/pagerfanta/src/Pagerfanta/View/Template/TwitterBootstrapTemplate.php
// and adjust to your preferences

    static protected $defaultOptions = array(
        'previous_message' => 'Prev',
        'next_message' => 'Next',
        'css_disabled_class' => 'next disabled',
        'css_dots_class' => 'dots',
        'css_current_class' => 'active current',
        'dots_text' => '...',
        'container_template' => '<ul class="pagination">%pages%</ul>',
        'page_template' => '<li class="%class%"><a href="%href%">%text%</a></li>',
        'span_template' => '<li class="%class%"><a class="%class%">%text%</a></li>',
        'current_template' => '<li class="%class%"><a class="%class%">%text%</a></li>',
        'dots_template' => '<li class="%class%">%text%</li>',
    );

    public function container() {
        return $this->option('container_template');
    }

    public function page($page) {
        $text = $page;

        return $this->pageWithText($page, $text);
    }

    public function pageWithText($page, $text) {
        $search = array('%href%', '%text%');

        $href = $this->generateRoute($page);
        $replace = array($href, $text);

        return str_replace($search, $replace, $this->option('page_template'));
    }

    public function previousDisabled() {
        return $this->generateSpan($this->option('css_disabled_class'), $this->option('previous_message'));
    }

    public function previousEnabled($page) {
        return $this->pageWithText($page, $this->option('previous_message'));
    }

    public function nextDisabled() {
        return $this->generateSpan($this->option('css_disabled_class'), $this->option('next_message'));
    }

    public function nextEnabled($page) {
        return $this->pageWithText($page, $this->option('next_message'));
    }

    public function first() {
        return $this->page(1);
    }

    public function last($page) {
        return $this->page($page);
    }

    public function current($page) {
        return $this->generateSpanCurrent($this->option('css_current_class'), $page);
    }

    public function separator() {
        return $this->generateSpanDots($this->option('css_dots_class'), $this->option('dots_text'));
    }

    private function generateSpan($class, $page) {
        $search = array('%class%', '%text%');
        $replace = array($class, $page);

        return str_replace($search, $replace, $this->option('span_template'));
    }
    
    private function generateSpanCurrent($class, $page) {
        $search = array('%class%', '%text%');
        $replace = array($class, $page);

        return str_replace($search, $replace, $this->option('current_template'));
    }
    
    private function generateSpanDots($class, $page) {
        $search = array('%class%', '%text%');
        $replace = array($class, $page);

        return str_replace($search, $replace, $this->option('dots_template'));
    }
    
    

}
