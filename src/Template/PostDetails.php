<?php

namespace silverorange\DevTest\Template;
use silverorange\DevTest\Context;

class PostDetails extends Layout
{
    protected function renderPage(Context $context): string
    {
        // @codingStandardsIgnoreStart
        $id = $context->authorData['id'];
        $name = $context->authorData['full_name'];
        $posttitle = $context->authorData['title'];
        $postbody = nl2br ($context->authorData['body']);
        $createdate = $context->authorData['created_at'];
        
        return <<<HTML
               
                <div class="frame">
                        <h2 class="frame__title">Author Details</h2>
                        <div class="frame__contents">
                            <table cellpadding="5" cellspacing="5" width="100%">
                            <tr><td>Author ID :</td><td>$id </td></tr>
                            <tr><td>Title :</td><td>$posttitle </td></tr>
                            <tr><td>Full Name :</td><td>$name </td></tr>
                            <tr><td valign="top">Description :</td><td style="whitespace:pre;">$postbody </td></tr>
                            <tr><td>created_at :</td><td>$createdate </td></tr> 
                            </table>
                        </div> 
                </div>
HTML;
        // @codingStandardsIgnoreEnd
    }
    

}
