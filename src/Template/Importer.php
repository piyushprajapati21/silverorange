<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

class Importer extends Layout
{
    protected function renderPage(Context $context): string
    {  
        return <<<HTML
        <div class="frame">
                         <h2>Json Files fetched and Data imported Successfully....</h2>
                </div>
        HTML;
        // @codingStandardsIgnoreEnd
    }
}
