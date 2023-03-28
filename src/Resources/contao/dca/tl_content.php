<?php

/*
 * This file is part of the contao teaser bundle.
 *
 * Copyright (c) 2017 Janosch Oltmanns
 *
 */

$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = ['tl_content_teaser_bundle', 'contentOnloadCallback'];


$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = "joAddLinkToTeaser";
$GLOBALS['TL_DCA']['tl_content']['palettes']['teaserelement'] = '{type_legend},type,headline,joTeaserSubheadline;{text_legend},text;{image_legend},addImage;{link_legend},joAddLinkToTeaser;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['simpleteaserelement'] = '{type_legend},type,headline,joTeaserSubheadline;{image_legend},addImage;{link_legend},joAddLinkToTeaser;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['subpalettes']['joAddLinkToTeaser'] = 'url,target,linkTitle,embed,titleText,rel';

$GLOBALS['TL_DCA']['tl_content']['fields']['joTeaserSubheadline'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['joTeaserSubheadline'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'inputUnit',
    'options'                 => ['h2', 'h3', 'h4', 'h5', 'h6'],
    'eval'                    => ['maxlength'=>200, 'tl_class'=>'w50'],
    'sql'                     => "varchar(255) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_content']['fields']['joAddLinkToTeaser'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['joAddLinkToTeaser'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => ['submitOnChange'=>true],
    'sql'                     => "char(1) NOT NULL default ''"
];

class tl_content_teaser_bundle extends \Contao\Backend {

    public function contentOnloadCallback($dc) {

        $objCte = \Contao\ContentModel::findByPk($dc->id);

        if ($objCte === null) {
            return;
        }

        switch ($objCte->type) {
            case 'teaserelement':
                $GLOBALS['TL_DCA']['tl_content']['fields']['text']['eval']['mandatory'] = false;
                break;
        }
    }

}
