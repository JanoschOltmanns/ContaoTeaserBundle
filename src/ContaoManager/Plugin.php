<?php

/*
 * This file is part of contao teaser bundle.
 *
 * (c) Janosch Oltmanns
 *
 * @license LGPL-3.0-or-later
 */

namespace JanoschOltmanns\ContaoTeaserBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use JanoschOltmanns\ContaoTeaserBundle\JanoschOltmannsContaoTeaserBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(JanoschOltmannsContaoTeaserBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
