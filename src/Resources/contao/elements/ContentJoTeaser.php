<?php

namespace JanoschOltmanns\ContaoTeaserBundle;

use Contao\ContentText;
use Contao\StringUtil;

class ContentJoTeaser extends ContentText {

    /**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_teaserelement';


	/**
	 * Generate the content element
	 */
	protected function compile()
	{

        parent::compile();

        $arrSubHeadline = StringUtil::deserialize($this->joTeaserSubheadline);
		$this->Template->subHeadline = is_array($arrSubHeadline) ? $arrSubHeadline['value'] : $arrSubHeadline;
		$this->Template->subHl = is_array($arrSubHeadline) ? $arrSubHeadline['unit'] : 'h2';

        if ($this->joAddLinkToTeaser) {

            if (strpos($this->url, 'mailto:') === 0) {
                $this->url = StringUtil::encodeEmail($this->url);
            } else {
                $this->url = StringUtil::ampersand($this->url);
            }

            $embed = explode('%s', $this->embed);

            if (strncmp($this->rel, 'lightbox', 8) !== 0) {
                $this->Template->attribute = ' rel="' . $this->rel . '"';
            } else {
                $this->Template->attribute = ' data-lightbox="' . substr($this->rel, 9, -1) . '"';
            }

            // Deprecated since Contao 4.0, to be removed in Contao 5.0
            $this->Template->rel = $this->rel;

            if ($this->linkTitle == '') {
                $this->linkTitle = $this->url;
            }

            $this->Template->href = $this->url;
            $this->Template->embed_pre = $embed[0] ?? '';
            $this->Template->embed_post = $embed[1] ?? '';
            $this->Template->link = $this->linkTitle;
            $this->Template->target = '';

            if ($this->titleText) {
                $this->Template->linkTitle = StringUtil::specialchars($this->titleText);
            }

            // Override the link target
            if ($this->target) {
                $this->Template->target = ' target="_blank"';
            }

            // Unset the title attributes in the back end (see #6258)
            if (TL_MODE === 'BE') {
                $this->Template->title = '';
                $this->Template->linkTitle = '';
            }

            $this->Template->addLink = true;
        }

	}

}
