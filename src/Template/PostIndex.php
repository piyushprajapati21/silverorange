<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

class PostIndex extends Layout
{
    protected function renderPage(Context $context): string
    { 
        
        //$postData = $this->getData($context->postData);
        return <<<HTML
                <p>ALL THE POSTS</p>
                <div class="frame">
                        <h2 class="frame__title">Post Data List </h2><a href="/importer"><small>Click to Import</small></a>
                        <div class="frame__contents">
                          $context->postData  
                        </div>
                </div>
        HTML;
        // @codingStandardsIgnoreEnd
    } 
}
